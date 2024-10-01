<?php

namespace App\Controllers;

class Home extends BaseController
{
    public $cart;
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->cart = \Config\Services::cart();
    }

    public function index(): string
    {
        return view('web/home');
    }

    public function katalog()
    {
        return view('web/katalog');
    }

    public function tentang()
    {
        return view('web/tentang');
    }

    public function cart()
    {
        return view('web/cart');
    }

    public function add_barang()
    {
        sleep(2);

        $get = $this->db->table('barang')->where('id_barang', $this->request->getPost('id_barang'))->get()->getRowArray();
        $getImg = $this->db->table('barang_detail_gambar')->where('id_barang', $this->request->getPost('id_barang'))->orderBy('id_detail_gambar', 'RANDOM')->get()->getRowArray();

        if ($this->request->getPost('qty') > $get['stok']) {
            return redirect()->to(previous_url())->with('type-status', 'error')
                ->with('message', 'Stok Tidak Mencukupi, silahkan hubungi toko');
        }

        $this->cart->insert([
            'id' => $get['id_barang'],
            'qty' => $this->request->getPost('qty'),
            'price' => $get['harga'],
            'name' => $get['nama_barang'],
            'gambar' => $getImg['file'],
            'stok' => $get['stok'],
            'id_customer' => session()->get('id_customer')
        ]);

        return redirect()->to(base_url('Cart'));
    }

    public function remove_barang($rowId)
    {
        $this->cart->remove($rowId);

        return redirect()->to(base_url('Cart'))->with('type-status', 'success')->with('message', 'Barang Berhasilsil Dihapus');
    }

    public function clear_cart()
    {
        $destroy = new \CodeIgniterCart\Config\Services;

        $destroy->cart()->destroy();

        return redirect()->to(base_url('Cart'));
    }

    public function update_cart()
    {
        $rowid = $this->request->getPost('rowid');
        $qty = $this->request->getPost('qtybutton');
        $stok = $this->request->getPost('stok');
        $status = true;

        foreach ($this->cart->contents() as $i => $item) {
            if ($qty[$i] > $stok[$i]) {
                $status = false;
                break;
            }

            $this->cart->update([
                'rowid' => $rowid[$i],
                'qty' => $qty[$i]
            ]);
        }

        if ($status == false) {
            return redirect()->to(base_url('Cart'))->with('type-status', 'error')
                ->with('message', 'Kuantitas barang melebihi stok');
        }

        return redirect()->to(base_url('Cart'))->with('type-status', 'success')
            ->with('message', 'Berhasil diperbaruhi');
    }

    public function review_star($id)
    {
        $get = $this->db->table('barang_detail_review')->where('id_barang', $id)->get()->getResultArray();

        $rt = [];
        $i = 1;

        foreach ($get as $barang) {
            $rt[] = $barang['rating'];
        }

        $nilai = array_sum($rt);

        $pbagi = count($rt);

        try {
            $rating = $nilai / $pbagi;
        } catch (\Throwable $th) {
            $rating = 0;
        }

        $nbulat = round($rating);
        $nbulat = ($nbulat > 5) ? 5 : $nbulat;
        $star = '<i class="fa fa-star" style="color: lightgrey"></i>';

        if ($nbulat == 1) {
            $star = '<i class="fa fa-star text-warning"></i>';
        } else if ($nbulat == 2) {
            $star = '<i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>';
        } else if ($nbulat == 3) {
            $star = '<i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>';
        } else if ($nbulat == 4) {
            $star = '<i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>';
        } else if ($nbulat == 5) {
            $star = '<i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>
                      <i class="fa fa-star text-warning"></i>';
        }

        return $star;
    }

    public function total_review($id)
    {
        $get = $this->db->table('barang_detail_review')->where('id_barang', $id)->get()->getResultArray();

        return count($get);
    }

    public function review($id)
    {
        return $this->db->table('barang_detail_review')->where('id_barang', $id)->get()->getResultArray();
    }
}
