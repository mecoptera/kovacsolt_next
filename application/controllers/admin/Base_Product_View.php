<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Product_View extends MY_Controller {
  protected $middlewares = [ 'Auth.isLoggedInAsAdmin' => '' ];

  public function __construct() {
    parent::__construct();

    $this->load->model('base_product_view_model', 'baseProductViewModel');
  }

  public function index($id) {
    $this->slice->view('panel/baseproductview-edit', [ 'baseProductView' => $this->baseProductViewModel->get($id) ]);
  }

  public function indexPost($id) {
    $this->baseProductViewModel->update($id);
    $baseProductView = $this->baseProductViewModel->get($id);

    redirect('admin/base_product/edit/' . $baseProductView->base_product_id);
  }

  public function createPost($baseProductId) {
    $this->baseProductViewModel->insert($baseProductId);

    redirect('admin/base_product/edit/' . $baseProductId);
  }

  public function delete($id) {
    $baseProductView = $this->baseProductViewModel->get($id);

    $this->baseProductViewModel->delete($id);

    redirect('admin/base_product/edit/' . $baseProductView->base_product_id);
  }
}
