<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Design extends MY_Controller {
  protected $middlewares = [
    'Auth.isLoggedIn' => '*'
  ];

  public function __construct() {
    parent::__construct();

    $this->load->model('design_model', 'designModel');
    $this->load->library('slice');
  }

  public function index() {
    $this->slice->view('panel/designs', [ 'designs' => $this->designModel->getAdmin() ]);
  }

  public function uploadPost() {
    $this->load->library('media');

    $designId = $this->designModel->insert(true, false);

    $this->media->upload('design', $designId);
  }

  public function renamePost($id) {
    $this->designModel->rename($id);
    redirect('panel/design');
  }
}
