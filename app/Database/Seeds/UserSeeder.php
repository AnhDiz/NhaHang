<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'admin',
                'email'    => 'admin@gmail.com',
                'password' => password_hash('123456789',PASSWORD_BCRYPT),
                'group_id' => '1',
                'phone_number' => '123456789',
                'is_admin' => '1',
                'is_inside' => '1'
            ],
            [
                'name' => 'manager',
                'email'    => 'manager@gmail.com',
                'password' => password_hash('123456789',PASSWORD_BCRYPT),
                'group_id' => '2',
                'phone_number' => '123456789',
                'is_admin' => '0',
                'is_inside' => '1'
            ]
        ];
        $this->db->table('user')->insertBatch($data);
    }
}
