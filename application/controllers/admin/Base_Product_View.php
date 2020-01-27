<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Product_View extends MY_Controller {
  protected $middlewares = [ 'Auth.isLoggedIn' => '' ];

  public function __construct() {
    parent::__construct();

    $this->session->set_flashdata('login_error_redirect', 'panel');
    $this->session->set_flashdata('login_success_redirect', 'panel/dashboard');

    $this->load->model('base_product_view_model', 'baseProductViewModel');
    $this->load->library('slice');
  }

  public function index($id) {
    $this->slice->view('panel/baseproductview-edit', [ 'baseProductView' => $this->baseProductViewModel->get($id) ]);
  }

  public function indexPost($id) {
    $this->baseProductViewModel->update($id);
    $baseProductView = $this->baseProductViewModel->get($id);

    redirect('panel/base_product/edit/' . $baseProductView->base_product_id);
  }
}
