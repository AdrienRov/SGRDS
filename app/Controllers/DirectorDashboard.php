<?php

namespace App\Controllers;

class DirectorDashboard extends BaseController
{

    public function __construct() {
		helper('breadcrumbs');
    }

    public function Index() {

        $semesterModel = new \App\Models\SemesterModel();
        $semesters = $semesterModel->findAll();

        $resourcesModel = new \App\Models\ResourceModel();
        $resources = $resourcesModel->findAll();

        $userModel = new \App\Models\UserModel();
        $users = $userModel->findAll();

        $userResourceModel = new \App\Models\UserResourceModel();
        $userResources = $userResourceModel->findAll();

        $studentModel = new \App\Models\StudentModel();
        $students = $studentModel->findAll();

        $session = \Config\Services::session();
        $user = $session->get('user');

		$breadcrumbs = getBreadcrumbs(['Accueil'], ['DirectorDashboard']);

        if ($session->has('user') || $user->type = 1) {
            return view('commons/CommonPage', [
                'content' => view('DirectorDashboard', [
                    'semesters' => $semesters,
                    'resources' => $resources,
                    'users' => $users,
                    'userResources' => $userResources,
                    'students' => $students,
					'breadcrumbs' => $breadcrumbs
                ])
            ]);
        }
        return view('commons/CommonPage', [
            'content' => view('Connexion')
        ]);
        
    }

    public function AjoutSemestre() {
        $request = \Config\Services::request();
        $semesterModel = new \App\Models\SemesterModel();
        $semester = new \App\Entities\Semester();
        $semester->fill($request->getPost());
        $semesterModel->insert($semester);
        return redirect()->to('/DirectorDashboard');
    }

    public function SupprimerSemestre($id) {

        $semesterModel = new \App\Models\SemesterModel();
        $semesterModel->delete($id);

        return redirect()->to('/DirectorDashboard');
    }

    public function AjoutUser() {
        $request = \Config\Services::request();
        $userModel = new \App\Models\UserModel();
        $user = new \App\Entities\User();
        $user->fill($request->getPost());
        $userModel->insert($user);
        return redirect()->to('/DirectorDashboard');
    }

    public function supprimerUser($id) {

        $userModel = new \App\Models\UserModel();
        $userModel->delete($id);

        return redirect()->to('/DirectorDashboard');
    }

    public function AjoutResource() {
        $request = \Config\Services::request();
        $resourceModel = new \App\Models\ResourceModel();
        $resource = new \App\Entities\Resource();
        $resource->fill($request->getPost());
        $resourceModel->insert($resource);
        return redirect()->to('/DirectorDashboard');
    }

    public function supprimerResource($id) {

        $resourceModel = new \App\Models\ResourceModel();
        $resourceModel->delete($id);

        return redirect()->to('/DirectorDashboard');
    }

    public function AjoutUserResource() {
        $request = \Config\Services::request();
        $userResourceModel = new \App\Models\UserResourceModel();
        $userResource = new \App\Entities\UserResource();
        $userResource->fill($request->getPost());
        $userResourceModel->insert($userResource);
        return redirect()->to('/DirectorDashboard');
    }

    public function supprimerUserResource($id) {

        $userResourceModel = new \App\Models\UserResourceModel();
        $userResourceModel->delete($id);

        return redirect()->to('/DirectorDashboard');
    }

    public function AjoutStudent() {
        $request = \Config\Services::request();
        $studentModel = new \App\Models\StudentModel();
        $student = new \App\Entities\Student();
        $student->fill($request->getPost());
        $studentModel->insert($student);
        return redirect()->to('/DirectorDashboard');
    }

    public function SupprimerStudent($id) {

        $studentModel = new \App\Models\StudentModel();
        $studentModel->delete($id);

        return redirect()->to('/DirectorDashboard');
    }

    public function ImportStudents() {
        $request = \Config\Services::request();
        $file = $request->getFile('file');
        $file->move('./uploads');
        $file = fopen('./uploads/'.$file->getName(), 'r');
        $studentModel = new \App\Models\StudentModel();
        while (($line = fgetcsv($file)) !== FALSE) {
            $student = new \App\Entities\Student();
            $student->fill([
                'first_name' => $line[0],
                'last_name' => $line[1],
                'email' => $line[2],
                'promotion' => $line[3],
            ]);
            $studentModel->insert($student);
        }
        return redirect()->to('/DirectorDashboard');
    }

}
