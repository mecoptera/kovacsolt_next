<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends MY_Controller {
  protected $middlewares = [
    'Auth.isLoggedIn' => 'except::index|indexPost'
  ];

  public function index() {
    if ($this->userModel->isLoggedIn()) {
      redirect('');
    }

    $this->session->set_flashdata('login_error_redirect', 'authentication');
    $this->session->set_flashdata('login_success_redirect', '');

    return $this->slice->view('login');
  }

  protected function indexPost(...$params) {
    $redirectError = $this->session->flashdata('login_error_redirect') ? $this->session->flashdata('login_error_redirect') : 'authentication';
    $redirectSuccess = $this->session->flashdata('login_success_redirect') ? $this->session->flashdata('login_success_redirect') : '';

    $user = $this->userModel->getByEmail($this->input->post('email'));

    if (!$user) {
      if ($this->input->post('ajax')) {
        return $this->output->json([ 'message' => 'Error 1' ], 500);
      } else {
        $this->session->set_flashdata('errors', [ 'email' => 'Invalid user', 'password' => 'Invalid user' ]);
        $this->session->set_flashdata('old', [ 'email' => $this->input->post('email'), 'remember' => $this->input->post('remember') ]);
        return redirect($redirectError);
      }
    }

    $authVerified = password_verify($this->input->post('password'), $user->password);

    if (!$authVerified) {
      if ($this->input->post('ajax')) {
        return $this->output->json([ 'message' => 'Error 2' ], 500);
      } else {
        $this->session->set_flashdata('errors', [ 'email' => 'Invalid user', 'password' => 'Invalid user' ]);
        $this->session->set_flashdata('old', [ 'email' => $this->input->post('email'), 'remember' => $this->input->post('remember') ]);
        return redirect($redirectError);
      }
    }

    $this->userModel->login($user);

    if ($this->input->post('ajax')) {
      return $this->output->json([ 'message' => $authVerified ], 200);
    } else {
      return redirect($redirectSuccess);
    }
  }

  public function logout() {
    $this->userModel->logout();

    return redirect('');
  }
}
