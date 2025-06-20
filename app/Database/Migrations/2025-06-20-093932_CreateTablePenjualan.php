<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablePenjualan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => false,
            ],
            'no_invoice' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'created_by' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => false,
            ],
            'total' => [
                'type'       => 'DECIMAL',
                'constraint' => '18,2',
                'null'       => false,
            ],
            'ppn' => [
                'type'       => 'DECIMAL',
                'constraint' => '18,2',
                'null'       => false,
            ],
            'diskon' => [
                'type'       => 'DECIMAL',
                'constraint' => '18,2',
                'null'       => false,
                'default'    => '0.00',
            ],
            'metode_pembayaran' => [
                'type'       => 'ENUM',
                'constraint' => ['cash', 'transfer'],
                'null'       => false,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['draft', 'berhasil', 'gagal'],
                'null'       => false,
                'default'    => 'draft',
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
        $this->forge->addUniqueKey('no_invoice');
        $this->forge->addForeignKey('created_by', 'tbl_user', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('tbl_penjualan');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_penjualan');
    }
}
