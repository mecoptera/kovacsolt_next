<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MY_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->library('markdown');
  }

  public function index() {
    $this->load->model('product_model', 'productModel');

    $products = array_map(function($product) {
      $product->base_product_variant_image = media('variant', $product->base_product_variant_id, 'small');
      $product->product_variant_design_image = media('design', $product->product_variant_design_id, 'small');
      return $product;
    }, $this->productModel->getAllFeatured());

    $this->slice->view('page/welcome', [ 'products' => $products ]);
  }

  public function contact() {
    $this->load->helper('MY_form_helper');

    $this->slice->view('page/contact');
  }

  public function privacy() {
    $this->slice->view('page/privacy');
  }

  public function about() {
    $this->slice->view('page/about');
  }
}
