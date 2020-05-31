<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function cartItemsCount() {
  $CI = &get_instance();
  $CI->load->library('cart', [ 'singleton' => true ]);

  return $CI->cart->quantity();
}
