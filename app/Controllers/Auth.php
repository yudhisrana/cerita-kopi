<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Auth as ServicesAuth;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    protected $authService;
    public function __construct()
    {
        $this->authService = new ServicesAuth;
    }

    public function index()
    {
        $data = [
            'title' => 'SwimUp - Login',
        ];
        return view('login', $data);
    }

    public function attemptLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $result = $this->authService->login($username, $password);
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['message']);
        }

        if (session()->get('role_id') != 2) {
            return redirect()->to('/menu/kasir')->with('success', $result['message']);
        }

        return redirect()->to('/dashboard')->with('success', $result['message']);
    }

    public function attemptLogout()
    {
        $this->authService->logout();
        return redirect()->to('/login');
    }
}
