<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PrePSeeder extends Seeder
{
    public function run()
    {
        $data =[
            [
                'capacity' => '5',
                'pre_oder_price' => '100000'
            ],
            [
                'capacity' => '7',
                'pre_oder_price' => '150000'
            ],
            [
                'capacity' => '10',
                'pre_oder_price' => '200000'
            ],
        ];
        $this->db->table('pre_oder_price')->insertBatch($data);
    }   
}
