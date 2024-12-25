<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TableSeeder extends Seeder
{
    public function run()
    {
        $data =[
            [
                'table_num' => '01',
                'capacity' => '5',
                'status' => '1',
                'floor' => '1'
            ],
            [
                'table_num' => '02',
                'capacity' => '5',
                'status' => '1',
                'floor' => '1'
            ],
            [
                'table_num' => '03',
                'capacity' => '5',
                'status' => '1',
                'floor' => '1'
            ],
            [
                'table_num' => '04',
                'capacity' => '5',
                'status' => '1',
                'floor' => '1'
            ],
            [
                'table_num' => '05',
                'capacity' => '7',
                'status' => '1',
                'floor' => '2'
            ],
            [
                'table_num' => '06',
                'capacity' => '7',
                'status' => '1',
                'floor' => '2'
            ],
            [
                'table_num' => '07',
                'capacity' => '10',
                'status' => '1',
                'floor' => '2'
            ],
            [
                'table_num' => '08',
                'capacity' => '10',
                'status' => '1',
                'floor' => '2'
            ],
            [
                'table_num' => '09',
                'capacity' => '10',
                'status' => '1',
                'floor' => '2'
            ],
        ];
        $this->db->table('tables')->insertBatch($data);
    }
}
