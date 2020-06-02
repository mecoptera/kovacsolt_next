<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends MY_Controller {
  public function index() {
    $this->load->helper('MY_form_helper');

    $this->slice->view('page.contact', [
      'errors' => $this->session->flashdata('validationErrors')
    ]);
  }

  public function indexPost() {
    $this->load->library('form_validation');

    $this->form_validation->set_error_delimiters('', '');

    $this->form_validation->set_rules('name', null, 'required', [ 'required' => 'Kötelező kitölteni' ]);
    $this->form_validation->set_rules('email', null, 'required|valid_email', [
      'required' => 'Kötelező kitölteni',
      'valid_email' => 'Nem megfelelő e-mail formátum',
    ]);
    $this->form_validation->set_rules('message', null, 'required', [ 'required' => 'Kötelező kitölteni' ]);
    $this->form_validation->set_rules('accept', null, 'required', [ 'required' => 'Kötelező elfogadni' ]);

    if ($this->form_validation->run() === false) {
      $this->session->set_flashdata('validationErrors', $this->form_validation->error_array());

      return redirect(current_url());
    }

    $this->load->model('message_model', 'messageModel');
    $this->messageModel->insert();

    return redirect('contact');
  }
}
