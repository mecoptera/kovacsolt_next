<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_Variant extends MY_Controller {
  protected $middlewares = ['Auth.isLoggedInAsAdmin' => ''];

  public function __construct() {
    parent::__construct();

    $this->load->model('product_variant_model', 'productVariantModel');
  }

  public function index($id) {
    $productVariant = $this->productVariantModel->get($id);
    $productVariant->base_product_variant_image = media('variant', $productVariant->base_product_variant_id);
    $productVariant->design_image = media('design', $productVariant->design_id);

    $this->slice->view('panel/productvariant-edit', ['productVariant' => $productVariant]);
  }

  public function indexPost($id) {
    $productVariant = $this->productVariantModel->get($id);

    $this->productVariantModel->update($id);

    redirect('admin/product/edit/' . $productVariant->product_id);
  }

  public function createPost($productId) {
    $this->productVariantModel->insert($productId);

    redirect('admin/product/edit/' . $productId);
  }

  public function default($id) {
    $productVariant = $this->productVariantModel->get($id);

    $this->productVariantModel->default($id, $productVariant->product_id);

    redirect('admin/product/edit/' . $productVariant->product_id);
  }

  public function delete($id) {
    $productVariant = $this->productVariantModel->get($id);

    $this->productVariantModel->delete($id);

    redirect('admin/product/edit/' . $productVariant->product_id);
  }
}
