<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Design_model extends CI_Model {
  public function insert($isAdmin = false, $isTemporary = true) {
    $this->db->query('INSERT INTO `designs` (`user_id`, `is_admin`, `name`, `temporary`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, ?)', [
      $this->session->userdata('user')->id,
      $isAdmin,
      $this->input->post('name'),
      $isTemporary,
      date('Y-m-d H:i:s'),
      date('Y-m-d H:i:s'),
    ]);

    return $this->db->insert_id();
  }

  public function getAdmin() {
    return $this->db->query('SELECT * FROM `designs` WHERE `is_admin` = TRUE')->result();
  }

  public function rename($id) {
    $this->db->query('UPDATE `designs` SET `name` = ?, `updated_at` = ? WHERE `id` = ?', [
      $this->input->post('name'),
      date('Y-m-d H:i:s'),
      $id,
    ]);
  }

  public function delete($id) {
    $this->db->query('DELETE FROM `designs` WHERE `id` = ?', [ $id ]);
  }
}
