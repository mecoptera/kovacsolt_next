<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Product extends MY_Controller {
  protected $middlewares = [ 'Auth.isLoggedIn' => '' ];

  public function __construct() {
    parent::__construct();

    $this->session->set_flashdata('login_error_redirect', 'panel');
    $this->session->set_flashdata('login_success_redirect', 'panel/dashboard');

    $this->load->model('base_product_model', 'baseProductModel');
  }

  public function index() {
    $this->slice->view('panel/baseproducts', [ 'baseProducts' => $this->baseProductModel->getAll() ]);
  }

  public function createPost() {
    $this->baseProductModel->insert();

    redirect('panel/base_product');
  }

  public function edit($id) {
    $this->load->model('base_product_view_model', 'baseProductViewModel');
    $this->load->model('base_product_color_model', 'baseProductColorModel');
    $this->load->model('base_product_variant_model', 'baseProductVariantModel');
    $this->load->model('base_product_zone_model', 'baseProductZoneModel');

    $this->slice->view('panel/baseproduct-edit', [
      'baseProduct' => $this->baseProductModel->get($id),
      'baseProductViews' => $this->baseProductViewModel->getByBaseProductId($id),
      'baseProductColors' => $this->baseProductColorModel->getByBaseProductId($id),
      'baseProductVariants' => $this->baseProductVariantModel->getByBaseProductId($id),
      'baseProductZones' => $this->baseProductZoneModel->getByBaseProductId($id),
    ]);
  }

  public function editPost($id) {
    $this->baseProductModel->update($id);

    redirect('panel/base_product/edit/' . $id);
  }
}
