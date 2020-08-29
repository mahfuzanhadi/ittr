<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tindakan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tindakan_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url();
            redirect($url);
        }
    }

    public function index()
    {
        $this->load->helper('url');
        $data['title'] = 'Data Tindakan';

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/tindakan/index', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '4') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/staf/sidebar', $data);
            $this->load->view('templates/staf/topbar', $data);
            $this->load->view('admin/tindakan/index', $data);
            $this->load->view('templates/footer');
        } else {
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        }
        $this->session->set_userdata('previous_url', current_url());
    }

    public function fetch_data()
    {
        $this->load->model('Tindakan_model');
        $list = $this->Tindakan_model->make_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $tindakan) {
            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $tindakan->nama;
            $row[] = $tindakan->biaya;
            $row[] = '<a href="tindakan/edit/' . $tindakan->id_tindakan . ' " class="btn btn-sm btn btn-success" ><i class="fas fa-edit"></i></a>&nbsp<button type="button" name="delete" onclick="delete_data(' . $tindakan->id_tindakan . ')" class="btn btn-sm btn btn-danger delete"><i class="fas fa-trash" style="width: 15px"></i></button>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST["draw"],
            "recordsTotal" => $this->Tindakan_model->get_all_data(),
            "recordsFiltered" => $this->Tindakan_model->get_filtered_data(),
            "data" => $data
        );

        //output to json format
        echo json_encode($output);
    }

    public function add()
    {
        $data['title'] = 'Tambah Data Tindakan';

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/tindakan/add_data', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '4') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/staf/sidebar', $data);
            $this->load->view('templates/staf/topbar', $data);
            $this->load->view('admin/tindakan/add_data', $data);
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
                'biaya' => $this->input->post('biaya')
            ];

            $this->Tindakan_model->add_data($data);
            $this->session->set_flashdata('flash', 'ditambahkan');
            redirect('tindakan');
        }
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
            $this->load->view('admin/tindakan/edit_data', $data);
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
