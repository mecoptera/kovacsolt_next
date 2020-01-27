<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Base_product_view_model extends CI_Model {
  public function insert($baseProductId) {
    $this->db->query('INSERT INTO `base_product_views` (`base_product_id`, `name`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?)', [
      $baseProductId,
      $this->input->post('name'),
      date('Y-m-d H:i:s'),
      date('Y-m-d H:i:s'),
    ]);

    return $this->db->insert_id();
  }

  public function update($id) {
    $this->db->query('UPDATE `base_product_views` SET `name` = ?, `updated_at` = ? WHERE `id` = ?', [
      $this->input->post('name'),
      date('Y-m-d H:i:s'),
      $id,
    ]);
  }

  public function getAll() {
    return $this->db->query('SELECT * FROM `base_product_views`')->result();
  }

  public function get($id) {
    return $this->db->query('SELECT * FROM `base_product_views` WHERE `id` = ?', [ $id ])->row();
  }

  public function getByBaseProductId($baseProductId) {
    return $this->db->query('SELECT * FROM `base_product_views` WHERE `base_product_id` = ?', [ $baseProductId ])->result();
  } 
}
