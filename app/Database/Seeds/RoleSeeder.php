<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 2,
                'nama_role' => 'Admin',
            ],
            [
                'id' => 3,
                'nama_role' => 'Kasir',
            ],
        ];

        $this->db->table('tbl_role')->insertBatch($data);
    }
}
