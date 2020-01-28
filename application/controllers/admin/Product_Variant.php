<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_Variant extends MY_Controller {
  protected $middlewares = [ 'Auth.isLoggedIn' => '' ];

  public function __construct() {
    parent::__construct();

    $this->session->set_flashdata('login_error_redirect', 'panel');
    $this->session->set_flashdata('login_success_redirect', 'panel/dashboard');

    $this->load->model('product_variant_model', 'productVariantModel');
    $this->load->library('slice');
  }

  public function index($id) {
    $this->slice->view('panel/productvariant-edit', [ 'productVariant' => $this->productVariantModel->get($id) ]);
  }

  public function indexPost($id) {
    $this->productVariantModel->update($id);

    $productVariant = $this->productVariantModel->get($id);

    redirect('panel/product/edit/' . $productVariant->product_id);
  }

  public function createPost($productId) {
    $this->productVariantModel->insert($productId);

    redirect('panel/product/edit/' . $productId);
  }
}

