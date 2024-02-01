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
        $error = null;
        if ($user) {
           
            if ($user->checkPassword($password)) {
                $session->set('user', $user);
                return json_encode([
                    'success' => true
                ]);
            } else {
                $error = 'Mot de passe incorrect';
            }
        } else {
            $error = 'Email incorrect';
        }

        // return error in json
        return json_encode([
            'success' => false,
            'error' => $error
        ]);
    }

    public function ForgotPassword()
    {
        $data = $this->request->getPost();
        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('email', $data['email'])->first();

        if (!$user) {
            return json_encode([
                'success' => false,
                'error' => 'Email incorrect'
            ]);
        }

        // random token
        $token = bin2hex(random_bytes(32));
        // set in session
        $session = \Config\Services::session();
        $session->set('reset_token', $token);
        $session->set('reset_user_id', $user->id);

        // generate url to /ResetPassword/$token
        $url = base_url() . '/resetPassword/' . $token;

        // send email to email address with new password
        $email = \Config\Services::email();
        $email->setFrom('noreply@test.fr');
        $email->setTo($data['email']);
        $email->setSubject('Mot de passe oublié');
        $email->setMailType('html');
        $email->setMessage(view('emails/EmailResetPassword', [
            'url' => $url
        ]));
        $email->send();

        return json_encode([
            'success' => true
        ]);

    }

    public function ResetPassword($token)
    {
        $session = \Config\Services::session();
        if (!$session->has('reset_token') || $session->get('reset_token') != $token) {
            return view('commons/CommonPage', [
                'content' => view('Connexion')
            ]);
        }

        return view('commons/CommonPage', [
            'content' => view('ResetPassword')
        ]);
    }
    public function ResetPasswordPost($token)
    {
        $session = \Config\Services::session();
        if (!$session->has('reset_token') || $session->get('reset_token') != $token) {
            return view('commons/CommonPage', [
                'content' => view('Connexion')
            ]);
        }

        $data = $this->request->getPost();
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($session->get('reset_user_id'));
        $user->password = $data['password'];
        $userModel->update($user->id, $user);

        $session->remove('reset_token');
        $session->remove('reset_user_id');

        $email = \Config\Services::email();
        $email->setFrom('noreply@test.fr');
        $email->setTo($user->email);
        $email->setSubject('Mot de passe changer avec success');
        $email->setMessage('Votre mot de passe a été changer avec success');
        $email->send();

        return redirect()->to('/connexion');
    }
}
