<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_Variant extends MY_Controller {
  protected $middlewares = [ 'Auth.isLoggedInAsAdmin' => '' ];

  public function __construct() {
    parent::__construct();

    $this->load->model('product_variant_model', 'productVariantModel');
  }

  public function index($id) {
    $this->slice->view('panel/productvariant-edit', [ 'productVariant' => $this->productVariantModel->get($id) ]);
  }

  public function indexPost($id) {
    $productVariant = $this->productVariantModel->get($id);

    $this->productVariantModel->update($id);

    redirect('panel/product/edit/' . $productVariant->product_id);
  }

  public function createPost($productId) {
    $this->productVariantModel->insert($productId);

    redirect('panel/product/edit/' . $productId);
  }

  public function default($id) {
    $productVariant = $this->productVariantModel->get($id);

    $this->productVariantModel->default($id, $productVariant->product_id);

    redirect('panel/product/edit/' . $productVariant->product_id);
  }

  public function delete($id) {
    $productVariant = $this->productVariantModel->get($id);

    $this->productVariantModel->delete($id);

    redirect('panel/product/edit/' . $productVariant->product_id);
  }
}
