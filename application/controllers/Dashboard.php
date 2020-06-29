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
        $data['obat'] = $this->db->count_all_results('inventaris_obat');
        $data['bahan'] = $this->db->count_all_results('inventaris_bahan');
        $data['tahun'] = $this->Transaksi_model->fetch_year();

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/dashboard/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/dashboard/index', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '4') {
            $this->load->view('templates/header', $data);
            $this->load->view('staf/dashboard/sidebar', $data);
            $this->load->view('templates/staf/topbar', $data);
            $this->load->view('staf/dashboard/index', $data);
            $this->load->view('templates/footer');
        } else {
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        }
        $this->session->set_userdata('previous_url', current_url());
    }

    public function fetch_data()
    {
        $tahun = $this->input->post('id', TRUE);
        $query1 = $this->db->query("SELECT * from transaksi where MONTH(tanggal) = '1' AND YEAR(tanggal) = '" . $tahun . "'");
        $data1 = $query1->num_rows();
        $query2 = $this->db->query("SELECT * from transaksi where MONTH(tanggal) = '2' AND YEAR(tanggal) = '" . $tahun . "'");
        $data2 = $query2->num_rows();
        $query3 = $this->db->query("SELECT * from transaksi where MONTH(tanggal) = '3' AND YEAR(tanggal) = '" . $tahun . "'");
        $data3 = $query3->num_rows();
        $query4 = $this->db->query("SELECT * from transaksi where MONTH(tanggal) = '4' AND YEAR(tanggal) = '" . $tahun . "'");
        $data4 = $query4->num_rows();
        $query5 = $this->db->query("SELECT * from transaksi where MONTH(tanggal) = '5' AND YEAR(tanggal) = '" . $tahun . "'");
        $data5 = $query5->num_rows();
        $query6 = $this->db->query("SELECT * from transaksi where MONTH(tanggal) = '6' AND YEAR(tanggal) = '" . $tahun . "'");
        $data6 = $query6->num_rows();
        $query7 = $this->db->query("SELECT * from transaksi where MONTH(tanggal) = '7' AND YEAR(tanggal) = '" . $tahun . "'");
        $data7 = $query7->num_rows();
        $query8 = $this->db->query("SELECT * from transaksi where MONTH(tanggal) = '8' AND YEAR(tanggal) = '" . $tahun . "'");
        $data8 = $query8->num_rows();
        $query9 = $this->db->query("SELECT * from transaksi where MONTH(tanggal) = '9' AND YEAR(tanggal) = '" . $tahun . "'");
        $data9 = $query9->num_rows();
        $query10 = $this->db->query("SELECT * from transaksi where MONTH(tanggal) = '10' AND YEAR(tanggal) = '" . $tahun . "'");
        $data10 = $query10->num_rows();
        $query11 = $this->db->query("SELECT * from transaksi where MONTH(tanggal) = '11' AND YEAR(tanggal) = '" . $tahun . "'");
        $data11 = $query11->num_rows();
        $query12 = $this->db->query("SELECT * from transaksi where MONTH(tanggal) = '12' AND YEAR(tanggal) = '" . $tahun . "'");
        $data12 = $query12->num_rows();
        $data = array('bulan1' => $data1, 'bulan2' => $data2, 'bulan3' => $data3, 'bulan4' => $data4, 'bulan5' => $data5, 'bulan6' => $data6, 'bulan7' => $data7, 'bulan8' => $data8, 'bulan9' => $data9, 'bulan10' => $data10, 'bulan11' => $data11, 'bulan12' => $data12);
        echo json_encode($data);
    }
}
