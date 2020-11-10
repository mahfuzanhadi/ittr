<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekap extends CI_Controller
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
        $this->load->helper('url');
        $this->load->model('Transaksi_model');
        $data['title'] = 'Rekap Data';
        $data['dokter'] = $this->Transaksi_model->get_dokter();

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/rekap/index', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '3') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/perawat/sidebar', $data);
            $this->load->view('templates/perawat/topbar', $data);
            $this->load->view('admin/rekap/index', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '4') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/staf/sidebar', $data);
            $this->load->view('templates/staf/topbar', $data);
            $this->load->view('admin/rekap/index', $data);
            $this->load->view('templates/footer');
        }
        $this->session->set_userdata('previous_url', current_url());
    }

    // fetch rekap data    
    public function rangeDates()
    {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $dokter = $this->input->post('dokter');

        $data = array();
        $this->db->select('transaksi.tanggal as Tanggal, dokter.nama as Dokter, transaksi.total_biaya_keseluruhan as Total');
        $this->db->from('transaksi');
        $this->db->where('tanggal >= ', $start_date);
        $this->db->where('tanggal <= ', $end_date);
        $this->db->where('transaksi.id_dokter', $dokter);
        $this->db->join('dokter', 'dokter.id_dokter = transaksi.id_dokter', 'left');
        $query = $this->db->get()->result();
        foreach ($query as $row) {
            $rows = array();
            $data3[] = $row->Total;
            $format_rupiah = "Rp " . number_format($row->Total, 0, ',', '.');
            setlocale(LC_ALL, 'id-ID', 'id_ID');
            $tanggal = strftime("%d %B %Y", strtotime($row->Tanggal));
            $rows[] = $tanggal;
            $rows[] = $row->Dokter;
            $rows[] = $format_rupiah;
            $data[] = $rows;
        }

        // echo json_encode($data);
        echo json_encode(array($data, $data3));
    }
}
