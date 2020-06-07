<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function asset($path) {
  $CI = &get_instance();
  $CI->load->helper('url');

  return base_url('assets') . '/' . $path;
}

function media($type, $id, $size = 'original') {
  $files = glob(FCPATH . 'uploads/' . $type . '/' . $id . '/' . $size . '.*', GLOB_BRACE);

  if (!$files) { die('Error file'); }

  return base_url('uploads') . '/' . $type . '/' . $id . '/' . basename($files[0]);
}
