<?php

use App\Controllers\Dashboard;
use App\Controllers\Satuan;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', function () {
    echo 'hello world';
});

// dashboard
$routes->get('/dashboard', [Dashboard::class, 'index']);

// master data satuan
$routes->get('/master-data/satuan', [Satuan::class, 'index']);
$routes->get('/master-data/satuan/create', [Satuan::class, 'create']);
$routes->post('/master-data/satuan/store', [Satuan::class, 'store']);
$routes->get('/master-data/satuan/edit/(:num)', [Satuan::class, 'edit']);
$routes->post('/master-data/satuan/update/(:num)', [Satuan::class, 'update']);
$routes->post('/master-data/satuan/delete/(:num)', [Satuan::class, 'destroy']);
