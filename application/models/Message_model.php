<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Message_model extends CI_Model {
  public function getAll() {
    return $this->db->query('SELECT * FROM `messages`')->result();
  }

  public function insert() {
    $this->db->query('INSERT INTO `messages` (`email`, `name`, `message`, `status`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, ?)', [
      $this->input->post('email'),
      $this->input->post('name'),
      $this->input->post('message'),
      'new',
      date('Y-m-d H:i:s'),
      date('Y-m-d H:i:s'),
    ]);

    return $this->db->insert_id();
  }

  public function delete($id) {
    $this->db->query('DELETE FROM `messages` WHERE `id` = ?', [$id]);
  }
}
