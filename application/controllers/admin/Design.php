<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Design extends MY_Controller {
  protected $middlewares = ['Auth.isLoggedInAsAdmin' => ''];

  public function __construct() {
    parent::__construct();

    $this->load->model('design_model', 'designModel');
  }

  public function index() {
    $designs = array_map(function($design) {
      $design->image = media('design', $design->id);
      return $design;
    }, $this->designModel->getAdmin());

    $this->slice->view('panel/designs', ['designs' => $designs]);
  }

  public function uploadPost() {
    $designId = $this->designModel->insert(true, false);

    $this->load->library('media');
    $this->media->upload('design', $designId)->resize('small');

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
