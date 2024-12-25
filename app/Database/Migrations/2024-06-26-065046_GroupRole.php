<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GroupRole extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'group_id' => [
                'type' => 'int',
                'constraint' => 5,
                'unsigned'   => true
            ],
            'role_id' =>[
                'type' => 'int',
                'constraint' => 5,
                'unsigned'   => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('group_id','group','group_id','CASCADE', 'CASCADE');
        $this->forge->addForeignKey('role_id','role','role_id','CASCADE', 'CASCADE');
        $this->forge->createTable('group_role');
    }

    public function down()
    {
        $this->forge->dropTable('group_role');
    }
}
