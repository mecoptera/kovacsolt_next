<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_cart_products extends CI_Migration {
  public function up() {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'unsigned' => true,
        'auto_increment' => true
      ),
      'unique_id' => array(
        'type' => 'VARCHAR',
        'constraint' => '32',
      ),
      'cart_id' => array(
        'type' => 'INT',
        'unsigned' => true,
      ),
      'product_id' => array(
        'type' => 'INT',
        'unsigned' => true,
      ),
      'extra_data' => array(
        'type' => 'LONGTEXT',
      ),
      'quantity' => array(
        'type' => 'INT',
        'unsigned' => true,
      ),
      'created_at' => array(
        'type' => 'TIMESTAMP',
        'null' => true,
      ),
      'updated_at' => array(
        'type' => 'TIMESTAMP',
        'null' => true,
      ),
    ));
    $this->dbforge->add_key('id', true);
    $this->dbforge->create_table('cart_products');
  }

  public function down() {
    $this->dbforge->drop_table('cart_products');
  }
}
