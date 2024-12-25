<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MaterialType extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'material_type_id' =>[
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
        $this->forge->addKey('material_type_id', true);
        $this->forge->createTable('material_type');
    }

    public function down()
    {
        $this->forge->dropTable('material_type');
    }
}
