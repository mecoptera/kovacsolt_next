<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends MY_Controller {
  protected $middlewares = [
    'Auth.isLoggedIn' => 'except::index|indexPost'
  ];

  public function index() {
    if ($this->userModel->isLoggedIn()) {
      return redirect('');
    }

    $this->session->set_userdata('login_error_redirect', 'authentication');
    $this->session->set_userdata('login_success_redirect', '');

    $this->load->helper('MY_form_helper');

    return $this->slice->view('auth.login', ['errors' => $this->session->flashdata('errors')]);
  }

  protected function indexPost() {
    $redirectError = $this->session->userdata('login_error_redirect') ? $this->session->userdata('login_error_redirect') : 'login';
    $redirectSuccess = $this->session->userdata('login_success_redirect') ? $this->session->userdata('login_success_redirect') : '';

    $user = $this->userModel->getByEmail($this->input->post('email'));

    if (!$user) {
      if ($this->input->post('ajax')) {
        return $this->output->json([ 'message' => 'A megadott adatok hibásak' ], 500);
      } else {
        $this->session->set_flashdata('errors', ['email' => 'A megadott adatok hibásak', 'password' => true]);
        $this->session->set_flashdata('old', ['email' => $this->input->post('email'), 'remember' => $this->input->post('remember')]);
        return redirect($redirectError);
      }
    }

    $authVerified = password_verify($this->input->post('password'), $user->password);

    if (!$authVerified) {
      if ($this->input->post('ajax')) {
        return $this->output->json([ 'message' => 'A megadott adatok hibásak' ], 500);
      } else {
        $this->session->set_flashdata('errors', ['email' => 'A megadott adatok hibásak', 'password' => true]);
        $this->session->set_flashdata('old', ['email' => $this->input->post('email'), 'remember' => $this->input->post('remember')]);
        return redirect($redirectError);
      }
    }

    $this->userModel->login($user);

    if ($this->input->post('ajax')) {
      return $this->output->json([ 'message' => $authVerified ], 200);
    } else {
      return redirect($this->userModel->isAdmin() ? 'admin/dashboard' : $redirectSuccess);
    }
  }

  public function logout() {
    $this->userModel->logout();

    return redirect('');
  }

  public function registration() {
    return $this->slice->view('auth.register');
  }

  public function registrationPost() {
    
  }

  public function password() {
    return $this->slice->view('auth.passwords.email');
  }

  public function passwordPost() {
    
  }
}
