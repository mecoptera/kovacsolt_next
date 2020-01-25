<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_base_product_zones extends CI_Migration {
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
      'name' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
      ),
      'width' => array(
        'type' => 'FLOAT',
        'unsigned' => true,
      ),
      'height' => array(
        'type' => 'FLOAT',
        'unsigned' => true,
      ),
      'left' => array(
        'type' => 'FLOAT',
        'unsigned' => true,
      ),
      'top' => array(
        'type' => 'FLOAT',
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
    $this->dbforge->create_table('base_product_zones');
  }

  public function down() {
    $this->dbforge->drop_table('base_product_zones');
  }
}
