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
    var $select_column = array('transaksi.id_transaksi as id_transaksi', 'transaksi.tanggal as tanggal', 'pasien.no_rekam_medis as no_rekam_medis', 'pasien.nama as nama_pasien', 'dokter.nama as nama_dokter', 'transaksi.total_biaya_tindakan as total_biaya_tindakan', 'transaksi.total_biaya_obat as total_biaya_obat', 'transaksi.diskon as diskon', 'transaksi.total_biaya_keseluruhan as total_biaya_keseluruhan', 'transaksi.sisa as sisa', 'transaksi.keterangan as keterangan');
    var $order_column = array(null, null, 'tanggal', 'no_rekam_medis', 'nama_pasien', 'nama_dokter', null, null, 'total_biaya_tindakan', 'total_biaya_obat', 'diskon', 'total_biaya_keseluruhan', null); //set column field database for datatable orderable
    var $order = array('id_transaksi' => 'desc'); // default order 

    public function make_query()
    {
        $this->db->select('transaksi.id_transaksi as id_transaksi, transaksi.tanggal as tanggal, pasien.no_rekam_medis as no_rekam_medis, pasien.nama as nama_pasien, dokter.nama as nama_dokter, transaksi.total_biaya_tindakan as total_biaya_tindakan, transaksi.total_biaya_obat as total_biaya_obat, transaksi.diskon as diskon, transaksi.total_biaya_keseluruhan as total_biaya_keseluruhan, transaksi.sisa as sisa, transaksi.keterangan as keterangan');
        $this->db->from($this->table);
        $this->db->join('pasien', 'pasien.id_pasien = transaksi.id_pasien', 'left');
        $this->db->join('dokter', 'dokter.id_dokter = transaksi.id_dokter', 'left');
        if (isset($_POST["search"]["value"])) {
            $this->db->like('no_rekam_medis', $_POST["search"]["value"]);
            $this->db->or_like('pasien.nama', $_POST["search"]["value"]);
            $this->db->or_like('dokter.nama', $_POST["search"]["value"]);
        }
        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by("id_transaksi", "DESC");
        }
    }

    //make query for user dokter
    public function make_query_dokter($id_dokter)
    {
        $this->db->select('transaksi.id_transaksi as id_transaksi, transaksi.tanggal as tanggal, pasien.no_rekam_medis as no_rekam_medis, pasien.nama as nama_pasien, dokter.nama as nama_dokter, transaksi.total_biaya_tindakan as total_biaya_tindakan, transaksi.total_biaya_obat as total_biaya_obat, transaksi.diskon as diskon, transaksi.total_biaya_keseluruhan as total_biaya_keseluruhan, transaksi.sisa as sisa, transaksi.keterangan as keterangan');
        $this->db->from($this->table);
        $this->db->join('pasien', 'pasien.id_pasien = transaksi.id_pasien', 'left');
        $this->db->join('dokter', 'dokter.id_dokter = transaksi.id_dokter', 'left');
        $this->db->where('transaksi.id_dokter', $id_dokter);
        if ($this->input->post('no_rekam_medis')) {
            $this->db->where('no_rekam_medis', $this->input->post('no_rekam_medis'));
        }
        if ($this->input->post('nama')) {
            $this->db->like('pasien.nama', $this->input->post('nama'));
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

    //make datatable for user dokter
    public function make_datatables_dokter($id_dokter)
    {
        $this->make_query_dokter($id_dokter);
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        // print_r($this->db->last_query());
        return $query->result();
    }

    public function get_filtered_data()
    {
        $this->make_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    //get filtered data transaksi for datatable, for user dokter
    public function get_filtered_data_dokter($id_dokter)
    {
        $this->make_query_dokter($id_dokter);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_all_data()
    {
        $this->db->select('transaksi.id_transaksi as id_transaksi, transaksi.tanggal as tanggal, pasien.no_rekam_medis as no_rekam_medis, pasien.nama as nama_pasien, dokter.nama as nama_dokter, transaksi.total_biaya_tindakan as total_biaya_tindakan, transaksi.total_biaya_obat as total_biaya_obat, transaksi.diskon as diskon, transaksi.total_biaya_keseluruhan as total_biaya_keseluruhan, transaksi.keterangan as keterangan, transaksi.sisa as sisa');
        $this->db->from($this->table);
        $this->db->join('pasien', 'pasien.id_pasien = transaksi.id_pasien', 'left');
        $this->db->join('dokter', 'dokter.id_dokter = transaksi.id_dokter', 'left');
        return $this->db->count_all_results();
    }

    //get all data transaksi for datatable, for user dokter
    public function get_all_data_dokter($id_dokter)
    {
        $this->db->select('transaksi.id_transaksi as id_transaksi, transaksi.tanggal as tanggal, pasien.no_rekam_medis as no_rekam_medis, pasien.nama as nama_pasien, dokter.nama as nama_dokter, transaksi.total_biaya_tindakan as total_biaya_tindakan, transaksi.total_biaya_obat as total_biaya_obat, transaksi.diskon as diskon, transaksi.total_biaya_keseluruhan as total_biaya_keseluruhan, transaksi.sisa as sisa, transaksi.keterangan as keterangan');
        $this->db->from($this->table);
        $this->db->join('pasien', 'pasien.id_pasien = transaksi.id_pasien', 'left');
        $this->db->join('dokter', 'dokter.id_dokter = transaksi.id_dokter', 'left');
        $this->db->where('transaksi.id_dokter', $id_dokter);
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id_transaksi', $id);
        $this->db->join('pasien', 'pasien.id_pasien = transaksi.id_pasien', 'left');
        $this->db->join('dokter', 'dokter.id_dokter = transaksi.id_dokter', 'left');
        $this->db->join('perawat', 'perawat.id_perawat = transaksi.id_perawat', 'left');
        $this->db->join('detail_tindakan', 'detail_tindakan.id_transaksi = transaksi.id_transaksi', 'left');
        $query = $this->db->get();
        return $query->row();
    }

    public function getById($id)
    {
        return $this->db->get_where('transaksi', ["id_transaksi" => $id])->row_array();
    }

    public function add_data($data)
    {
        $this->db->insert('transaksi', $data);
    }

    public function edit_data($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_data($id)
    {

        $this->db->where('id_transaksi', $id);
        $this->db->delete('detail_tindakan');

        $this->db->where('id_transaksi', $id);
        $this->db->delete('detail_biaya_obat');

        $this->db->where('id_transaksi', $id);
        $this->db->delete('pembayaran');

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
        $query = $this->db->query('SELECT * FROM pasien');
        return $query->result();
    }

    public function get_dokter()
    {
        $query = $this->db->query('SELECT * FROM dokter WHERE status = 1');
        return $query->result();
    }

    public function get_all_dokter()
    {
        $query = $this->db->query('SELECT * FROM dokter');
        return $query->result();
    }

    public function get_perawat()
    {
        $query = $this->db->query('SELECT * FROM perawat');
        return $query->result();
    }

    public function get_pembayaran()
    {
        $query = $this->db->query('SELECT * FROM pembayaran');
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

    public function get_detail_transaksi($id)
    {
        $this->db->select('transaksi.id_transaksi as id_transaksi, pasien.no_rekam_medis as no_rekam_medis, pasien.nama as nama_pasien,transaksi.tanggal as tanggal, transaksi.total_biaya_tindakan as total_biaya_tindakan, transaksi.total_biaya_obat as total_biaya_obat, transaksi.keterangan as keterangan,transaksi.total_biaya_keseluruhan as total_biaya_keseluruhan, transaksi.sisa as sisa, transaksi.diskon as diskon');
        $this->db->from($this->table);
        $this->db->where('id_transaksi', $id);
        $this->db->join('pasien', 'pasien.id_pasien = transaksi.id_pasien', 'left');
        return $this->db->get()->row();
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

    //DETAIL TINDAKAN
    public function add_data_detail_tindakan($data)
    {
        $this->db->insert('detail_tindakan', $data);
    }


    public function edit_data_detail_tindakan($where, $data)
    {
        $this->db->update('detail_tindakan', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_data_detail_tindakan($id)
    {
        $this->db->where('id_detail_tindakan', $id);
        $this->db->delete('detail_tindakan');
    }

    public function get_last_transaksi()
    {
        $last_row = $this->db->select('id_transaksi')->order_by('id_transaksi', "desc")->limit(1)->get('transaksi')->row();
        return $last_row;
    }

    //GET ALL DATA FROM TABLE TINDAKAN
    public function get_tindakan()
    {
        return $this->db->query('SELECT * from tindakan')->result();
    }

    //FUNCTION UNTUK SEARCH TINDAKAN DI SELECT2
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

        $this->db->set('total_biaya_tindakan', $total_biaya_tindakan);
        $this->db->where('id_transaksi', $id);
        $this->db->update('transaksi');
        return $this->db->affected_rows();
    }

    //DETAIL BIAYA OBAT
    public function add_data_biaya_obat($data)
    {
        $this->db->insert('detail_biaya_obat', $data);
    }


    public function edit_data_biaya_obat($where, $data)
    {
        $this->db->update('detail_biaya_obat', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_data_biaya_obat($id)
    {
        $this->db->where('id_detail_biaya_obat', $id);
        $this->db->delete('detail_biaya_obat');
    }

    public function get_obat()
    {
        return $this->db->query('SELECT * from obat')->result();
    }

    function getObat($searchTerm = "")
    {
        // Fetch users
        $this->db->select('*');
        $this->db->where("nama like '%" . $searchTerm . "%' ");
        $this->db->order_by('nama', 'asc');
        $fetched_records = $this->db->get('obat');
        $obat = $fetched_records->result_array();

        // Initialize Array with fetched data
        $data = array();
        foreach ($obat as $t) {
            $obats = $t['nama'] . ' -- ' . $t['ukuran'];
            $data[] = array("id" => $t['id_obat'], "text" => $obats);
        }
        return $data;
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
            if ($row->diskon > 100) {
                $total_biaya_keseluruhan = ($row->total_biaya_tindakan + $row->total_biaya_obat) - $row->diskon;
            } else {
                $total_biaya = $row->total_biaya_tindakan + $row->total_biaya_obat;
                $total_biaya_keseluruhan = $total_biaya - ($total_biaya * $row->diskon / 100);
            }
        }

        $this->db->set('total_biaya_keseluruhan', $total_biaya_keseluruhan);
        $this->db->set('sisa', $total_biaya_keseluruhan);
        $this->db->where('id_transaksi', $last);
        $this->db->update('transaksi');
        return $this->db->affected_rows();
    }

    public function edit_total_biaya_keseluruhan($id)
    {
        //MASIH SALAH
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('id_transaksi', $id);
        $row = $this->db->get()->row();
        if ($row->diskon > 100) {
            $total_biaya_keseluruhan = ($row->total_biaya_tindakan + $row->total_biaya_obat) - $row->diskon;
        } else {
            $total_biaya = $row->total_biaya_tindakan + $row->total_biaya_obat;
            $total_biaya_keseluruhan = $total_biaya - ($total_biaya * $row->diskon / 100);
        }

        $this->db->set('total_biaya_keseluruhan', $total_biaya_keseluruhan);
        if ($row->sisa == 0) {
            $this->db->set('sisa', $row->sisa);
        } else {
            $this->db->set('sisa', $total_biaya_keseluruhan);
        }
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

    public function get_detail_tindakan()
    {
        return $this->db->query('SELECT * FROM detail_tindakan ORDER BY id_transaksi DESC')->result();
    }

    public function get_detail_biaya_obat()
    {
        return $this->db->query('SELECT * FROM detail_biaya_obat')->result();
    }

    public function get_transaksi_tindakan($id)
    {
        $this->db->select('*');
        $this->db->from('detail_tindakan');
        $this->db->where('id_transaksi', $id);
        $this->db->order_by('id_transaksi', 'DESC');
        return $this->db->get()->result();
    }

    public function get_transaksi_obat($id)
    {
        $this->db->select('*');
        $this->db->from('detail_biaya_obat');
        $this->db->where('id_transaksi', $id);
        $this->db->order_by('id_transaksi', 'DESC');
        return $this->db->get()->result();
    }

    public function get_nama_pasien($no_rekam_medis)
    {
        $this->db->select('nama');
        $this->db->from('pasien');
        $this->db->where('no_rekam_medis', $no_rekam_medis);
        $row = $this->db->get()->row();
        if (isset($row)) {
            return $row->nama;
        } else {
            return '';
        }
    }
}
