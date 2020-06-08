<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {
  public function getAllFeatured() {
    return $this->db->query('
      SELECT
        `products`.`id`, `products`.`name`, `products`.`price`, `products`.`discount`,
        CAST(`products`.`price` * (100 - COALESCE(`products`.`discount`, 0)) / 100 AS UNSIGNED) AS `discount_price`,
        `base_product_variants`.`id` AS `base_product_variant_id`,
        `base_product_zones`.`width` AS `base_product_zone_width`, `base_product_zones`.`height` AS `base_product_zone_height`, `base_product_zones`.`left` AS `base_product_zone_left`, `base_product_zones`.`top` AS `base_product_zone_top`,
        `product_variants`.`design_id` AS `product_variant_design_id`, `product_variants`.`design_width` AS `product_variant_design_width`, `product_variants`.`design_left` AS `product_variant_design_left`, `product_variants`.`design_top` AS `product_variant_design_top`,
        `base_products`.`name` AS `base_product_name`
      FROM `products`
      LEFT JOIN `product_variants` ON `product_variants`.`product_id` = `products`.`id`
      LEFT JOIN `base_product_variants` ON `base_product_variants`.`id` = `product_variants`.`base_product_variant_id`
      LEFT JOIN `base_product_zones` ON `base_product_zones`.`id` = `base_product_variants`.`base_product_zone_id`
      LEFT JOIN `base_products` ON `base_products`.`id` = `products`.`base_product_id`
      WHERE `products`.`show_on_welcome` = TRUE
        AND `product_variants`.`default` = TRUE
      ORDER BY `products`.`updated_at` DESC
    ')->result();
  }

  public function get($id) {
    return $this->db->query('
      SELECT
        `products`.`id`, `products`.`name`, `products`.`description`, `products`.`price`, `products`.`discount`,
        CAST(`products`.`price` * (100 - COALESCE(`products`.`discount`, 0)) / 100 AS UNSIGNED) AS `discount_price`,
        `base_product_variants`.`id` AS `base_product_variant_id`,
        `base_product_zones`.`width` AS `base_product_zone_width`, `base_product_zones`.`height` AS `base_product_zone_height`, `base_product_zones`.`left` AS `base_product_zone_left`, `base_product_zones`.`top` AS `base_product_zone_top`,
        `base_product_colors`.`name` AS `base_product_color_name`,
        `product_variants`.`design_id` AS `product_variant_design_id`, `product_variants`.`design_width` AS `product_variant_design_width`, `product_variants`.`design_left` AS `product_variant_design_left`, `product_variants`.`design_top` AS `product_variant_design_top`,
        `base_products`.`name` AS `base_product_name`
      FROM `products`
      LEFT JOIN `product_variants` ON `product_variants`.`product_id` = `products`.`id`
      LEFT JOIN `base_product_variants` ON `base_product_variants`.`id` = `product_variants`.`base_product_variant_id`
      LEFT JOIN `base_product_zones` ON `base_product_zones`.`id` = `base_product_variants`.`base_product_zone_id`
      LEFT JOIN `base_product_colors` ON `base_product_colors`.`id` = `base_product_variants`.`base_product_color_id`
      LEFT JOIN `base_products` ON `base_products`.`id` = `products`.`base_product_id`
      WHERE `products`.`id` = ?
        AND `product_variants`.`default` = TRUE
    ', [$id])->row();
  }

  public function getAll() {
    return $this->db->query('
      SELECT
        `products`.`id`, `products`.`name`, `products`.`description`, `products`.`price`, `products`.`discount`,
        CAST(`products`.`price` * (100 - COALESCE(`products`.`discount`, 0)) / 100 AS UNSIGNED) AS `discount_price`,
        `base_product_variants`.`id` AS `base_product_variant_id`,
        `base_product_zones`.`width` AS `base_product_zone_width`, `base_product_zones`.`height` AS `base_product_zone_height`, `base_product_zones`.`left` AS `base_product_zone_left`, `base_product_zones`.`top` AS `base_product_zone_top`,
        `product_variants`.`design_id` AS `product_variant_design_id`, `product_variants`.`design_width` AS `product_variant_design_width`, `product_variants`.`design_left` AS `product_variant_design_left`, `product_variants`.`design_top` AS `product_variant_design_top`,
        `base_products`.`name` AS `base_product_name`
      FROM `products`
      LEFT JOIN `product_variants` ON `product_variants`.`product_id` = `products`.`id`
      LEFT JOIN `base_product_variants` ON `base_product_variants`.`id` = `product_variants`.`base_product_variant_id`
      LEFT JOIN `base_product_zones` ON `base_product_zones`.`id` = `base_product_variants`.`base_product_zone_id`
      LEFT JOIN `base_products` ON `base_products`.`id` = `products`.`base_product_id`
      WHERE `products`.`is_public` = TRUE
        AND `product_variants`.`default` = TRUE
      ORDER BY `products`.`updated_at` DESC
    ')->result();
  }

  public function getAllByProductCategoryId($productCategoryId, $sortBy) {
    $query = '
      SELECT
        `products`.`id`, `products`.`name`, `products`.`description`, `products`.`price`, `products`.`discount`,
        CAST(`products`.`price` * (100 - COALESCE(`products`.`discount`, 0)) / 100 AS UNSIGNED) AS `discount_price`,
        `base_product_variants`.`id` AS `base_product_variant_id`,
        `base_product_zones`.`width` AS `base_product_zone_width`, `base_product_zones`.`height` AS `base_product_zone_height`, `base_product_zones`.`left` AS `base_product_zone_left`, `base_product_zones`.`top` AS `base_product_zone_top`,
        `product_variants`.`design_id` AS `product_variant_design_id`, `product_variants`.`design_width` AS `product_variant_design_width`, `product_variants`.`design_left` AS `product_variant_design_left`, `product_variants`.`design_top` AS `product_variant_design_top`,
        `base_products`.`name` AS `base_product_name`,
        `base_products`.`product_category_id` AS `base_product_product_category_id`
      FROM `products`
      LEFT JOIN `product_variants` ON `product_variants`.`product_id` = `products`.`id`
      LEFT JOIN `base_product_variants` ON `base_product_variants`.`id` = `product_variants`.`base_product_variant_id`
      LEFT JOIN `base_product_zones` ON `base_product_zones`.`id` = `base_product_variants`.`base_product_zone_id`
      LEFT JOIN `base_products` ON `base_products`.`id` = `products`.`base_product_id`
      WHERE `products`.`is_public` = TRUE
        AND `product_variants`.`default` = TRUE
        AND (
          `base_products`.`product_category_id` = ?
          OR
          `base_products`.`product_category_id` IN
            (
              SELECT `id` FROM `product_categories` WHERE `parent_id` = ?
            )
        )
    ';

    if ($sortBy === 'new') {
      $query .= 'ORDER BY `products`.`updated_at` DESC';
    } elseif ($sortBy === 'old') {
      $query .= 'ORDER BY `products`.`updated_at` ASC';
    } elseif ($sortBy === 'name_asc') {
      $query .= 'ORDER BY `products`.`name` ASC';
    } elseif ($sortBy === 'name_desc') {
      $query .= 'ORDER BY `products`.`name` DESC';
    } elseif ($sortBy === 'price_asc') {
      $query .= 'ORDER BY `discount_price` ASC';
    } elseif ($sortBy === 'price_desc') {
      $query .= 'ORDER BY `discount_price` DESC';
    }

    return $this->db->query($query, [$productCategoryId, $productCategoryId])->result();
  }

  public function _get($id) {
    return $this->db->query('SELECT * FROM `products` WHERE `id` = ?', [$id])->row();
  }

  public function _insert($isAdmin = false) {
    $this->db->query('INSERT INTO `products` (`base_product_id`, `user_id`, `is_admin`, `name`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, ?)', [
      $this->input->post('base_product_id'),
      $this->session->userdata('user')->id,
      $isAdmin,
      $this->input->post('name'),
      date('Y-m-d H:i:s'),
      date('Y-m-d H:i:s'),
    ]);
  }

  public function _getAdmin() {
    return $this->db->query('SELECT * FROM `products` WHERE `is_admin` = TRUE')->result();
  }

  public function _update($id) {
    $this->db->query('UPDATE `products` SET `name` = ?, `description` = ?, `price` = ?, `discount` = ?, `is_public` = ?, `show_on_welcome` = ?, `updated_at` = ? WHERE `id` = ?', [
      $this->input->post('name'),
      $this->input->post('description'),
      $this->input->post('price'),
      $this->input->post('discount') === '0' || $this->input->post('discount') === '' ? null : $this->input->post('discount'),
      $this->input->post('is_public') === 'on',
      $this->input->post('show_on_welcome') === 'on',
      date('Y-m-d H:i:s'),
      $id
    ]);
  }

  public function _delete($id) {
    $this->db->query('DELETE FROM `products` WHERE `id` = ?', [$id]);
  }
}
