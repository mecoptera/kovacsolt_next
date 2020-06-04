<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_category_model extends CI_Model {
  public function buildTree($activeCategoryId) {
    $categories = $this->db->query('SELECT * FROM `product_categories`')->result();

    if (count($categories) === 0) { return []; }

    $children = [];

    foreach($categories as $category) {
      if ($category->id === $activeCategoryId) {
        $category->active = true;
      }

      $children[$category->parent_id !== null ? $category->parent_id : 0][] = $category;
    }

    foreach($categories as $category) {
      if (isset($children[$category->id])) {
        $category->children = $children[$category->id];
      }
    }

    return $children[0];
  }
}
