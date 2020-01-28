<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Media {
  protected $CI;

  public function __construct() {
    $this->CI = &get_instance();
  }

  public function upload($entityType, $entityId) {
    $folder = FCPATH . 'uploads/' . $entityType . '/' . $entityId;

    $config = [
      'upload_path' => $folder,
      'file_name' => 'original',
      'file_ext_tolower' => true,
      'overwrite' => true,
      'allowed_types' => 'jpg|png',
    ];

    $this->CI->load->library('upload', $config);

    if (!file_exists($folder)) {
      if (!mkdir($folder, 0777, true)) {
        die('Failed to create folders...');
      }
    }

    if (!$this->CI->upload->do_upload('image')) {
      $error = [ 'error' => $this->CI->upload->display_errors() ];

      die($error);
    }
  }

  public function delete($entityType, $entityId) {
    $folder = FCPATH . 'uploads/' . $entityType . '/' . $entityId;
    array_map('unlink', glob($folder . '/*.*'));
    rmdir($folder);
  }
}
