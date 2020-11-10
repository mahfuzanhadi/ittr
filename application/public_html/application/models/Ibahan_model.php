<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ibahan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table = 'inventaris_bahan';
    var $select_column = array('inventaris_bahan.id_inventaris_bahan as id_inventaris_bahan', 'bahan.nama as nama', 'bahan.satuan as satuan', 'inventaris_bahan.tgl_masuk as tgl_masuk', 'inventaris_bahan.expired as expired', 'inventaris_bahan.jumlah_masuk as jumlah_masuk');
    var $order_column = array(null, 'nama', 'satuan', 'tgl_masuk', 'expired', 'jumlah_masuk'); //set column field database for datatable orderable
    var $order = array('id_inventaris_bahan' => 'asc'); // default order 

    public function make_query()
    {
        $this->db->select('inventaris_bahan.id_inventaris_bahan as id_inventaris_bahan, bahan.nama as nama, bahan.satuan as satuan, inventaris_bahan.tgl_masuk as tgl_masuk, inventaris_bahan.expired as expired, inventaris_bahan.jumlah_masuk as jumlah_masuk');
        $this->db->from($this->table);
        $this->db->join('bahan', 'bahan.id_bahan = inventaris_bahan.id_bahan', 'left');
        if (isset($_POST["search"]["value"])) {
            $this->db->like('nama', $_POST["search"]["value"]);
            $this->db->or_like('satuan', $_POST["search"]["value"]);
            $this->db->or_like('tgl_masuk', $_POST["search"]["value"]);
            $this->db->or_like('expired', $_POST["search"]["value"]);
        }
        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by("id_inventaris_bahan", "ASC");
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
        $this->db->select('inventaris_bahan.id_inventaris_bahan as id_inventaris_bahan, bahan.nama as nama, bahan.satuan as satuan, inventaris_bahan.tgl_masuk as tgl_masuk, inventaris_bahan.expired as expired, inventaris_bahan.jumlah_masuk as jumlah_masuk');
        $this->db->from($this->table);
        $this->db->join('bahan', 'bahan.id_bahan = inventaris_bahan.id_bahan', 'left');
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_inventaris_bahan', $id);
        $this->db->join('bahan', 'bahan.id_bahan = inventaris_bahan.id_bahan', 'left');
        $query = $this->db->get();
        return $query->row();
    }

    public function getById($id)
    {
        //SELECT * FROM pasien WHERE id_pasien = $id
        //mengembalikan sebuah objek
        return $this->db->get_where('inventaris_bahan', ["id_inventaris_bahan" => $id])->row_array();
    }

    public function get_bahan()
    {
        $query = $this->db->query('SELECT * from bahan ORDER BY nama ASC');
        return $query->result();
    }

    public function add_data($data)
    {
        $this->db->insert('inventaris_bahan', $data);
    }

    function edit_data($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    function delete_data($id)
    {
        $this->db->where('id_inventaris_bahan', $id);
        $this->db->delete($this->table);
    }

    public function get_stok($where)
    {
        $this->db->select('*');
        $this->db->from('bahan');
        $this->db->where($where);
        return $this->db->get()->row();
    }

    public function add_stok($data, $where)
    {
        $jumlah_stok = 0;

        $query = $this->get_stok($where);
        $jumlah_stok = $query->stok + $data;

        $this->db->set('stok', $jumlah_stok);
        $this->db->where($where);
        $this->db->update('bahan'); //update bahan set stok + jumlah masuk where id_bahan = id
        return $this->db->affected_rows();
    }

    public function update_stok($data, $id_bahan, $id_inventaris)
    {
        $temp = 0;

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($id_inventaris);
        $query = $this->db->get()->row();
        $jumlah_masuk = $query->jumlah_masuk;

        $query2 = $this->get_stok($id_bahan);
        $temp = $query2->stok - $jumlah_masuk; //

        // $query = $this->get_stok($data, $id_bahan);
        $jumlah_stok = 0;

        $jumlah_stok = $temp + $data;

        $this->db->set('stok', $jumlah_stok);
        $this->db->where($id_bahan);
        $this->db->update('bahan'); //update bahan set stok + jumlah masuk where id_bahan = id
        return $this->db->affected_rows();
    }

    public function delete_stok($id)
    {
        $jumlah_masuk = 0;

        $this->db->select('*');
        $this->db->from('inventaris_bahan');
        $this->db->where('id_inventaris_bahan', $id);
        $query = $this->db->get()->row();
        $id_bahan = $query->id_bahan;
        $jumlah_masuk = $query->jumlah_masuk;

        $this->db->select('*');
        $this->db->from('bahan');
        $this->db->where('id_bahan', $id_bahan);
        $query2 = $this->db->get()->row();
        $stok = $query2->stok;

        $jumlah_stok = $stok - $jumlah_masuk;
        $this->db->set('stok', $jumlah_stok);
        $this->db->where('id_bahan', $id_bahan);
        $this->db->update('bahan'); //update obat set stok + jumlah masuk where id_obat = id
        return $this->db->affected_rows();
    }
}
