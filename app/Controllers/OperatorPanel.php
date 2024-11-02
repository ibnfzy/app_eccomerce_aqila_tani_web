<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class OperatorPanel extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();

        if (session('operator_logged_in')) {
            session()->set('totalTransaksiAktif', $this->db->table('transaksi')->whereNotIn('status_transaksi', [
                'Dibatalkan',
                'Selesai'
            ])->countAllResults());
        }

        session()->set('data_toko', $this->db->table('informasi_toko')->get()->getRowArray());
    }

    public function laporan()
    {
        return view('operator/laporan_keuangan', [
            'date' => $this->request->getVar('tanggal_laporan'),
            'data' => $this->db->table('transaksi')->select('transaksi.*, users.nama as nama_user')->join('users', 'users.id_user=transaksi.id_user')->where('YEAR(transaksi.created_at)', $this->request->getVar('tanggal_laporan'))->get()->getResultArray()
        ]);
    }

    public function informasi()
    {
        $this->db->table('informasi_toko')->where('id_informasi_toko', 1)->update([
            'tentang' => $this->request->getVar('tentang'),
            'kontak_wa' => $this->request->getVar('kontak_wa'),
            'alamat' => $this->request->getVar('alamat'),
            'rekening_toko' => $this->request->getVar('rekening_toko')
        ]);

        return redirect()->to(previous_url())->with('type-status', 'success')->with('message', 'Berhasil mengubah data');
    }

    public function operator()
    {
        return view('operator/operator', [
            'data' => $this->db->table('operator')->orderBy('id_operator', 'DESC')->get()->getResultArray(),
        ]);
    }

    public function operator_hapus($id)
    {
        $this->db->table('operator')->where('id_operator', $id)->delete();

        return redirect()->to(route_to('OperatorPanel::operator'))->with('type-status', 'success')->with('message', 'Berhasil menghapus data');
    }

    public function operator_simpan()
    {
        $rules = [
            'username' => [
                'rules' => 'required|is_unique[operator.username]',
                'errors' => [
                    'required' => 'Username wajib diisi',
                    'is_unique' => 'Username sudah terdaftar'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(route_to('OperatorPanel::operator'))->with('type-status', 'error')->with('message', $this->validator->getErrors());
        }

        $this->db->table('operator')->insert([
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role' => $this->request->getPost('role'),
        ]);

        return redirect()->to(route_to('OperatorPanel::operator'))->with('type-status', 'success')->with('message', 'Berhasil menambahkan data');
    }

    public function operator_update()
    {
        $rules = [
            'id_operator' => 'required',
            'username' => [
                'rules' => 'required|is_unique[operator.username,id_operator,{id_operator}]',
                'errors' => [
                    'required' => 'Username wajib diisi',
                    'is_unique' => 'Username sudah terdaftar'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(route_to('OperatorPanel::operator'))->with('type-status', 'error')->with('message', $this->validator->getErrors());
        }

        $this->db->table('operator')->where('id_operator', $this->request->getPost('id_operator'))->update([
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'role' => $this->request->getPost('role'),
        ]);

        return redirect()->to(route_to('OperatorPanel::operator'))->with('type-status', 'success')->with('message', 'Berhasil mengubah data');
    }


    public function operator_update_password()
    {
        $this->db->table('operator')->where('id_operator', $this->request->getPost('id_operator'))->update([
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
        ]);

        return redirect()->to(route_to('OperatorPanel::operator'))->with('type-status', 'success')->with('message', 'Berhasil mengubah data');
    }

    public function barang()
    {
        return view('operator/barang', [
            'data' => $this->db->table('barang')->orderBy('id_barang', 'DESC')->get()->getResultArray(),
        ]);
    }

    public function barang_hapus($id)
    {
        $this->db->table('barang')->where('id_barang', $id)->delete();

        return redirect()->to(route_to('OperatorPanel::barang'))->with('type-status', 'success')->with('message', 'Berhasil menghapus data');
    }

    public function barang_simpan()
    {
        $rules = [
            'images' => [
                'rules' => 'uploaded[images]|max_size[images,2048]|is_image[images]|mime_in[images,image/jpg,image/jpeg,image/png,image/gif]',
                'errors' => [
                    'uploaded' => 'Gambar wajib diisi',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar',
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(route_to('OperatorPanel::barang'))->with('type-status', 'error')->with('message', $this->validator->getErrors());
        }

        $image = $this->request->getFiles('images')['images'];
        $arrImages = [];
        foreach ($image as $key => $item) {
            if ($image[$key]->isValid() && ! $image[$key]->hasMoved()) {
                $newName = $image[$key]->getRandomName();
                $image[$key]->move('uploads', $newName);
                $arrImages[] = $newName;
            }
        }

        $this->db->table('barang')->insert([
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga' => $this->request->getPost('harga'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'stok' => $this->request->getPost('stok'),
            'images' => serialize($arrImages),
        ]);

        return redirect()->to(route_to('OperatorPanel::barang'))->with('type-status', 'success')->with('message', 'Berhasil menambahkan data');
    }

    public function barang_update()
    {
        $this->db->table('barang')->where('id_barang', $this->request->getPost('id_barang'))->update([
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga' => $this->request->getPost('harga'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'stok' => $this->request->getPost('stok'),
        ]);

        return redirect()->to(route_to('OperatorPanel::barang'))->with('type-status', 'success')->with('message', 'Berhasil mengupdate data');
    }

    public function barang_get_images()
    {
        $id = $this->request->getVar('id_barang');
        $data = unserialize($this->db->table('barang')->where('id_barang', $id)->get()->getRow()->images);

        return $this->response->setJSON([
            'data' => $data
        ]);
    }

    public function barang_delete_images()
    {
        $fileName = $this->request->getVar('fileName');
        $id = $this->request->getVar('id_barang');
        $getData = $this->db->table('barang')->where('id_barang', $id)->get()->getRow();
        $data = unserialize($getData->images);
        $key = array_search($fileName, $data);
        unset($data[$key]);
        $this->db->table('barang')->where('id_barang', $id)->update([
            'images' => serialize($data),
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Berhasil menghapus gambar',
            'id_barang' => $id
        ]);
    }

    public function barang_tambah_images()
    {
        $rules = [
            'images' => [
                'rules' => 'uploaded[images]|max_size[images,2048]|is_image[images]|mime_in[images,image/jpg,image/jpeg,image/png,image/gif]',
                'errors' => [
                    'uploaded' => 'Gambar wajib diisi',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar',
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(route_to('OperatorPanel::barang'))->with('type-status', 'error')->with('message', $this->validator->getErrors());
        }

        $getData = $this->db->table('barang')->where('id_barang', $this->request->getPost('id_barang'))->get()->getRow();
        $data = unserialize($getData->images);

        $image = $this->request->getFiles('images')['images'];
        foreach ($image as $key => $item) {
            if ($image[$key]->isValid() && ! $image[$key]->hasMoved()) {
                $newName = $image[$key]->getRandomName();
                $image[$key]->move('uploads', $newName);
                $data[] = $newName;
            }
        }

        $this->db->table('barang')->where('id_barang', $this->request->getPost('id_barang'))->update([
            'images' => serialize($data),
        ]);

        return redirect()->to(route_to('OperatorPanel::barang'))->with('type-status', 'success')->with('message', 'Berhasil mengupdate data');
    }

    public function transaksi_aktif()
    {
        return view('operator/transaksi', [
            'data' => $this->db->table('transaksi')->whereNotIn('status_transaksi', [
                'Selesai',
                'Dibatalkan'
            ])->get()->getResultArray()
        ]);
    }

    public function invoice($id)
    {
        $data = $this->db->table('transaksi')->where('id_transaksi', $id)->get()->getRowArray();

        return view('user/invoice', [
            'data' => $data,
            'dataDetail' => $this->db->table('transaksi_detail')->where('id_transaksi', $id)->get()->getResultArray(),
            'dataToko' => $this->db->table('informasi_toko')->where('id_informasi_toko', 1)->get()->getRowArray(),
            'dataCustomer' => $this->db->table('users')->where('id_user', $data['id_user'])->get()->getRowArray()
        ]);
    }

    public function acc($id)
    {
        $this->db->table('transaksi')->where('id_transaksi', $id)->update([
            'status_transaksi' => 'Diproses'
        ]);

        return redirect()->to(previous_url())->with('type-status', 'success')->with('message', 'Berhasil validasi data');
    }

    public function denied($id)
    {
        $this->db->table('transaksi')->where('id_transaksi', $id)->update([
            'status_transaksi' => 'Dibatalkan'
        ]);

        return redirect()->to(previous_url())->with('type-status', 'success')->with('message', 'Berhasil validasi data');
    }

    public function kirim($id)
    {
        $this->db->table('transaksi')->where('id_transaksi', $id)->update([
            'status_transaksi' => 'Dikirim'
        ]);

        return redirect()->to(previous_url())->with('type-status', 'success')->with('message', 'Sebuah pesanan sedang dalam pengiriman');
    }

    public function jenis_barang()
    {
        return view('operator/jenis_barang', [
            'data' => $this->db->table('jenis_barang')->orderBy('id_jenis_barang', 'DESC')->get()->getResultArray()
        ]);
    }

    public function jenis_barang_tambah()
    {
        $this->db->table('jenis_barang')->insert([
            'nama' => $this->request->getVar('nama')
        ]);

        return redirect()->to(route_to('OperatorPanel::jenis_barang'))->with('type-status', 'success')->with('message', 'Berhasil menambahkan data');
    }

    public function jenis_barang_update()
    {
        $this->db->table('jenis_barang')->where('id_jenis_barang', $this->request->getVar('id_jenis_barang'))->update([
            'nama' => $this->request->getVar('nama')
        ]);

        return redirect()->to(route_to('OperatorPanel::jenis_barang'))->with('type-status', 'success')->with('message', 'Berhasil mengubah data');
    }

    public function jenis_barang_delete($id)
    {
        $this->db->table('jenis_barang')->where('id_jenis_barang', $id)->delete();

        return redirect()->to(route_to('OperatorPanel::jenis_barang'))->with('type-status', 'success')->with('message', 'Berhasil menghapus data');
    }

    public function pelanggan()
    {
        return view('operator/pelanggan', [
            'data' => $this->db->table('users')->get()->getResultArray()
        ]);
    }

    public function review()
    {
        return view('operator/review', [
            'data' => $this->db->table('barang_detail_review')->select('barang_detail_review.*, users.nama as nama, users.username as username, barang.nama_barang as nama_barang')->join('users', 'barang_detail_review.id_user = users.id_user')->join('barang', 'barang_detail_review.id_barang = barang.id_barang')->get()->getResultArray()
        ]);
    }

    public function history_transaksi()
    {
        return view('operator/transaksi', [
            'data' => $this->db->table('transaksi')->whereIn('status_transaksi', [
                'Selesai',
                'Dibatalkan'
            ])->get()->getResultArray()
        ]);
    }

    public function slider()
    {
        return view('operator/slider', [
            'data' => $this->db->table('slider')->get()->getResultArray()
        ]);
    }

    public function slider_tambah()
    {
        $rules = [
            'file' => [
                'rules' => 'uploaded[file]|max_size[file,3048]|is_image[file]|mime_in[file,image/jpg,image/jpeg,image/png,image/gif]',
                'errors' => [
                    'uploaded' => 'Gambar wajib diisi',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar',
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(previous_url())->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $file = $this->request->getFile('file');
        $fileName = $file->getRandomName();

        $this->db->table('slider')->insert([
            'file' => $fileName
        ]);

        $file->move('uploads', $fileName);

        return redirect()->to(route_to('OperatorPanel::slider'))->with('type-status', 'success')->with('message', 'Berhasil menambahkan data');
    }

    public function slider_hapus($id)
    {
        $this->db->table('slider')->where('id_slider', $id)->delete();

        return redirect()->to(route_to('OperatorPanel::slider'))->with('type-status', 'success')->with('message', 'Berhasil menghapus data');
    }
}