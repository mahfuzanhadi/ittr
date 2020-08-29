<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Iobat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Iobat_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url();
            redirect($url);
        }
    }

    public function index()
    {
        $this->load->helper('url');
        $data['title'] = 'Data Inventaris Obat';
        $data['obat'] = $this->Iobat_model->get_obat();

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/inventaris_obat/index', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '4') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/staf/sidebar', $data);
            $this->load->view('templates/staf/topbar', $data);
            $this->load->view('admin/inventaris_obat/index', $data);
            $this->load->view('templates/footer');
        } else {
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        }
        $this->session->set_userdata('previous_url', current_url());
    }

    public function fetch_data()
    {
        $list = $this->Iobat_model->make_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $obat) {
            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $obat->nama;
            $row[] = $obat->satuan;
            $row[] = $obat->ukuran;
            $row[] = $obat->harga;
            $row[] = $obat->tgl_masuk;
            $row[] = $obat->expired;
            $row[] = $obat->jumlah_masuk;
            $row[] = '<a href="iobat/edit/' . $obat->id_inventaris_obat . ' " class="btn btn-sm btn btn-success" ><i class="fas fa-edit"></i></a>&nbsp<button type="button" name="delete" onclick="delete_data(' . $obat->id_inventaris_obat . ')" class="btn btn-sm btn btn-danger delete"><i class="fas fa-trash" style="width: 15px"></i></button>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST["draw"],
            "recordsTotal" => $this->Iobat_model->get_all_data(),
            "recordsFiltered" => $this->Iobat_model->get_filtered_data(),
            "data" => $data
        );

        //output to json format
        echo json_encode($output);
    }

    public function add()
    {
        $data['title'] = 'Tambah Data Inventaris Obat';
        $data['obat'] = $this->Iobat_model->get_obat();

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/inventaris_obat/add_data', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '4') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/staf/sidebar', $data);
            $this->load->view('templates/staf/topbar', $data);
            $this->load->view('admin/inventaris_obat/add_data', $data);
            $this->load->view('templates/footer');
        } else {
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        }
        $this->session->set_userdata('previous_url', current_url());

        $nama = $this->input->post('nama');
        if (isset($nama)) {
            $data = [
                'id_obat' => $this->input->post('nama'),
                'tgl_masuk' => $this->input->post('tgl_masuk'),
                'expired' => $this->input->post('expired'),
                'jumlah_masuk' => $this->input->post('jumlah_masuk'),
            ];

            $this->Iobat_model->add_data($data);

            $jumlah_masuk = $this->input->post('jumlah_masuk');
            $this->Iobat_model->add_stok($jumlah_masuk, array('id_obat' => $this->input->post('nama'))); //fungsi update stok pada tabel obat
            $this->session->set_flashdata('flash', 'ditambahkan');
            redirect('iobat');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Data Inventaris Obat';
        $data['obat'] = $this->Iobat_model->get_obat();
        $data['iobat'] = $this->Iobat_model->getById($id);

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/inventaris_obat/edit_data', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '4') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/staf/sidebar', $data);
            $this->load->view('templates/staf/topbar', $data);
            $this->load->view('admin/inventaris_obat/edit_data', $data);
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
            'id_obat' => $this->input->post('nama'),
            'tgl_masuk' => $this->input->post('tgl_masuk'),
            'expired' => $this->input->post('expired'),
            'jumlah_masuk' => $this->input->post('jumlah_masuk'),
        ];

        $jumlah_masuk = $this->input->post('jumlah_masuk');
        $this->Iobat_model->update_stok($jumlah_masuk, array('id_obat' => $this->input->post('nama')), array('id_inventaris_obat' => $this->input->post('id'))); //fungsi update stok pada tabel obat
        $this->Iobat_model->edit_data(array('id_inventaris_obat' => $this->input->post('id')), $data);

        $this->session->set_flashdata('flash', 'diubah');
        redirect('iobat');
    }

    public function delete($id)
    {
        $this->Iobat_model->delete_stok($id);
        $this->Iobat_model->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
