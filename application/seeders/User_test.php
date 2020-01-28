<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require 'Seeders.php';

class User_test extends Seeders {
  public function run() {
    $this->CI->db->query('INSERT IGNORE INTO `users` (`email`, `password`, `fullname`) VALUES (?, ?, ?)', [
      'kocsis.david89@gmail.com',
      password_hash('123456', PASSWORD_DEFAULT),
      'Kocsis David',
    ]);
  }
}
