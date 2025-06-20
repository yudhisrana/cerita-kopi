<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Penjualan as ServicesPenjualan;
use CodeIgniter\HTTP\ResponseInterface;

class Penjualan extends BaseController
{
    protected $penjualanService;

    public function __construct()
    {
        $this->penjualanService = new ServicesPenjualan();
    }

    public function index()
    {
        $start = $this->request->getGet('start');
        $end   = $this->request->getGet('end');

        $dataPenjualanDetail = $this->penjualanService->getSoldProduct($start, $end);
        $penjualan = $dataPenjualanDetail['success'] ? $dataPenjualanDetail['data'] : [];

        return view('penjualan', [
            'page'       => 'penjualan',
            'title'      => 'Laporan Penjualan',
            'table_name' => 'Laporan Penjualan Produk per Tanggal',
            'penjualan'  => $penjualan,
            'start'      => $start,
            'end'        => $end,
        ]);
    }
}
