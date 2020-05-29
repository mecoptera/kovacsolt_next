<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->model('product_model', 'productModel');
  }

  public function index($categoryId) {
    $this->slice->view('page/products', [ 'products' => $this->productModel->getAll() ]);
  }

  public function view($id) {
    $this->slice->view('page/product', [ 'product' => $this->productModel->get($id) ]);
  }
}
