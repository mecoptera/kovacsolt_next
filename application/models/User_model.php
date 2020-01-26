<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
  public function getByEmail($email) {
    return $this->db->query('SELECT * FROM `users` WHERE `email` = ?', [ $email ])->row();
  }

  public function login($userData) {
    $this->session->set_userdata('user', $userData);
  }

  public function isLoggedIn() {
    return $this->session->userdata('user') ? true : false;
  }

  public function logout() {
    $this->session->unset_userdata('user');
  }
}
