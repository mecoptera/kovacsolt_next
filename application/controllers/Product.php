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

    $this->slice->view('page.products', [
      'categories' => $this->productCategoryModel->buildTree($activeCategoryId),
      'activeCategoryId' => $activeCategoryId,
      'sortBy' => $sortBy,
      'products' => $this->productModel->getAllByProductCategoryId($activeCategoryId, $sortBy)
    ]);
  }

  public function view($id) {
    $this->slice->view('page.product', ['product' => $this->productModel->get($id)]);
  }
}
