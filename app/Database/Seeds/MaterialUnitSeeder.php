<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MaterialUnitSeeder extends Seeder
{
    public function run()
    {
        $data =[
            [
                'unit' => 'kg',
                'unit_name' => 'kilogram'
            ],
            [
                'unit' => 'lon/chai',
                'unit_name' => 'Lon/chai '
            ],
            [
                'unit' => 'ml',
                'unit_name' => 'mililit'
            ],
            [
                'unit' => 'bao',
                'unit_name' => 'Bao'
            ],
        ];
        $this->db->table('material_unit')->insertBatch($data);
    }
}
