<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'group_id' => '2',
                'role_id' => '4'
            ],
            [
                'group_id' => '3',
                'role_id' => '4'
            ],
        ];
        $this->db->table('group_role')->insertBatch($data);
    }
}
