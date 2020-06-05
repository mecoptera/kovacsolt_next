<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
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

    redirect('user/profile');
  }

  public function activate($hash = null) {
    if ($hash) {
      $email = $this->userModel->activateEmail($hash);
      $userData = $this->userModel->getByEmail($email);
      $this->userModel->login($userData);

      redirect('login');
    } else {
      $this->slice->view('user.register-activate');
    }
  }

  public function change_password() {
    $email = $this->session->userdata('user')->email;
    $changeHash = $this->userModel->createPasswordChange($email);
    
    $this->load->library('email');

    $this->email->from('krazyqwed@gmail.com', 'Kovácsolt Póló');
    $this->email->to(ENVIRONMENT === 'development' ? 'krazyqwed@gmail.com' : $email);
    $this->email->subject('Jelszó megváltoztatása');
    $this->email->message($this->slice->view('mail.password-change', ['changeHash' => $changeHash]));
    $this->email->send();

    $this->session->set_flashdata('passwordSuccess', true);
    
    return redirect('user/profile');
  }
}
