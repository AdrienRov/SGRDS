<?php

namespace App\Controllers;

class AjoutRattrapage extends BaseController
{
    public function __construct() {

    }
    public function Index($id) {

        $examModel = new \App\Models\ExamModel();
        $exam = $examModel->find($id);

        // get resource of exam
        $resourceModel = new \App\Models\ResourceModel();
        $resource = $resourceModel->find($exam->resource_id);

        $usersModel = new \App\Models\UserModel();
        $users = $usersModel->findAll();

        $studentModel = new \App\Models\StudentModel();
        $students = $studentModel->findAll();

        $participationModel = new \App\Models\ParticipationModel();
        $participations = $participationModel->where('exam_id', $id)->findAll();

		$breadcrumbs = array(
			array(
				'title' => 'Rattrapages',
				'link' => 'AjoutRattrapage'
			)
		);

        return view('commons/CommonPage', [
            'content' => view('AjoutRattrapage', [
                'exam' => $exam,
                'resource' => $resource,
                'users' => $users,
                'students' => $students,
                'participations' => $participations,
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

        $id = $session->get('user')->id;

        $request = \Config\Services::request();
        $examModel = new \App\Models\ExamModel();
        $exam = new \App\Entities\Exam();
        $exam->fill($request->getPost());
        $exam->user_id = $id;
        $examModel->insert($exam);
        $id = $examModel->getInsertID();

        $examStudentModel = new \App\Models\ParticipationModel();
        // copy participations from original exam but only the one with status = 2
        $original_id = $request->getPost('original_id');
        $participations = $examStudentModel->where('exam_id', $original_id)->findAll();
        foreach ($participations as $participation) {
            if ($participation->status == 2) {
                $examStudent = new \App\Entities\Participation();
                $examStudent->exam_id = $id;
                $examStudent->student_id = $participation->student_id;
                $examStudent->status = 0;
                $examStudentModel->insert($examStudent);
            }
        }

        return redirect()->to('/rattrapages');
    }

}
