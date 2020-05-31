<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_order_products extends CI_Migration {
  public function up() {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'unsigned' => true,
        'auto_increment' => true
      ),
      'order_id' => array(
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
      'price' => array(
        'type' => 'INT',
        'unsigned' => true,
      ),
      'quantity' => array(
        'type' => 'INT',
        'unsigned' => true,
      ),
      'status' => array(
        'type' => 'VARCHAR',
        'constraint' => '32',
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
    $this->dbforge->create_table('order_products');
  }

  public function down() {
    $this->dbforge->drop_table('order_products');
  }
}
