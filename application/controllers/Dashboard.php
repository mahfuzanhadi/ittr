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
        $data['rekammedis'] = $this->db->count_all_results('transaksi');
        $data['pasien'] = $this->db->count_all_results('pasien');
        $data['obat'] = $this->db->count_all_results('inventaris_obat');
        $data['bahan'] = $this->db->count_all_results('inventaris_bahan');

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/dashboard/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/dashboard/index', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '2') {
            $this->load->view('templates/header', $data);
            $this->load->view('dokter/dashboard/sidebar', $data);
            $this->load->view('templates/dokter/topbar', $data);
            $this->load->view('dokter/dashboard/index', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '3') {
            $this->load->view('templates/header', $data);
            $this->load->view('perawat/dashboard/sidebar', $data);
            $this->load->view('templates/perawat/topbar', $data);
            $this->load->view('perawat/dashboard/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('staf/dashboard/sidebar', $data);
            $this->load->view('templates/staf/topbar', $data);
            $this->load->view('staf/dashboard/index', $data);
            $this->load->view('templates/footer');
        }
        $this->session->set_userdata('previous_url', current_url());
    }
}
