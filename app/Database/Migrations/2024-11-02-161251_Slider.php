<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Slider extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_slider' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'file' => [
                'type' => 'TEXT'
            ]
        ]);

        $this->forge->addKey('id_slider', true);

        $this->forge->createTable('slider');
    }

    public function down()
    {
        $this->forge->dropTable('slider');
    }
}