<?php

namespace App\Controllers;

class AjoutExam extends BaseController
{
	public function __construct()
	{
		helper('breadcrumbs');
	}


    public function Index() {
        $session = \Config\Services::session();

        $semesterModel = new \App\Models\SemesterModel();
        $semesters = $semesterModel->findAll();

        $resourceModel = new \App\Models\ResourceModel();
        $resources = $resourceModel->findAll();

        $examModel = new \App\Models\ExamModel();
        $exams = $examModel->findAll();

        $studentModel = new \App\Models\StudentModel();
        $students = $studentModel->findAll();

        $userModel = new \App\Models\UserModel();
        $users = $userModel->findAll();

		$breadcrumbs = getBreadcrumbs(['Accueil', 'Ajout d\'examen'], ['accueil', 'AjoutExam']);

        if (!$session->has('user')) {
            return view('commons/CommonPage', [
                'content' => view('Connexion', [
					'breadcrumbs' => $breadcrumbs
				])
            ]);
        }

        return view('commons/CommonPage', [
            'content' => view('AjoutExam', [
                'semesters' => $semesters,
                'resources' => $resources,
                'exams' => $exams,
                'students' => $students,
                'users' => $users,
				'breadcrumbs' => $breadcrumbs
            ])
        ]);
    }

    public function Ajout() {

        $session = \Config\Services::session();
        if (!$session->has('user')) {
            return view('commons/CommonPage', [
                'content' => view('Connexion')
            ]);
        }

        $request = \Config\Services::request();
        $examModel = new \App\Models\ExamModel();
        $exam = new \App\Entities\Exam();
        $exam->fill($request->getPost());
        $examModel->insert($exam);

        $id = $examModel->getInsertID();
        $students = $request->getPost('students');

        $examStudentModel = new \App\Models\ParticipationModel();
        foreach ($students as $student) {
            $examStudent = new \App\Entities\Participation();
            $examStudent->exam_id = $id;
            $examStudent->student_id = $student;
            $examStudent->status = 1;
            $examStudentModel->insert($examStudent);
        }

        return redirect()->to('/accueil');
    }

    public function Edit($id) {
        $session = \Config\Services::session();
        if (!$session->has('user')) {
            return view('commons/CommonPage', [
                'content' => view('Connexion')
            ]);
        }

        $semesterModel = new \App\Models\SemesterModel();
        $semesters = $semesterModel->findAll();

        $resourceModel = new \App\Models\ResourceModel();
        $resources = $resourceModel->findAll();

        $examModel = new \App\Models\ExamModel();
        $exam = $examModel->find($id);

        $studentModel = new \App\Models\StudentModel();
        $students = $studentModel->findAll();

        $participationModel = new \App\Models\ParticipationModel();
        $participations = $participationModel->where('exam_id', $id)->findAll();

        $userModel = new \App\Models\UserModel();
        $users = $userModel->findAll();

		$breadcrumbs = getBreadcrumbs(['Accueil', 'Rattrapages', 'Modifier'], ['accueil', 'rattrapages', 'AjoutExam/edit/'.$id]);

        return view('commons/CommonPage', [
            'content' => view('EditExam', [
                'semesters' => $semesters,
                'resources' => $resources,
                'exam' => $exam,
                'students' => $students,
                'participations' => $participations,
				'breadcrumbs' => $breadcrumbs,
                'users' => $users
            ])
        ]);
    }

    public function EditExam($id) {

        $request = \Config\Services::request();

        $examModel = new \App\Models\ExamModel();
        $exam = $examModel->find($id);
        $exam->fill($request->getPost());

        if ($exam->status == 100) {
            // delete participations
            $examStudentModel = new \App\Models\ParticipationModel();
            $examStudentModel->where('exam_id', $id)->delete();

            $examModel->delete($id);
            return redirect()->to('/accueil');
        }

        $examModel->update($id, $exam);

        $participations_data = $request->getPost('participations');

        $examStudentModel = new \App\Models\ParticipationModel();

        foreach ($participations_data as $data) {
            $pid = explode('-', $data)[0];
            $status = explode('-', $data)[1];

            if ($status == 100)
            {
                $examStudentModel->delete($pid);
                continue;
            }

            $participation = $examStudentModel->find($pid);
            if ($participation->status == $status) {
                continue;
            }
            $participation->status = $status;
            $examStudentModel->update($pid, $participation);
        }

        return redirect()->to('/accueil');
    }
}