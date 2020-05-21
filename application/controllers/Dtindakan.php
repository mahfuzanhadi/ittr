<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dtindakan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dtindakan_model');
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
        // $this->load->helper('url');
        // $this->load->model('Ibahan_model', 'bahan');
        // $data['title'] = 'Data Inventaris Alat dan Bahan';
        // $data['bahan'] = $this->Ibahan_model->get_bahan();
        // $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();

        // $this->load->view('templates/header', $data);
        // $this->load->view('admin/inventaris_bahan/sidebar', $data);
        // $this->load->view('templates/admin/topbar', $data);
        // $this->load->view('admin/inventaris_bahan/index', $data);
        // $this->load->view('templates/footer');
    }

    public function add()
    {
        $data['title'] = 'Tambah Data Detail Tindakan';
        $data['admin'] = $this->db->get_where('admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $last_transaksi = $this->Dtindakan_model->get_last_transaksi();
        foreach ($last_transaksi as $last) {
            $data['last'] = $last;
        }
        // $data['transaksi'] = $this->Dtindakan_model->get_transaksi();
        $data['tindakan'] = $this->Dtindakan_model->get_tindakan();
        // $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tindakan', 'Tindakan', 'required');
        $this->form_validation->set_rules('biaya', 'Biaya', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->helper(array('form', 'url'));
            $this->load->view('templates/header', $data);
            $this->load->view('admin/detail_tindakan/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/detail_tindakan/add_data', $data);
            $this->load->view('templates/footer');
        } else {
            $last_transaksi = $this->Dtindakan_model->get_last_transaksi();
            foreach ($last_transaksi as $last) {
                $last;
            }
            $data = [
                'id_detail_tindakan' => $this->input->post('id_detail_tindakan'),
                'id_transaksi' => $last,
                'id_tindakan' => $this->input->post('tindakan'),
                'biaya_tindakan' => $this->input->post('biaya')
            ];
            $this->Dtindakan_model->add_data($data);

            $tindakan2 = $this->input->post('tindakan2');
            if ($tindakan2 != '') {
                $data2 = [
                    'id_detail_tindakan' => $this->input->post('id_detail_tindakan'),
                    'id_transaksi' => $last,
                    'id_tindakan' => $this->input->post('tindakan2'),
                    'biaya_tindakan' => $this->input->post('biaya2')
                ];
                $this->Dtindakan_model->add_data($data2);
                $this->Dtindakan_model->total_biaya_tindakan();

                redirect('dobat/add');
            } else {
                $this->Dtindakan_model->total_biaya_tindakan();
                redirect('dobat/add');
            }
            // $this->session->set_flashdata('flash', 'ditambahkan');
            // redirect('transaksi');
        }
    }

    public function get_tindakan()
    {
        // Search term
        $searchTerm = $this->input->post('searchTerm');

        // Get data tindakan
        $response = $this->Dtindakan_model->getTindakan($searchTerm);

        echo json_encode($response);
    }

    public function get_biaya()
    {
        $id_tindakan = $this->input->post('id', TRUE);
        $data = $this->Dtindakan_model->get_biaya($id_tindakan);
        echo json_encode($data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Data Inventaris Bahan';
        $data['admin'] = $this->db->get_where('admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['bahan'] = $this->Ibahan_model->get_bahan();
        $data['ibahan'] = $this->Ibahan_model->getById($id);
        $this->form_validation->set_rules('nama', 'Nama');
        $this->form_validation->set_rules('tgl_masuk', 'Tanggal Masuk', 'required');
        $this->form_validation->set_rules('expired', 'Expired', 'required');
        $this->form_validation->set_rules('jumlah_masuk', 'Jumlah Masuk', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/detail_tindakan/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/detail_tindakan/edit_data', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'id_bahan' => $this->input->post('id_bahan'),
                'tgl_masuk' => $this->input->post('tgl_masuk'),
                'expired' => $this->input->post('expired'),
                'jumlah_masuk' => $this->input->post('jumlah_masuk'),
            ];

            $this->Ibahan_model->edit_data(array('id_inventaris_bahan' => $this->input->post('id')), $data);
            $this->session->set_flashdata('flash', 'diubah');
            redirect('ibahan');
        }
    }

    public function delete($id)
    {
        $this->Dtindakan_model->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
