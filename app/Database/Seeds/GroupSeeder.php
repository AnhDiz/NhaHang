<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'groupName' => 'admin',
                'description' => 'Quản trị web'
            ],
            [
                'groupName' => 'user',
                'description' => 'người dùng'
            ]
        ];
        $this->db->table('group')->insertBatch($data);
    }
}
