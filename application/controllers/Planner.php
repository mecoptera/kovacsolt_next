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
    $baseProducts = array_map(function($baseProduct) {
      $baseProduct->base_product_variant_image = media('variant', $baseProduct->base_product_variant_id);
      return $baseProduct;
    }, $this->baseProductModel->getAll());


    $this->slice->view('page.planner-types', [ 'baseProducts' => $baseProducts ]);
  }

  public function editor($baseProductId) {
    $baseProductVariant = $this->baseProductVariantModel->getByBaseProductId($baseProductId);

    $this->slice->view('page.planner-editor', [
      'baseProduct' => $this->baseProductModel->get($baseProductId),
      'baseProductViews' => $this->baseProductViewModel->getByBaseProductId($baseProductVariant->base_product_id),
      'baseProductColors' => $this->baseProductColorModel->getByBaseProductId($baseProductVariant->base_product_id),
      'userProducts' => [],
    ]);
  }

  public function variant($baseProductId, $baseProductViewId, $baseProductColorId) {
    $baseProductVariant = $this->baseProductVariantModel->getByViewIdAndColorId($baseProductId, $baseProductViewId, $baseProductColorId);
    $baseProductVariant->base_product_variant_image = media('variant', $baseProductVariant->id);

    return $this->output->json($baseProductVariant, 200);
  }

  public function designs() {
    $this->load->model('design_model', 'designModel');

    return $this->output->json([
      'content' => $this->slice->view('page.areas.designs', [ 'designs' => $this->designModel->getAdmin() ])
    ], 200);
  }

  public function savePost() {
    $this->load->library('form_validation');

    $this->form_validation->set_error_delimiters('', '');

    $this->form_validation->set_rules('design[]', null, 'required', ['required' => 'Nincs kiválasztva minta a termékhez']);
    
    if ($this->form_validation->run() === false) {
      return $this->output->json([
        'status' => 'error',
        'validation' => $this->form_validation->error_array()
      ], 200);
    }

    $baseProductVariant = $this->baseProductVariantModel->get($this->input->post('base_product_variant_id'));

    $this->db->query('INSERT INTO `products` (`base_product_id`, `user_id`, `name`, `price`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, ?)', [
      $baseProductVariant->base_product_id,
      $this->userModel->isLoggedIn() ? $this->session->userdata('user')->id : null,
      $this->input->post('name'),
      4990,
      date('Y-m-d H:i:s'),
      date('Y-m-d H:i:s')
    ]);

    $productId = $this->db->insert_id();

    $this->db->query('INSERT INTO `product_variants` (`product_id`, `base_product_variant_id`, `design_id`, `design_width`, `design_left`, `design_top`, `default`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)', [
      $productId,
      $baseProductVariant->id,
      $this->input->post('design')['id'],
      $this->input->post('design')['width'],
      $this->input->post('design')['left'],
      $this->input->post('design')['top'],
      1,
      date('Y-m-d H:i:s'),
      date('Y-m-d H:i:s')
    ]);

    $this->db->query('UPDATE `designs` SET `temporary` = 0 WHERE `id` = ?', [$this->input->post('design')['id']]);

    $this->load->library('cart', [ 'singleton' => true ]);
    $this->cart->add($productId, $this->input->post('extra_data'));

    return $this->output->json([
      'status' => 'success',
      'redirect' => base_url('cart')
    ], 200);
  }
}
