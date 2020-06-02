<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Base_product_zone_model extends CI_Model {
  public function insert($baseProductId) {
    $this->db->query('INSERT INTO `base_product_zones` (`base_product_id`, `name`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?)', [
      $baseProductId,
      $this->input->post('name'),
      date('Y-m-d H:i:s'),
      date('Y-m-d H:i:s'),
    ]);
  }

  public function update($id) {
    $this->db->query('UPDATE `base_product_zones` SET `name` = ?, `width` = ?, `height` = ?, `left` = ?, `top` = ?, `updated_at` = ? WHERE `id` = ?', [
      $this->input->post('name'),
      $this->input->post('width'),
      $this->input->post('height'),
      $this->input->post('left'),
      $this->input->post('top'),
      date('Y-m-d H:i:s'),
      $id,
    ]);
  }

  public function get($id) {
    return $this->db->query('SELECT * FROM `base_product_zones` WHERE `id` = ?', [$id])->row();
  }

  public function getByBaseProductId($baseProductId) {
    return $this->db->query('SELECT * FROM `base_product_zones` WHERE `base_product_id` = ?', [$baseProductId])->result();
  }

  public function delete($id) {
    $this->db->query('DELETE FROM `base_product_zones` WHERE `id` = ?', [$id]);
  }
}
