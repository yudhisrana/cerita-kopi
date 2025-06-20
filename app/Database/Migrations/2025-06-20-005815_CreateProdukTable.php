<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProdukTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => false,
            ],
            'nama_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'harga' => [
                'type'       => 'DECIMAL',
                'constraint' => '18,2',
                'null'       => false,
            ],
            'stok' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => false,
                'default'  => 0,
            ],
            'kategori_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => false,
            ],
            'satuan_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kategori_id', 'tbl_kategori', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('satuan_id', 'tbl_satuan', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('tbl_produk');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_produk');
    }
}
