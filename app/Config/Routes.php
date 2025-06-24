<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Rute Publik (Bisa diakses tanpa login)
$routes->get('/', '\App\Modules\Auth\Controllers\AuthController::login');
$routes->get('login', '\App\Modules\Auth\Controllers\AuthController::login');
$routes->post('login', '\App\Modules\Auth\Controllers\AuthController::attemptLogin');
$routes->get('logout', '\App\Modules\Auth\Controllers\AuthController::logout');

// --------------------------------------------------------------------

// Rute Terproteksi (Hanya bisa diakses setelah login)
$routes->group('', ['filter' => 'auth'], function($routes) {

    // --- Modul Dashboard ---
    $routes->get('dashboard', '\App\Modules\Dashboard\Controllers\DashboardController::index');

    // --- Modul Buku ---
    $routes->get('buku', '\App\Modules\Buku\Controllers\BukuController::index');
    $routes->get('buku/new', '\App\Modules\Buku\Controllers\BukuController::new');
    $routes->post('buku/create', '\App\Modules\Buku\Controllers\BukuController::create');
    $routes->get('buku/edit/(:num)', '\App\Modules\Buku\Controllers\BukuController::edit/$1');
    $routes->post('buku/update/(:num)', '\App\Modules\Buku\Controllers\BukuController::update/$1');
    $routes->delete('buku/(:num)', '\App\Modules\Buku\Controllers\BukuController::delete/$1');
    $routes->get('buku/(:num)', '\App\Modules\Buku\Controllers\BukuController::show/$1');

    // --- Modul Kategori ---
    $routes->get('kategori', '\App\Modules\Kategori\Controllers\KategoriController::index');
    $routes->get('kategori/new', '\App\Modules\Kategori\Controllers\KategoriController::new');
    $routes->post('kategori/create', '\App\Modules\Kategori\Controllers\KategoriController::create');
    $routes->get('kategori/edit/(:num)', '\App\Modules\Kategori\Controllers\KategoriController::edit/$1');
    $routes->post('kategori/update/(:num)', '\App\Modules\Kategori\Controllers\KategoriController::update/$1');
    $routes->delete('kategori/(:num)', '\App\Modules\Kategori\Controllers\KategoriController::delete/$1');
    
     // --- Modul Manajemen User  ---
    $routes->get('user', '\App\Modules\User\Controllers\UserController::index');
    $routes->get('user/new', '\App\Modules\User\Controllers\UserController::new');
    $routes->post('user/create', '\App\Modules\User\Controllers\UserController::create');
    $routes->get('user/edit/(:num)', '\App\Modules\User\Controllers\UserController::edit/$1');
    $routes->post('user/update/(:num)', '\App\Modules\User\Controllers\UserController::update/$1');
    $routes->delete('user/(:num)', '\App\Modules\User\Controllers\UserController::delete/$1');


});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}