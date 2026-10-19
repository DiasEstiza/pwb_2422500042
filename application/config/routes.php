<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
*/

$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Admin
$route['admin']        = 'administrator/Admin_dashboard_controller/index';
$route['admin/login']  = 'administrator/admin_auth_controller/index';
$route['admin/logout'] = 'administrator/admin_auth_controller/logout';

// Admin kategori
$route['administrator/kategori'] = 'administrator/kategori_controller/index';
$route['administrator/kategori/tambah'] = 'administrator/kategori_controller/tambah_kategori';
$route['administrator/kategori/hapus/(:num)'] = 'administrator/kategori_controller/hapus_kategori/$1';
$route['administrator/kategori/ubah/(:num)'] = 'administrator/kategori_controller/ubah_kategori/$1';

// Alias agar tautan lama pada modul tetap berjalan
$route['admin/kategori'] = 'administrator/kategori_controller/index';
$route['admin/kategori/tambah'] = 'administrator/kategori_controller/tambah_kategori';
$route['admin/kategori/hapus/(:num)'] = 'administrator/kategori_controller/hapus_kategori/$1';
$route['admin/kategori/ubah/(:num)'] = 'administrator/kategori_controller/ubah_kategori/$1';

$route['administrator/produk'] = 'Produk_controller/index';
$route['administrator/produk/tambah_produk'] = 'Produk_controller/tambah_produk';