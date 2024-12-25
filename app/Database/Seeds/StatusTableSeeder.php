<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'description' => 'trống'
            ],
            [
                'description' => 'được đặt / chờ'
            ],
            [
                'description' => 'đang ăn'
            ],
        ];
        $this->db->table('statusTable')->insertBatch($data);
    }
}
