<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function isIndexPage() {
  $CI = &get_instance();

  return $CI->router->fetch_class() === 'welcome' && $CI->router->fetch_method() === 'index';
}
