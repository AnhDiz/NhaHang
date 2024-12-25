<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bookings extends Migration
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
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'customer_name' =>[
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'phone_number' =>[
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'request' =>[
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'time' =>[
                'type' => 'datetime',
            ],
            'status' =>[
                'type' => 'varchar',
                'constraint' => '100',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('dish_id', true);
        $this->forge->addForeignKey('id', 'tables', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('bookings');
    }

    public function down()
    {
        $this->forge->dropTable('bookings');
    }
}
