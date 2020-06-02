<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends MY_Controller {
  protected $middlewares = [ 'Auth.isLoggedInAsAdmin' => 'except::index' ];

  public function index() {
    if (!$this->userModel->isAdmin()) {
      return redirect('');
    } else { 
      return redirect('admin/dashboard');
    }
  }
}
