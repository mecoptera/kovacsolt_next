<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Design extends MY_Controller {
  protected $middlewares = [ 'Auth.isLoggedInAsAdmin' => '' ];

  public function __construct() {
    parent::__construct();

    $this->load->model('design_model', 'designModel');
  }

  public function index() {
    $this->slice->view('panel/designs', [ 'designs' => $this->designModel->getAdmin() ]);
  }

  public function uploadPost() {
    $designId = $this->designModel->insert(true, false);

    $this->load->library('media');
    $this->media->upload('design', $designId);

    redirect('admin/design');
  }

  public function renamePost($id) {
    $this->designModel->rename($id);

    redirect('admin/design');
  }

  public function delete($id) {
    $this->designModel->delete($id);

    $this->load->library('media');
    $this->media->delete('design', $id);

    redirect('admin/design');
  }
}
