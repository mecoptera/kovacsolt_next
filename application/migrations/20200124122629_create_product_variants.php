<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_product_variants extends CI_Migration {
  public function up() {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'unsigned' => true,
        'auto_increment' => true
      ),
      'product_id' => array(
        'type' => 'INT',
        'unsigned' => true,
      ),
      'base_product_variant_id' => array(
        'type' => 'INT',
        'unsigned' => true,
        'null' => true,
      ),
      'design_id' => array(
        'type' => 'INT',
        'unsigned' => true,
      ),
      'desing_width' => array(
        'type' => 'FLOAT',
        'unsigned' => true,
      ),
      'desing_left' => array(
        'type' => 'FLOAT',
        'unsigned' => true,
      ),
      'design_top' => array(
        'type' => 'FLOAT',
        'unsigned' => true,
      ),
      'default' => array(
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
    $this->dbforge->create_table('product_variants');
  }

  public function down() {
    $this->dbforge->drop_table('product_variants');
  }
}
