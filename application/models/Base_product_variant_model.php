<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Base_product_variant_model extends CI_Model {
  public function insert($baseProductId) {
    $this->db->query('INSERT INTO `base_product_variants` (`base_product_id`, `base_product_view_id`, `base_product_color_id`, `default`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, ?)', [
      $baseProductId,
      $this->input->post('base_product_view_id'),
      $this->input->post('base_product_color_id'),
      false,
      date('Y-m-d H:i:s'),
      date('Y-m-d H:i:s'),
    ]);

    return $this->db->insert_id();
  }

  public function update($id) {
    $this->db->query('UPDATE `base_product_variants` SET `base_product_view_id` = ?, `base_product_color_id` = ?, `base_product_zone_id` = ?, `updated_at` = ? WHERE `id` = ?', [
      $this->input->post('base_product_view_id'),
      $this->input->post('base_product_color_id'),
      $this->input->post('base_product_zone_id'),
      date('Y-m-d H:i:s'),
      $id,
    ]);
  }

  public function updateZone($id, $baseProductZoneId) {
    $this->db->query('UPDATE `base_product_variants` SET `base_product_zone_id` = ?, `updated_at` = ? WHERE `id` = ?', [
      $baseProductZoneId,
      date('Y-m-d H:i:s'),
      $id,
    ]);
  }

  public function default($id, $baseProductId) {
    $this->db->query('UPDATE `base_product_variants` SET `default` = false WHERE `base_product_id` = ?', [$baseProductId]);
    $this->db->query('UPDATE `base_product_variants` SET `default` = true WHERE `id` = ?', [$id]);
  }

  public function delete($id) {
    $this->db->query('DELETE FROM `base_product_variants` WHERE `id` = ?', [$id]);
  }

  public function get($id) {
    return $this->db->query('SELECT * FROM `base_product_variants` WHERE `id` = ?', [$id])->row();
  }

  public function getAllByBaseProductId($baseProductId) {
    return $this->db->query('
      SELECT `base_product_variants`.*, `base_product_views`.`name` AS `base_product_view_name`, `base_product_colors`.`name` AS `base_product_color_name`, `base_product_zones`.`name` AS `base_product_zone_name`
      FROM `base_product_variants`
      LEFT JOIN `base_product_views` ON `base_product_views`.`id` = `base_product_variants`.`base_product_view_id`
      LEFT JOIN `base_product_colors` ON `base_product_colors`.`id` = `base_product_variants`.`base_product_color_id`
      LEFT JOIN `base_product_zones` ON `base_product_zones`.`id` = `base_product_variants`.`base_product_zone_id`
      WHERE `base_product_variants`.`base_product_id` = ?
    ', [$baseProductId])->result();
  }

  public function getByBaseProductId($baseProductId) {
    return $this->db->query('
      SELECT `base_product_variants`.*, `base_product_views`.`name` AS `base_product_view_name`, `base_product_colors`.`name` AS `base_product_color_name`, `base_product_zones`.`name` AS `base_product_zone_name`
      FROM `base_product_variants`
      LEFT JOIN `base_product_views` ON `base_product_views`.`id` = `base_product_variants`.`base_product_view_id`
      LEFT JOIN `base_product_colors` ON `base_product_colors`.`id` = `base_product_variants`.`base_product_color_id`
      LEFT JOIN `base_product_zones` ON `base_product_zones`.`id` = `base_product_variants`.`base_product_zone_id`
      WHERE
        `base_product_variants`.`base_product_id` = ?
        AND `base_product_variants`.`default` = TRUE
    ', [$baseProductId])->row();
  }

  public function getByViewIdAndColorId($baseProductId, $baseProductViewId, $baseProductColorId) {
    return $this->db->query('
      SELECT `base_product_variants`.*, `base_product_zones`.`width` AS `base_product_zone_width`, `base_product_zones`.`height` AS `base_product_zone_height`, `base_product_zones`.`left` AS `base_product_zone_left`, `base_product_zones`.`top` AS `base_product_zone_top`
      FROM `base_product_variants`
      LEFT JOIN `base_product_views` ON `base_product_views`.`id` = `base_product_variants`.`base_product_view_id`
      LEFT JOIN `base_product_colors` ON `base_product_colors`.`id` = `base_product_variants`.`base_product_color_id`
      LEFT JOIN `base_product_zones` ON `base_product_zones`.`id` = `base_product_variants`.`base_product_zone_id`
      WHERE
        `base_product_variants`.`base_product_id` = ?
        AND `base_product_variants`.`base_product_view_id` = ?
        AND `base_product_variants`.`base_product_color_id` = ?
    ', [$baseProductId, $baseProductViewId, $baseProductColorId])->row();
  }
}
