<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Alter_products_add_product_category_id extends CI_Migration {
  public function up() {
    $field = array(
      'product_category_id' => array(
        'type' => 'INT',
        'unsigned' => true,
        'after' => 'user_id',
      ),
    );

    $this->dbforge->add_column('products', $field);
  }

  public function down() {
    $this->dbforge->drop_column('products', 'product_category_id');
  }
}
