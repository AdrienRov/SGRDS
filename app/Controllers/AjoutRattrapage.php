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

        return view('commons/CommonPage', [
            'content' => view('AjoutRattrapage', [
                'exam' => $exam,
                'resource' => $resource,
                'users' => $users,
                'students' => $students,
                'participations' => $participations
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

        $studentModel = new \App\Models\StudentModel();
        $examStudentModel = new \App\Models\ParticipationModel();
        $resourceModel = new \App\Models\ResourceModel();
        $resource = $resourceModel->find($exam->resource_id);

        $original_id = $request->getPost('original_id');
        // array of checkbox, if checked, copy the participation from the original exam
        $participations = $request->getPost('participations');
        foreach ($participations as $participation) {
            $examStudent = new \App\Entities\Participation();
            $examStudent->exam_id = $id;
            $examStudent->student_id = $participation;
            $examStudent->status = 0;
            $examStudentModel->insert($examStudent);

            $student = $studentModel->find($participation);

            $email = \Config\Services::email();
            $email->setFrom('noreply@test.fr');
            $email->setTo($student->email);
            $email->setSubject('Rattrapage');
            $email->setMailType('html');
            $email->setMessage(view('emails/EmailRattrapage', [
                'student' => $student,
                'exam' => $exam,
                'resource' => $resource
            ]));
            $email->send();


        }

        return redirect()->to('/rattrapages');
    }

}
