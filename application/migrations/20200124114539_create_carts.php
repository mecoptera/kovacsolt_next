<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_carts extends CI_Migration {
  public function up() {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'unsigned' => true,
        'auto_increment' => true
      ),
      'user_id' => array(
        'type' => 'INT',
        'unsigned' => true,
      ),
      'closed' => array(
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
    $this->dbforge->create_table('carts');
  }

  public function down() {
    $this->dbforge->drop_table('carts');
  }
}
