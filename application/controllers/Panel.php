<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends MY_Controller {
  protected $middlewares = [ 'Auth.isLoggedIn' => 'except::index' ];

  public function __construct() {
    parent::__construct();

    $this->session->set_flashdata('login_error_redirect', 'panel');
    $this->session->set_flashdata('login_success_redirect', 'panel/dashboard');

    $this->load->library('slice');
  }

  public function index() {
    if ($this->userModel->isLoggedIn()) {
      redirect('panel/dashboard');
    }

    $this->load->helper('MY_form_helper');

    $this->slice->view('panel/login', [ 'errors' => $this->session->flashdata('errors') ]);
  }

  public function dashboard() {
    $this->slice->view('panel/dashboard');
  }
}
