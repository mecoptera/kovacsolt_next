<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_subscriptions extends CI_Migration {
  public function up() {
    $this->dbforge->add_field(array(
      'email' => array(
        'type' => 'VARCHAR',
        'constraint' => '128',
        'unique' => true,
      ),
      'active' => array(
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
    $this->dbforge->add_key('email', true);
    $this->dbforge->create_table('subscriptions');
  }

  public function down() {
    $this->dbforge->drop_table('subscriptions');
  }
}
