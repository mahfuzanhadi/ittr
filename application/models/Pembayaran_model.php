<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table = 'pembayaran';
    var $select_column = array('id_pembayaran', 'id_transaksi', 'jumlah_bayar', 'kembalian', 'tanggal');
    var $order_column = array(null, 'jumlah_bayar', 'kembalian', 'tanggal'); //set column field database for datatable orderable
    var $order = array('id_pembayaran' => 'asc'); // default order 

    public function get_all()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    public function getById($id)
    {
        return $this->db->get_where('pembayaran', ["id_pembayaran" => $id])->row_array();
    }

    public function add_data($data)
    {
        $this->db->insert('pembayaran', $data);

        $kembalian = 0;

        $id = $this->get_last_id()->id_pembayaran;
        $this->db->select('*');
        $this->db->from('pembayaran');
        $this->db->where('id_pembayaran', $id);
        $row = $this->db->get()->row();
        if (isset($row)) {
            $id_transaksi = $row->id_transaksi;
            $jumlah_bayar = $row->jumlah_bayar;
        }

        $query1 = $this->db->query("SELECT id_pembayaran FROM pembayaran WHERE id_transaksi = " . $id_transaksi . " AND id_pembayaran < " . $id . " ORDER BY id_pembayaran LIMIT 1");
        if ($query1->num_rows() == null || $query1->num_rows() <= 0) {
            $id_before = null;
        } else {
            $id_before = $query1->id_pembayaran;
        }

        if ($id_before != '' || $id_before != null) {
            $this->db->select('*');
            $this->db->from('pembayaran');
            $this->db->where('id_pembayaran', $id_before);
            $row1 = $this->db->get()->row();
            if (isset($row1)) {
                $sisa_sebelum = $row1->sisa_sesudah;
            }
        } else {
            $sisa_sebelum = 0;
        }

        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('id_transaksi', $id_transaksi);
        $query = $this->db->get()->row();
        if (isset($query)) {
            $sisa_sebelum = $query->sisa;
        }

        $kembalian = $jumlah_bayar - $sisa_sebelum;
        if ($kembalian > 0) {
            $sisa_sesudah = 0;
        } else {
            $sisa_sesudah = abs($kembalian);
            $kembalian = 0;
        }

        $this->db->set('sisa', $sisa_sesudah);
        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->update('transaksi');

        $this->db->set('kembalian', $kembalian);
        $this->db->set('sisa_sebelum', $sisa_sebelum);
        $this->db->set('sisa_sesudah', $sisa_sesudah);
        $this->db->where('id_pembayaran', $id);
        $this->db->update('pembayaran');
        return $this->db->affected_rows();
    }

    function edit_data($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    function delete_data($id)
    {
        $this->db->where('id_pembayaran', $id);
        $this->db->delete($this->table);
    }

    function get_last_id()
    {
        return $this->db->select('id_pembayaran')->order_by('id_pembayaran', "desc")->limit(1)->get('pembayaran')->row();
    }

    //GET ALL DATA FROM TABLE TRANSAKSI
    public function get_transaksi()
    {
        return $this->db->query('SELECT * from transaksi')->result();
    }
}
