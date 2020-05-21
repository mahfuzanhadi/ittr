<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Staf_model');
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
        $this->load->model('Staf_model', 'staf');
        $data['title'] = 'Data Staf Administrasi';
        $data['admin'] = $this->db->get_where('admin', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/staff/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/staff/index', $data);
        $this->load->view('templates/footer');
    }

    public function fetch_data()
    {
        $this->load->model('Staf_model');
        $list = $this->Staf_model->make_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $staf) {
            $row = array();
            $no++;
            $jk = $staf->jenis_kelamin;
            if ($jk == 1) {
                $jk = "Laki-laki";
            } else {
                $jk = "Perempuan";
            }
            $row[] = $no;
            $row[] = '<a onclick="detail_data(' . $staf->id_staf . ')" >' . $staf->nama . '</a>';
            $row[] = $staf->alamat;
            $row[] = $staf->tanggal_lahir;
            $row[] = $jk;
            $row[] = $staf->no_telp;
            $row[] = $staf->email;
            $row[] = $staf->username;
            $row[] = $staf->password;
            $row[] = '<a href="staff/edit/' . $staf->id_staf . ' " class="btn btn-sm btn btn-success" ><i class="fas fa-edit"></i></a>&nbsp<button type="button" name="delete" onclick="delete_data(' . $staf->id_staf . ')" class="btn btn-sm btn btn-danger delete"><i class="fas fa-trash" style="width: 15px"></i></button>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST["draw"],
            "recordsTotal" => $this->Staf_model->get_all_data(),
            "recordsFiltered" => $this->Staf_model->get_filtered_data(),
            "data" => $data
        );

        //output to json format
        echo json_encode($output);
    }

    public function add()
    {
        $data['title'] = 'Tambah Data Staf Administrasi';
        $data['admin'] = $this->db->get_where('admin', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/staff/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/staff/add_data', $data);
        $this->load->view('templates/footer');

        $nama = $this->input->post('nama');
        if (isset($nama)) {
            $password = $this->input->post('password');
            if ($password == '') {
                $password = '';
            } else {
                $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }
            $data = [
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'no_telp' => $this->input->post('no_telp'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'password' => $password
            ];

            $this->Staf_model->add_data($data);
            $this->session->set_flashdata('flash', 'ditambahkan');
            redirect('staff');
        }
    }

    public function isExist()
    {
        $username = $this->input->post('username');
        if ($this->Staf_model->is_available($username)) {
            echo "Username sudah terdaftar!";
        } else {
            echo "";
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Data Staf Administrasi';
        $data['staf'] = $this->Staf_model->getById($id);
        $data['admin'] = $this->db->get_where('admin', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/staff/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/staff/edit_data', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $password = $this->input->post('password');
        if ($password == '') {
            $password = $this->input->post('password2');
        } else {
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }
        $data = [
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'no_telp' => $this->input->post('no_telp'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => $password
        ];

        $this->Staf_model->edit_data(array('id_staf' => $this->input->post('id')), $data);
        $this->session->set_flashdata('flash', 'diubah');
        redirect('staff');
    }

    public function detail_data($id)
    {
        $data = $this->Staf_model->get_by_id($id);
        echo json_encode($data);
    }

    public function delete($id)
    {
        $this->Staf_model->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
