<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Product extends MY_Controller {
  protected $middlewares = [ 'Auth.isLoggedInAsAdmin' => '' ];

  public function __construct() {
    parent::__construct();

    $this->load->model('base_product_model', 'baseProductModel');
  }

  public function index() {
    $this->slice->view('panel/baseproducts', [ 'baseProducts' => $this->baseProductModel->_getAll() ]);
  }

  public function createPost() {
    $this->baseProductModel->_insert();

    redirect('admin/base_product');
  }

  public function edit($id) {
    $this->load->model('base_product_view_model', 'baseProductViewModel');
    $this->load->model('base_product_color_model', 'baseProductColorModel');
    $this->load->model('base_product_variant_model', 'baseProductVariantModel');
    $this->load->model('base_product_zone_model', 'baseProductZoneModel');

    $this->slice->view('panel/baseproduct-edit', [
      'baseProduct' => $this->baseProductModel->_get($id),
      'baseProductViews' => $this->baseProductViewModel->getByBaseProductId($id),
      'baseProductColors' => $this->baseProductColorModel->getByBaseProductId($id),
      'baseProductVariants' => $this->baseProductVariantModel->getAllByBaseProductId($id),
      'baseProductZones' => $this->baseProductZoneModel->getByBaseProductId($id),
    ]);
  }

  public function editPost($id) {
    $this->baseProductModel->_update($id);

    redirect('admin/base_product/edit/' . $id);
  }
}
