<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {
  protected $middlewares = [ 'Auth.isLoggedInAsAdmin' => '' ];

  public function __construct() {
    parent::__construct();

    $this->load->model('product_model', 'productModel');
  }

  public function index() {
    $this->load->model('base_product_model', 'baseProductModel');

    $this->slice->view('panel/products', [
      'products' => $this->productModel->_getAdmin(),
      'baseProducts' => $this->baseProductModel->getAll(),
    ]);
  }

  public function edit($id) {
    $this->load->model('base_product_model', 'baseProductModel');
    $this->load->model('base_product_variant_model', 'baseProductVariantModel');
    $this->load->model('design_model', 'designModel');
    $this->load->model('product_variant_model', 'productVariantModel');

    $product = $this->productModel->_get($id);

    $this->slice->view('panel/product-edit', [
      'product' => $this->productModel->_get($id),
      'baseProducts' => $this->baseProductModel->getAll(),
      'baseProductVariants' => $this->baseProductVariantModel->getByBaseProductId($product->base_product_id),
      'designs' => $this->designModel->getAdmin(),
      'productVariants' => $this->productVariantModel->getByProductId($id),
    ]);
  }

  public function editPost($id) {
    $this->productModel->_update($id);

    redirect('panel/product/edit/' . $id);
  }

  public function createPost() {
    $this->productModel->_insert(true);

    redirect('panel/product');
  }
}
