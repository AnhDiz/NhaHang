<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableDish extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'table_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'dish_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'quantity' => [
                'type'       => 'INT',
                'constraint' => 100,
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'default' => 'CURRENT_TIMESTAMP',
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'default' => 'CURRENT_TIMESTAMP',
                'on_update' => 'CURRENT_TIMESTAMP',
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('table_id', 'tables', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('dish_id', 'dishes', 'id', 'CASCADE', 'CASCADE'); // Sửa tên bảng thành dishes
        $this->forge->createTable('table_dish');
    }

    public function down()
    {
        $this->forge->dropTable('table_dish');
    }
}
