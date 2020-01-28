<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller {
  public function index($entityType, $entityId, $size = 'original') {
    if (preg_match("/^[a-z]+$/", $entityType) === false) {
      die('Error type');
    } elseif (preg_match("/^[0-9]+$/", $entityType) === false) {
      die('Error id');
    }

    $directory = FCPATH . 'uploads/' . $entityType . '/' . $entityId . '/';

    $files = glob($directory . $size . '.*', GLOB_BRACE);

    if (!$files) { die('Error file'); }

    $imageInfo = getimagesize($files[0]);

    header('Content-type: ' . $imageInfo['mime']);
    readfile($files[0]);
  }
}
