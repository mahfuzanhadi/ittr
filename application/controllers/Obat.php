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
        if ($this->session->userdata('akses') != 1) {
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        }
    }

    public function index()
    {
        $this->load->helper('url');
        $this->load->model('Obat_model', 'obat');
        $data['title'] = 'Data Obat';
        $data['admin'] = $this->db->get_where('admin', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/obat/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/obat/index', $data);
        $this->load->view('templates/footer');
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
        $data['admin'] = $this->db->get_where('admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/obat/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/obat/add_data', $data);
        $this->load->view('templates/footer');
        // $this->form_validation->set_rules('nama', 'Nama', 'required');
        // $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        // $this->form_validation->set_rules('jenis', 'Jenis', 'required');
        // $this->form_validation->set_rules('ukuran', 'Ukuran', 'required');
        // $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $nama = $this->input->post('nama');
        if (isset($nama)) {
            $data = [
                'nama' => $this->input->post('nama'),
                'satuan' => $this->input->post('satuan'),
                'jenis' => $this->input->post('jenis'),
                'ukuran' => $this->input->post('ukuran'),
                'harga' => $this->input->post('harga')
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
        $data['admin'] = $this->db->get_where('admin', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/obat/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/obat/edit_data', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'satuan' => $this->input->post('satuan'),
            'jenis' => $this->input->post('jenis'),
            'ukuran' => $this->input->post('ukuran'),
            'harga' => $this->input->post('harga')
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
