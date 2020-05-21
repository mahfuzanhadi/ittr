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
        if ($this->session->userdata('akses') != 1) {
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        }
    }

    public function index()
    {
        $this->load->helper('url');
        $this->load->model('Ibahan_model', 'bahan');
        $data['title'] = 'Data Inventaris Alat dan Bahan';
        $data['bahan'] = $this->Ibahan_model->get_bahan();
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/inventaris_bahan/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/inventaris_bahan/index', $data);
        $this->load->view('templates/footer');
    }

    public function fetch_data()
    {
        $this->load->model('Ibahan_model');
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
        $data['admin'] = $this->db->get_where('admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['bahan'] = $this->Ibahan_model->get_bahan();
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tgl_masuk', 'Tanggal Masuk', 'required');
        $this->form_validation->set_rules('expired', 'Expired', 'required');
        $this->form_validation->set_rules('jumlah_masuk', 'Jumlah Masuk', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/inventaris_bahan/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/inventaris_bahan/add_data', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'id_bahan' => $this->input->post('id_bahan'),
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
        $data['admin'] = $this->db->get_where('admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['bahan'] = $this->Ibahan_model->get_bahan();
        $data['ibahan'] = $this->Ibahan_model->getById($id);
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tgl_masuk', 'Tanggal Masuk', 'required');
        $this->form_validation->set_rules('expired', 'Expired', 'required');
        $this->form_validation->set_rules('jumlah_masuk', 'Jumlah Masuk', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/inventaris_bahan/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/inventaris_bahan/edit_data', $data);
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
        $this->Ibahan_model->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
