<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bills extends Migration
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
            'table_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'email' =>[
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' =>'NULL',
            ],
            'customer_name' =>[
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'phone_number' =>[
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'total' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'status' =>[
                'type' => 'varchar',
                'constraint' => '100',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('table_id', 'tables', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('bills');
    }

    public function down()
    {
        $this->forge->dropTable('bills');
    }
}
