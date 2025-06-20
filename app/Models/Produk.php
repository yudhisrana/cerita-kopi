<?php

namespace App\Models;

use CodeIgniter\Model;

class Produk extends Model
{
    protected $table            = 'tbl_produk';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'nama_produk', 'harga', 'stok', 'kategori_id', 'satuan_id', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
    protected $deletedField  = '';

    public function findAllDataWithRelation()
    {
        return $this->select('
            tbl_produk.*,
            tbl_kategori.nama_kategori AS nama_kategori,
            tbl_satuan.nama_satuan AS nama_satuan
        ')
            ->join('tbl_kategori', 'tbl_kategori.id = tbl_produk.kategori_id')
            ->join('tbl_satuan', 'tbl_satuan.id = tbl_produk.satuan_id')
            ->findAll();
    }
}
