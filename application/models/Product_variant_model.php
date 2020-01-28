<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_variant_model extends CI_Model {
  public function insert($productId) {
    $this->db->query('INSERT INTO `product_variants` (`product_id`, `base_product_variant_id`, `design_id`, `default`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, ?)', [
      $productId,
      $this->input->post('base_product_variant_id'),
      $this->input->post('design_id'),
      false,
      date('Y-m-d H:i:s'),
      date('Y-m-d H:i:s'),
    ]);
  }

  public function update($id) {
    $this->db->query('UPDATE `product_variants` SET `design_width` = ?, `design_left` = ?, `design_top` = ?, `updated_at` = ? WHERE `id` = ?', [
      $this->input->post('design_width'),
      $this->input->post('design_left'),
      $this->input->post('design_top'),
      date('Y-m-d H:i:s'),
      $id,
    ]);
  }

  public function get($id) {
    return $this->db->query('
      SELECT `product_variants`.*, `base_product_zones`.`width` AS `base_product_zone_width`, `base_product_zones`.`height` AS `base_product_zone_height`, `base_product_zones`.`left` AS `base_product_zone_left`, `base_product_zones`.`top` AS `base_product_zone_top`, `base_product_views`.`name` AS `base_product_view_name`, `base_product_colors`.`name` AS `base_product_color_name`, `designs`.`name` AS `design_name`
      FROM `product_variants`
      LEFT JOIN `base_product_variants` ON `base_product_variants`.`id` = `product_variants`.`base_product_variant_id`
      LEFT JOIN `base_product_zones` ON `base_product_zones`.`id` = `base_product_variants`.`base_product_zone_id`
      LEFT JOIN `base_product_views` ON `base_product_views`.`id` = `base_product_variants`.`base_product_view_id`
      LEFT JOIN `base_product_colors` ON `base_product_colors`.`id` = `base_product_variants`.`base_product_color_id`
      LEFT JOIN `designs` ON `designs`.`id` = `product_variants`.`design_id`
      WHERE `product_variants`.`id` = ?
    ', [ $id ])->row();
  }

  public function getByProductId($productId) {
    return $this->db->query('
      SELECT `product_variants`.*, `base_product_zones`.`width` AS `base_product_zone_width`, `base_product_zones`.`height` AS `base_product_zone_height`, `base_product_zones`.`left` AS `base_product_zone_left`, `base_product_zones`.`top` AS `base_product_zone_top`, `base_product_views`.`name` AS `base_product_view_name`, `base_product_colors`.`name` AS `base_product_color_name`, `designs`.`name` AS `design_name`
      FROM `product_variants`
      LEFT JOIN `base_product_variants` ON `base_product_variants`.`id` = `product_variants`.`base_product_variant_id`
      LEFT JOIN `base_product_zones` ON `base_product_zones`.`id` = `base_product_variants`.`base_product_zone_id`
      LEFT JOIN `base_product_views` ON `base_product_views`.`id` = `base_product_variants`.`base_product_view_id`
      LEFT JOIN `base_product_colors` ON `base_product_colors`.`id` = `base_product_variants`.`base_product_color_id`
      LEFT JOIN `designs` ON `designs`.`id` = `product_variants`.`design_id`
      WHERE `product_variants`.`product_id` = ?
    ', [ $productId ])->result();
  } 
}
