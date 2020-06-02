<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Alter_base_products_add_product_category_id extends CI_Migration {
  public function up() {
    $field = array(
      'product_category_id' => array(
        'type' => 'INT',
        'unsigned' => true,
        'null' => true,
        'after' => 'name',
      ),
    );

    $this->dbforge->add_column('base_products', $field);
  }

  public function down() {
    $this->dbforge->drop_column('base_products', 'product_category_id');
  }
}
