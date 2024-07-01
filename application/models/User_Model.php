<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function register($data) {
        $this->db->insert('users', $data);
    }

    public function get_user($email) {
        return $this->db->get_where('users', ['email' => $email])->row_array();
    }

    public function get_user_by_id($id) {
        return $this->db->get_where('users', ['id' => $id])->row_array();
    }

    public function update_profile($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }
}
