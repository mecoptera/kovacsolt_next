<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends MY_Controller {
  //protected $middlewares = [ 'Auth.isLoggedInAsAdmin' => '' ];

  public function index() {
    $this->load->library('migration');

    if ($this->migration->current() === FALSE) {
      show_error($this->migration->error_string());

      return;
    }

    echo 'Migration success!';
  }

  public function rollback() {
    $this->load->library('migration');
    $this->migration->version(-1);

    echo 'Rollback success!';
  }

  public function seeder_test() {
    $this->load->library('seeder');
    $this->seeder->run('test');

    echo 'Seeding success!';
  }
}
