<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_products extends CI_Migration {
  public function up() {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'unsigned' => true,
        'auto_increment' => true
      ),
      'base_product_id' => array(
        'type' => 'INT',
        'unsigned' => true,
      ),
      'user_id' => array(
        'type' => 'INT',
        'unsigned' => true,
        'null' => true,
      ),
      'is_admin' => array(
        'type' => 'TINYINT',
        'constraint' => '1',
        'unsigned' => true,
        'default' => 0,
      ),
      'name' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
      ),
      'description' => array(
        'type' => 'TEXT',
      ),
      'price' => array(
        'type' => 'INT',
        'unsigned' => true,
      ),
      'discount' => array(
        'type' => 'INT',
        'unsigned' => true,
        'null' => true,
      ),
      'is_public' => array(
        'type' => 'TINYINT',
        'constraint' => '1',
        'unsigned' => true,
        'default' => 0,
      ),
      'show_on_welcome' => array(
        'type' => 'TINYINT',
        'constraint' => '1',
        'unsigned' => true,
        'default' => 0,
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
    $this->dbforge->create_table('products');
  }

  public function down() {
    $this->dbforge->drop_table('products');
  }
}
