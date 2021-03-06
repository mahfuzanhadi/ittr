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
    var $column_search = array('no_rekam_medis', 'nama', 'alamat', 'no_telp'); //set column field database for datatable searchable 
    var $order = array('no_rekam_medis' => 'desc'); // default order 

    public function make_query()
    {
        // $this->db->select($this->select_column);

        //add custom filter here
        if ($this->input->post('no_rekam_medis')) {
            $this->db->where('no_rekam_medis', $this->input->post('no_rekam_medis'));
        }
        if ($this->input->post('nama')) {
            $this->db->like('nama', $this->input->post('nama'));
        }
        if ($this->input->post('alamat')) {
            $this->db->like('alamat', $this->input->post('alamat'));
        }
        if ($this->input->post('no_telp')) {
            $this->db->like('no_telp', $this->input->post('no_telp'));
        }

        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {
                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        // if (isset($_POST['order'])) // here order processing
        // {
        //     $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        // } else if (isset($this->order)) {
        //     $order = $this->order;
        //     $this->db->order_by(key($order), $order[key($order)]);
        // }

        // if (isset($_POST["search"]["value"])) {
        //     $this->db->like('no_rekam_medis', $_POST["search"]["value"]);
        //     $this->db->or_like('nama', $_POST["search"]["value"]);
        //     $this->db->or_like('alamat', $_POST["search"]["value"]);
        //     $this->db->or_like('username', $_POST["search"]["value"]);
        //     $this->db->or_like('email', $_POST["search"]["value"]);
        // }
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

    public function is_exist($no_rekam_medis)
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
}
