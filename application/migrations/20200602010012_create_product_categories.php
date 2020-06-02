<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_product_categories extends CI_Migration {
  public function up() {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'unsigned' => true,
        'auto_increment' => true,
      ),
      'parent_id' => array(
        'type' => 'INT',
        'unsigned' => true,
        'null' => true,
      ),
      'name' => array(
        'type' => 'VARCHAR',
        'constraint' => '128',
      ),
    ));
    $this->dbforge->add_key('id', true);
    $this->dbforge->create_table('product_categories');
  }

  public function down() {
    $this->dbforge->drop_table('product_categories');
  }
}
