<?php

namespace App\Controllers;

class AjoutExam extends BaseController
{
    public function Index() {

        // get semesters
        $semesterModel = new \App\Models\SemesterModel();
        $semesters = $semesterModel->findAll();


        // get resources
        $resourceModel = new \App\Models\ResourceModel();
        $resources = $resourceModel->findAll();

        // get exams
        $examModel = new \App\Models\ExamModel();
        $exams = $examModel->findAll();



        return view('commons/CommonPage', [
            'content' => view('AjoutExam', [
                'semesters' => $semesters,
                'resources' => $resources,
                'exams' => $exams
            ])
        ]);
    }

    public function Ajout() {
        $request = \Config\Services::request();
        $examModel = new \App\Models\ExamModel();
        $exam = new \App\Entities\Exam();
        $exam->fill($request->getPost());
        $examModel->insert($exam);
        return redirect()->to('/AjoutExam');
    }

}
