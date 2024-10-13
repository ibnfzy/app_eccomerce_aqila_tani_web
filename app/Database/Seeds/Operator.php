<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class Operator extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $this->db->table('operator')->insertBatch([
            [
                'name' => 'Admin Developer',
                'username' => 'admin',
                'password' => password_hash('admin', PASSWORD_BCRYPT),
                'role' => 'admin'
            ],
            [
                'name' => 'Akun Pemilik Developer',
                'username' => 'pemilik',
                'password' => password_hash('pemilik', PASSWORD_BCRYPT),
                'role' => 'pemilik'
            ]
        ]);

        $this->db->table('users')->insert([
            'username' => 'admin',
            'password' => password_hash('admin', PASSWORD_BCRYPT),
            'nama' => 'Admin Customer',
            'alamat_pengiriman' => 'Jl TOddopuli',
            'nomor_wa' => '6285158668102'
        ]);

        $this->db->table('informasi_toko')->insert([
            'nama_toko' => 'Toko Aqila Tani',
            'tentang' => $faker->paragraph,
            'kontak_wa' => '6222222222',
            'alamat' => $faker->address,
            'rekening_toko' => 'ABC 2222222222 A/n ABC'
        ]);
    }
}
