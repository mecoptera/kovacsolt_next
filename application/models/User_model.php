<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
  public function getByEmail($email) {
    return $this->db->query('SELECT * FROM `users` WHERE `email` = ?', [$email])->row();
  }

  public function login($userData) {
    $this->session->set_userdata('user', $userData);
  }

  public function isLoggedIn() {
    return $this->session->userdata('user') ? true : false;
  }

  public function isAdmin() {
    return $this->session->userdata('user')->admin ? true : false;
  }

  public function logout() {
    $this->session->unset_userdata('user');
  }

  public function create() {
    $this->db->query('INSERT INTO `users` (`email`, `password`, `fullname`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?)', [
      $this->input->post('email'),
      password_hash($this->input->post('password'), PASSWORD_DEFAULT),
      $this->input->post('fullname'),
      date('Y-m-d H:i:s'),
      date('Y-m-d H:i:s')
    ]);
  }

  public function update() {
    $this->db->query('UPDATE `users` SET `fullname` = ?, `phone` = ? WHERE `id` = ?', [
      $this->input->post('fullname'),
      $this->input->post('phone'),
      $this->session->userdata('user')->id
    ]);
  }

  public function createEmailActivation($email) {
    $hash = md5(rand());

    $this->db->query('INSERT INTO `user_activations` (`email`, `hash`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?)', [
      $email,
      $hash,
      date('Y-m-d H:i:s'),
      date('Y-m-d H:i:s')
    ]);

    return $hash;
  }

  public function activateEmail($hash) {
    $email = $this->db->query('SELECT `email` FROM `user_activations` WHERE `hash` = ?', [$hash])->row()->email;

    $this->db->query('UPDATE `users` SET `email_verified_at` = ? WHERE `email` = ?', [
      date('Y-m-d H:i:s'),
      $email
    ]);

    $this->db->query('DELETE FROM `user_activations` WHERE `hash` = ?', [$hash]);

    return $email;
  }

  public function createPasswordChange($email) {
    $hash = md5(rand());

    $this->db->query('INSERT INTO `password_changes` (`email`, `hash`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?)', [
      $email,
      $hash,
      date('Y-m-d H:i:s'),
      date('Y-m-d H:i:s')
    ]);

    return $hash;
  }

  public function updatePassword($hash) {
    $email = $this->db->query('SELECT `email` FROM `password_changes` WHERE `hash` = ?', [$hash])->row()->email;

    $this->db->query('UPDATE `users` SET `password` = ? WHERE `email` = ?', [
      password_hash($this->input->post('password'), PASSWORD_DEFAULT),
      $email
    ]);

    $this->db->query('DELETE FROM `password_changes` WHERE `hash` = ?', [$hash]);
  }
}
