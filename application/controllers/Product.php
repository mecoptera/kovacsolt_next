<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {
  public function index($id) {
    $this->load->model('product_model', 'productModel');

    $this->slice->view('page/product', [ 'product' => $this->productModel->get($id) ]);
  }
}
