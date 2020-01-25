<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function asset($path) {
  $CI = &get_instance();
  $CI->load->helper('url');

  return base_url('assets') . '/' . $path;
}
