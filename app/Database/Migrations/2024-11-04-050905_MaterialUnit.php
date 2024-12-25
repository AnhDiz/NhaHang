<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MaterialUnit extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'material_unit_id' =>[
                'type' => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'unit' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'unit_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('material_unit_id', true);
        $this->forge->createTable('material_unit');
    }

    public function down()
    {
        $this->forge->dropTable('material_unit');
    }
}
