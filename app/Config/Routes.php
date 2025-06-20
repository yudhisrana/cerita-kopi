<?php

use App\Controllers\Dashboard;
use App\Controllers\Kategori;
use App\Controllers\Produk;
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

// master data produk
$routes->get('/master-data/produk', [Produk::class, 'index']);
$routes->get('/master-data/produk/create', [Produk::class, 'create']);
$routes->post('/master-data/produk/store', [Produk::class, 'store']);
$routes->get('/master-data/produk/edit/(:hash)', [Produk::class, 'edit']);
$routes->post('/master-data/produk/update/(:hash)', [Produk::class, 'update']);
$routes->post('/master-data/produk/delete/(:hash)', [Produk::class, 'destroy']);

// master data kategori
$routes->get('/master-data/kategori', [Kategori::class, 'index']);
$routes->get('/master-data/kategori/create', [Kategori::class, 'create']);
$routes->post('/master-data/kategori/store', [Kategori::class, 'store']);
$routes->get('/master-data/kategori/edit/(:num)', [Kategori::class, 'edit']);
$routes->post('/master-data/kategori/update/(:num)', [Kategori::class, 'update']);
$routes->post('/master-data/kategori/delete/(:num)', [Kategori::class, 'destroy']);

// master data satuan
$routes->get('/master-data/satuan', [Satuan::class, 'index']);
$routes->get('/master-data/satuan/create', [Satuan::class, 'create']);
$routes->post('/master-data/satuan/store', [Satuan::class, 'store']);
$routes->get('/master-data/satuan/edit/(:num)', [Satuan::class, 'edit']);
$routes->post('/master-data/satuan/update/(:num)', [Satuan::class, 'update']);
$routes->post('/master-data/satuan/delete/(:num)', [Satuan::class, 'destroy']);
