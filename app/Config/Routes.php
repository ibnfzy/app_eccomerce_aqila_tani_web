<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('OperatorPanel', function (RouteCollection $routes) {
  $routes->get('/', function () {
    return redirect()->to(base_url('OperatorPanel/Operator'));
  });

  $routes->get('Operator', 'OperatorPanel::operator');
  $routes->get('Operator/(:num)', 'OperatorPanel::operator_hapus/$1');
  $routes->post('Operator', 'OperatorPanel::operator_simpan');
  $routes->post('Operator/Update', 'OperatorPanel::operator_update');
  $routes->post('Operator/Update/Password', 'OperatorPanel::operator_update_password');
});