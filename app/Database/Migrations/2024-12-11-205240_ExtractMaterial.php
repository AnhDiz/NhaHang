<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ExtractMaterial extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' =>[
                'type' => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'material_id' => [
                'type' => 'int',
                'constraint' => 11
            ],
            'quanity' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00,
            ],
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id', 'materials', 'material_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('extract_material');
    }

    public function down()
    {
        $this->forge->dropTable('extract_material');
    }
}
