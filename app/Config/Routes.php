<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('Katalog', 'Home::katalog');
$routes->get('KatalogJenis/(:num)', 'Home::katalog_jenis/$1');
$routes->get('Katalog/(:num)', 'Home::detail/$1');
$routes->get('Tentang', 'Home::tentang');

$routes->get('Cart', 'Home::cart');
$routes->get('Cart/Delete/(:segment)', 'Home::remove_barang/$1');
$routes->get('Cart/Clear', 'Home::clear_cart');
$routes->post('Cart/Update', 'Home::update_cart');
$routes->post('Cart/Add', 'Home::add_barang');

$routes->group('Auth', function (RouteCollection $routes) {
  $routes->get('User/Login', 'UserAuth::index');
  $routes->post('User/Login', 'UserAuth::auth');
  $routes->get('User/Logout', 'UserAuth::logout');
  $routes->get('User/Daftar', 'UserAuth::daftar');
  $routes->post('User/Daftar', 'UserAuth::daftar_akun');

  $routes->get('Operator/Login', 'OperatorAuth::index');
  $routes->post('Operator/Login', 'OperatorAuth::auth');
  $routes->get('Operator/Logout', 'OperatorAuth::logout');
});

$routes->group('OperatorPanel', function (RouteCollection $routes) {
  $routes->get('/', function () {
    return redirect()->to(base_url('OperatorPanel/Operator'));
  });

  $routes->get('Operator', 'OperatorPanel::operator');
  $routes->get('Operator/(:num)', 'OperatorPanel::operator_hapus/$1');
  $routes->post('Operator', 'OperatorPanel::operator_simpan');
  $routes->post('Operator/Update', 'OperatorPanel::operator_update');
  $routes->post('Operator/Update/Password', 'OperatorPanel::operator_update_password');

  $routes->get('Barang', 'OperatorPanel::barang');
  $routes->get('Barang/(:num)', 'OperatorPanel::barang_hapus/$1');
  $routes->post('Barang', 'OperatorPanel::barang_simpan');
  $routes->post('Barang/Update', 'OperatorPanel::barang_update');
  $routes->post('Barang/GetImage', 'OperatorPanel::barang_get_images');
  $routes->post('Barang/DeleteImage', 'OperatorPanel::barang_delete_images');
  $routes->post('Barang/TambahImage', 'OperatorPanel::barang_tambah_images');

  $routes->get('Transaksi', 'OperatorPanel::transaksi_aktif');
  $routes->get('Invoice/(:num)', 'OperatorPanel::invoice/$1');
  $routes->get('Acc/(:num)', 'OperatorPanel::acc/$1');
  $routes->get('Denied/(:num)', 'OperatorPanel::denied/$1');
  $routes->get('Kirim/(:num)', 'OperatorPanel::kirim/$1');

  $routes->get('JenisBarang', 'OperatorPanel::jenis_barang');
  $routes->post('JenisBarang', 'OperatorPanel::jenis_barang_tambah');
  $routes->post('JenisBarang/Update', 'OperatorPanel::jenis_barang_update');
  $routes->get('JenisBarang/(:num)', 'OperatorPanel::jenis_barang_delete/$1');

  $routes->get('Pelanggan', 'OperatorPanel::pelanggan');

  $routes->get('Review', 'OperatorPanel::review');

  $routes->get('HistoryTransaksi', 'OperatorPanel::history_transaksi');
});

$routes->group('UserPanel', function (RouteCollection $routes) {
  $routes->get('/', function () {
    return redirect()->to(base_url('UserPanel/Home'));
  });

  $routes->get('Home', 'UserPanel::index');
  $routes->get('Checkout', 'UserPanel::checkout');
  $routes->get('Invoice/(:num)', 'UserPanel::invoice/$1');
  $routes->get('Acc/(:num)', 'UserPanel::acc/$1');
  $routes->post('Bayar', 'UserPanel::upload_pembayaran');
});
