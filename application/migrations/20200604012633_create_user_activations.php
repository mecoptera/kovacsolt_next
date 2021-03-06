<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_user_activations extends CI_Migration {
  public function up() {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'unsigned' => true,
        'auto_increment' => true,
      ),
      'email' => array(
        'type' => 'VARCHAR',
        'constraint' => '128',
      ),
      'hash' => array(
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
    $this->dbforge->create_table('user_activations');
  }

  public function down() {
    $this->dbforge->drop_table('user_activations');
  }
}
