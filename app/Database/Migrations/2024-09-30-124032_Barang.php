<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Barang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_barang' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'nama_barang' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'harga' => [
                'type' => 'INT',
            ],
            'deskripsi' => [
                'type' => 'TEXT',
            ],
            'stok' => [
                'type' => 'INT',
            ],
            'images' => [
                'type' => 'TEXT',
            ],
            'jenis' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ]
        ]);

        $this->forge->addKey('id_barang', true);
        $this->forge->createTable('barang');
    }

    public function down()
    {
        $this->forge->dropTable('barang');
    }
}