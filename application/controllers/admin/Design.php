<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Design extends MY_Controller {
  protected $middlewares = [ 'Auth.isLoggedIn' => '' ];

  public function __construct() {
    parent::__construct();

    $this->session->set_flashdata('login_error_redirect', 'panel');
    $this->session->set_flashdata('login_success_redirect', 'panel/dashboard');

    $this->load->model('design_model', 'designModel');
  }

  public function index() {
    $this->slice->view('panel/designs', [ 'designs' => $this->designModel->getAdmin() ]);
  }

  public function uploadPost() {
    $designId = $this->designModel->insert(true, false);

    $this->load->library('media');
    $this->media->upload('design', $designId);

    redirect('panel/design');
  }

  public function renamePost($id) {
    $this->designModel->rename($id);

    redirect('panel/design');
  }

  public function delete($id) {
    $this->designModel->delete($id);

    $this->load->library('media');
    $this->media->delete('design', $id);

    redirect('panel/design');
  }
}
