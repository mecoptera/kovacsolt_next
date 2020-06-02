<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription extends MY_Controller {
  public function indexPost() {
    $this->db->query('INSERT INTO `subscriptions` (`email`, `active`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?)', [
      $this->input->post('email'),
      true,
      date('Y-m-d H:i:s'),
      date('Y-m-d H:i:s')
    ]);

    redirect('');
  }
}
