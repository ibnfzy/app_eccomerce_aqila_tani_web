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
            'data' => $this->db->table('operator')->orderBy('id_operator', 'DESC')->get()->getResult(),
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
}