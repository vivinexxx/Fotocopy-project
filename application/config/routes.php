<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['index'] = 'Controller/index';
$route['logout'] = 'Controller/logout';

$route['menu'] = 'Controller/menu';
$route['database'] = 'Controller/database';
$route['print'] = 'Controller/print';
$route['create'] = 'Controller/tambahData';
$route['update'] = 'Controller/update';
$route['hapus'] = 'Controller/hapusData';
