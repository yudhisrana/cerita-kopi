<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Kategori as ServicesKategori;
use App\Validation\Kategori as ValidationKategori;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class Kategori extends BaseController
{
    protected $kategoriService;
    protected $ruleValidation;
    public function __construct()
    {
        $this->kategoriService = new ServicesKategori();
        $this->ruleValidation = new ValidationKategori();
    }

    public function index()
    {
        $dataKategori = $this->kategoriService->getData();
        $kategori = $dataKategori['success'] ? $dataKategori['data'] : [];
        $data = [
            'page'       => 'kategori',
            'title'      => 'Cerita Kopi - Kategori',
            'table_name' => 'Data Kategori',
            'kategori'   => $kategori,
        ];
        return view('kategori/index', $data);
    }

    public function create()
    {
        $data = [
            'page'      => 'kategori',
            'title'     => 'Cerita Kopi - Kategori',
            'form_name' => 'Form tambah data kategori'
        ];
        return view('kategori/create', $data);
    }

    public function store()
    {
        $rules = $this->ruleValidation->ruleStore();
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', Services::validation());
        }

        $data = [
            'kategori' => $this->request->getPost('kategori'),
        ];

        $result = $this->kategoriService->createData($data);
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['message']);
        }

        return redirect()->to('/master-data/kategori')->with('success', $result['message']);
    }

    public function edit($id)
    {
        $result = $this->kategoriService->getById($id);
        if (!$result['success']) {
            return redirect()->to('/master-data/kategori')->with('error', $result['message']);
        }
        $data = [
            'page'      => 'kategori',
            'title'     => 'Cerita Kopi - Kategori',
            'form_name' => 'Form edit data kategori',
            'kategori'  => $result['data'],
        ];
        return view('kategori/edit', $data);
    }

    public function update($id)
    {
        $rules = $this->ruleValidation->ruleUpdate($id);
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', Services::validation());
        }

        $data = [
            'kategori' => $this->request->getPost('kategori'),
        ];

        $result = $this->kategoriService->updateData($id, $data);
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['message']);
        }

        return redirect()->to('/master-data/kategori')->with('success', $result['message']);
    }

    public function destroy($id)
    {
        $result = $this->kategoriService->deleteData($id);
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
