<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserPanel extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('user/home', [
            'data' => $this->db->table('transaksi')->where('id_user', session()->get('data_user')['id_user'])->get()->getResultArray()
        ]);
    }

    public function invoice($id)
    {
        return view('user/invoice', []);
    }
}