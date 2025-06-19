<?php

use App\Controllers\Dashboard;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', function () {
    echo 'hello world';
});

// dashboard
$routes->get('/dashboard', [Dashboard::class, 'index']);
