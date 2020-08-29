<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pembayaran_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url();
            redirect($url);
        }
    }

    public function add()
    {
        $id_transaksi = $this->input->post('id_transaksi');
        if (isset($id_transaksi)) {
            $data = [
                'id_pembayaran' => $this->input->post('id_pembayaran'),
                'id_transaksi' => $id_transaksi,
                'jumlah_bayar' => $this->input->post('jumlah_bayar'),
                'kembalian' => $this->input->post('kembalian'),
                'sisa_sebelum' => $this->input->post('sisa_sebelum'),
                'sisa_sesudah' => $this->input->post('sisa_sesudah'),
                'metode_pembayaran' => $this->input->post('metode_pembayaran'),
                'tanggal' => date('Y-m-d H:i:s'),
                'added_by' => $this->session->userdata('nama')
            ];

            $this->Pembayaran_model->add_data($data);

            $this->session->set_flashdata('bayar', 'ditambahkan');
            // redirect('transaksi');
        }
    }

    public function last_pembayaran()
    {
        $data = $this->Pembayaran_model->get_last_id()->id_pembayaran;
        echo json_encode($data);
    }

    // Function to print bill
    public function print_bill($id)
    {
        $this->load->model('Transaksi_model');
        $data['title'] = 'Bukti Pembayaran';

        $data['pembayaran'] = $this->Pembayaran_model->getById($id);
        $pembayaran = $this->Pembayaran_model->getById($id);
        $id_transaksi = $pembayaran['id_transaksi'];
        $data['transaksi'] = $this->Transaksi_model->getById($id_transaksi);
        $data['pasien'] = $this->Transaksi_model->get_pasien();
        $data['detail_tindakan'] = $this->Transaksi_model->get_detail_tindakan();
        $data['tindakan'] = $this->Transaksi_model->get_tindakan();
        $data['detail_obat'] = $this->Transaksi_model->get_detail_biaya_obat();
        $data['obat'] = $this->Transaksi_model->get_obat();

        $this->load->view('admin/transaksi/print_bill', $data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Data Tindakan';
        $data['tindakan'] = $this->Tindakan_model->getById($id);

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/tindakan/edit_data', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '4') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/staf/sidebar', $data);
            $this->load->view('templates/staf/topbar', $data);
            $this->load->view('staf/tindakan/edit_data', $data);
            $this->load->view('templates/footer');
        } else {
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        }
        $this->session->set_userdata('previous_url', current_url());
    }

    public function update()
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'biaya' => $this->input->post('biaya')
        ];

        $this->Tindakan_model->edit_data(array('id_tindakan' => $this->input->post('id')), $data);
        $this->session->set_flashdata('flash', 'diubah');
        redirect('tindakan');
    }

    public function delete($id)
    {
        $this->Tindakan_model->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
