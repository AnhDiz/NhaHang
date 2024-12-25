<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Group extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'group_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'groupName' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'description' =>[
                'type' => 'VARCHAR',
                'constraint' => '100',
            ]
        ]);
        $this->forge->addKey('group_id', true);
        $this->forge->createTable('group');
    }

    public function down()
    {
        $this->forge->dropTable('group');
    }
}
