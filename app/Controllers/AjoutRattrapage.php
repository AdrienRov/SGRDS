<?php

namespace App\Controllers;

class AjoutRattrapage extends BaseController
{
    public function Index() {

        $id = $this->request->getGet('id');
        // get exam of id
        $examModel = new \App\Models\ExamModel();
        $exam = $examModel->find($id);
        // get first of array
        $exam = $exam[0];

        // get resource of exam
        $resourceModel = new \App\Models\ResourceModel();
        $resource = $resourceModel->find($exam->resource_id);


        return view('commons/CommonPage', [
            'content' => view('AjoutRattrapage', [
                'exam' => $exam,
                'resource' => $resource
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
