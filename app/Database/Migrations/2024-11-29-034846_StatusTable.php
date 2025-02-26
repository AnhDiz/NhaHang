<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StatusTable extends Migration
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
            'description' => [
                'type'       => 'varchar',
                'constraint' => '100',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('statusTable');
    }

    public function down()
    {
        $this->forge->dropTable('statusTable');
    }
}
