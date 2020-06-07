<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Media {
  protected $CI;

  public function __construct() {
    $this->CI = &get_instance();
    $this->entityType = '';
    $this->uploadData = null;
    $this->originalPath = '';
  }

  public function upload($entityType, $entityId, $size = 'original') {
    $this->$entityType = $entityType;

    $folder = FCPATH . 'uploads/' . $entityType . '/' . $entityId;

    $config = [
      'upload_path' => $folder,
      'file_name' => $size,
      'file_ext_tolower' => true,
      'overwrite' => true,
      'allowed_types' => 'jpg|png',
    ];

    $this->CI->load->library('upload', $config);

    if (!file_exists($folder)) {
      if (!mkdir($folder, 0777, true)) {
        die('Failed to create folders...');
      }
    } else {
      $this->deleteFiles($entityType, $entityId);
    }

    if (!$this->CI->upload->do_upload('image')) {
      die($this->CI->upload->display_errors());
    }

    require_once APPPATH . '/third_party/image-converter/ImageConverter.php';

    $this->uploadData = $this->CI->upload->data();

    convert($this->uploadData['full_path'], $this->uploadData['full_path'], 100);
    convert($this->uploadData['full_path'], $this->uploadData['file_path'] . $size . '.webp', 100);

    return $this;
  }

  public function resize($size) {
    require_once APPPATH . '/third_party/image-resize/ImageResize.php';

    if ($this->uploadData !== null) {
      $from = $this->uploadData['full_path'];
      $to = $this->uploadData['file_path'] . $size . $this->uploadData['file_ext'];

      resize($from, $to, 240);
      convert($to, $this->uploadData['file_path'] . $size . '.webp', 100);
    }

    return $this;
  }

  public function delete($entityType, $entityId) {
    $this->deleteFiles($entityType, $entityId);
    rmdir($folder);
  }

  private function deleteFiles($entityType, $entityId) {
    $folder = FCPATH . 'uploads/' . $entityType . '/' . $entityId;
    array_map('unlink', glob($folder . '/*.*'));
  }
}
