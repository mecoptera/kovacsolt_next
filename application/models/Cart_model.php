<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model {
  public function getByUserId($userId) {
    return $this->db->query('SELECT * FROM `carts` WHERE `user_id` = ? AND `closed` = FALSE', [ $userId ])->row();
  }

  public function create($userId) {
    $this->db->query('INSERT INTO `carts` (`user_id`, `closed`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?)', [
      $userId,
      false,
      date('Y-m-d H:i:s'),
      date('Y-m-d H:i:s'),
    ]);

    return $this->db->insert_id();
  }
}
