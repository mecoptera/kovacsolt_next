<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MY_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->library('markdown');
    $this->load->library('slice');
  }

  public function index() {
    $this->load->model('product_model', 'productModel');

    $this->slice->view('page/welcome', [ 'products' => $this->productModel->getAllFeatured() ]);
  }

  public function about() {
    $this->slice->view('page/about');
  }
}
