<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_base_product_views extends CI_Migration {
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
    $this->dbforge->create_table('base_product_views');
  }

  public function down() {
    $this->dbforge->drop_table('base_product_views');
  }
}
