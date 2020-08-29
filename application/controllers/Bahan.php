<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bahan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Bahan_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url();
            redirect($url);
        }
    }

    public function index()
    {
        $this->load->helper('url');
        $data['title'] = 'Data Alat dan Bahan';

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/bahan/index', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '4') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/staf/sidebar', $data);
            $this->load->view('templates/staf/topbar', $data);
            $this->load->view('admin/bahan/index', $data);
            $this->load->view('templates/footer');
        } else {
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        }
        $this->session->set_userdata('previous_url', current_url());
    }

    public function fetch_data()
    {
        $list = $this->Bahan_model->make_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $bahan) {
            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $bahan->nama;
            $row[] = $bahan->satuan;
            $row[] = '<a href="bahan/edit/' . $bahan->id_bahan . ' " class="btn btn-sm btn btn-success" ><i class="fas fa-edit"></i></a>&nbsp<button type="button" name="delete" onclick="delete_data(' . $bahan->id_bahan . ')" class="btn btn-sm btn btn-danger delete"><i class="fas fa-trash" style="width: 15px"></i></button>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST["draw"],
            "recordsTotal" => $this->Bahan_model->get_all_data(),
            "recordsFiltered" => $this->Bahan_model->get_filtered_data(),
            "data" => $data
        );

        //output to json format
        echo json_encode($output);
    }

    public function add()
    {
        $data['title'] = 'Tambah Data Alat dan Bahan';

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/bahan/add_data', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '4') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/staf/sidebar', $data);
            $this->load->view('templates/staf/topbar', $data);
            $this->load->view('admin/bahan/add_data', $data);
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
                'satuan' => $this->input->post('satuan')
            ];

            $this->Bahan_model->add_data($data);
            $this->session->set_flashdata('flash', 'ditambahkan');
            redirect('bahan');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Data Alat dan Bahan';
        $data['bahan'] = $this->Bahan_model->getById($id);

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/bahan/edit_data', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '4') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/staf/sidebar', $data);
            $this->load->view('templates/staf/topbar', $data);
            $this->load->view('admin/bahan/edit_data', $data);
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
            'satuan' => $this->input->post('satuan')
        ];

        $this->Bahan_model->edit_data(array('id_bahan' => $this->input->post('id')), $data);
        $this->session->set_flashdata('flash', 'diubah');
        redirect('bahan');
    }

    public function delete($id)
    {
        $this->Bahan_model->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
