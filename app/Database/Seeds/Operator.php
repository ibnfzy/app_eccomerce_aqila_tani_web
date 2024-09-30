<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Operator extends Seeder
{
    public function run()
    {
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
    }
}