<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Base_product_model extends CI_Model {
  public function insert() {
    $this->db->query('INSERT INTO `base_products` (`name`, `created_at`, `updated_at`) VALUES (?, ?, ?)', [
      $this->input->post('name'),
      date('Y-m-d H:i:s'),
      date('Y-m-d H:i:s'),
    ]);

    return $this->db->insert_id();
  }

  public function update($id) {
    $this->db->query('UPDATE `base_products` SET `name` = ?, `updated_at` = ? WHERE `id` = ?', [
      $this->input->post('name'),
      date('Y-m-d H:i:s'),
      $id,
    ]);
  }

  public function getAll() {
    return $this->db->query('SELECT * FROM `base_products`')->result();
  }

  public function get($id) {
    return $this->db->query('SELECT * FROM `base_products` WHERE `id` = ?', [ $id ])->row();
  }
}
