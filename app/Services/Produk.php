<?php

namespace App\Services;

use App\Models\Kategori;
use App\Models\Produk as ModelsProduk;
use App\Models\Satuan;
use Ramsey\Uuid\Uuid;

class Produk
{
    protected $produkModel;
    protected $kategoriModel;
    protected $satuanModel;
    public function __construct()
    {
        $this->produkModel = new ModelsProduk();
        $this->kategoriModel = new Kategori();
        $this->satuanModel = new Satuan();
    }

    public function getData()
    {
        try {
            $data = $this->produkModel->findAllDataWithRelation();
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

    public function getDataKategori()
    {
        try {
            $data = $this->kategoriModel->findAll();
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

    public function getDataSatuan()
    {
        try {
            $data = $this->satuanModel->findAll();
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

    public function getById($id)
    {
        try {
            $data = $this->produkModel->where('id', $id)->first();
            if (!$data) {
                return [
                    'success' => false,
                    'message' => 'Data tidak ditemukan',
                    'data'    => [],
                ];
            }

            return [
                'success' => true,
                'message' => 'Data ditemukan',
                'data'    => $data,
            ];
        } catch (\Throwable $th) {
            log_message('error', $th->getMessage());
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan : ' . $th->getMessage(),
                'data'    => [],
            ];
        }
    }

    public function createData($data)
    {
        $id = Uuid::uuid4()->toString();

        $newData = [
            'id'          => $id,
            'nama_produk' => $data['produk'],
            'harga'       => $data['harga'],
            'stok'        => $data['stok'],
            'kategori_id' => $data['kategori'],
            'satuan_id'   => $data['satuan'],
        ];

        try {
            if (!$this->produkModel->insert($newData)) {
                return [
                    'success' => false,
                    'message' => 'Gagal menyimpan data produk'
                ];
            }

            return [
                'success' => true,
                'message' => 'Berhasil menyimpan data produk'
            ];
        } catch (\Throwable $th) {
            log_message('error', $th->getMessage());
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan : ' . $th->getMessage(),
            ];
        }
    }

    public function updateData($id, $data)
    {
        $existing = $this->produkModel->where('id', $id)->first();
        if (!$existing) {
            return [
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ];
        }

        $newData = [
            'nama_produk' => $data['produk'],
            'harga'       => $data['harga'],
            'stok'        => $data['stok'],
            'kategori_id' => $data['kategori'],
            'satuan_id'   => $data['satuan'],
            'updated_at'  => date('Y-m-d H:i:s'),
        ];

        try {
            if (!$this->produkModel->update($existing->id, $newData)) {
                return [
                    'success' => false,
                    'message' => 'Gagal update data produk'
                ];
            }

            return [
                'success' => true,
                'message' => 'Berhasil update data produk'
            ];
        } catch (\Throwable $th) {
            log_message('error', $th->getMessage());
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan : ' . $th->getMessage(),
            ];
        }
    }

    public function deleteData($id)
    {
        $existing = $this->produkModel->where('id', $id)->first();
        if (!$existing) {
            return [
                'success' => false,
                'code'    => 404,
                'message' => 'Data tidak ditemukan'
            ];
        }

        try {
            if (!$this->produkModel->delete($existing->id)) {
                return [
                    'success' => false,
                    'code'    => 500,
                    'message' => 'Gagal hapus data produk'
                ];
            }

            return [
                'success' => true,
                'code'    => 200,
                'message' => 'Berhasil hapus data produk'
            ];
        } catch (\Throwable $th) {
            log_message('error', $th->getMessage());
            return [
                'success' => false,
                'code'    => 500,
                'message' => 'Terjadi kesalahan : ' . $th->getMessage(),
            ];
        }
    }
}
