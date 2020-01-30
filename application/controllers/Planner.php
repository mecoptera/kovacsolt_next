<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Planner extends MY_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->model('base_product_model', 'baseProductModel');
    $this->load->model('base_product_variant_model', 'baseProductVariantModel');
    $this->load->model('base_product_view_model', 'baseProductViewModel');
    $this->load->model('base_product_color_model', 'baseProductColorModel');
  }

  public function types() {
    $this->slice->view('page/planner-types', [ 'baseProducts' => $this->baseProductModel->getAll() ]);
  }

  public function editor($baseProductId) {
    $baseProductVariant = $this->baseProductVariantModel->getByBaseProductId($baseProductId);

    $this->slice->view('page/planner-editor', [
      'baseProduct' => $this->baseProductModel->get($baseProductId),
      'baseProductViews' => $this->baseProductViewModel->getByBaseProductId($baseProductVariant->base_product_view_id),
      'baseProductColors' => $this->baseProductColorModel->getByBaseProductId($baseProductVariant->base_product_view_id),
      'userProducts' => [],
    ]);
  }
}
