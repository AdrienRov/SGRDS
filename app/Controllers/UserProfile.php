<?php

namespace App\Controllers;

class UserProfile extends BaseController
{
	public function __construct()
	{
		helper('breadcrumbs');
	}

    public function MyProfile()
    {
        $session = \Config\Services::session();

        if (!$session->has('user')) {
            return view('commons/CommonPage', [
                'content' => view('Connexion')
            ]);
        }

        $user = $session->get('user');

		$breadcrumbs = getBreadcrumbs(['Accueil', 'Mon profil'], ['accueil', 'userprofile']);

        return view('commons/CommonPage', [
            'content' => view('UserProfile', [
                'user' => $user,
				'breadcrumbs' => $breadcrumbs
            ])
        ]);
    }

    public function EditProfile()
    {
        $session = \Config\Services::session();

        if (!$session->has('user')) {
            return view('commons/CommonPage', [
                'content' => view('Connexion')
            ]);
        }
        $session_user = $session->get('user');

        $request = \Config\Services::request();
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($session_user->id);
        $user->email = $request->getPost('email');
        $user->password = $request->getPost('password');
        $user->first_name = $request->getPost('first_name');
        $user->last_name = $request->getPost('last_name');
        $userModel->update($session_user->id, $user);

        $session->set('user', $user);

        return redirect()->to('/UserProfile');
    }

}

