<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dobat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dobat_model');
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

    public function add()
    {
        $data['title'] = 'Tambah Data Detail Obat';
        $data['admin'] = $this->db->get_where('admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $last_transaksi = $this->Dobat_model->get_last_transaksi();
        foreach ($last_transaksi as $last) {
            $data['last'] = $last;
        }
        // $data['transaksi'] = $this->Dtindakan_model->get_transaksi();
        $data['obat'] = $this->Dobat_model->get_obat();
        // $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('obat', 'Obat', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->helper(array('form', 'url'));
            $this->load->view('templates/header', $data);
            $this->load->view('admin/detail_obat/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/detail_obat/add_data', $data);
            $this->load->view('templates/footer');
        } else {
            $last_transaksi = $this->Dobat_model->get_last_transaksi();
            foreach ($last_transaksi as $last) {
                $last;
            }
            $biaya_obat = $this->input->post('harga');
            $jumlah_obat = $this->input->post('jumlah_obat');
            $total_biaya_obat = $biaya_obat * $jumlah_obat;
            $data = [
                'id_detail_biaya_obat' => $this->input->post('id_detail_biaya_obat'),
                'id_transaksi' => $last,
                'id_obat' => $this->input->post('obat'),
                'dosis' => $this->input->post('dosis'),
                'jumlah_obat' => $this->input->post('jumlah_obat'),
                'biaya_obat' => $total_biaya_obat
            ];
            $this->Dobat_model->add_data($data);

            $obat2 = $this->input->post('obat2');
            if ($obat2 != '') {

                $biaya_obat2 = $this->input->post('harga2');
                $jumlah_obat2 = $this->input->post('jumlah_obat2');
                $total_biaya_obat2 = $biaya_obat2 * $jumlah_obat2;
                $data2 = [
                    'id_detail_biaya_obat' => $this->input->post('id_detail_biaya_obat'),
                    'id_transaksi' => $last,
                    'id_obat' => $this->input->post('obat2'),
                    'dosis' => $this->input->post('dosis2'),
                    'jumlah_obat' => $this->input->post('jumlah_obat2'),
                    'biaya_obat' => $total_biaya_obat2
                ];
                $this->Dobat_model->add_data($data2);
                $this->Dobat_model->total_biaya_obat();
                $this->Dobat_model->total_biaya_keseluruhan();

                $this->session->set_flashdata('flash', 'ditambahkan');
                redirect('transaksi');
            } else {
                $this->Dobat_model->total_biaya_obat();
                $this->Dobat_model->total_biaya_keseluruhan();
                $this->session->set_flashdata('flash', 'ditambahkan');
                redirect('transaksi');
            }
        }
    }

    public function adding_data()
    {
        $last_transaksi = $this->Dobat_model->get_last_transaksi();
        foreach ($last_transaksi as $last) {
            $last;
        }
        $data = [
            'id_detail_biaya_obat' => $this->input->post('id_detail_biaya_obat'),
            'id_transaksi' => $last,
            'id_obat' => $this->input->post('obat'),
            'dosis' => $this->input->post('dosis'),
            'jumlah_obat' => $this->input->post('jumlah_obat'),
            'biaya_obat' => $this->input->post('harga')
        ];

        $data['obat'] = $data;

        $obat2 = $this->input->post('obat2');
        if ($obat2 != '') {
            $data2 = [
                'id_detail_biaya_obat' => $this->input->post('id_detail_biaya_obat'),
                'id_transaksi' => $last,
                'id_obat' => $this->input->post('obat2'),
                'dosis' => $this->input->post('dosis2'),
                'jumlah_obat' => $this->input->post('jumlah_obat2'),
                'biaya_obat' => $this->input->post('harga2')
            ];

            $data['obat2'] = $data2;
        } else {
            // $this->Dobat_model->total_biaya_obat();
            // $this->session->set_flashdata('flash', 'ditambahkan');
            // redirect('transaksi');
        }
        $this->load->view('templates/header', $data);
        $this->load->view('admin/detail_obat/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/detail_obat/test', $data);
        $this->load->view('templates/footer');
    }

    public function get_obat()
    {
        // Search term
        $searchTerm = $this->input->post('searchTerm');

        // Get data tindakan
        $response = $this->Dobat_model->getObat($searchTerm);

        echo json_encode($response);
    }

    public function get_harga()
    {
        $id_obat = $this->input->post('id', TRUE);
        $data = $this->Dobat_model->get_harga($id_obat);
        echo json_encode($data);
    }
}
