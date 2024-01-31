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

        return view('commons/CommonPage', [
            'content' => view('AjoutRattrapage', [
                'exam' => $exam,
                'resource' => $resource,
                'users' => $users
            ])
        ]);
    }

    public function Ajout() {
        $request = \Config\Services::request();
        $examModel = new \App\Models\ExamModel();
        $exam = new \App\Entities\Exam();
        $exam->fill($request->getPost());
        $examModel->insert($exam);
        return redirect()->to('/rattrapages');
    }

}
