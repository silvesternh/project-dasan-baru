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
$routes->get('/layout/drenmin', 'Layout::drenmin');
$routes->get('/layout/dfaskon', 'Layout::dfaskon');
$routes->get('/layout/dpal', 'Layout::dpal');
$routes->get('/layout/dada', 'Layout::dada');
$routes->get('/layout/dinfo', 'Layout::dinfo');
$routes->get('/layout/dbekum', 'Layout::dbekum');
$routes->get('/layout/dgudang', 'Layout::dgudang');

$routes->get('/layout/index1', 'Layout::index1');
$routes->get('/layout/dashboard1', 'Layout::dashboard1');

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
    $routes->get('data', 'Kendaraan::data');
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
    $routes->get('data', 'Senpi::data');
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

$routes->group('alsus', function () use ($routes) {
    $routes->get('index', 'Alsus::index');
    $routes->get('data', 'Alsus::data');
    $routes->get('tampil', 'Alsus::tampil');
    $routes->get('export', 'Alsus::export');
    $routes->get('create', 'Alsus::create');
    $routes->get('impor', 'Alsus::impor');
    $routes->post('store', 'Alsus::store');
    $routes->post('prosesImpor', 'Alsus::prosesImpor');
    $routes->post('edit/(:num)', 'Alsus::edit/$1');
    $routes->post('update/(:num)', 'Alsus::update/$1');
    $routes->get('delete/(:num)', 'Alsus::delete/$1');
});

$routes->group('psp', function () use ($routes) {
    $routes->get('index', 'Psp::index');
    $routes->get('tampil', 'Psp::tampil');
    $routes->get('export', 'Psp::export');
    $routes->get('create', 'Psp::create');
    $routes->get('impor', 'Psp::impor');
    $routes->post('store', 'Psp::store');
    $routes->post('prosesImpor', 'Psp::prosesImpor');
    $routes->post('edit/(:num)', 'Psp::edit/$1');
    $routes->post('update/(:num)', 'Psp::update/$1');
    $routes->get('delete/(:num)', 'Psp::delete/$1');
});

$routes->group('stokkapor', function () use ($routes) {
    $routes->get('index', 'Stokkapor::index');
    $routes->get('tampil', 'Stokkapor::tampil');
    $routes->get('export', 'Stokkapor::export');
    $routes->get('create', 'Stokkapor::create');
    $routes->get('impor', 'Stokkapor::impor');
    $routes->post('store', 'Stokkapor::store');
    $routes->post('prosesImpor', 'Stokkapor::prosesImpor');
    $routes->post('edit/(:num)', 'Stokkapor::edit/$1');
    $routes->post('update/(:num)', 'Stokkapor::update/$1');
    $routes->get('delete/(:num)', 'Stokkapor::delete/$1');
});

$routes->group('alsintor', function () use ($routes) {
    $routes->get('index', 'Alsintor::index');
    $routes->get('data', 'Alsintor::data');
    $routes->get('tampil', 'Alsintor::tampil');
    $routes->get('export', 'Alsintor::export');
    $routes->get('create', 'Alsintor::create');
    $routes->get('impor', 'Alsintor::impor');
    $routes->post('store', 'Alsintor::store');
    $routes->post('prosesImpor', 'Alsintor::prosesImpor');
    $routes->post('edit/(:num)', 'Alsintor::edit/$1');
    $routes->post('update/(:num)', 'Alsintor::update/$1');
    $routes->get('delete/(:num)', 'Alsintor::delete/$1');
});

$routes->group('anggotarolog', function () use ($routes) {
    $routes->get('index', 'Anggotarolog::index');
    $routes->get('tampil', 'Anggotarolog::tampil');
    $routes->get('export', 'Anggotarolog::export');
    $routes->get('create', 'Anggotarolog::create');
    $routes->get('impor', 'Anggotarolog::impor');
    $routes->post('store', 'Anggotarolog::store');
    $routes->post('prosesImpor', 'Anggotarolog::prosesImpor');
    $routes->post('edit/(:num)', 'Anggotarolog::edit/$1');
    $routes->post('update/(:num)', 'Anggotarolog::update/$1');
    $routes->get('delete/(:num)', 'Anggotarolog::delete/$1');
});

$routes->group('alkes', function () use ($routes) {
    $routes->get('index', 'Alkes::index');
    $routes->get('data', 'Alkes::data');
    $routes->get('tampil', 'Alkes::tampil');
    $routes->get('export', 'Alkes::export');
    $routes->get('create', 'Alkes::create');
    $routes->get('impor', 'Alkes::impor');
    $routes->post('store', 'Alkes::store');
    $routes->post('prosesImpor', 'Alkes::prosesImpor');
    $routes->post('edit/(:num)', 'Alkes::edit/$1');
    $routes->post('update/(:num)', 'Alkes::update/$1');
    $routes->get('delete/(:num)', 'Alkes::delete/$1');
});

$routes->group('pemegang', function () use ($routes) {
    $routes->get('index', 'Pemegang::index');
    $routes->get('data', 'Pemegang::data');
    $routes->get('tampil', 'Pemegang::tampil');
    $routes->get('export', 'Pemegang::export');
    $routes->get('create', 'Pemegang::create');
    $routes->get('impor', 'Pemegang::impor');
    $routes->post('store', 'Pemegang::store');
    $routes->post('prosesImpor', 'Pemegang::prosesImpor');
    $routes->post('edit/(:num)', 'Pemegang::edit/$1');
    $routes->post('update/(:num)', 'Pemegang::update/$1');
    $routes->get('delete/(:num)', 'Pemegang::delete/$1');
});