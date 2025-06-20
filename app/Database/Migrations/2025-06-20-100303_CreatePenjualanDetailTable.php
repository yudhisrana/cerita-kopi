<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePenjualanDetailTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => false,
            ],
            'penjualan_id' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => false,
            ],
            'produk_id' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => false,
            ],
            'jumlah' => [
                'type'       => 'INT',
                'null'       => false,
            ],
            'harga' => [
                'type'       => 'DECIMAL',
                'constraint' => '18,2',
                'null'       => false,
            ],
            'sub_total' => [
                'type'       => 'DECIMAL',
                'constraint' => '18,2',
                'null'       => false,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => false,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('penjualan_id', 'tbl_penjualan', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('produk_id', 'tbl_produk', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('tbl_penjualan_detail');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_penjualan_detail');
    }
}
