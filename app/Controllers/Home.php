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

        session()->set('data_jenis', $this->db->table('jenis_barang')->get()->getResultArray());
        session()->set('cartTotalItems', $this->cart->totalItems());
    }

    public function index(): string
    {
        return view('web/home', [
            'slider' => $this->db->table('slider')->get()->getResultArray(),
            'rekom' => $this->db->table('transaksi_detail')->select('transaksi_detail.id_barang, SUM(transaksi_detail.qty) AS total_qty, barang.nama_barang, barang.harga, barang.deskripsi, barang.images')->join('barang', 'transaksi_detail.id_barang = barang.id_barang')->groupBy('transaksi_detail.id_barang')->orderBy('total_qty', 'DESC')->get(4)->getResultArray()
        ]);
    }

    public function katalog()
    {
        return view('web/katalog', [
            'data' => $this->db->table('barang')->orderBy('id_barang', 'DESC')->get()->getResultArray()
        ]);
    }

    public function katalog_jenis($id)
    {
        $getKategori = $this->db->table('jenis_barang')->where('id_jenis_barang', $id)->get()->getRowArray();

        return view('web/katalog', [
            'data' => $this->db->table('barang')->where('jenis', $getKategori['nama'])->orderBy('id_barang', 'DESC')->get()->getResultArray()
        ]);
    }

    public function detail($id)
    {
        return view('web/detail', [
            'data' => $this->db->table('barang')->where('id_barang', $id)->get()->getRowArray(),
            'review' => $this->db->table('barang_detail_review')->join('users', 'users.id_user = barang_detail_review.id_user')->where('barang_detail_review.id_barang', $id)->get()->getResultArray()
        ]);
    }

    public function tentang()
    {
        return view('web/tentang');
    }

    public function cart()
    {
        $data = $this->cart->contents();

        foreach ($data as $key => $value) {
            $getBarang = $this->db->table('barang')->where('id_barang', $value['id'])->get()->getRowArray();

            if ($value['qty'] > $getBarang['stok']) {
                $this->cart->update([
                    'rowid' => $value['rowid'],
                    'qty' => $getBarang['stok'],
                ]);
            }

            $this->cart->update([
                'rowid' => $value['rowid'],
                'stok' => $getBarang['stok']
            ]);
        }

        return view('web/cart', [
            'data' => $data
        ]);
    }

    public function add_barang()
    {
        sleep(1);

        $get = $this->db->table('barang')->where('id_barang', $this->request->getPost('id_barang'))->get()->getRowArray();
        $stillErr = false;
        $err = false;
        $ImgArr = unserialize($get['images']);

        if ($this->request->getPost('qty') > $get['stok']) {
            return redirect()->to(previous_url())->with('type-status', 'error')
                ->with('message', 'Stok Tidak Mencukupi, silahkan hubungi toko');
        }

        foreach ($this->cart->contents() as $key => $value) {
            if ($value['id'] == $get['id_barang']) {

                if (($value['qty'] + $this->request->getPost('qty')) > $get['stok']) {

                    $stillErr = true;

                    $this->cart->update([
                        'rowid' => $value['rowid'],
                        'qty' => $get['stok']
                    ]);
                }
            }
        }

        if ($stillErr == false) {
            $this->cart->insert([
                'id' => $get['id_barang'],
                'qty' => $this->request->getPost('qty'),
                'price' => $get['harga'],
                'name' => $get['nama_barang'],
                'gambar' => $ImgArr[array_rand($ImgArr)],
                'stok' => $get['stok'],
                'id_customer' => session()->get('id_customer')
            ]);
        }

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
        return $this->db->table('barang_detail_review')->join('users', 'users.id_user=barang_detail_review.id_user')->where('id_barang', $id)->get()->getResultArray();
    }
}
