<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->model('user_model', 'userModel');
  }

  public function index() {
    $this->slice->view('user.profile', [
      'user' => $this->session->userdata('user')
    ]);
  }

  public function indexPost() {
    $this->userModel->update();
    $this->session->set_flashdata('success', true);

    $userData = $this->userModel->getByEmail($this->session->userdata('user')->email);
    $this->userModel->login($userData);

    redirect('profile');
  }

  public function mail() {
    // Email configuration
    $config = Array(
      'protocol' => 'smtp',
      'smtp_host' => 'localhost',
      'smtp_port' => 18082,
      'mailtype' => 'html',
      'newline' => "\r\n",
      'wordwrap' => false
    );
    
    $this->load->library('email', $config);
    $this->email->from('admin@yourdomainname.com', "Admin Team");
    $this->email->to("test@domainname.com");
    $this->email->cc("testcc@domainname.com");
    $this->email->subject("This is test subject line");
    $this->email->message($this->slice->view('mail.password-change'));
    $this->email->send();
  }
}
