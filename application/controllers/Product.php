<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->model('product_category_model', 'productCategoryModel');
    $this->load->model('product_model', 'productModel');
  }

  public function index($activeCategoryId) {
    $sortBy = $this->input->get('sort_by') ? $this->input->get('sort_by') : 'new';
    $products = array_map(function($product) {
      $product->base_product_variant_image = media('variant', $product->base_product_variant_id);
      $product->product_variant_design_image = media('design', $product->product_variant_design_id);
      return $product;
    }, $this->productModel->getAllByProductCategoryId($activeCategoryId, $sortBy));

    $this->slice->view('page.products', [
      'categories' => $this->productCategoryModel->buildTree($activeCategoryId),
      'activeCategoryId' => $activeCategoryId,
      'sortBy' => $sortBy,
      'products' => $products
    ]);
  }

  public function view($id) {
    $product = $this->productModel->get($id);
    $product->base_product_variant_image = media('variant', $product->base_product_variant_id);
    $product->product_variant_design_image = media('design', $product->product_variant_design_id);

    $this->slice->view('page.product', ['product' => $product]);
  }
}
