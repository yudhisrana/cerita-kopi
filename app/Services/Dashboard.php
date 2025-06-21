<?php

namespace App\Services;

class Dashboard
{
    public function getDashboardSummary()
    {
        $db = \Config\Database::connect();

        $today = date('Y-m-d');

        $totalTransaksi = $db->table('tbl_penjualan')
            ->where('DATE(created_at)', $today)
            ->countAllResults();

        $totalPendapatan = $db->table('tbl_penjualan')
            ->selectSum('total')
            ->where('DATE(created_at)', $today)
            ->get()->getRow()->total ?? 0;

        $totalProdukTerjual = $db->table('tbl_penjualan_detail')
            ->selectSum('jumlah')
            ->join('tbl_penjualan', 'tbl_penjualan.id = tbl_penjualan_detail.penjualan_id')
            ->where('DATE(tbl_penjualan.created_at)', $today)
            ->get()->getRow()->jumlah ?? 0;

        $StokHabis = $db->table('tbl_produk')
            ->where('stok =', 0)
            ->countAllResults();

        return [
            'transaksiHariIni'     => $totalTransaksi,
            'pendapatanHariIni'    => $totalPendapatan,
            'produkTerjualHariIni' => $totalProdukTerjual,
            'StokHabis'            => $StokHabis,
        ];
    }
}
