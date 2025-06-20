<?php

namespace App\Services;

use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Produk;
use Config\Database;
use Ramsey\Uuid\Uuid;

class Kasir
{
    protected $produkModel;
    protected $penjualanModel;
    protected $penjualanDetailModel;
    public function __construct()
    {
        $this->produkModel = new Produk();
        $this->penjualanModel = new Penjualan();
        $this->penjualanDetailModel = new PenjualanDetail();
    }

    public function getDataProduk()
    {
        try {
            $data = $this->produkModel->findAllDataWithStokReady();
            if (empty($data)) {
                return [
                    'success' => true,
                    'data'    => [],
                ];
            }

            return [
                'success' => true,
                'data'    => $data,
            ];
        } catch (\Throwable $th) {
            log_message('error', $th->getMessage());
            return [
                'success' => false,
                'data'    => [],
            ];
        }
    }

    public function tambahKeKeranjang(string $produkId, int $jumlah): array
    {
        try {
            $produk = $this->produkModel->where('id', $produkId)->first();

            if (!$produk) {
                return [
                    'success' => false,
                    'message' => 'Produk tidak ditemukan.',
                ];
            }

            $cart = session()->get('kasir_cart') ?? [];

            if (isset($cart[$produkId])) {
                $cart[$produkId]['jumlah'] += $jumlah;
                $cart[$produkId]['subtotal'] = $cart[$produkId]['jumlah'] * $produk->harga;
            } else {
                $cart[$produkId] = [
                    'id' => $produk->id,
                    'nama' => $produk->nama_produk,
                    'harga' => $produk->harga,
                    'jumlah' => $jumlah,
                    'subtotal' => $jumlah * $produk->harga,
                ];
            }

            session()->set('kasir_cart', $cart);

            // Update stok
            $this->produkModel
                ->where('id', $produkId)
                ->set('stok', 'stok - ' . $jumlah, false)
                ->update();

            return [
                'success' => true,
                'message' => 'Produk ditambahkan ke tabel.',
            ];
        } catch (\Throwable $th) {
            log_message('error', $th->getMessage());
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $th->getMessage(),
            ];
        }
    }

    public function hapusDariKeranjang(string $produkId): array
    {
        try {
            $cart = session()->get('kasir_cart') ?? [];

            if (!isset($cart[$produkId])) {
                return [
                    'success' => false,
                    'message' => 'Produk tidak ditemukan di keranjang.',
                ];
            }

            // Ambil jumlah yang akan dikembalikan ke stok
            $jumlahDihapus = $cart[$produkId]['jumlah'];

            // Hapus dari keranjang
            unset($cart[$produkId]);

            session()->set('kasir_cart', $cart);

            // Tambahkan kembali ke stok
            $this->produkModel
                ->where('id', $produkId)
                ->set('stok', 'stok + ' . $jumlahDihapus, false)
                ->update();

            return [
                'success' => true,
                'message' => 'Produk berhasil dihapus dari tabel.',
            ];
        } catch (\Throwable $th) {
            log_message('error', $th->getMessage());
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $th->getMessage(),
            ];
        }
    }

    public function checkout(array $data): array
    {
        $db = Database::connect();
        $db->transStart();

        try {
            $penjualanId = Uuid::uuid4()->toString();
            $noInvoice = 'INV-' . strtoupper(substr(uniqid(), -6));

            $this->penjualanModel->insert([
                'id' => $penjualanId,
                'no_invoice' => $noInvoice,
                'created_by' => $data['created_by'],
                'total' => array_sum(array_column($data['cart'], 'subtotal')),
                'ppn' => $data['ppn'],
                'diskon' => $data['diskon'],
                'metode_pembayaran' => $data['metode'],
                'status' => 'berhasil',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            foreach ($data['cart'] as $item) {
                $this->penjualanDetailModel->insert([
                    'id' => Uuid::uuid4()->toString(),
                    'penjualan_id' => $penjualanId,
                    'produk_id' => $item['id'],
                    'jumlah' => $item['jumlah'],
                    'harga' => $item['harga'],
                    'sub_total' => $item['subtotal'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                return [
                    'success' => false,
                    'message' => 'Gagal menyimpan transaksi.',
                ];
            }

            return [
                'success' => true,
                'message' => 'Transaksi berhasil disimpan.',
            ];
        } catch (\Throwable $e) {
            $db->transRollback();
            log_message('error', $e->getMessage());

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan: ' . $e->getMessage(),
            ];
        }
    }
}
