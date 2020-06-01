<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table = 'transaksi';
    var $select_column = array('transaksi.id_transaksi as id_transaksi', 'pasien.no_rekam_medis as no_rekam_medis', 'pasien.nama as nama_pasien', 'dokter.nama as nama_dokter', 'perawat.nama as nama_perawat', 'transaksi.tanggal as tanggal', 'transaksi.diagnosa as diagnosa', 'transaksi.total_biaya_tindakan as total_biaya_tindakan', 'transaksi.total_biaya_obat as total_biaya_obat', 'transaksi.foto_rontgen as foto_rontgen', 'transaksi.keterangan as keterangan', 'transaksi.jam_mulai as jam_mulai', 'transaksi.jam_selesai as jam_selesai', 'transaksi.total_biaya_keseluruhan as total_biaya_keseluruhan', 'transaksi.metode_pembayaran as metode_pembayaran');
    var $order_column = array(null, 'no_rekam_medis', 'nama_pasien', 'nama_dokter', 'nama_perawat', 'tanggal',  'diagnosa', 'total_biaya_tindakan', 'total_biaya_obat', null, 'keterangan', 'jam_mulai', 'jam_selesai', 'total_biaya_keseluruhan', 'metode_pembayaran'); //set column field database for datatable orderable
    var $order = array('id_transaksi' => 'desc'); // default order 

    public function make_query()
    {
        $this->db->select('transaksi.id_transaksi as id_transaksi, pasien.no_rekam_medis as no_rekam_medis, pasien.nama as nama_pasien, dokter.nama as nama_dokter, perawat.nama as nama_perawat, transaksi.tanggal as tanggal, transaksi.diagnosa as diagnosa, transaksi.total_biaya_tindakan as total_biaya_tindakan, transaksi.total_biaya_obat as total_biaya_obat, transaksi.foto_rontgen as foto_rontgen, transaksi.keterangan as keterangan, transaksi.jam_mulai as jam_mulai, transaksi.jam_selesai as jam_selesai, transaksi.total_biaya_keseluruhan as total_biaya_keseluruhan, transaksi.metode_pembayaran as metode_pembayaran');
        $this->db->from($this->table);
        $this->db->join('pasien', 'pasien.id_pasien = transaksi.id_pasien', 'left');
        $this->db->join('dokter', 'dokter.id_dokter = transaksi.id_dokter', 'left');
        $this->db->join('perawat', 'perawat.id_perawat = transaksi.id_perawat', 'left');
        if (isset($_POST["search"]["value"])) {
            $this->db->like('no_rekam_medis', $_POST["search"]["value"]);
            $this->db->or_like('pasien.nama', $_POST["search"]["value"]);
            $this->db->or_like('dokter.nama', $_POST["search"]["value"]);
            $this->db->or_like('perawat.nama', $_POST["search"]["value"]);
            $this->db->or_like('tanggal', $_POST["search"]["value"]);
            $this->db->or_like('diagnosa', $_POST["search"]["value"]);
            $this->db->or_like('total_biaya_tindakan', $_POST["search"]["value"]);
            $this->db->or_like('total_biaya_obat', $_POST["search"]["value"]);
            $this->db->or_like('keterangan', $_POST["search"]["value"]);
            $this->db->or_like('jam_mulai', $_POST["search"]["value"]);
            $this->db->or_like('jam_selesai', $_POST["search"]["value"]);
            $this->db->or_like('total_biaya_keseluruhan', $_POST["search"]["value"]);
            $this->db->or_like('metode_pembayaran', $_POST["search"]["value"]);
        }
        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by("id_transaksi", "DESC");
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
        $this->db->select('transaksi.id_transaksi as id_transaksi, pasien.no_rekam_medis as no_rekam_medis, pasien.nama as nama_pasien, dokter.nama as nama_dokter, perawat.nama as nama_perawat, transaksi.tanggal as tanggal, transaksi.diagnosa as diagnosa, transaksi.total_biaya_tindakan as total_biaya_tindakan, transaksi.total_biaya_obat as total_biaya_obat, transaksi.foto_rontgen as foto_rontgen, transaksi.keterangan as keterangan, transaksi.jam_mulai as jam_mulai, transaksi.jam_selesai as jam_selesai, transaksi.total_biaya_keseluruhan as total_biaya_keseluruhan, transaksi.metode_pembayaran as metode_pembayaran');
        $this->db->from($this->table);
        $this->db->join('pasien', 'pasien.id_pasien = transaksi.id_pasien', 'left');
        $this->db->join('dokter', 'dokter.id_dokter = transaksi.id_dokter', 'left');
        $this->db->join('perawat', 'perawat.id_perawat = transaksi.id_perawat', 'left');
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id_transaksi', $id);
        $this->db->join('pasien', 'pasien.id_pasien = transaksi.id_pasien', 'left');
        $this->db->join('dokter', 'dokter.id_dokter = transaksi.id_dokter', 'left');
        $this->db->join('perawat', 'perawat.id_perawat = transaksi.id_perawat', 'left');
        $query = $this->db->get();
        return $query->row();
    }

    public function getById($id)
    {
        //SELECT * FROM transaksi WHERE id_transaksi = $id
        //mengembalikan sebuah objek
        return $this->db->get_where('transaksi', ["id_transaksi" => $id])->row_array();
    }

    public function getDetailTindakan($id)
    {
        return $this->db->get_where('detail_tindakan', ["id_transaksi" => $id])->result_array();
    }

    public function getDetailObat($id)
    {
        return $this->db->get_where('detail_biaya_obat', ["id_transaksi" => $id])->result_array();
    }

    public function add_data($data)
    {
        $this->db->insert('transaksi', $data);
        // return $this->db->affected_rows();
    }

    public function edit_data($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_data($id)
    {

        // $this->db->select('*');
        $this->db->where('id_transaksi', $id);
        $this->db->delete('detail_tindakan');

        // $this->db->select('*');
        $this->db->where('id_transaksi', $id);
        $this->db->delete('detail_biaya_obat');

        // $this->delete_tindakan($id);
        // $this->delete_biaya_obat($id);

        $_id = $this->db->get_where('transaksi', ["id_transaksi" => $id])->row();
        $image_path = '/uploads/rontgen/';
        $query = $this->db->delete($this->table, array("id_transaksi" => $id));
        if ($query) {
            if ($_id->foto_rontgen != "default.jpg") {
                unlink(FCPATH . $image_path . $_id->foto_rontgen);
            }
        }
    }

    public function get_pasien()
    {
        $query = $this->db->query('SELECT * from pasien');
        return $query->result();
    }

    public function get_dokter()
    {
        $query = $this->db->query('SELECT * from dokter');
        return $query->result();
    }

    public function get_perawat()
    {
        $query = $this->db->query('SELECT * from perawat');
        return $query->result();
    }

    public function get_id_pasien($id)
    {
        $this->db->select('id_pasien');
        $this->db->from('pasien');
        $this->db->where('no_rekam_medis', $id);
        $row = $this->db->get()->row();
        if (isset($row)) {
            return $row->id_pasien;
        } else {
            return false;
        }
    }

    public function get_no_rekam_medis($id)
    {
        $data = $this->db->get_where('transaksi', ["id_transaksi" => $id])->row_array();
        $pasien = $data->id_pasien;
        $this->db->select('no_rekam_medis');
        $this->db->from('pasien');
        $this->db->where('id_pasien', $pasien);
        $row = $this->db->get()->row();
        if (isset($row)) {
            return $row->no_rekam_medis;
        } else {
            return false;
        }
    }

    public function get_transaksi_id($id)
    {
        $this->db->select('transaksi.id_transaksi as id_transaksi, pasien.no_rekam_medis as no_rekam_medis, pasien.nama as nama_pasien,transaksi.tanggal as tanggal, transaksi.total_biaya_tindakan as total_biaya_tindakan, transaksi.total_biaya_obat as total_biaya_obat,  transaksi.keterangan as keterangan,transaksi.total_biaya_keseluruhan as total_biaya_keseluruhan, transaksi.metode_pembayaran as metode_pembayaran');
        $this->db->from($this->table);
        $this->db->where('id_transaksi', $id);
        $this->db->join('pasien', 'pasien.id_pasien = transaksi.id_pasien', 'left');
        return $this->db->get()->row();

        // $this->db->join('dokter', 'dokter.id_dokter = transaksi.id_dokter', 'left');
        // $this->db->join('perawat', 'perawat.id_perawat = transaksi.id_perawat', 'left');
    }

    public function update_metode_pembayaran($id, $data)
    {
        $this->db->set('metode_pembayaran', $data);
        $this->db->where('id_transaksi', $id);
        $this->db->update($this->table);
        return $this->db->affected_rows();
    }

    public function fetch_year()
    {
        // $query = $this->db->query("SELECT year(tanggal) FROM transaksi GROUP by year(tanggal)");
        $this->db->select('year(tanggal)');
        $this->db->from('transaksi');
        $this->db->group_by('year(tanggal)');
        $this->db->order_by('year(tanggal)', 'desc');
        return $this->db->get()->result_array();
    }
}
