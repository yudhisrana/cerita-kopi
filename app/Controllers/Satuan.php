<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Satuan as ServicesSatuan;
use App\Validation\Satuan as ValidationSatuan;
use CodeIgniter\HTTP\ResponseInterface;

class Satuan extends BaseController
{
    protected $satuanService;
    protected $ruleValidation;
    public function __construct()
    {
        $this->satuanService = new ServicesSatuan();
        $this->ruleValidation = new ValidationSatuan();
    }

    public function index()
    {
        $dataSatuan = $this->satuanService->getData();
        $satuan = $dataSatuan['success'] ? $dataSatuan['data'] : [];
        $data = [
            'page'       => 'satuan',
            'title'      => 'Cerita Kopi - Satuan',
            'table_name' => 'Data Satuan',
            'satuan'     => $satuan,
        ];
        return view('satuan/index', $data);
    }

    public function create()
    {
        $data = [
            'page'      => 'satuan',
            'title'     => 'Cerita Kopi - Satuan',
            'form_name' => 'Form tambah data satuan'
        ];
        return view('satuan/create', $data);
    }

    public function store()
    {
        $rules = $this->ruleValidation->ruleStore();
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $data = [
            'satuan' => $this->request->getPost('satuan'),
        ];

        $result = $this->satuanService->createData($data);
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['message']);
        }

        return redirect()->to('/master-data/satuan')->with('success', $result['message']);
    }

    public function edit($id)
    {
        $result = $this->satuanService->getById($id);
        if (!$result['success']) {
            return redirect()->to('/master-data/satuan')->with('error', $result['message']);
        }
        $data = [
            'page'      => 'satuan',
            'title'     => 'Cerita Kopi - Satuan',
            'form_name' => 'Form edit data satuan',
            'satuan'    => $result['data'],
        ];
        return view('satuan/edit', $data);
    }

    public function update($id)
    {
        $rules = $this->ruleValidation->ruleUpdate($id);
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $data = [
            'satuan' => $this->request->getPost('satuan'),
        ];

        $result = $this->satuanService->updateData($id, $data);
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['message']);
        }

        return redirect()->to('/master-data/satuan')->with('success', $result['message']);
    }

    public function destroy($id)
    {
        $result = $this->satuanService->deleteData($id);
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
