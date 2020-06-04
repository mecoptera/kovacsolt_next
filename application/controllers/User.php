<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
  private $emailConfiguration = [
    'protocol' => 'smtp',
    'smtp_host' => 'localhost',
    'smtp_port' => 18082,
    'mailtype' => 'html',
    'newline' => "\r\n",
    'wordwrap' => false
  ];

  protected $middlewares = [ 'Auth.isLoggedIn' => 'except::activate' ];

  public function __construct() {
    parent::__construct();

    $this->load->model('user_model', 'userModel');
  }

  public function profile() {
    $this->slice->view('user.profile', [
      'user' => $this->session->userdata('user'),
      'passwordSuccess' => $this->session->flashdata('passwordSuccess')
    ]);
  }

  public function profilePost() {
    $this->userModel->update();
    $this->session->set_flashdata('success', true);

    $userData = $this->userModel->getByEmail($this->session->userdata('user')->email);
    $this->userModel->login($userData);

    redirect('profile');
  }

  public function activate($hash = null) {
    if ($hash) {
      $email = $this->userModel->activateEmail($hash);
      $userData = $this->userModel->getByEmail($email);
      $this->userModel->login($userData);

      redirect('');
    } else {
      $this->slice->view('user.register-activate');
    }
  }

  public function change_password() {
    $changeHash = $this->userModel->createPasswordChange($this->session->userdata('user')->email);
    
    $this->load->library('email', $this->emailConfiguration);

    $this->email->from('admin@yourdomainname.com', 'Kovácsolt Póló');
    $this->email->to($this->session->userdata('user')->email);
    $this->email->cc('testcc@domainname.com');
    $this->email->subject('Jelszó megváltoztatása');
    $this->email->message($this->slice->view('mail.password-change', ['changeHash' => $changeHash]));
    $this->email->send();

    $this->session->set_flashdata('passwordSuccess', true);
    
    return redirect('user/profile');
  }
}
