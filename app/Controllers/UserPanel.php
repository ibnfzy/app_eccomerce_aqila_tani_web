<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserPanel extends BaseController
{
    protected $db;
    public $cart;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->cart = \Config\Services::cart();

        if (session('user_logged_in')) {
            session()->set('totalTransaksiAktifCust', $this->db->table('transaksi')->where('id_user', session()->get('data_user')['id_user'])->whereNotIn('status_transaksi', [
                'Dibatalkan',
                'Selesai'
            ])->countAllResults());
        }
    }

    public function index()
    {
        return view('user/home', [
            'data' => $this->db->table('transaksi')->where('id_user', session()->get('data_user')['id_user'])->whereNotIn('status_transaksi', [
                'Dibatalkan',
                'Selesai'
            ])->orderBy('id_transaksi', 'DESC')->get()->getResultArray()
        ]);
    }

    public function invoice($id)
    {
        return view('user/invoice', [
            'data' => $this->db->table('transaksi')->where('id_transaksi', $id)->get()->getRowArray(),
            'dataDetail' => $this->db->table('transaksi_detail')->where('id_transaksi', $id)->get()->getResultArray(),
            'dataToko' => $this->db->table('informasi_toko')->where('id_informasi_toko', 1)->get()->getRowArray(),
            'dataCustomer' => $this->db->table('users')->where('id_user', session('data_user')['id_user'])->get()->getRowArray()
        ]);
    }

    public function checkout()
    {
        $home = new \App\Controllers\Home;
        $cart = [];
        $qtyArr = [];
        $hargaArr = [];
        $i = 0;

        if ($this->cart->totalItems() == 0) {
            return redirect()->to(route_to('Home::cart'))->with('type-status', 'error')->with('message', 'Keranjang Kosong');
        }

        $dataCustomer = $this->db->table('users')->where('id_user', session('data_user')['id_user'])->get()->getRowArray();

        foreach ($this->cart->contents() as $key => $value) {
            $dataBarang = $this->db->table('barang')->where('id_barang', $value['id'])->get()->getRowArray();

            if ($dataBarang['stok'] < $value['qty']) {
                return redirect()->to(route_to('Home::cart'))->with('type-status', 'error')->with('message', 'Terdapat kekurangan stok pada keranjang anda, silahkan dicek ulang');
            }

            $hargaArr[] = $value['price'] * $value['qty'];
            $qtyArr[] = $value['qty'];
            $cart[] = $dataBarang;
            $cart[$i]['qty'] = $value['qty'];
            $cart[$i]['total_harga'] = $value['price'] * $value['qty'];
            $cart[$i]['price'] = $value['price'];

            $this->db->table('barang')->where('id_barang', $value['id'])->update([
                'stok' => $dataBarang['stok'] - $value['qty']
            ]);

            $i++;
        }

        $totalHarga = array_sum($hargaArr);
        $totalBarang = array_sum($qtyArr);
        $ongkir = 10000;
        $totalBayar = $totalHarga + $ongkir;

        $this->db->table('transaksi')->insert([
            'id_user' => session('data_user')['id_user'],
            'total_kuantitas' => $totalBarang,
            'total_harga' => $totalHarga,
            'total_bayar' => $totalBayar,
            'ongkir' => $ongkir,
            'status_transaksi' => 'Menunggu Pembayaran'
        ]);

        $idTransaksi = $this->db->insertID();

        foreach ($cart as $key => $value) {
            $this->db->table('transaksi_detail')->insert([
                'id_transaksi' => $idTransaksi,
                'id_barang' => $value['id_barang'],
                'qty' => $value['qty'],
                'harga' => $value['price'],
                'nama_barang' => $value['nama_barang']
            ]);
        }

        $home->clear_cart();

        return redirect()->to(route_to('UserPanel::invoice', $idTransaksi))->with('type-status', 'success')->with('message', 'Berhasil checkout belanjaan');
    }

    public function upload_pembayaran()
    {
        $jenis_bayar = $this->request->getPost('jenis_bayar');

        if ($jenis_bayar == 'Transfer') {
            $rules = [
                'bukti_bayar' => [
                    'rules' => 'uploaded[bukti_bayar]|max_size[bukti_bayar,2048]|is_image[bukti_bayar]|mime_in[bukti_bayar,image/jpg,image/jpeg,image/png,image/gif]',
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

            $file = $this->request->getFile('bukti_bayar');
            $fileName = $file->getRandomName();

            if (!$file->hasMoved()) {
                $file->move('uploads', $fileName);
            }

            $this->db->table('transaksi')->where('id_transaksi', $this->request->getPost('id_transaksi'))->update([
                'bukti_bayar' => $fileName,
                'status_transaksi' => 'Menunggu Konfirmasi Pembayaran'
            ]);
        } else {
            $this->db->table('transaksi')->where('id_transaksi', $this->request->getPost('id_transaksi'))->update([
                'status_transaksi' => 'Menunggu Konfirmasi COD'
            ]);
        }

        return redirect()->to(previous_url())->with('type-status', 'success')->with('message', 'Berhasil, silahkan menunggu Toko mengkonfirmasi');
    }

    public function acc($id)
    {
        $this->db->table('transaksi')->where('id_transaksi', $id)->update([
            'status_transaksi' => 'Selesai'
        ]);

        return redirect()->to(base_url('UserPanel/Invoice/' . $id))->with('type-status', 'success')->with('message', 'Berhasil menerima pesanan');
    }

    public function review_add()
    {
        $this->db->table('barang_detail_review')->insert([
            'id_transaksi' => $this->request->getVar('id_transaksi'),
            'id_barang' => $this->request->getVar('id_barang'),
            'id_user' => session('data_user')['id_user'],
            'rating' => $this->request->getVar('rating') ?? 0,
            'review' => $this->request->getVar('review')
        ]);

        return redirect()->to(previous_url())->with('type-status', 'success')->with('message', 'Berhasil mereview barang');
    }

    public function checkIfReviewExist($id_transaksi, $id_barang): bool
    {
        $check = $this->db->table('barang_detail_review')->where('id_transaksi', $id_transaksi)->where('id_barang', $id_barang)->get()->getRowArray();

        if ($check != null) {
            return true;
        }

        return false;
    }

    public function review()
    {
        return view('user/review', [
            'data' => $this->db->table('barang_detail_review')->select('barang_detail_review.*, barang.nama_barang as nama_barang')->join('barang', 'barang.id_barang=barang_detail_review.id_barang')->where('barang_detail_review.id_user', session('data_user')['id_user'])->get()->getResultArray()
        ]);
    }

    public function informasi()
    {
        $this->db->table('users')->where('id_user', session('data_user')['id_user'])->update([
            'username' => $this->request->getVar('username'),
            'nama' => $this->request->getVar('nama'),
            'alamat_pengiriman' => $this->request->getVar('alamat_pengiriman'),
            'nomor_wa' => $this->request->getVar('nomor_wa')
        ]);

        return redirect()->to(previous_url())->with('type-status', 'success')->with('message', 'Berhasil mengubah data');
    }

    public function password()
    {
        $this->db->table('users')->where('id_user', session('data_user')['id_user'])->update([
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)
        ]);

        return redirect()->to(previous_url())->with('type-status', 'success')->with('message', 'Berhasil mengubah data');
    }
}