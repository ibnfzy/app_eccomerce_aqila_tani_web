<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Barang extends Seeder
{
    public function run()
    {
        $this->db->table('barang')->insertBatch([
            [
                'nama_barang' => 'Barang 1',
                'harga' => 10000,
                'stok' => 10,
                'deskripsi' => 'Deskripsi 1',
                'images' => serialize(['1727839585_67e077d02435f8beabb8.jpg', '1727842020_1cf913cc6f24ef51786a.png'])
            ],
            [
                'nama_barang' => 'Barang 2',
                'harga' => 20000,
                'stok' => 20,
                'deskripsi' => 'Deskripsi 2',
                'images' => serialize(['1727839585_67e077d02435f8beabb8.jpg', '1727842020_1cf913cc6f24ef51786a.png'])
            ],
            [
                'nama_barang' => 'Barang 3',
                'harga' => 30000,
                'stok' => 30,
                'deskripsi' => 'Deskripsi 3',
                'images' => serialize(['1727839585_67e077d02435f8beabb8.jpg', '1727842020_1cf913cc6f24ef51786a.png'])
            ],
            [
                'nama_barang' => 'Barang 4',
                'harga' => 40000,
                'stok' => 40,
                'deskripsi' => 'Deskripsi 4',
                'images' => serialize(['1727839585_67e077d02435f8beabb8.jpg', '1727842020_1cf913cc6f24ef51786a.png'])
            ]
        ]);
    }
}
