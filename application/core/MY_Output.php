<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Output extends CI_Output {
  public function json($data, $statusCode) {
    $this->set_content_type('application/json')
      ->set_status_header($statusCode)
      ->set_output(json_encode($data));
  }
}
