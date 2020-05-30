<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url();
            redirect($url);
        }
        if ($this->session->userdata('akses') != 1) {
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard';

        $this->load->view('templates/header', $data);
        $this->load->view('admin/dashboard/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/dashboard/index', $data);
        $this->load->view('templates/footer');
        $this->session->set_userdata('previous_url', current_url());
    }

    public function dashboard()
    {
        $data['title'] = 'Dashboard';
        $data['rekammedis'] = $this->db->count_all_results('transaksi');
        $data['pasien'] = $this->db->count_all_results('pasien');
        $data['obat'] = $this->db->count_all_results('inventaris_obat');
        $data['bahan'] = $this->db->count_all_results('inventaris_bahan');

        $this->load->view('templates/header', $data);
        $this->load->view('admin/dashboard/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/dashboard/index', $data);
        $this->load->view('templates/footer');
        $this->session->set_userdata('previous_url', current_url());
    }

    public function profil()
    {
        $data['title'] = 'Profil Saya';
        $data['admin'] = $this->db->get_where('admin', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/profil/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/profil/index', $data);
        $this->load->view('templates/footer');
        $this->session->set_userdata('previous_url', current_url());
    }

    public function edit_profil()
    {
        $data['title'] = 'Edit Profil';
        $data['admin'] = $this->db->get_where('admin', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/edit_profil/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/edit_profil/index', $data);
        $this->load->view('templates/footer');
        $this->session->set_userdata('previous_url', current_url());
    }

    public function update_profil()
    {
        $data = [
            'id' => $this->input->post('id'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email')
        ];

        $this->db->update('admin', $data, ["id_pasien" => $this->input->post('id')]);
        return $this->db->affected_rows();
    }
}
