<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {
  public function insert($isAdmin = false) {
    $this->db->query('INSERT INTO `products` (`base_product_id`, `user_id`, `is_admin`, `name`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, ?)', [
      $this->input->post('base_product_id'),
      $this->session->userdata('user')->id,
      $isAdmin,
      $this->input->post('name'),
      date('Y-m-d H:i:s'),
      date('Y-m-d H:i:s'),
    ]);
  }

  public function getAdmin() {
    return $this->db->query('SELECT * FROM `products` WHERE `is_admin` = TRUE')->result();
  }

  public function get($id) {
    return $this->db->query('SELECT * FROM `products` WHERE `id` = ?', [ $id ])->row();
  }

  public function update($id) {
    $this->db->query('UPDATE `products` SET `name` = ?, `price` = ?, `discount` = ?, `is_public` = ?, `show_on_welcome` = ?, `updated_at` = ? WHERE `id` = ?', [
      $this->input->post('name'),
      $this->input->post('price'),
      $this->input->post('discount'),
      $this->input->post('is_public'),
      $this->input->post('show_on_welcome'),
      date('Y-m-d H:i:s'),
      $id
    ]);
  }

  public function delete($id) {
    $this->db->query('DELETE FROM `products` WHERE `id` = ?', [ $id ]);
  }
}
