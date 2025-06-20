<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Produk as ServicesProduk;
use App\Validation\Produk as ValidationProduk;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class Produk extends BaseController
{
    protected $produkService;
    protected $ruleValidation;
    public function __construct()
    {
        $this->produkService = new ServicesProduk();
        $this->ruleValidation = new ValidationProduk();
    }

    public function index()
    {
        $dataProduk = $this->produkService->getData();
        $produk = $dataProduk['success'] ? $dataProduk['data'] : [];
        $data = [
            'page'       => 'produk',
            'title'      => 'Cerita Kopi - Produk',
            'table_name' => 'Data Produk',
            'produk'     => $produk,
        ];
        return view('produk/index', $data);
    }

    public function create()
    {
        $dataKategori = $this->produkService->getDataKategori();
        $kategori = $dataKategori['success'] ? $dataKategori['data'] : [];

        $dataSatuan = $this->produkService->getDataSatuan();
        $satuan = $dataSatuan['success'] ? $dataSatuan['data'] : [];

        $data = [
            'page'      => 'produk',
            'title'     => 'Cerita Kopi - Produk',
            'form_name' => 'Form tambah data produk',
            'kategori'  => $kategori,
            'satuan'    => $satuan,
        ];
        return view('produk/create', $data);
    }

    public function store()
    {
        $rules = $this->ruleValidation->ruleStore();
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', Services::validation());
        }

        $data = [
            'produk'   => $this->request->getPost('produk'),
            'harga'    => $this->request->getPost('harga'),
            'stok'     => $this->request->getPost('stok'),
            'kategori' => $this->request->getPost('kategori'),
            'satuan'   => $this->request->getPost('satuan'),
        ];

        $result = $this->produkService->createData($data);
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['message']);
        }

        return redirect()->to('/master-data/produk')->with('success', $result['message']);
    }

    public function edit($id)
    {
        $result = $this->produkService->getById($id);
        if (!$result['success']) {
            return redirect()->to('/master-data/produk')->with('error', $result['message']);
        }

        $dataKategori = $this->produkService->getDataKategori();
        $kategori = $dataKategori['success'] ? $dataKategori['data'] : [];

        $dataSatuan = $this->produkService->getDataSatuan();
        $satuan = $dataSatuan['success'] ? $dataSatuan['data'] : [];

        $data = [
            'page'      => 'produk',
            'title'     => 'Cerita Kopi - Produk',
            'form_name' => 'Form edit data produk',
            'produk'    => $result['data'],
            'kategori'  => $kategori,
            'satuan'    => $satuan,
        ];
        return view('produk/edit', $data);
    }

    public function update($id)
    {
        $rules = $this->ruleValidation->ruleUpdate();
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', Services::validation());
        }

        $data = [
            'produk'   => $this->request->getPost('produk'),
            'harga'    => $this->request->getPost('harga'),
            'stok'     => $this->request->getPost('stok'),
            'kategori' => $this->request->getPost('kategori'),
            'satuan'   => $this->request->getPost('satuan'),
        ];

        $result = $this->produkService->updateData($id, $data);
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('error', $result['message']);
        }

        return redirect()->to('/master-data/produk')->with('success', $result['message']);
    }

    public function destroy($id)
    {
        $result = $this->produkService->deleteData($id);
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
