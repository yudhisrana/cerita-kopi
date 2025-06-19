<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRoleTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => false,
            ],
            'nama_role' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('nama_role');
        $this->forge->createTable('tbl_role');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_role');
    }
}
