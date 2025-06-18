<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', function () {
    return redirect()->to('/clientes');
});
$routes->get('/clientes', 'ClientesController::listar');
$routes->get('/clientes/novo', 'ClientesController::novo');
$routes->get('/clientes/editar/(:num)', 'ClientesController::editar/$1');
$routes->post('/clientes/salvar', 'ClientesController::salvar');
$routes->post('clientes/salvar/(:num)', 'ClientesController::salvar/$1');
$routes->get('/clientes/excluir/(:num)', 'ClientesController::excluir/$1');
