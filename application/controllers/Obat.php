<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Obat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Obat_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url();
            redirect($url);
        }
    }

    public function index()
    {
        $this->load->helper('url');
        $this->load->model('Obat_model', 'obat');
        $data['title'] = 'Data Obat';

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/obat/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/obat/index', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '4') {
            $this->load->view('templates/header', $data);
            $this->load->view('staf/obat/sidebar', $data);
            $this->load->view('templates/staf/topbar', $data);
            $this->load->view('staf/obat/index', $data);
            $this->load->view('templates/footer');
        } else {
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        }
        $this->session->set_userdata('previous_url', current_url());
    }

    public function fetch_data()
    {
        $this->load->model('Obat_model');
        $list = $this->Obat_model->make_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $obat) {
            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $obat->nama;
            $row[] = $obat->satuan;
            $row[] = $obat->jenis;
            $row[] = $obat->ukuran;
            $row[] = $obat->harga;
            $row[] = $obat->stok;
            $row[] = '<a href="obat/edit/' . $obat->id_obat . ' " class="btn btn-sm btn btn-success" ><i class="fas fa-edit"></i></a>&nbsp<button type="button" name="delete" onclick="delete_data(' . $obat->id_obat . ')" class="btn btn-sm btn btn-danger delete"><i class="fas fa-trash" style="width: 15px"></i></button>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST["draw"],
            "recordsTotal" => $this->Obat_model->get_all_data(),
            "recordsFiltered" => $this->Obat_model->get_filtered_data(),
            "data" => $data
        );

        //output to json format
        echo json_encode($output);
    }

    public function add()
    {
        $data['title'] = 'Tambah Data Obat';

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/obat/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/obat/add_data', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '4') {
            $this->load->view('templates/header', $data);
            $this->load->view('staf/obat/sidebar', $data);
            $this->load->view('templates/staf/topbar', $data);
            $this->load->view('staf/obat/add_data', $data);
            $this->load->view('templates/footer');
        } else {
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        }
        $this->session->set_userdata('previous_url', current_url());

        $nama = $this->input->post('nama');
        if (isset($nama)) {
            $data = [
                'nama' => $this->input->post('nama'),
                'satuan' => $this->input->post('satuan'),
                'jenis' => $this->input->post('jenis'),
                'ukuran' => $this->input->post('ukuran'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok')
            ];

            $this->Obat_model->add_data($data);
            $this->session->set_flashdata('flash', 'ditambahkan');
            redirect('obat');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Data Obat';
        $data['obat'] = $this->Obat_model->getById($id);

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/obat/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/obat/edit_data', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '4') {
            $this->load->view('templates/header', $data);
            $this->load->view('staf/obat/sidebar', $data);
            $this->load->view('templates/staf/topbar', $data);
            $this->load->view('staf/obat/edit_data', $data);
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
            'satuan' => $this->input->post('satuan'),
            'jenis' => $this->input->post('jenis'),
            'ukuran' => $this->input->post('ukuran'),
            'harga' => $this->input->post('harga'),
            'stok' => $this->input->post('stok')
        ];

        $this->Obat_model->edit_data(array('id_obat' => $this->input->post('id')), $data);
        $this->session->set_flashdata('flash', 'diubah');
        redirect('obat');
    }

    public function delete($id)
    {
        $this->Obat_model->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
