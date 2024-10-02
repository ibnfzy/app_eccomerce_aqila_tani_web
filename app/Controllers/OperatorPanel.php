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
}
