<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->library('slice');
  }

  public function index() {
    $this->load->model('product_model', 'productModel');

    $this->slice->view('page/welcome', [ 'products' => $this->productModel->getAllFeatured() ]);
  }
}
