<?php namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('login');
    }

    public function processLogin()
    {
        $session = session();
        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            $sessionData = [
                'user_id'    => $user['id'],
                'user_nama'  => $user['nama'],
                'user_email' => $user['email'],
                'isLoggedIn' => TRUE
            ];
            $session->set($sessionData);
            return redirect()->to('/admin/dashboard');
        }

        $session->setFlashdata('msg', 'Email atau Password Salah');
        return redirect()->to('/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
