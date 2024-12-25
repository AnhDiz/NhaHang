<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DishType extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'type_id' =>[
                'type' => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'type_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('type_id', true);
        $this->forge->createTable('dish_type');
    }

    public function down()
    {
        $this->forge->dropTable('dish_type');
    }
}
