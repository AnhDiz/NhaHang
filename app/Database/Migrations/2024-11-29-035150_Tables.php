<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tables extends Migration
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
            'table_num' => [
                'type'       => 'int',
                'constraint' => '11',
            ],
            'capacity' => [
                'type' => 'int',
                'constraint'     => '11',
            ],
            'status' => [
                'type'       => 'INT',
                'constraint' => '11',
                'unsigned'       => true,
            ],
            'floor' =>[
                'type' => 'INT',
                'constraint' => '11'  
            ],
            'position' =>[
                'type' => 'varchar',
                'constraint' => '100'
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('capacity', 'pre_oder_price', 'capacity', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('status', 'statustable', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tables');
    }

    public function down()
    {
        $this->forge->dropTable('tables');
    }
}
