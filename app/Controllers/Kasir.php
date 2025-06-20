<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Kasir as ServicesKasir;
use CodeIgniter\HTTP\ResponseInterface;

class Kasir extends BaseController
{
    protected $kasirService;
    public function __construct()
    {
        $this->kasirService = new ServicesKasir();
    }

    public function index()
    {
        $dataProduk = $this->kasirService->getDataProduk();
        $produk = $dataProduk['success'] ? $dataProduk['data'] : [];

        $data = [
            'title'      => 'Cerita Kopi - Kasir',
            'produk'     => $produk,
        ];
        return view('kasir', $data);
    }

    public function add()
    {
        $produkId = $this->request->getPost('produk');
        $jumlah = (int) $this->request->getPost('jumlah');

        if (!$produkId || $jumlah <= 0) {
            return redirect()->to('/menu/kasir')->with('error', 'Produk dan jumlah harus diisi.');
        }

        $result = $this->kasirService->tambahKeKeranjang($produkId, $jumlah);

        if (!$result['success']) {
            return redirect()->to('/menu/kasir')->with('error', $result['message']);
        }

        return redirect()->to('/menu/kasir');
    }


    public function remove()
    {
        $produkId = $this->request->getPost('produk_id');

        if (!$produkId) {
            return redirect()->to('/menu/kasir')->with('error', 'Produk tidak ditemukan.');
        }

        $result = $this->kasirService->hapusDariKeranjang($produkId);

        if (!$result['success']) {
            return redirect()->to('/menu/kasir')->with('error', $result['message']);
        }

        return redirect()->to('/menu/kasir');
    }

    public function checkout()
    {
        $cart = session()->get('kasir_cart') ?? [];
        $userId = session()->get('user_id');

        if (empty($cart)) {
            return redirect()->to('/menu/kasir')->with('error', 'Tidak ada item di keranjang.');
        }

        $ppnPercent = (float) $this->request->getPost('ppn_percent');
        $ppn = (float) $this->request->getPost('ppn');
        $diskon = (float) $this->request->getPost('diskon');
        $grandTotal = (float) $this->request->getPost('grand_total');
        $metode = $this->request->getPost('metode_pembayaran');

        if (!$metode) {
            return redirect()->to('/menu/kasir')->with('error', 'Pilih metode pembayaran terlebih dahulu.');
        }

        $data = [
            'cart' => $cart,
            'ppn_percent' => $ppnPercent,
            'ppn' => $ppn,
            'diskon' => $diskon,
            'total' => $grandTotal,
            'metode' => $metode,
            'created_by' => $userId,
        ];

        $result = $this->kasirService->checkout($data);

        if (!$result['success']) {
            return redirect()->to('/menu/kasir')->with('error', $result['message']);
        }

        session()->remove('kasir_cart');

        return redirect()->to('/menu/kasir')->with('success', 'Transaksi berhasil disimpan.');
    }
}
