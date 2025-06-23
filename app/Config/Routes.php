<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Arahkan halaman utama langsung ke halaman login
$routes->get('/', '\App\Modules\Auth\Controllers\AuthController::login');

// Auth Routes
$routes->get('login', '\App\Modules\Auth\Controllers\AuthController::login');
$routes->post('login', '\App\Modules\Auth\Controllers\AuthController::attemptLogin');
$routes->get('logout', '\App\Modules\Auth\Controllers\AuthController::logout');



$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', '\App\Modules\Dashboard\Controllers\DashboardController::index');
    
    // -- RUTE BUKU (MANUAL) --
    $routes->get('buku', '\App\Modules\Buku\Controllers\BukuController::index');
    $routes->get('buku/new', '\App\Modules\Buku\Controllers\BukuController::new'); // Form tambah
    $routes->post('buku', '\App\Modules\Buku\Controllers\BukuController::create'); // Proses simpan
    $routes->get('buku/edit/(:num)', '\App\Modules\Buku\Controllers\BukuController::edit/$1'); // Form edit
    $routes->put('buku/(:num)', '\App\Modules\Buku\Controllers\BukuController::update/$1'); // Proses update
    $routes->delete('buku/(:num)', '\App\Modules\Buku\Controllers\BukuController::delete/$1'); // Proses hapus
    $routes->get('buku/(:num)', '\App\Modules\Buku\Controllers\BukuController::show/$1'); // Tampilkan detail (ditempatkan terakhir)

    // Rute Kategori
    $routes->resource('kategori', ['controller' => '\App\Modules\Kategori\Controllers\KategoriController']);
});
