<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Transaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'id_user' => [
                'type' => 'INT'
            ],
            'total_kuantitas' => [
                'type' => 'INT'
            ],
            'total_harga' => [
                'type' => 'INT'
            ],
            'ongkir' => [
                'type' => 'INT'
            ],
            'bukti_bayar' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'jenis_bayar' => [
                'type' => 'ENUM',
                'constraint' => ["COD", "Transfer"]
            ],
            'status_transaksi' => [
                'type' => 'ENUM',
                'constraint' => ["Menunggu Pembayaran", "Dibatalkan", "Diproses", "Dikirim", "Selesai", "Menunggu Konfirmasi Pembayaran"]
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'default' => new RawSql('(CURRENT_TIMESTAMP)')
            ],
        ]);

        $this->forge->addKey('id_transaksi', true);
        $this->forge->createTable('transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi');
    }
}
