<?php

namespace App\Controllers;

class ConnexionController extends BaseController
{
    public function index()
    {
        return view('commons/CommonPage', [
            'content' => view('Semester')
        ]);
    }

    public function getUserById($id)
    {
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($id);
        return $user;
    }

    public function checkConnexion()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('email', $email)->first();
        
        $session = \Config\Services::session();
        if ($user) {
           
            if ($user->checkPassword($password)) {
                $session->set('user', $user);
                return view('commons/CommonPage', [
                    'content' => view('Accueil')
                ]);
            } else {
                $session->setFlashdata('error', 'Mot de passe incorrect');
            }
        } else {
            $session->setFlashdata('error', 'Email incorrect');
        }
        
        $data['error'] = $session->getFlashdata('error');

        return view('commons/CommonPage', [
            'content' => view('Connexion', $data) 
        ]);
    }
}