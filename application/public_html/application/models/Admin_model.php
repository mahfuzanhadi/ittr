<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table = 'admin';

    function edit_data($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    function is_exist($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get("admin");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
