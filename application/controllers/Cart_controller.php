<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_controller extends MY_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->model('base_product_model', 'baseProductModel');
    $this->load->model('base_product_variant_model', 'baseProductVariantModel');
    $this->load->model('base_product_view_model', 'baseProductViewModel');
    $this->load->model('base_product_color_model', 'baseProductColorModel');

    $this->load->library('cart', [ 'singleton' => true ]);
  }

  public function addPost() {
    $this->cart->add($this->input->post('product_id'), $this->input->post('extra_data'));

    redirect($this->session->userdata('referred_from'), 'refresh');
  }

  public function menu_button() {
    return $this->output->json([
      'content' => $this->slice->view('page/areas/cart-button', [ 'cartItems' => $this->cart->get() ])
    ], 200);
  }
}
