<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Rute untuk Autentikasi
$routes->get('/', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::processLogin');
$routes->get('logout', 'Auth::logout');

// Grup rute admin yang dilindungi oleh filter 'auth'
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Admin\Dashboard::index'); // Redirect /admin ke dashboard
    $routes->get('dashboard', 'Admin\Dashboard::index');
    
    // Rute Lengkap untuk Buku
    $routes->get('book', 'Admin\Book::index');
    $routes->get('book/new', 'Admin\Book::new');
    $routes->post('book/create', 'Admin\Book::create');
    $routes->get('book/edit/(:num)', 'Admin\Book::edit/$1');
    $routes->post('book/update/(:num)', 'Admin\Book::update/$1');
    $routes->get('book/delete/(:num)', 'Admin\Book::delete/$1');
	$routes->get('book/view/(:num)', 'Admin\Book::view/$1'); 
    $routes->get('book/read/(:num)', 'Admin\Book::read/$1');
	$routes->post('book/delete-multiple', 'Admin\Book::deleteMultiple');
	$routes->get('sirkulasi', 'Admin\Sirkulasi::index');
	$routes->get('laporan', 'Admin\Laporan::index');
	$routes->get('book', 'Admin\Book::index');
	$routes->get('anggota', 'Admin\Anggota::index');
	$routes->get('sirkulasi', 'Admin\Sirkulasi::index');
	$routes->get('laporan', 'Admin\Laporan::index');
	$routes->get('laporan/sirkulasi', 'Admin\Laporan::sirkulasi');
	$routes->get('laporan/inventaris', 'Admin\Laporan::inventaris');
	$routes->get('pengguna', 'Admin\Pengguna::index'); 
	$routes->get('anggota', 'Admin\Anggota::index');
	$routes->get('anggota/new', 'Admin\Anggota::new');
	$routes->post('anggota/create', 'Admin\Anggota::create');
	$routes->get('anggota/edit/(:num)', 'Admin\Anggota::edit/$1');
	$routes->get('anggota/delete/(:num)', 'Admin\Anggota::delete/$1');
	$routes->get('pengguna', 'Admin\Pengguna::index');
	$routes->get('pengguna/new', 'Admin\Pengguna::new');
	$routes->post('pengguna/create', 'Admin\Pengguna::create');
	$routes->get('pengguna/edit/(:num)', 'Admin\Pengguna::edit/$1');
	$routes->post('pengguna/update/(:num)', 'Admin\Pengguna::update/$1');
	$routes->get('pengguna/delete/(:num)', 'Admin\Pengguna::delete/$1');
	// Sirkulasi
$routes->get('sirkulasi', 'Admin\Sirkulasi::index');

// Laporan
$routes->get('laporan', 'Admin\Laporan::index');
$routes->get('laporan/sirkulasi', 'Admin\Laporan::sirkulasi');
$routes->get('laporan/inventaris', 'Admin\Laporan::inventaris');

// Sirkulasi
$routes->get('sirkulasi', 'Admin\Sirkulasi::index');
$routes->get('sirkulasi/new', 'Admin\Sirkulasi::new');
$routes->post('sirkulasi/create', 'Admin\Sirkulasi::create');
$routes->get('sirkulasi/return/(:num)', 'Admin\Sirkulasi::markAsReturned/$1');
$routes->get('sirkulasi/print/(:num)', 'Admin\Sirkulasi::printReceipt/$1');

});