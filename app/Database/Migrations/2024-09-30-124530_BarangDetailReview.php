<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class BarangDetailReview extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_barang_detail_review' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'id_transaksi' => [
                'type' => 'INT'
            ],
            'id_barang' => [
                'type' => 'INT'
            ],
            'id_user' => [
                'type' => 'INT'
            ],
            'rating' => [
                'type' => 'INT'
            ],
            'review' => [
                'type' => 'TEXT'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'default' => new RawSql('(CURRENT_TIMESTAMP)')
            ]
        ]);

        $this->forge->addKey('id_barang_detail_review', true);

        $this->forge->createTable('barang_detail_review');
    }

    public function down()
    {
        $this->forge->dropTable('barang_detail_review');
    }
}
