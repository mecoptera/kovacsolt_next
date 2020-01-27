<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// $route['authentication/(.+)'] = 'authentication/index/$1';
$route['media/([a-z]+)/(\d+)'] = 'media/index/$1/$2';
$route['media/([a-z]+)/(\d+)/([a-z]+)'] = 'media/index/$1/$2/$3';

$route['panel/dashboard'] = 'panel/dashboard';
$route['panel/base_product_view/(:num)'] = 'admin/base_product_view/index/$1';
$route['panel/(.+)'] = 'admin/$1';
