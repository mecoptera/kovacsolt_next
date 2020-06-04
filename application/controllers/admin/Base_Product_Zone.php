<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Product_Zone extends MY_Controller {
  protected $middlewares = [ 'Auth.isLoggedInAsAdmin' => '' ];

  public function __construct() {
    parent::__construct();

    $this->load->model('base_product_zone_model', 'baseProductZoneModel');
  }

  public function index($id) {
    $this->load->model('base_product_variant_model', 'baseProductVariantModel');

    $baseProductZone = $this->baseProductZoneModel->get($id);

    $this->slice->view('panel/baseproductzone-edit', [
      'baseProductZone' => $this->baseProductZoneModel->get($id),
      'baseProductVariants' => $this->baseProductVariantModel->getAllByBaseProductId($baseProductZone->base_product_id),
    ]);
  }

  public function indexPost($id) {
    $this->baseProductZoneModel->update($id);

    if ($this->input->post('base_product_variant_id')) {
      foreach ($this->input->post('base_product_variant_id') as $baseProductVariantId) {
        $this->load->model('base_product_variant_model', 'baseProductVariantModel');
        $this->baseProductVariantModel->updateZone($baseProductVariantId, $id);
      }
    }

    $baseProductZone = $this->baseProductZoneModel->get($id);

    redirect('admin/base_product/edit/' . $baseProductZone->base_product_id);
  }

  public function createPost($baseProductId) {
    $this->baseProductZoneModel->insert($baseProductId);

    redirect('admin/base_product/edit/' . $baseProductId);
  }

  public function delete($id) {
    $baseProductZone = $this->baseProductZoneModel->get($id);

    $this->baseProductZoneModel->delete($id);

    redirect('admin/base_product/edit/' . $baseProductZone->base_product_id);
  }
}
