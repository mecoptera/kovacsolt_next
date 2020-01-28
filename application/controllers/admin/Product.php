<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {
  protected $middlewares = [ 'Auth.isLoggedIn' => '' ];

  public function __construct() {
    parent::__construct();

    $this->session->set_flashdata('login_error_redirect', 'panel');
    $this->session->set_flashdata('login_success_redirect', 'panel/dashboard');

    $this->load->model('product_model', 'productModel');
    $this->load->library('slice');
  }

  public function index() {
    $this->load->model('base_product_model', 'baseProductModel');

    $this->slice->view('panel/products', [
      'products' => $this->productModel->getAdmin(),
      'baseProducts' => $this->baseProductModel->getAll(),
    ]);
  }

  public function edit($id) {
    $this->load->model('base_product_model', 'baseProductModel');
    $this->load->model('base_product_variant_model', 'baseProductVariantModel');
    $this->load->model('design_model', 'designModel');

    $product = $this->productModel->get($id);

    $this->slice->view('panel/product-edit', [
      'product' => $this->productModel->get($id),
      'baseProducts' => $this->baseProductModel->getAll(),
      'baseProductVariants' => $this->baseProductVariantModel->getByBaseProductId($product->base_product_id),
      'designs' => $this->designModel->getAdmin(),
      'productVariants' => [],
    ]);
  }

  public function createPost() {
    $this->productModel->insert(true);

    redirect('panel/product');
  }

  public function uploadPost() {
    $designId = $this->designModel->insert(true, false);

    $this->load->library('media');
    $this->media->upload('design', $designId);

    redirect('panel/design');
  }

  public function renamePost($id) {
    $this->designModel->rename($id);

    redirect('panel/design');
  }

  public function delete($id) {
    $this->designModel->delete($id);

    $this->load->library('media');
    $this->media->delete('design', $id);

    redirect('panel/design');
  }
}
