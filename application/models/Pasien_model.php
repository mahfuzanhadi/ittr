<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table = 'pasien';
    var $select_column = array('id_pasien', 'no_rekam_medis', 'nama', 'alamat', 'tanggal_lahir', 'pekerjaan',  'no_telp', 'jenis_kelamin', 'riwayat_penyakit', 'alergi_obat', 'username', 'password', 'email');
    var $order_column = array(null, 'no_rekam_medis', 'nama',  'tanggal_lahir',  'jenis_kelamin', 'alamat', 'tanggal_lahir', 'pekerjaan',  'no_telp', 'riwayat_penyakit', 'alergi_obat', 'username', null, 'email'); //set column field database for datatable orderable
    var $order = array('no_rekam_medis' => 'desc'); // default order 

    public function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->like('no_rekam_medis', $_POST["search"]["value"]);
            $this->db->or_like('nama', $_POST["search"]["value"]);
            $this->db->or_like('alamat', $_POST["search"]["value"]);
            $this->db->or_like('tanggal_lahir', $_POST["search"]["value"]);
            $this->db->or_like('pekerjaan', $_POST["search"]["value"]);
            $this->db->or_like('no_telp', $_POST["search"]["value"]);
            $this->db->or_like('jenis_kelamin', $_POST["search"]["value"]);
            $this->db->or_like('riwayat_penyakit', $_POST["search"]["value"]);
            $this->db->or_like('alergi_obat', $_POST["search"]["value"]);
            $this->db->or_like('username', $_POST["search"]["value"]);
            $this->db->or_like('email', $_POST["search"]["value"]);
        }
        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by("no_rekam_medis", "DESC");
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
        $this->db->where('id_pasien', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getById($id)
    {
        //SELECT * FROM pasien WHERE id_pasien = $id
        //mengembalikan sebuah objek
        return $this->db->get_where('pasien', ["id_pasien" => $id])->row_array();
    }

    // public function get_last_record()
    // {
    //     $last_row = $this->db->select('no_rekam_medis')->order_by('id_pasien', 'desc')->limit(1)->get('pasien')->row();
    //     return $last_row;
    // }

    public function get_biggest_record()
    {
        $row = $this->db->select_max('no_rekam_medis')->get('pasien')->row();
        return $row;
    }

    public function add_data($data)
    {
        $this->db->insert('pasien', $data);
    }

    function edit_data($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    function delete_data($id)
    {
        $this->db->where('id_pasien', $id);
        $this->db->delete($this->table);
    }

    function is_exist($no_rekam_medis)
    {
        $this->db->where('no_rekam_medis', $no_rekam_medis);
        $query = $this->db->get('pasien');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_transaksi_by_id($id)
    {
        return $this->db->get_where('transaksi', ["id_pasien" => $id])->result_array();
    }

    public function get_detail_tindakan()
    {
        // $this->db->select('*');
        // $this->db->from('transaksi');
        // $this->db->where('id_pasien', $id);
        // $query = $this->db->get()->result_array();
        // foreach ($query as $query) {
        //     $id_transaksi = $query['id_transaksi'];
        // }

        // $this->db->select('*');
        // $this->db->from('detail_tindakan');
        // $this->db->where('id_transaksi', $id_transaksi);

        // return $this->db->get()->result();
        return $this->db->query('SELECT * from detail_tindakan')->result();
    }

    // public function getDtindakan1($id)
    // {
    //     $query = $this->db->get_where('transaksi', ["id_pasien" => $id])->result_array();
    //     if (isset($query)) {
    //         $id_transaksi = $query['id_transaksi'];
    //     }

    //     $this->db->select_min('id_detail_tindakan');
    //     $this->db->from('detail_tindakan');
    //     $this->db->where('id_transaksi', $id_transaksi);
    //     $row = $this->db->get()->row();
    //     if (isset($row)) {
    //         $min = $row->id_detail_tindakan;
    //     }

    //     return $this->db->get_where('detail_tindakan', ["id_detail_tindakan" => $min])->row_array();
    // }

    public function get_tindakan()
    {
        return $this->db->query('SELECT * from tindakan')->result();
    }

    public function get_detail_biaya_obat()
    {
        return $this->db->query('SELECT * from detail_biaya_obat')->result();
    }

    public function get_obat()
    {
        return $this->db->query('SELECT * from obat')->result();
    }
}
