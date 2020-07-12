<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url();
            redirect($url);
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $this->load->model('Transaksi_model');
        $data['rekammedis'] = $this->db->count_all_results('transaksi');
        $data['pasien'] = $this->db->count_all_results('pasien');
        $data['obat'] = $this->db->count_all_results('obat');
        $data['bahan'] = $this->db->count_all_results('bahan');
        $data['tahun'] = $this->Transaksi_model->fetch_year();

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/dashboard/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/dashboard/index', $data);
            $this->load->view('templates/footer');
        } else {
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        }
        $this->session->set_userdata('previous_url', current_url());
    }

    public function fetch_kunjungan()
    {
        $tahun = $this->input->post('id', TRUE);
        for ($i = 1; $i < 13; $i++) {
            //query mengambil data kunjungan tiap bulan per tahun
            $query = $this->db->query("SELECT * FROM transaksi WHERE MONTH(tanggal) = '" . $i . "' AND YEAR(tanggal) = '" . $tahun . "'");
            $data[] = $query->num_rows();
        }
        echo json_encode($data);
    }

    public function fetch_metode_pembayaran()
    {
        for ($i = 1; $i < 5; $i++) {
            $query = $this->db->query("SELECT * FROM transaksi WHERE metode_pembayaran = '" . $i . "'");
            $data[] = $query->num_rows();
        }
        echo json_encode($data);
    }

    public function fetch_jk()
    {
        for ($i = 1; $i < 3; $i++) {
            $query = $this->db->query("SELECT * FROM pasien WHERE jenis_kelamin = '" . $i . "'");
            $data[] = $query->num_rows();
        }
        echo json_encode($data);
    }

    public function fetch_umur()
    {
        //query pasien umur < 10 tahun
        $query1 = $this->db->query("SELECT * FROM pasien WHERE TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 10");
        $data[0] = $query1->num_rows();
        //query pasien umur >= 10 tahun dan < 20 tahun
        $query2 = $this->db->query("SELECT * FROM pasien WHERE TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 10 AND TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 20");
        $data[1] = $query2->num_rows();
        //query pasien umur >= 20 tahun dan < 30 tahun
        $query3 = $this->db->query("SELECT * FROM pasien WHERE TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 20 AND TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 30");
        $data[2] = $query3->num_rows();
        //query pasien umur >= 30 tahun dan < 40 tahun
        $query4 = $this->db->query("SELECT * FROM pasien WHERE TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 30 AND TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 40");
        $data[3] = $query4->num_rows();
        //query pasien umur >= 40 tahun dan < 50 tahun
        $query5 = $this->db->query("SELECT * FROM pasien WHERE TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 40 AND TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 50");
        $data[4] = $query5->num_rows();
        //query pasien umur >= 50 tahun
        $query6 = $this->db->query("SELECT * FROM pasien WHERE TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 50");
        $data[5] = $query6->num_rows();

        echo json_encode($data);
    }

    public function fetch_riwayat_penyakit()
    {
        //query pasien dengan riwayat penyakit
        $query1 = $this->db->query("SELECT * FROM pasien WHERE NOT riwayat_penyakit = '' ");
        $data[] = $query1->num_rows();
        //query pasien tanpa riwayat penyakit
        $query2 = $this->db->query("SELECT * FROM pasien WHERE riwayat_penyakit = '' ");
        $data[] = $query2->num_rows();

        echo json_encode($data);
    }

    public function fetch_alergi_obat()
    {
        //query pasien dengan alergi obat
        $query1 = $this->db->query("SELECT * FROM pasien WHERE NOT alergi_obat = '' ");
        $data[] = $query1->num_rows();
        //query pasien tanpa alergi obat
        $query2 = $this->db->query("SELECT * FROM pasien WHERE alergi_obat = '' ");
        $data[] = $query2->num_rows();

        echo json_encode($data);
    }

    public function fetch_obat()
    {
        $data = array();
        $query = $this->db->query("SELECT * FROM obat");

        //mengambil semua nama obat
        foreach ($query->result() as $row) {
            $data[] = $row->nama;
        }

        //mengambil semua stok obat
        foreach ($query->result() as $row) {
            $data2[] = $row->stok;
        }

        echo json_encode(array($data, $data2));
    }

    public function fetch_rekap_tindakan()
    {
        $data = array();
        for ($i = 2; $i < 48; $i++) {
            $query = $this->db->query("SELECT * FROM detail_tindakan WHERE id_tindakan = '" . $i . "'");
            $data[] = $query->num_rows();
        }

        $query2 = $this->db->query("SELECT * FROM tindakan");
        foreach ($query2->result() as $row) {
            $data2[] = $row->nama;
        }

        echo json_encode(array($data, $data2));
    }
}
