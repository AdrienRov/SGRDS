<?php

namespace App\Controllers;

class Semester extends BaseController
{
    public function FindAll() {
        // return json with all semesters
        $semesterModel = new \App\Models\SemesterModel();
        $semesters = $semesterModel->findAll();
        return json_encode($semesters);
    }

}
