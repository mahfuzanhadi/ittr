<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
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

    public function profil()
    {
        $data['title'] = 'Profil Saya';
        $data['admin'] = $this->db->get_where('admin', ['id_admin' =>
        $this->session->userdata('id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/profil/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/profil/index', $data);
        $this->load->view('templates/footer');
        $this->session->set_userdata('previous_url', current_url());
    }

    public function isExist()
    {
        $username = $this->input->post('username');
        if ($this->Admin_model->is_exist($username)) {
            echo "Username sudah terdaftar!";
        } else {
            echo "";
        }
    }

    public function edit_profil()
    {
        $data['title'] = 'Edit Profil';
        $data['admin'] = $this->db->get_where('admin', ['id_admin' =>
        $this->session->userdata('id')])->row_array();

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
            'id_admin' => $this->input->post('id'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email')
        ];
        if (!empty($data['password'])) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        } else {
            // We don't save an empty password
            unset($data['password']);
        }

        $this->Admin_model->edit_data(array('id_admin' => $this->input->post('id')), $data);
        $this->session->set_flashdata('flash', 'diubah');
        redirect('admin/profil');
    }
}
