<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MY_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->library('markdown');
  }

  public function index() {
    $this->load->model('product_model', 'productModel');

    $this->slice->view('page/welcome', [ 'products' => $this->productModel->getAllFeatured() ]);
  }

  public function contact() {
    $this->load->helper('MY_form_helper');

    $this->slice->view('page/contact');
  }

  public function privacy() {
    $this->slice->view('page/privacy');
  }

  public function about() {
    $this->slice->view('page/about');
  }
}
