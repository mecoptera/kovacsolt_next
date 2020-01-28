<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_users extends CI_Migration {
  public function up() {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'unsigned' => true,
        'auto_increment' => true
      ),
      'email' => array(
        'type' => 'VARCHAR',
        'constraint' => '128',
        'unique' => TRUE,
      ),
      'email_verified_at' => array(
        'type' => 'TIMESTAMP',
        'null' => true,
      ),
      'password' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
      ),
      'fullname' => array(
        'type' => 'VARCHAR',
        'constraint' => '128',
      ),
    ));
    $this->dbforge->add_key('id', true);
    $this->dbforge->create_table('users');
  }

  public function down() {
    $this->dbforge->drop_table('users');
  }
}
