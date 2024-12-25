<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PreOderPrice extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'capacity' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'pre_oder_price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('capacity', true);
        $this->forge->createTable('pre_oder_price');
    }

    public function down()
    {
        $this->forge->dropTable('pre_oder_price');
    }
}
