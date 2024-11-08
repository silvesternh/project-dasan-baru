<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Layout::index');
service('auth')->routes($routes);

$routes->group('admins', function () use ($routes): void {
    $routes->get('/', 'Admins::index');
    $routes->get('new', 'Admins::new');
    $routes->get('edit/(:num)', 'Admins::edit/$1');
    $routes->post('/', 'Admins::create');
    $routes->post('update/(:num)', 'Admins::update/$1');
    $routes->get('delete/(:num)', 'Admins::delete/$1');
});
$routes->get('/layout/index', 'Layout::index');
$routes->get('/layout/tampil', 'Layout::tampil');
$routes->get('/layout/dashboard', 'Layout::dashboard');

$routes->group('kendaraan', function () use ($routes) {
    $routes->get('index', 'Kendaraan::index');
    $routes->get('tambah', 'Kendaraan::tambah');
});


// $routes->post('personil/delete/(:num)', 'Personil::delete/$1');

$routes->group('anggota', function () use ($routes) {
    $routes->get('index', 'Anggota::index');
    $routes->get('export', 'Anggota::export');
    $routes->get('create', 'Anggota::create');
    $routes->get('impor', 'Anggota::impor');
    $routes->post('store', 'Anggota::store');
    $routes->post('prosesImpor', 'Anggota::prosesImpor');
    $routes->post('edit/(:num)', 'Anggota::edit/$1');
    $routes->post('update/(:num)', 'Anggota::update/$1');
    $routes->get('delete/(:num)', 'Anggota::delete/$1');
});

$routes->group('kapor', function () use ($routes) {
    $routes->get('index', 'Kapor::index');
    $routes->get('export', 'Kapor::export');
    $routes->get('create', 'Kapor::create');
    $routes->get('impor', 'Kapor::impor');
    $routes->post('store', 'Kapor::store');
    $routes->post('prosesImpor', 'Kapor::prosesImpor');
    $routes->post('edit/(:num)', 'Kapor::edit/$1');
    $routes->post('update/(:num)', 'Kapor::update/$1');
    $routes->get('delete/(:num)', 'Kapor::delete/$1');
});

$routes->group('pengadaan', function () use ($routes) {
    $routes->get('index', 'Pengadaan::index');
    $routes->get('export', 'Pengadaan::export');
    $routes->get('create', 'Pengadaan::create');
    $routes->get('impor', 'Pengadaan::impor');
    $routes->post('store', 'Pengadaan::store');
    $routes->post('prosesImpor', 'Pengadaan::prosesImpor');
    $routes->post('edit/(:num)', 'Pengadaan::edit/$1');
    $routes->post('update/(:num)', 'Pengadaan::update/$1');
    $routes->get('delete/(:num)', 'Pengadaan::delete/$1');
});

$routes->group('sertifikasi', function () use ($routes) {
    $routes->get('index', 'Sertifikasi::index');
    $routes->get('export', 'Sertifikasi::export');
    $routes->get('create', 'Sertifikasi::create');
    $routes->get('impor', 'Sertifikasi::impor');
    $routes->post('store', 'Sertifikasi::store');
    $routes->post('prosesImpor', 'Sertifikasi::prosesImpor');
    $routes->post('edit/(:num)', 'Sertifikasi::edit/$1');
    $routes->post('update/(:num)', 'Sertifikasi::update/$1');
    $routes->get('delete/(:num)', 'Sertifikasi::delete/$1');
});

$routes->group('tanah', function () use ($routes) {
    $routes->get('index', 'Tanah::index');
    $routes->get('tampil', 'Tanah::tampil');
    $routes->get('export', 'Tanah::export');
    $routes->get('create', 'Tanah::create');
    $routes->get('impor', 'Tanah::impor');
    $routes->post('store', 'Tanah::store');
    $routes->post('prosesImpor', 'Tanah::prosesImpor');
    $routes->post('edit/(:num)', 'Tanah::edit/$1');
    $routes->post('update/(:num)', 'Tanah::update/$1');
    $routes->get('delete/(:num)', 'Tanah::delete/$1');
});


$routes->group('bangunan', function () use ($routes) {
    $routes->get('index', 'Bangunan::index');
    $routes->get('export', 'Bangunan::export');
    $routes->get('create', 'Bangunan::create');
    $routes->get('impor', 'Bangunan::impor');
    $routes->post('store', 'Bangunan::store');
    $routes->post('prosesImpor', 'Bangunan::prosesImpor');
    $routes->post('edit/(:num)', 'Bangunan::edit/$1');
    $routes->post('update/(:num)', 'Bangunan::update/$1');
    $routes->get('delete/(:num)', 'Bangunan::delete/$1');
});

$routes->group('kendaraan', function () use ($routes) {
    $routes->get('index', 'Kendaraan::index');
    $routes->get('export', 'Kendaraan::export');
    $routes->get('create', 'Kendaraan::create');
    $routes->get('impor', 'Kendaraan::impor');
    $routes->post('store', 'Kendaraan::store');
    $routes->post('prosesImpor', 'Kendaraan::prosesImpor');
    $routes->post('edit/(:num)', 'Kendaraan::edit/$1');
    $routes->post('update/(:num)', 'Kendaraan::update/$1');
    $routes->get('delete/(:num)', 'Kendaraan::delete/$1');
});
// $routes->post('Anggota/update', 'Anggota::update');
