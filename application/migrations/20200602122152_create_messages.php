<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_messages extends CI_Migration {
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
      'name' => array(
        'type' => 'VARCHAR',
        'constraint' => '128',
      ),
      'message' => array(
        'type' => 'TEXT',
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
    $this->dbforge->create_table('messages');
  }

  public function down() {
    $this->dbforge->drop_table('messages');
  }
}
