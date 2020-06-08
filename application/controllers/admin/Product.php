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

    $baseProductVariants = array_map(function($baseProductVariant) {
      $baseProductVariant->image = media('variant', $baseProductVariant->id);
      return $baseProductVariant;
    }, $this->baseProductVariantModel->getAllByBaseProductId($product->base_product_id));

    $designs = array_map(function($design) {
      $design->image = media('design', $design->id);
      return $design;
    }, $this->designModel->getAdmin());

    $productVariants = array_map(function($productVariant) {
      $productVariant->base_product_variant_image = media('variant', $productVariant->base_product_variant_id);
      $productVariant->design_image = media('design', $productVariant->design_id);
      return $productVariant;
    }, $this->productVariantModel->getByProductId($id));

    $this->slice->view('panel/product-edit', [
      'product' => $product,
      'baseProducts' => $this->baseProductModel->getAll(),
      'baseProductVariants' => $baseProductVariants,
      'designs' => $designs,
      'productVariants' => $productVariants,
    ]);
  }

  public function editPost($id) {
    $this->productModel->_update($id);

    redirect('admin/product/edit/' . $id);
  }

  public function createPost() {
    $this->productModel->_insert(true);

    redirect('admin/product');
  }
}
