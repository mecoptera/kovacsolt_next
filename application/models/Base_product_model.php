<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Base_product_model extends CI_Model {
  public function getAll() {
    return $this->db->query('
      SELECT
        `base_products`.`id`, `base_products`.`name`,
        `base_product_variants`.`id` AS `base_product_variant_id`,
        `base_product_zones`.`width` AS `base_product_zone_width`, `base_product_zones`.`height` AS `base_product_zone_height`, `base_product_zones`.`left` AS `base_product_zone_left`, `base_product_zones`.`top` AS `base_product_zone_top`,
        `base_products`.`name` AS `base_product_name`
      FROM `base_products`
      LEFT JOIN `base_product_variants` ON `base_product_variants`.`base_product_id` = `base_products`.`id`
      LEFT JOIN `base_product_zones` ON `base_product_zones`.`id` = `base_product_variants`.`base_product_zone_id`
      WHERE `base_product_variants`.`default` = TRUE
    ')->result();
  }

  public function get($id) {
    return $this->db->query('
      SELECT
        `base_products`.`id`, `base_products`.`name`,
        `base_product_variants`.`id` AS `base_product_variant_id`, `base_product_variants`.`base_product_view_id` AS `base_product_variant_view_id`, `base_product_variants`.`base_product_color_id` AS `base_product_variant_color_id`,
        `base_product_zones`.`width` AS `base_product_zone_width`, `base_product_zones`.`height` AS `base_product_zone_height`, `base_product_zones`.`left` AS `base_product_zone_left`, `base_product_zones`.`top` AS `base_product_zone_top`,
        `base_products`.`name` AS `base_product_name`
      FROM `base_products`
      LEFT JOIN `base_product_variants` ON `base_product_variants`.`base_product_id` = `base_products`.`id`
      LEFT JOIN `base_product_zones` ON `base_product_zones`.`id` = `base_product_variants`.`base_product_zone_id`
      WHERE
        `base_products`.`id` = ?
        AND `base_product_variants`.`default` = TRUE
    ', [ $id ])->row();
  }

  public function _insert() {
    $this->db->query('INSERT INTO `base_products` (`name`, `created_at`, `updated_at`) VALUES (?, ?, ?)', [
      $this->input->post('name'),
      date('Y-m-d H:i:s'),
      date('Y-m-d H:i:s'),
    ]);

    return $this->db->insert_id();
  }

  public function _update($id) {
    $this->db->query('UPDATE `base_products` SET `name` = ?, `updated_at` = ? WHERE `id` = ?', [
      $this->input->post('name'),
      date('Y-m-d H:i:s'),
      $id,
    ]);
  }

  public function _getAll() {
    return $this->db->query('SELECT * FROM `base_products`')->result();
  }

  public function _get($id) {
    return $this->db->query('SELECT * FROM `base_products` WHERE `id` = ?', [ $id ])->row();
  }
}
