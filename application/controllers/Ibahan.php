<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ibahan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ibahan_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url();
            redirect($url);
        }
    }

    public function index()
    {
        $this->load->helper('url');
        $data['title'] = 'Data Inventaris Alat dan Bahan';
        $data['bahan'] = $this->Ibahan_model->get_bahan();

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/inventaris_bahan/index', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '4') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/staf/sidebar', $data);
            $this->load->view('templates/staf/topbar', $data);
            $this->load->view('admin/inventaris_bahan/index', $data);
            $this->load->view('templates/footer');
        } else {
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        }
        $this->session->set_userdata('previous_url', current_url());
    }

    public function fetch_data()
    {
        $list = $this->Ibahan_model->make_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $bahan) {
            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $bahan->nama;
            $row[] = $bahan->satuan;
            $row[] = $bahan->tgl_masuk;
            $row[] = $bahan->expired;
            $row[] = $bahan->jumlah_masuk;
            $row[] = '<a href="ibahan/edit/' . $bahan->id_inventaris_bahan . ' " class="btn btn-sm btn btn-success" ><i class="fas fa-edit"></i></a>&nbsp<button type="button" name="delete" onclick="delete_data(' . $bahan->id_inventaris_bahan . ')" class="btn btn-sm btn btn-danger delete"><i class="fas fa-trash" style="width: 15px"></i></button>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST["draw"],
            "recordsTotal" => $this->Ibahan_model->get_all_data(),
            "recordsFiltered" => $this->Ibahan_model->get_filtered_data(),
            "data" => $data
        );

        //output to json format
        echo json_encode($output);
    }

    public function get_bahan()
    {
        $id_bahan = $this->input->post('id_bahan', TRUE);
        $data = $this->Ibahan_model->get_bahan($id_bahan)->result();
        echo json_encode($data);
    }

    public function add()
    {
        $data['title'] = 'Tambah Data Inventaris Bahan';
        $data['bahan'] = $this->Ibahan_model->get_bahan();

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/inventaris_bahan/add_data', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '4') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/staf/sidebar', $data);
            $this->load->view('templates/staf/topbar', $data);
            $this->load->view('admin/inventaris_bahan/add_data', $data);
            $this->load->view('templates/footer');
        } else {
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        }
        $this->session->set_userdata('previous_url', current_url());

        $nama = $this->input->post('nama');
        if (isset($nama)) {
            $data = [
                'id_bahan' => $this->input->post('nama'),
                'tgl_masuk' => $this->input->post('tgl_masuk'),
                'expired' => $this->input->post('expired'),
                'jumlah_masuk' => $this->input->post('jumlah_masuk')
            ];

            $this->Ibahan_model->add_data($data);
            $this->session->set_flashdata('flash', 'ditambahkan');
            redirect('ibahan');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Data Inventaris Bahan';
        $data['bahan'] = $this->Ibahan_model->get_bahan();
        $data['ibahan'] = $this->Ibahan_model->getById($id);

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/inventaris_bahan/edit_data', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '4') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/staf/sidebar', $data);
            $this->load->view('templates/staf/topbar', $data);
            $this->load->view('admin/inventaris_bahan/edit_data', $data);
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
            'id_bahan' => $this->input->post('nama'),
            'tgl_masuk' => $this->input->post('tgl_masuk'),
            'expired' => $this->input->post('expired'),
            'jumlah_masuk' => $this->input->post('jumlah_masuk'),
        ];

        $this->Ibahan_model->edit_data(array('id_inventaris_bahan' => $this->input->post('id')), $data);
        $this->session->set_flashdata('flash', 'diubah');
        redirect('ibahan');
    }

    public function delete($id)
    {
        $this->Ibahan_model->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
