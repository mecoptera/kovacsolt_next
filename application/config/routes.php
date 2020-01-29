<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'page';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// $route['authentication/(.+)'] = 'authentication/index/$1';
$route['media/([a-z]+)/(\d+)'] = 'media/index/$1/$2';
$route['media/([a-z]+)/(\d+)/([a-z]+)'] = 'media/index/$1/$2/$3';


$route['panel/dashboard'] = 'panel/dashboard';
$route['panel/base_product_view/(:num)'] = 'admin/base_product_view/index/$1';
$route['panel/base_product_color/(:num)'] = 'admin/base_product_color/index/$1';
$route['panel/base_product_variant/(:num)'] = 'admin/base_product_variant/index/$1';
$route['panel/base_product_zone/(:num)'] = 'admin/base_product_zone/index/$1';
$route['panel/product_variant/(:num)'] = 'admin/product_variant/index/$1';
$route['panel/(.+)'] = 'admin/$1';
$route['contact'] = 'page/contact';
$route['privacy'] = 'page/privacy';
$route['about'] = 'page/about';
