<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dobat_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    var $table = 'detail_biaya_obat';

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
        $total_biaya_obat = 0;
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

    public function edit_total_biaya_obat($id)
    {

        $total_biaya_obat = 0;
        $this->db->select('*');
        $this->db->from('detail_biaya_obat');
        $this->db->where('id_transaksi', $id);
        $query = $this->db->get()->result();
        foreach ($query as $row) {
            $total_biaya_obat += $row->biaya_obat;
        }

        $this->db->set('total_biaya_obat', $total_biaya_obat);
        $this->db->where('id_transaksi', $id);
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

    public function edit_total_biaya_keseluruhan($id)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('id_transaksi', $id);
        $query = $this->db->get()->result();
        foreach ($query as $row) {
            $total_biaya_keseluruhan = $row->total_biaya_tindakan + $row->total_biaya_obat;
        }

        $this->db->set('total_biaya_keseluruhan', $total_biaya_keseluruhan);
        $this->db->where('id_transaksi', $id);
        $this->db->update('transaksi');
        return $this->db->affected_rows();
    }

    public function get_stok($id_obat)
    {
        $this->db->select('*');
        $this->db->from('obat');
        $this->db->where('id_obat', $id_obat);
        return $this->db->get()->row();
    }

    public function kurangi_stok($data, $id)
    {
        $stok = 0;

        $query = $this->get_stok($id);
        $stok = $query->stok;

        $this->db->set('stok', $stok - $data);
        $this->db->where('id_obat', $id);
        $this->db->update('obat');
        return $this->db->affected_rows();
    }

    public function update_stok($data, $id_obat, $id_detail)
    {
        $temp = 0;
        $jumlah_stok = 0;

        $this->db->select('*');
        $this->db->from('detail_biaya_obat');
        $this->db->where('id_detail_biaya_obat', $id_detail);
        $query = $this->db->get()->row();
        $jumlah_obat = $query->jumlah_obat; //dapat jumlah obat dari id detail biaya obat
        $id = $query->id_obat;

        if ($id_obat == $id) {
            $query2 = $this->get_stok($id_obat);
            $temp = $query2->stok + $jumlah_obat; //temp = stok dari tabel obat + jumlah obat dari detail biaya obat

            $jumlah_stok = $temp - $data;

            $this->db->set('stok', $jumlah_stok);
            $this->db->where('id_obat', $id_obat);
            $this->db->update('obat'); //update obat set stok + jumlah masuk where id_obat = id
            return $this->db->affected_rows();
        } else {
            //balikin stok obat lama ke semula
            $query2 = $this->get_stok($id);
            $temp = $query2->stok + $jumlah_obat;
            $this->db->set('stok', $temp);
            $this->db->where('id_obat', $id);
            $this->db->update('obat');

            //kurangi stok obat baru
            $query3 = $this->get_stok($id_obat);
            $temp2 = $query3->stok - $data;

            $this->db->set('stok', $temp2);
            $this->db->where('id_obat', $id_obat);
            $this->db->update('obat');
            return $this->db->affected_rows();
        }
    }

    public function delete_stok($id)
    {
        $jumlah_obat = 0;

        $this->db->select('*');
        $this->db->from('detail_biaya_obat');
        $this->db->where('id_transaksi', $id);
        $query2 = $this->db->get()->result();
        foreach ($query2 as $row) {
            $id_obat = $row->id_obat;
            $jumlah_obat = $row->jumlah_obat;

            $this->db->select('*');
            $this->db->from('obat');
            $this->db->where('id_obat', $id_obat);
            $query3 = $this->db->get()->row();
            $stok = $query3->stok;

            $jumlah_stok = $stok + $jumlah_obat;
            $this->db->set('stok', $jumlah_stok);
            $this->db->where('id_obat', $id_obat);
            $this->db->update('obat'); //update obat set stok + jumlah masuk where id_obat = id
        }

        return $this->db->affected_rows();
    }

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

    public function getDobat1($id)
    {
        $this->db->select('id_detail_biaya_obat');
        // $this->db->select_min('id_detail_biaya_obat');
        $this->db->from('detail_biaya_obat');
        $this->db->where('id_transaksi', $id);
        $row = $this->db->get()->first_row();
        if (isset($row)) {
            $first = $row->id_detail_biaya_obat;
        }

        return $this->db->get_where('detail_biaya_obat', ["id_detail_biaya_obat" => $first])->row_array();
    }


    public function getObat1($id)
    {
        $this->db->select('id_detail_biaya_obat');
        // $this->db->select_min('id_detail_biaya_obat');
        $this->db->from('detail_biaya_obat');
        $this->db->where('id_transaksi', $id);
        $row = $this->db->get()->first_row();
        if (isset($row)) {
            $first = $row->id_detail_biaya_obat;
        }

        $this->db->select('*');
        $this->db->from('detail_biaya_obat');
        $this->db->where('id_detail_biaya_obat', $first);
        $row2 = $this->db->get()->row();
        if (isset($row2)) {
            $id_obat = $row2->id_obat;
        }

        return $this->db->get_where('obat', ["id_obat" => $id_obat])->row_array();
    }

    public function getDobat2($id)
    {
        $this->db->select('id_detail_biaya_obat');
        $this->db->from('detail_biaya_obat');
        $this->db->where('id_transaksi', $id);
        $row = $this->db->get();
        if ($row->num_rows() > 1) {
            $this->db->select('id_detail_biaya_obat');
            $this->db->from('detail_biaya_obat');
            $this->db->where('id_transaksi', $id);
            $row2 = $this->db->get()->last_row();
            if (isset($row2)) {
                $last = $row2->id_detail_biaya_obat;
            }

            return $this->db->get_where('detail_biaya_obat', ["id_detail_biaya_obat" => $last])->row_array();
        }
    }

    public function getObat2($id)
    {
        $this->db->select('id_detail_biaya_obat');
        $this->db->from('detail_biaya_obat');
        $this->db->where('id_transaksi', $id);
        $row = $this->db->get();
        if ($row->num_rows() > 1) {
            $this->db->select('id_detail_biaya_obat');
            $this->db->from('detail_biaya_obat');
            $this->db->where('id_transaksi', $id);
            $row2 = $this->db->get()->last_row();
            if (isset($row2)) {
                $last = $row2->id_detail_biaya_obat;
            }

            $this->db->select('*');
            $this->db->from('detail_biaya_obat');
            $this->db->where('id_detail_biaya_obat', $last);
            $row2 = $this->db->get()->row();
            if (isset($row2)) {
                $id_obat = $row2->id_obat;
            }

            return $this->db->get_where('obat', ["id_obat" => $id_obat])->row_array();
        }
    }
}
