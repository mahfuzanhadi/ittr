<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dobat_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id_detail_biaya_obat', $id);
        $this->db->join('transaksi', 'transaksi.id_transaksi = detail_biaya_obat.id_transaksi', 'left');
        $this->db->join('obat', 'obat.id_obat = detail_biaya_obat.id_obat', 'left');
        $query = $this->db->get();
        return $query->row();
    }

    public function getById($id)
    {
        return $this->db->get_where('detail_biaya_obat', ["id_detail_biaya_obat" => $id])->row_array();
    }

    public function add_data($data)
    {
        $this->db->insert('detail_biaya_obat', $data);
        // return $this->db->affected_rows();
    }


    public function edit_data($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_data($id)
    {
        $this->db->where('id_detail_biaya_obat', $id);
        $this->db->delete($this->table);
    }


    public function get_last_transaksi()
    {
        $last_row = $this->db->select('id_transaksi')->order_by('id_transaksi', "desc")->limit(1)->get('transaksi')->row();
        return $last_row;
    }

    public function get_obat()
    {
        $query = $this->db->query('SELECT * from obat');
        return $query->result();
    }

    public function get_harga($id)
    {
        $this->db->select('harga');
        $this->db->from('obat');
        $this->db->where('id_obat', $id);
        $row = $this->db->get()->row();
        if (isset($row)) {
            return $row->harga;
        }
    }

    public function total_biaya_obat()
    {
        $last_transaksi = $this->db->select('id_transaksi')->order_by('id_transaksi', "desc")->limit(1)->get('transaksi')->row();
        $last = $last_transaksi->id_transaksi;

        $this->db->select('*');
        $this->db->from('detail_biaya_obat');
        $this->db->where('id_transaksi', $last);
        $query = $this->db->get()->result();
        foreach ($query as $row) {
            $total_biaya_obat += $row->biaya_obat;
        }

        $this->db->set('total_biaya_obat', $total_biaya_obat);
        $this->db->where('id_transaksi', $last);
        $this->db->update('transaksi');
        return $this->db->affected_rows();
    }

    public function total_biaya_keseluruhan()
    {
        $last_transaksi = $this->db->select('id_transaksi')->order_by('id_transaksi', "desc")->limit(1)->get('transaksi')->row();
        $last = $last_transaksi->id_transaksi;

        $this->db->select('*');
        $this->db->from('transaksi');
        $query = $this->db->get()->result();
        foreach ($query as $row) {
            $total_biaya_keseluruhan = $row->total_biaya_tindakan + $row->total_biaya_obat;
        }

        $this->db->set('total_biaya_keseluruhan', $total_biaya_keseluruhan);
        $this->db->where('id_transaksi', $last);
        $this->db->update('transaksi');
        return $this->db->affected_rows();
    }

    // public function kurangiStok()
    // {
    //     $last_transaksi = $this->db->select('id_transaksi')->order_by('id_transaksi', "desc")->limit(1)->get('transaksi')->row();
    //     $last = $last_transaksi->id_transaksi;

    //     $this->db->select('*');
    //     $this->db->from('detail_biaya_obat');
    //     $this->db->where('id_transaksi', $last);
    //     $query = $this->db->get()->result();
    //     foreach ($query as $row) {
    //         $id_obat = $row->id_obat;
    //         $jumlah_obat = $row->jumlah_obat;
    //     }

    //     $this->db->set('jumlah_masuk', $jumlah_obat);
    //     $this->db->where('id_obat', $id_obat);
    //     $this->db->update('inventaris_obat');
    //     return $this->db->affected_rows();
    // }

    function getObat($searchTerm = "")
    {
        // Fetch users
        $this->db->select('*');
        $this->db->where("nama like '%" . $searchTerm . "%' ");
        $fetched_records = $this->db->get('obat');
        $obat = $fetched_records->result_array();

        // Initialize Array with fetched data
        $data = array();
        foreach ($obat as $t) {
            $data[] = array("id" => $t['id_obat'], "text" => $t['nama']);
        }
        return $data;
    }
}
