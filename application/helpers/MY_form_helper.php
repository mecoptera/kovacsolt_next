<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function old($key) {
  $CI = &get_instance();

  if (is_array($CI->session->flashdata('old'))) {
    return isset($CI->session->flashdata('old')[$key]) ? $CI->session->flashdata('old')[$key] : false;
  } else {
    return false;
  }
}
