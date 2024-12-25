<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dishs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'dish_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'dish_type_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'description' =>[
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'image' =>[
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('dish_id', true);
        $this->forge->addForeignKey('dish_type_id', 'dish_type', 'type_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('dishs');
    }

    public function down()
    {
        $this->forge->dropTable('dishs');
    }
}
