<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Seeder {
  protected $CI;

  public function __construct() {
    $this->CI = &get_instance();
  }

  public function run($postfix = '') {
    $seedersFolder = APPPATH . 'seeders/';

    $seeders = glob($seedersFolder . '*' . ($postfix ? '_' . $postfix : '') . '.php');

    foreach ($seeders as $seeder) {
      require $seeder;
      $className = basename($seeder, '.php');
      $seederObject = new $className($this->CI);
      $seederObject->run();
    }
  }
}
