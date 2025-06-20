<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\User as ServicesUser;
use App\Validation\User as ValidationUser;
use CodeIgniter\HTTP\ResponseInterface;

class User extends BaseController
{
    protected $userService;
    protected $ruleValidation;
    public function __construct()
    {
        $this->userService = new ServicesUser();
        $this->ruleValidation = new ValidationUser();
    }

    public function index()
    {
        $dataUser = $this->userService->getData();
        $user = $dataUser['success'] ? $dataUser['data'] : [];
        $data = [
            'page'          => 'user',
            'title'         => 'Cerita Kopi - User',
            'table_name'    => 'Data User',
            'user'          => $user,
        ];
        return view('user/index', $data);
    }

    public function create()
    {
        $dataRole = $this->userService->getDataRole();
        $role = $dataRole['success'] ? $dataRole['data'] : [];
        $data = [
            'page'        => 'user',
            'title'       => 'Cerita Kopi - User',
            'form_name'   => 'Form tambah data User',
            'roles'        => $role,
        ];
        return view('user/create', $data);
    }

    public function store()
    {
        $rules = $this->ruleValidation->ruleStore();
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $imageName = 'default-profile.png';
        $dataImage = $this->request->getFile('image');
        if (!empty($dataImage) && $dataImage->isValid()) {
            $imageName = $dataImage->getRandomName();
            $dataImage->move(FCPATH . 'assets/img/user/', $imageName);
        }

        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'role'         => $this->request->getPost('role'),
            'username'     => $this->request->getPost('username'),
            'password'     => $this->request->getPost('password'),
            'email'        => $this->request->getPost('email'),
            'no_tlp'       => $this->request->getPost('no_tlp'),
            'alamat'       => $this->request->getPost('alamat'),
            'image'        => $imageName,
        ];

        $result = $this->userService->createData($data);
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['message']);
        }

        return redirect()->to('/setting/user')->with('success', $result['message']);
    }

    public function edit($id)
    {
        $result = $this->userService->getById($id);
        if (!$result['success']) {
            return redirect()->to('/setting/user')->with('error', $result['message']);
        }

        $dataRole = $this->userService->getDataRole();
        $role = $dataRole['success'] ? $dataRole['data'] : [];

        $data = [
            'page'      => 'user',
            'title'     => 'Cerita Kopi - User',
            'form_name' => 'Form edit data User',
            'roles'     => $role,
            'user'      => $result['data'],
        ];
        return view('user/edit', $data);
    }

    public function update($id)
    {
        $rules = $this->ruleValidation->ruleUpdate($id);
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $imageName = 'default-profile.png';
        $dataImage = $this->request->getFile('image');
        if (!empty($dataImage) && $dataImage->isValid()) {
            $imageName = $dataImage->getRandomName();
            $dataImage->move(FCPATH . 'assets/img/user/', $imageName);
        }

        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'role'         => $this->request->getPost('role'),
            'username'     => $this->request->getPost('username'),
            'password'     => $this->request->getPost('password'),
            'email'        => $this->request->getPost('email'),
            'no_tlp'       => $this->request->getPost('no_tlp'),
            'alamat'       => $this->request->getPost('alamat'),
            'old_img'      => $this->request->getPost('old-img'),
            'image'        => $imageName,
        ];

        $result = $this->userService->updateData($id, $data);
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['message']);
        }

        return redirect()->to('/setting/user')->with('success', $result['message']);
    }

    public function destroy($id)
    {
        $result = $this->userService->deleteData($id);
        if (!$result['success']) {
            return $this->response
                ->setStatusCode($result['code'])
                ->setJSON($result);
        }

        return $this->response
            ->setStatusCode($result['code'])
            ->setJSON($result);
    }
}
