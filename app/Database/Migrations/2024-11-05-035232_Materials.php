<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Materials extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'material_id' => [
            'type'           => 'INT',
            'constraint'     => 11,
            'auto_increment' => true,
            'unsigned'       => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'number_start' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00, // Đặt giá trị mặc định để tránh NULL
            ],
            'number_now' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00, // Đặt giá trị mặc định để tránh NULL
            ],
            'price_per_unit' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00, // Đặt giá trị mặc định để tránh NULL
            ],
            'material_type_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'constraint' => 11,
            ],
            'unit' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'constraint' => 11,
            ],
            'time' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('material_id', true);
        $this->forge->addForeignKey('material_type_id', 'material_type', 'material_type_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('unit', 'material_unit', 'material_unit_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('materials');
    }

    public function down()
    {
        $this->forge->dropTable('materials');
    }
}
