<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Layout::dashboard');
service('auth')->routes($routes);

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
    $routes->get('edit/(:num)', 'Anggota::edit/$1');
    $routes->post('store', 'Anggota::store');
    $routes->post('prosesImpor', 'Anggota::prosesImpor');
    $routes->post('edit/(:num)', 'Anggota::edit/$1');
    $routes->post('update/(:num)', 'Anggota::update/$1');
    $routes->get('delete/(:num)', 'Anggota::delete/$1');
});

$routes->group('satker', function () use ($routes) {
    $routes->get('index', 'Satker::index');
    $routes->get('export', 'Satker::export');
    $routes->get('create', 'Satker::create');
    $routes->get('impor', 'Satker::impor');
    $routes->post('store', 'Satker::store');
    $routes->post('prosesImpor', 'Satker::prosesImpor');
    $routes->post('edit/(:num)', 'Satker::edit/$1');
    $routes->post('update/(:num)', 'Satker::update/$1');
    $routes->get('delete/(:num)', 'Satker::delete/$1');
});

$routes->group('kapor', function () use ($routes) {
    $routes->get('index', 'Kapor::index');
    $routes->get('tampil', 'Kapor::tampil');
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
    $routes->get('tampil', 'Pengadaan::tampil');
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
    $routes->get('tampil', 'Sertifikasi::tampil');
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
    $routes->get('tampil', 'Bangunan::tampil');
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
    $routes->get('tampil', 'Kendaraan::tampil');
    $routes->get('export', 'Kendaraan::export');
    $routes->get('create', 'Kendaraan::create');
    $routes->get('impor', 'Kendaraan::impor');
    $routes->post('store', 'Kendaraan::store');
    $routes->post('prosesImpor', 'Kendaraan::prosesImpor');
    $routes->post('edit/(:num)', 'Kendaraan::edit/$1');
    $routes->post('update/(:num)', 'Kendaraan::update/$1');
    $routes->get('delete/(:num)', 'Kendaraan::delete/$1');
});

$routes->group('senpi', function () use ($routes) {
    $routes->get('index', 'Senpi::index');
    $routes->get('tampil', 'Senpi::tampil');
    $routes->get('export', 'Senpi::export');
    $routes->get('create', 'Senpi::create');
    $routes->get('impor', 'Senpi::impor');
    $routes->post('store', 'Senpi::store');
    $routes->post('prosesImpor', 'Senpi::prosesImpor');
    $routes->post('edit/(:num)', 'Senpi::edit/$1');
    $routes->post('update/(:num)', 'Senpi::update/$1');
    $routes->get('delete/(:num)', 'Senpi::delete/$1');
});

$routes->group('jenis', function () use ($routes) {
    $routes->get('index', 'Jenis::index');
    $routes->get('tampil', 'Jenis::tampil');
    $routes->get('export', 'Jenis::export');
    $routes->get('create', 'Jenis::create');
    $routes->get('impor', 'Jenis::impor');
    $routes->post('store', 'Jenis::store');
    $routes->post('prosesImpor', 'Jenis::prosesImpor');
    $routes->post('edit/(:num)', 'Jenis::edit/$1');
    $routes->post('update/(:num)', 'Jenis::update/$1');
    $routes->get('delete/(:num)', 'Jenis::delete/$1');
});

$routes->group('merk', function () use ($routes) {
    $routes->get('index', 'Merk::index');
    $routes->get('tampil', 'Merk::tampil');
    $routes->get('export', 'Merk::export');
    $routes->get('create', 'Merk::create');
    $routes->get('impor', 'Merk::impor');
    $routes->post('store', 'Merk::store');
    $routes->post('prosesImpor', 'Merk::prosesImpor');
    $routes->post('edit/(:num)', 'Merk::edit/$1');
    $routes->post('update/(:num)', 'Merk::update/$1');
    $routes->get('delete/(:num)', 'Merk::delete/$1');
});

$routes->group('bbm', function () use ($routes) {
    $routes->get('index', 'Bbm::index');
    $routes->get('tampil', 'Bbm::tampil');
    $routes->get('export', 'Bbm::export');
    $routes->get('create', 'Bbm::create');
    $routes->get('impor', 'Bbm::impor');
    $routes->post('store', 'Bbm::store');
    $routes->post('prosesImpor', 'Bbm::prosesImpor');
    $routes->post('edit/(:num)', 'Bbm::edit/$1');
    $routes->post('update/(:num)', 'Bbm::update/$1');
    $routes->get('delete/(:num)', 'Bbm::delete/$1');
});

$routes->group('stok', function () use ($routes) {
    $routes->get('index', 'Stok::index');
    $routes->get('tampil', 'Stok::tampil');
    $routes->get('export', 'Stok::export');
    $routes->get('create', 'Stok::create');
    $routes->get('impor', 'Stok::impor');
    $routes->post('store', 'Stok::store');
    $routes->post('prosesImpor', 'Stok::prosesImpor');
    $routes->post('edit/(:num)', 'Stok::edit/$1');
    $routes->post('update/(:num)', 'Stok::update/$1');
    $routes->get('delete/(:num)', 'Stok::delete/$1');
});
