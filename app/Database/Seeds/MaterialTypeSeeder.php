<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MaterialTypeSeeder extends Seeder
{
    public function run()
    {
        $data =[
            [
                'type_name' => 'Đồ uống đóng chai/lon',
            ],
            [
                'type_name' => 'Đồ tươi',
            ],
            [
                'type_name' => 'Thực phẩm',
            ],
        ];
        $this->db->table('material_type')->insertBatch($data);
    }
}
