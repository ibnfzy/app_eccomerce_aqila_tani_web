<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('Katalog', 'Home::katalog');
$routes->get('Katalog/(:num)', 'Home::detail/$1');
$routes->get('Tentang', 'Home::tentang');

$routes->get('Cart', 'Home::cart');
$routes->get('Cart/Delete/(:segment)', 'Home::remove_barang/$1');
$routes->get('Cart/Clear', 'Home::clear_cart');
$routes->post('Cart/Update', 'Home::update_cart');
$routes->post('Cart/Add', 'Home::add_barang');

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
});