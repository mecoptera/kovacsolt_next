<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Product_Variant extends MY_Controller {
  protected $middlewares = [ 'Auth.isLoggedInAsAdmin' => '' ];

  public function __construct() {
    parent::__construct();

    $this->load->model('base_product_variant_model', 'baseProductVariantModel');
  }

  public function index($id) {
    $this->load->model('base_product_view_model', 'baseProductViewModel');
    $this->load->model('base_product_color_model', 'baseProductColorModel');
    $this->load->model('base_product_zone_model', 'baseProductZoneModel');

    $baseProductVariant = $this->baseProductVariantModel->get($id);
    $baseProductVariant->image = media('variant', $baseProductVariant->id);

    $this->slice->view('panel/baseproductvariant-edit', [
      'baseProductVariant' => $baseProductVariant,
      'baseProductViews' => $this->baseProductViewModel->getByBaseProductId($baseProductVariant->base_product_id),
      'baseProductColors' => $this->baseProductColorModel->getByBaseProductId($baseProductVariant->base_product_id),
      'baseProductZones' => $this->baseProductZoneModel->getByBaseProductId($baseProductVariant->base_product_id),
    ]);
  }

  public function indexPost($id) {
    $this->baseProductVariantModel->update($id);
    $baseProductVariant = $this->baseProductVariantModel->get($id);

    $this->load->library('media');

    if (!empty($_FILES['image']['name'])) {
      $this->media->upload('variant', $id)->resize('small');

    }

    redirect('admin/base_product/edit/' . $baseProductVariant->base_product_id);
  }

  public function createPost($baseProductId) {
    $baseProductVariantId = $this->baseProductVariantModel->insert($baseProductId);

    $this->load->library('media');

    if (!empty($_FILES['image']['name'])) {
      $this->media->upload('variant', $baseProductVariantId)->resize('small');
    }

    redirect('admin/base_product/edit/' . $baseProductId);
  }

  public function default($id) {
    $baseProductVariant = $this->baseProductVariantModel->get($id);

    $this->baseProductVariantModel->default($id, $baseProductVariant->base_product_id);

    redirect('admin/base_product/edit/' . $baseProductVariant->base_product_id);
  }

  public function delete($id) {
    $baseProductVariant = $this->baseProductVariantModel->get($id);

    $this->baseProductVariantModel->delete($id);

    redirect('admin/base_product/edit/' . $baseProductVariant->base_product_id);
  }
}
