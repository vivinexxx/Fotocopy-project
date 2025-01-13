<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['index'] = 'Controller/index';
$route['logout'] = 'Controller/logout';

$route['fotocopy'] = 'FcController/fotocopy';
$route['fotocopy/create'] = 'Controller/tambahData';
$route['fotocopy/update'] = 'Controller/update';
$route['fotocopy/hapus'] = 'Controller/hapusData';

$route['pegawai'] = 'Controller/pegawai';
$route['pegawai/create'] = 'Controller/tambahData';
$route['pegawai/update'] = 'Controller/update';
$route['pegawai/hapus'] = 'Controller/hapusData';

$route['barang'] = 'BarangController/barang';
$route['barang/create'] = 'BarangController/tambahDataBarang';
$route['barang/update'] = 'BarangController/updateBarang';
$route['barang/hapus'] = 'BarangController/hapusDataBarang';
