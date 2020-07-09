<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dtindakan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table = 'detail_tindakan';
    var $select_column = array('detail_tindakan.id_detail_tindakan as id_detail_tindakan', 'transaksi.id_transaksi as id_transaksi', 'tindakan.nama as nama_tindakan', 'detail_tindakan.diagnosa as diagnosa', 'detail_tindakan.biaya_tindakan as biaya_tindakan');
    var $order_column = array(null, 'id_transaksi', 'nama_tindakan', 'biaya_tindakan'); //set column field database for datatable orderable
    var $order = array('id_detail_tindakan' => 'asc'); // default order 

    public function make_query()
    {
        $this->db->select('detail_tindakan.id_detail_tindakan as id_detail_tindakan, transaksi.id_transaksi as id_transaksi, tindakan.nama as nama_tindakan, detail_tindakan.diagnosa as diagnosa, detail_tindakan.biaya_tindakan as biaya_tindakan');
        $this->db->from($this->table);
        $this->db->join('transaksi', 'transaksi.id_transaksi = transaksi.id_transaksi', 'left');
        $this->db->join('tindakan', 'tindakan.id_tindakan = transaksi.id_tindakan', 'left');
        if (isset($_POST["search"]["value"])) {
            $this->db->like('id_transaksi', $_POST["search"]["value"]);
            $this->db->or_like('nama_tindakan', $_POST["search"]["value"]);
            $this->db->or_like('diagnosa', $_POST["search"]["value"]);
            $this->db->or_like('biaya_tindakan', $_POST["search"]["value"]);
        }
        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by("id_detail_tindakan", "asc");
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
        $this->db->select('detail_tindakan.id_detail_tindakan as id_detail_tindakan, transaksi.id_transaksi as id_transaksi, tindakan.nama as nama_tindakan, detail_tindakan.diagnosa as diagnosa, detail_tindakan.biaya_tindakan as biaya_tindakan');
        $this->db->from($this->table);
        $this->db->join('transaksi', 'transaksi.id_transaksi = transaksi.id_transaksi', 'left');
        $this->db->join('tindakan', 'tindakan.id_tindakan = transaksi.id_tindakan', 'left');
        return $this->db->count_all_results();
    }

    public function getById($id)
    {
        return $this->db->get_where('detail_tindakan', ["id_detail_tindakan" => $id])->row_array();
    }

    public function add_data($data)
    {
        $this->db->insert('detail_tindakan', $data);
    }


    public function edit_data($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_data($id)
    {
        $this->db->where('id_detail_tindakan', $id);
        $this->db->delete($this->table);
    }


    public function get_last_transaksi()
    {
        $last_row = $this->db->select('id_transaksi')->order_by('id_transaksi', "desc")->limit(1)->get('transaksi')->row();
        return $last_row;
    }

    public function get_tindakan()
    {
        $query = $this->db->query('SELECT * from tindakan');
        return $query->result();
    }

    public function get_biaya($id)
    {
        $this->db->select('biaya');
        $this->db->from('tindakan');
        $this->db->where('id_tindakan', $id);
        $row = $this->db->get()->row();
        if (isset($row)) {
            return $row->biaya;
        }
    }

    public function total_biaya_tindakan()
    {
        $last_transaksi = $this->db->select('id_transaksi')->order_by('id_transaksi', "desc")->limit(1)->get('transaksi')->row();
        $last = $last_transaksi->id_transaksi;
        $total_biaya_tindakan = 0;

        $this->db->select('*');
        $this->db->from('detail_tindakan');
        $this->db->where('id_transaksi', $last);
        $query = $this->db->get()->result();
        foreach ($query as $row) {
            $total_biaya_tindakan += $row->biaya_tindakan;
        }
        // $this->db->update('transaksi');

        $this->db->set('total_biaya_tindakan', $total_biaya_tindakan);
        $this->db->where('id_transaksi', $last);
        $this->db->update('transaksi');
        return $this->db->affected_rows();
    }

    public function edit_total_biaya_tindakan($id)
    {
        $total_biaya_tindakan = 0;
        $this->db->select('*');
        $this->db->from('detail_tindakan');
        $this->db->where('id_transaksi', $id);
        $query = $this->db->get()->result();
        foreach ($query as $row) {
            $total_biaya_tindakan += $row->biaya_tindakan;
        }
        // $this->db->update('transaksi');

        $this->db->set('total_biaya_tindakan', $total_biaya_tindakan);
        $this->db->where('id_transaksi', $id);
        $this->db->update('transaksi');
        return $this->db->affected_rows();
    }

    function getTindakan($searchTerm = "")
    {
        // Fetch users
        $this->db->select('*');
        $this->db->where("nama like '%" . $searchTerm . "%' ");
        $fetched_records = $this->db->get('tindakan');
        $tindakan = $fetched_records->result_array();

        // Initialize Array with fetched data
        $data = array();
        foreach ($tindakan as $t) {
            $data[] = array("id" => $t['id_tindakan'], "text" => $t['nama']);
        }
        return $data;
    }

    public function getDtindakan1($id)
    {
        $this->db->select_min('id_detail_tindakan');
        $this->db->from('detail_tindakan');
        $this->db->where('id_transaksi', $id);
        $row = $this->db->get()->row();
        if (isset($row)) {
            $min = $row->id_detail_tindakan;
        }

        return $this->db->get_where('detail_tindakan', ["id_detail_tindakan" => $min])->row_array();
    }

    public function getTindakan1($id)
    {
        $this->db->select_min('id_detail_tindakan');
        $this->db->from('detail_tindakan');
        $this->db->where('id_transaksi', $id);
        $row = $this->db->get()->row();
        if (isset($row)) {
            $min = $row->id_detail_tindakan;
        }

        $this->db->select('*');
        $this->db->from('detail_tindakan');
        $this->db->where('id_detail_tindakan', $min);
        $row2 = $this->db->get()->row();
        if (isset($row2)) {
            $id_tindakan = $row2->id_tindakan;
        }

        return $this->db->get_where('tindakan', ["id_tindakan" => $id_tindakan])->row_array();
    }

    public function getDtindakan2($id)
    {
        $this->db->select('id_detail_tindakan');
        $this->db->from('detail_tindakan');
        $this->db->where('id_transaksi', $id);
        $row = $this->db->get();
        if ($row->num_rows() > 1) {
            $this->db->select('id_detail_tindakan');
            $this->db->from('detail_tindakan');
            $this->db->where('id_transaksi', $id);
            $row2 = $this->db->get()->last_row();
            if (isset($row2)) {
                $last = $row2->id_detail_tindakan;
            }

            return $this->db->get_where('detail_tindakan', ["id_detail_tindakan" => $last])->row_array();
        }
    }

    public function getTindakan2($id)
    {
        $this->db->select('id_detail_tindakan');
        $this->db->from('detail_tindakan');
        $this->db->where('id_transaksi', $id);
        $row = $this->db->get();
        if ($row->num_rows() > 1) {
            $this->db->select('id_detail_tindakan');
            $this->db->from('detail_tindakan');
            $this->db->where('id_transaksi', $id);
            $row2 = $this->db->get()->last_row();
            if (isset($row2)) {
                $last = $row2->id_detail_tindakan;
            }

            $this->db->select('*');
            $this->db->from('detail_tindakan');
            $this->db->where('id_detail_tindakan', $last);
            $row2 = $this->db->get()->row();
            if (isset($row2)) {
                $id_tindakan = $row2->id_tindakan;
            }

            return $this->db->get_where('tindakan', ["id_tindakan" => $id_tindakan])->row_array();
        }
    }
}
