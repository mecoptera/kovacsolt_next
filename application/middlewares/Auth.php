<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require 'Middlewares.php';

class Auth extends Middlewares {
  public function isLoggedIn() {
    $this->CI->load->model('user_model', 'userModel');

    if (!$this->CI->userModel->isLoggedIn()) {
      $redirectError = $this->CI->session->flashdata('login_error_redirect') ?
        $this->CI->session->flashdata('login_error_redirect') : 'authentication';

      return redirect($redirectError);
    }
  }
}
