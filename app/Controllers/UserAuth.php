<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserAuth extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('login/user');
    }

    public function auth()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $data = $this->db->table('users')->where('username', $username)->get()->getRowArray();

        if (!$data) {
            return redirect()->to(route_to('UserAuth::index'))->with('type-status', 'error')->with('message', 'Username tidak ditemukan');
        }

        if (!password_verify($password, $data['password'])) {
            return redirect()->to(route_to('UserAuth::index'))->with('type-status', 'error')->with('message', 'Password tidak sesuai');
        }

        session()->set('data_user', $data);
        session()->set('user_logged_in', true);
        return redirect()->to(route_to('UserPanel::index'));
    }

    public function logout()
    {
        session()->remove('user_logged_in');
        session()->remove('data_user');

        return redirect()->to(route_to('UserAuth::index'));
    }

    public function daftar()
    {
        return view('login/daftar');
    }

    public function daftar_akun()
    {
        $rules = [
            'username' => [
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => 'Username wajib diisi',
                    'is_unique' => 'Username sudah terdaftar'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(route_to('UserAuth::daftar'))->with('type-status', 'error')->with('message', $this->validator->getErrors());
        }

        $this->db->table('users')->insert([
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'nama' => $this->request->getPost('nama'),
            'alamat_pengiriman' => $this->request->getPost('alamat_pengiriman'),
        ]);

        return redirect()->to(route_to('UserAuth::index'))->with('type-status', 'success')->with('message', 'Akun berhasil dibuat');
    }
}