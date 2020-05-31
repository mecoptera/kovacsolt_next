<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_product_model extends CI_Model {
  public function getAllByCartId($cartId) {
    return $this->db->query('SELECT * FROM `cart_products` WHERE `cart_id` = ?', [ $cartId ])->result();
  }

  public function updateOrCreate($cartId, $item) {
    $this->db->query('
      INSERT INTO `cart_products` (`unique_id`, `cart_id`, `product_id`, `extra_data`, `quantity`, `created_at`, `updated_at`)
      VALUES (?, ?, ?, ?, ?, ?, ?)
      ON DUPLICATE KEY
      UPDATE `quantity` = ?, `updated_at` = ?
    ', [
      $item['uniqueId'],
      $cartId,
      $item['product']->id,
      $item['extraData'],
      $item['quantity'],
      date('Y-m-d H:i:s'),
      date('Y-m-d H:i:s'),
      $item['quantity'],
      date('Y-m-d H:i:s'),
    ]);
  }

  public function deleteByUniqueId($uniqueId) {
    $this->db->query('DELETE FROM `cart_products` WHERE `unique_id` = ?', [ $uniqueId ]);
  }

  public function deleteByCartId($cartId) {
    $this->db->query('DELETE FROM `cart_products` WHERE `cart_id` = ?', [ $cartId ]);
  }
}
