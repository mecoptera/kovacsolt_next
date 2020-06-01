<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Product_Color extends MY_Controller {
  protected $middlewares = [ 'Auth.isLoggedInAsAdmin' => '' ];

  public function __construct() {
    parent::__construct();

    $this->load->model('base_product_color_model', 'baseProductColorModel');
  }

  public function index($id) {
    $this->slice->view('panel/baseproductcolor-edit', [ 'baseProductColor' => $this->baseProductColorModel->get($id) ]);
  }

  public function indexPost($id) {
    $this->baseProductColorModel->update($id);
    $baseProductColor = $this->baseProductColorModel->get($id);

    redirect('panel/base_product/edit/' . $baseProductColor->base_product_id);
  }

  public function createPost($baseProductId) {
    $this->baseProductColorModel->insert($baseProductId);

    redirect('panel/base_product/edit/' . $baseProductId);
  }
}
