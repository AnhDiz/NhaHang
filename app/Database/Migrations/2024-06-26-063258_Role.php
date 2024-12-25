<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Role extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'role_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'url' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'description' =>[
                'type' => 'varchar',
                'constraint' => '100',
            ],
            'type' => [
                'type' => 'varchar',
                'constraint' => '50',
                'default' =>'NULL'
            ]
        ]);
        $this->forge->addKey('role_id', true);
        $this->forge->createTable('role');
    }

    public function down()
    {
        $this->forge->dropTable('role');
    }
}
