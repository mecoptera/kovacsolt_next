<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends MY_Controller {
  protected $middlewares = [ 'Auth.isLoggedIn' => '' ];

  public function index() {
    $this->load->library('migration');

    if ($this->migration->current() === FALSE) {
      show_error($this->migration->error_string());
    }
  }

  public function rollback() {
    $this->load->library('migration');
    $this->migration->version(-1);
  }

  public function seeder_test() {
    $this->load->library('seeder');
    $this->seeder->run('test');
  }
}
