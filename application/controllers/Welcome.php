<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->model('user_model', 'userModel');
    $this->load->library('slice');
  }

  public function index() {
    $this->slice->view('page/welcome', [ 'products' => [] ]);
  }
}
