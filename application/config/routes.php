<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'page';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['media/([a-z]+)/(\d+)'] = 'media/index/$1/$2';
$route['media/([a-z]+)/(\d+)/([a-z]+)'] = 'media/index/$1/$2/$3';

$route['admin/base_product_view/(:num)'] = 'admin/base_product_view/index/$1';
$route['admin/base_product_color/(:num)'] = 'admin/base_product_color/index/$1';
$route['admin/base_product_variant/(:num)'] = 'admin/base_product_variant/index/$1';
$route['admin/base_product_zone/(:num)'] = 'admin/base_product_zone/index/$1';
$route['admin/product_variant/(:num)'] = 'admin/product_variant/index/$1';

$route['login'] = 'authentication/index';
$route['logout'] = 'authentication/logout';
$route['registration'] = 'authentication/registration';
$route['user/activate'] = "user/activate";
$route['user/activate/(:any)'] = "user/activate/$1";

$route['contact'] = 'message/index';
$route['privacy'] = 'page/privacy';
$route['about'] = 'page/about';
$route['products/(:num)'] = 'product/index/$1';
$route['product/(:num)'] = 'product/view/$1';
$route['planner/variant/(.+)'] = 'planner/variant/$1';
$route['cart'] = 'cart_controller/index';
$route['cart(.+)'] = 'cart_controller$1';
$route['order'] = 'order_controller/index';
$route['order(.+)'] = 'order_controller$1';
