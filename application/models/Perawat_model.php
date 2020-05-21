<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perawat_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table = 'perawat';
    var $select_column = array('id_perawat', 'nama', 'alamat', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'no_telp', 'no_str', 'tanggal_berlaku_str', 'username', 'password', 'email');
    var $order_column = array(null, 'nama', 'alamat', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'no_telp', 'no_str', 'tanggal_berlaku_str', 'username', null, 'email'); //set column field database for datatable orderable
    var $order = array('id_perawat' => 'asc'); // default order 

    public function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->like('nama', $_POST["search"]["value"]);
            $this->db->or_like('alamat', $_POST["search"]["value"]);
            $this->db->or_like('tempat_lahir', $_POST["search"]["value"]);
            $this->db->or_like('no_telp', $_POST["search"]["value"]);
            $this->db->or_like('email', $_POST["search"]["value"]);
            $this->db->or_like('no_str', $_POST["search"]["value"]);
            $this->db->or_like('username', $_POST["search"]["value"]);
        }
        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by("id_perawat", "ASC");
        }
    }

    public function make_datatables()
    {
        $this->make_query();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data()
    {
        $this->make_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_all_data()
    {
        $this->db->select("*");
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id_perawat', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getById($id)
    {
        //SELECT * FROM pasien WHERE id_pasien = $id
        //mengembalikan sebuah objek
        return $this->db->get_where('perawat', ["id_perawat" => $id])->row_array();
    }

    public function add_data($data)
    {
        $this->db->insert('perawat', $data);
        // return $this->db->insert_id();
    }

    function edit_data($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    function delete_data($id)
    {
        $this->db->where('id_perawat', $id);
        $this->db->delete($this->table);
    }

    function is_exist($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('perawat');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
