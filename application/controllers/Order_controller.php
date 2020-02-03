<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_controller extends MY_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->model('base_product_model', 'baseProductModel');
    $this->load->model('base_product_variant_model', 'baseProductVariantModel');
    $this->load->model('base_product_view_model', 'baseProductViewModel');
    $this->load->model('base_product_color_model', 'baseProductColorModel');

    $this->load->library('cart', [ 'singleton' => true ]);
  }

  public function index() {
    if ($this->userModel->isLoggedIn()) {
      return redirect('order/billing');
    } else {
      return redirect('order/login');
    }
  }

  public function login() {
    if ($this->userModel->isLoggedIn()) {
      return redirect('order/billing');
    }

    $this->session->set_userdata('login_error_redirect', 'order');
    $this->session->set_userdata('login_success_redirect', 'order');

    $this->load->helper('MY_form_helper');

    $this->slice->view('page/order/profile', [ 'step' => 0, 'errors' => $this->session->flashdata('errors') ]);
  }

  public function billing() {
    $this->slice->view('page/order/billing', [
      'step' => 1,
      'billingData' => $this->session->userdata('order.billingData'),
      'errors' => $this->session->flashdata('validationErrors'),
    ]);
  }

  public function billingPost() {
    $this->load->library('form_validation');

    $this->form_validation->set_error_delimiters('', '');

    $this->form_validation->set_rules('name', null, 'required', [ 'required' => 'Kötelező kitölteni' ]);
    $this->form_validation->set_rules('zip', null, 'required|is_natural|max_length', [
      'required' => 'Kötelező kitölteni',
      'is_natural' => 'Csak számokat tartalmazhat',
      'max_length' => 'Maximum 4 számjegy',
    ]);
    $this->form_validation->set_rules('city', null, 'required', [ 'required' => 'Kötelező kitölteni' ]);
    $this->form_validation->set_rules('address', null, 'required', [ 'required' => 'Kötelező kitölteni' ]);
    $this->form_validation->set_rules('email', null, 'required|valid_email', [
      'required' => 'Kötelező kitölteni',
      'valid_email' => 'Nem megfelelő e-mail formátum',
    ]);

    $this->session->set_userdata('order.billingData', $this->input->post());

    if ($this->form_validation->run() === false) {
      $this->session->set_flashdata('validationErrors', $this->form_validation->error_array());

      return redirect(current_url());
    } else {
      return redirect('order/shipping');
    }

    // $validator = Validator::make($request->all(), [
    //   'name' => 'required',
    //   'zip' => 'required|digits:4',
    //   'city' => 'required',
    //   'address' => 'required',
    //   'email' => 'required|email',
    // ], [
    //   'name.required' => 'Kötelező kitölteni',
    //   'zip.required' => 'Kötelező kitölteni',
    //   'zip.digits' => 'Maximum 4 számjegy',
    //   'city.required' => 'Kötelező kitölteni',
    //   'address.required' => 'Kötelező kitölteni',
    //   'email.required' => 'Kötelező kitölteni',
    //   'email.email' => 'Nem megfelelő formátum'
    // ]);

    // $request->session()->put('billingData', $request->all());

    // if ($validator->fails()) {
    //   return redirect()->back()->withErrors($validator);
    // }

    // return redirect(route('order.shipping'));
  }

  public function shipping() {
    $this->slice->view('page/order/billing', [ 'step' => 2, 'billingData' => $this->session->userdata('billingData') ]);
  }
}
