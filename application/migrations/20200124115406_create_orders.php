<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_orders extends CI_Migration {
  public function up() {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'unsigned' => true,
        'auto_increment' => true
      ),
      'order_id' => array(
        'type' => 'VARCHAR',
        'constraint' => '32',
      ),
      'visible_order_id' => array(
        'type' => 'VARCHAR',
        'constraint' => '7',
      ),
      'user_id' => array(
        'type' => 'INT',
        'unsigned' => true,
      ),
      'billing_data' => array(
        'type' => 'LONGTEXT',
      ),
      'shipping_data' => array(
        'type' => 'LONGTEXT',
      ),
      'payment_data' => array(
        'type' => 'LONGTEXT',
      ),
      'finalize_data' => array(
        'type' => 'LONGTEXT',
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
    $this->dbforge->create_table('orders');
  }

  public function down() {
    $this->dbforge->drop_table('orders');
  }
}
