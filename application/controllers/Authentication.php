<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends MY_Controller {
  protected $middlewares = [
    'Auth.isLoggedIn' => 'except::index|indexPost|registration|registrationPost|password|passwordPost|change_password|change_passwordPost'
  ];

  public function index() {
    if ($this->userModel->isLoggedIn()) {
      return redirect($this->session->userdata('login_success_redirect') ? $this->session->userdata('login_success_redirect') : '');
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
    $this->load->helper('MY_form_helper');

    return $this->slice->view('auth.register', ['errors' => $this->session->flashdata('validationErrors')]);
  }

  public function registrationPost() {
    $this->load->library('form_validation');

    $this->form_validation->set_error_delimiters('', '');

    $this->form_validation->set_rules('fullname', null, 'required', ['required' => 'Kötelező kitölteni']);
    $this->form_validation->set_rules('email', null, 'required|valid_email', [
      'required' => 'Kötelező kitölteni',
      'valid_email' => 'Nem megfelelő e-mail formátum',
    ]);
    $this->form_validation->set_rules('password', null, 'required', ['required' => 'Kötelező kitölteni']);
    $this->form_validation->set_rules('password_confirmation', null, 'required|matches[password]', ['required' => 'Kötelező elfogadni', 'matches' => 'A jelszavak nem egyeznek']);
    $this->form_validation->set_rules('accept', null, 'required', ['required' => 'Kötelező elfogadni']);

    if ($this->form_validation->run() === false) {
      $this->session->set_flashdata('validationErrors', $this->form_validation->error_array());
      $this->session->set_flashdata('old', $this->input->post());

      return redirect(current_url());
    }

    $this->userModel->create();
    $activationHash = $this->userModel->createEmailActivation($this->input->post('email'));
    
    $this->load->library('email');

    $this->email->from('admin@kovacsoltpolo.hu', 'Kovácsolt Póló');
    $this->email->to(ENVIRONMENT === 'development' ? 'krazyqwed@gmail.com' : $this->input->post('email'));
    $this->email->subject('Fiók aktiválása');
    $this->email->message($this->slice->view('mail.activate-user', ['activationHash' => $activationHash]));
    $this->email->send();
    
    return redirect('user/activate');
  }

  public function password() {
    $this->load->helper('MY_form_helper');

    return $this->slice->view('auth.passwords.email', ['errors' => $this->session->flashdata('validationErrors')]);
  }

  public function passwordPost() {
    $this->load->library('form_validation');

    $this->form_validation->set_error_delimiters('', '');

    $this->form_validation->set_rules('email', null, 'required|valid_email', [
      'required' => 'Kötelező kitölteni',
      'valid_email' => 'Nem megfelelő e-mail formátum',
    ]);

    if ($this->form_validation->run() === false) {
      $this->session->set_flashdata('validationErrors', $this->form_validation->error_array());

      return redirect(current_url());
    }

    $changeHash = $this->userModel->createPasswordChange($this->input->post('email'));
    
    $this->load->library('email');

    $this->email->from('admin@kovacsoltpolo.hu', 'Kovácsolt Póló');
    $this->email->to(ENVIRONMENT === 'development' ? 'krazyqwed@gmail.com' : $this->input->post('email'));
    $this->email->subject('Jelszó megváltoztatása');
    $this->email->message($this->slice->view('mail.password-change', ['changeHash' => $changeHash]));
    $this->email->send();

    $this->session->set_flashdata('success', true);
    
    return redirect(current_url());
  }

  public function change_password($hash) {
    $this->load->helper('MY_form_helper');

    return $this->slice->view('auth.passwords.reset', [
      'hash' => $hash,
      'errors' => $this->session->flashdata('validationErrors')
    ]);
  }

  public function change_passwordPost($hash) {
    $this->load->library('form_validation');

    $this->form_validation->set_error_delimiters('', '');

    $this->form_validation->set_rules('password', null, 'required', ['required' => 'Kötelező kitölteni']);
    $this->form_validation->set_rules('password_confirmation', null, 'required|matches[password]', ['required' => 'Kötelező elfogadni', 'matches' => 'A jelszavak nem egyeznek']);

    if ($this->form_validation->run() === false) {
      $this->session->set_flashdata('validationErrors', $this->form_validation->error_array());

      return redirect(current_url());
    }

    $this->userModel->updatePassword($hash);

    return redirect('login');
  }
}
