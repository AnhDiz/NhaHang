<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MaterialSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Material A',
                'number_start' => 100.50,
                'number_now' => 80.00,
                'price_per_unit' => 80.00,
                'material_type_id' => 1,
                'unit' => 1,
                'time' => '1200000',
            ],
            [
                'name' => 'Material B',
                'number_start' => 200.00,
                'number_now' => 150.00,
                'price_per_unit' => 150.00,
                'material_type_id' => 2,
                'unit' => 2,
                'time' => '12',
            ],
            [
                'name' => 'Material C',
                'number_start' => 300.25,
                'number_now' => 250.00,
                'price_per_unit' => 20.50,
                'material_type_id' => 3,
                'unit' => 3,
                'time' => '12000',
            ],
        ];

        // Sử dụng Query Builder để chèn dữ liệu
        $this->db->table('materials')->insertBatch($data);
    }
}
