<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function Connexion()
    {
        return view('commons/CommonPage', [
            'content' => view('Connexion')
        ]);
    }


    public function Accueil()
    {
        $session = \Config\Services::session();

        if (!$session->has('user')) {
            return view('commons/CommonPage', [
                'content' => view('Connexion')
            ]);
        }

        if ($session->get('user')->type == 1) {
            return redirect()->to('/DirectorDashboard');
        }
        return view('commons/CommonPage', [
            'content' => view('Accueil')
        ]);
    }

    public function Absences()
    {
        $session = \Config\Services::session();

        if (!$session->has('user')) {
            return view('commons/CommonPage', [
                'content' => view('Connexion')
            ]);
        }

        return view('commons/CommonPage', [
            'content' => view('Absences')
        ]);
    }

    public function Rattrapages()
    {
        $session = \Config\Services::session();
        if (!$session->has('user')) {
            return view('commons/CommonPage', [
                'content' => view('Connexion')
            ]);
        }

        $examModel = new \App\Models\ExamModel();
        $exams = $examModel->findAll();

        $semesterModel = new \App\Models\SemesterModel();
        $semesters = $semesterModel->findAll();

        $resourceModel = new \App\Models\ResourceModel();
        $resources = $resourceModel->findAll();

        $userModel = new \App\Models\UserModel();
        $users = $userModel->findAll();

        $user = $session->get('user');

        return view('commons/CommonPage', [
            'content' => view('Rattrapages', [
                'exams' => $exams,
                'semesters' => $semesters,
                'resources' => $resources,
                'users' => $users,
                'user' => $user
            ])
        ]);
    }

    public function isConnected()
    {
        $session = \Config\Services::session();

        if ($session->has('user')) {
            return true;
        }
        return false;
    }

    public function logout()
    {
        $session = \Config\Services::session();
        $session->destroy();
        return view('commons/CommonPage', [
            'content' => view('Connexion')
        ]);
    }
}

