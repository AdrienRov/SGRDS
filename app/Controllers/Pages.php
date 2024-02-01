<?php

namespace App\Controllers;

class Pages extends BaseController
{
	public function __construct()
    {
        // Charger le helper dans le constructeur
        helper('breadcrumbs');
    }
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

        $examModel = new \App\Models\ExamModel();
        // with original_id is not null
        $exams = $examModel->where('original_id IS NULL')->findAll();

        $semesterModel = new \App\Models\SemesterModel();
        $semesters = $semesterModel->findAll();

        $resourceModel = new \App\Models\ResourceModel();
        $resources = $resourceModel->findAll();

        $userModel = new \App\Models\UserModel();
        $users = $userModel->findAll();

        $user = $session->get('user');

		$breadcrumbs = getBreadcrumbs(['Accueil'], ['accueil']);

        return view('commons/CommonPage', [
            'content' => view('Accueil', [
                'exams' => $exams,
                'semesters' => $semesters,
                'resources' => $resources,
                'users' => $users,
                'user' => $user,
				'breadcrumbs' => $breadcrumbs
            ])
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

        $examModel = new \App\Models\ExamModel();
        $exams = $examModel->findAll();

        $semesterModel = new \App\Models\SemesterModel();
        $semesters = $semesterModel->findAll();

        $resourceModel = new \App\Models\ResourceModel();
        $resources = $resourceModel->findAll();

        $userModel = new \App\Models\UserModel();
        $users = $userModel->findAll();

        $studentModel = new \App\Models\StudentModel();
        $students = $studentModel->findAll();

        $participationModel = new \App\Models\ParticipationModel();
        $participations = $participationModel->findAll();

        $user = $session->get('user');

		$breadcrumbs = getBreadcrumbs(['Accueil', 'Absences'], ['accueil', 'absences']);

        return view('commons/CommonPage', [
            'content' => view('Absences', [
                'exams' => $exams,
                'semesters' => $semesters,
                'resources' => $resources,
                'users' => $users,
                'participations' => $participations,
                'students' => $students,
                'user' => $user,
				'breadcrumbs' => $breadcrumbs
            ])
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
        // with original_id is not null
        $exams = $examModel->where('original_id IS NOT NULL')->findAll();

        $semesterModel = new \App\Models\SemesterModel();
        $semesters = $semesterModel->findAll();

        $resourceModel = new \App\Models\ResourceModel();
        $resources = $resourceModel->findAll();

        $userModel = new \App\Models\UserModel();
        $users = $userModel->findAll();

        $user = $session->get('user');

		$breadcrumbs = getBreadcrumbs(['Accueil', 'Rattrapages'], ['accueil', 'rattrapages']);

        return view('commons/CommonPage', [
            'content' => view('Rattrapages', [
                'exams' => $exams,
                'semesters' => $semesters,
                'resources' => $resources,
                'users' => $users,
                'user' => $user,
				'breadcrumbs' => $breadcrumbs
            ])
        ]);
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

