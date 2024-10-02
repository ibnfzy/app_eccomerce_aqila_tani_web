<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class OperatorAuth extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function index()
    {
        return view('login/operator');
    }

    public function auth()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $data = $this->db->table('operator')->where('username', $username)->get()->getRowArray();

        if (!$data) {
            return redirect()->to(route_to('OperatorAuth::index'))->with('type-status', 'error')->with('message', 'Username tidak ditemukan');
        }

        if (!password_verify($password, $data['password'])) {
            return redirect()->to(route_to('OperatorAuth::index'))->with('type-status', 'error')->with('message', 'Password salah');
        }

        session()->set('data_operator', $data);
        session()->set('operator_logged_in', true);
        return redirect()->to(route_to('OperatorPanel::index'));
    }

    public function logout()
    {
        session()->remove('operator_logged_in');
        session()->remove('data_operator');

        return redirect()->to(route_to('OperatorAuth::index'));
    }
}