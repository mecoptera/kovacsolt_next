<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends MY_Controller {
  protected $middlewares = [ 'Auth.isLoggedInAsAdmin' => '' ];

  public function __construct() {
    parent::__construct();

    $this->load->model('message_model', 'messageModel');
  }

  public function index() {
    $this->slice->view('panel/messages', ['messages' => $this->messageModel->getAll()]);
  }

  public function delete($id) {
    $this->messageModel->delete($id);

    $this->load->library('media');
    $this->media->delete('message', $id);

    redirect('admin/message');
  }
}
