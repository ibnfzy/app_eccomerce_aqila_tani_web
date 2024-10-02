<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TransaksiDetail extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi_detail' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'id_transaksi' => [
                'type' => 'INT',
            ],
            'id_barang' => [
                'type' => 'INT',
            ],
            'qty' => [
                'type' => 'INT',
            ],
            'harga' => [
                'type' => 'INT',
            ],
            'nama_barang' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
        ]);

        $this->forge->addKey('id_transaksi_detail', true);
        $this->forge->createTable('transaksi_detail');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi_detail');
    }
}
