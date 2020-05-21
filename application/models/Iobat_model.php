<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Iobat_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table = 'inventaris_obat';
    var $select_column = array('inventaris_obat.id_inventaris_obat as id_inventaris_obat', 'obat.nama as nama', 'obat.satuan as satuan', 'obat.ukuran as ukuran', 'obat.harga as harga', 'inventaris_obat.tgl_masuk as tgl_masuk', 'inventaris_obat.expired as expired', 'inventaris_obat.jumlah_masuk as jumlah_masuk');
    var $order_column = array(null, 'nama', 'satuan', 'ukuran', 'harga', 'tgl_masuk', 'expired', 'jumlah_masuk'); //set column field database for datatable orderable
    var $order = array('id_inventaris_obat' => 'asc'); // default order 

    public function make_query()
    {
        $this->db->select('inventaris_obat.id_inventaris_obat as id_inventaris_obat, obat.nama as nama, obat.satuan as satuan, obat.ukuran as ukuran, obat.harga as harga, inventaris_obat.tgl_masuk as tgl_masuk, inventaris_obat.expired as expired, inventaris_obat.jumlah_masuk as jumlah_masuk');
        $this->db->from($this->table);
        $this->db->join('obat', 'obat.id_obat = inventaris_obat.id_obat', 'left');
        if (isset($_POST["search"]["value"])) {
            $this->db->like('nama', $_POST["search"]["value"]);
        }
        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by("id_inventaris_obat", "ASC");
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
        $this->db->select('inventaris_obat.id_inventaris_obat as id_inventaris_obat, obat.nama as nama, obat.satuan as satuan, obat.ukuran as ukuran, obat.harga as harga, inventaris_obat.tgl_masuk as tgl_masuk, inventaris_obat.expired as expired, inventaris_obat.jumlah_masuk as jumlah_masuk');
        $this->db->from($this->table);
        $this->db->join('obat', 'obat.id_obat = inventaris_obat.id_obat', 'left');
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_inventaris_obat', $id);
        $this->db->join('obat', 'obat.id_obat = inventaris_obat.id_obat', 'left');
        $query = $this->db->get();
        return $query->row();
    }

    public function getById($id)
    {
        //SELECT * FROM pasien WHERE id_pasien = $id
        //mengembalikan sebuah objek
        return $this->db->get_where('inventaris_obat', ["id_inventaris_obat" => $id])->row_array();
    }

    public function get_obat()
    {
        $query = $this->db->query('SELECT * from obat');
        return $query->result();
    }

    public function add_data($data)
    {
        $this->db->insert('inventaris_obat', $data);
    }

    function edit_data($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    function delete_data($id)
    {
        $this->db->where('id_inventaris_obat', $id);
        $this->db->delete($this->table);
    }
}
