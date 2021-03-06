<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dokter_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url();
            redirect($url);
        }
    }

    public function index()
    {
        $this->load->helper('url');
        $this->load->model('dokter_model', 'dokter');
        $data['title'] = 'Data Dokter';
        $data['admin'] = $this->db->get_where('admin', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/dokter/index', $data);
        $this->load->view('templates/footer');
    }

    public function fetch_data()
    {
        $this->load->model('dokter_model');
        $list = $this->Dokter_model->make_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $dokter) {
            $row = array();
            $no++;

            if ($dokter->status == 1) {
                $status = "Aktif";
            } else {
                $status = "Tidak Aktif";
            }

            $row[] = $no;
            $row[] = '<a style="cursor: pointer; color:#007bff;" onclick="detail_data(' . $dokter->id_dokter . ')" >' . $dokter->nama . '</a>';
            $row[] = $dokter->alamat;
            $row[] = $dokter->tempat_lahir;
            $row[] = $dokter->tanggal_lahir;
            $row[] = $dokter->jenis_kelamin;
            $row[] = $dokter->no_sip;
            $row[] = $dokter->no_str;
            $row[] = $dokter->tanggal_berlaku_sip;
            $row[] = $dokter->tanggal_berlaku_str;
            $row[] = $dokter->no_telp;
            $row[] = $dokter->email;
            $row[] = $dokter->username;
            $row[] = $status;
            $row[] = '<a href="dokter/edit/' . $dokter->id_dokter . ' " class="btn btn-sm btn btn-success" ><i class="fas fa-edit"></i></a>&nbsp<button type="button" name="delete" onclick="delete_data(' . $dokter->id_dokter . ')" class="btn btn-sm btn btn-danger delete"><i class="fas fa-trash" style="width: 15px"></i></button>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST["draw"],
            "recordsTotal" => $this->Dokter_model->get_all_data(),
            "recordsFiltered" => $this->Dokter_model->get_filtered_data(),
            "data" => $data
        );

        //output to json format
        echo json_encode($output);
    }

    public function add()
    {
        $data['title'] = 'Tambah Data Dokter';
        $data['admin'] = $this->db->get_where('admin', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/dokter/add_data', $data);
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
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'no_telp' => $this->input->post('no_telp'),
                'email' => $this->input->post('email'),
                'no_sip' => $this->input->post('no_sip'),
                'no_str' => $this->input->post('no_str'),
                'tanggal_berlaku_sip' => $this->input->post('tanggal_berlaku_sip'),
                'tanggal_berlaku_str' => $this->input->post('tanggal_berlaku_str'),
                'username' => $this->input->post('username'),
                'password' => $password,
                'status' => $this->input->post('status')
            ];

            $this->Dokter_model->add_data($data);
            $this->session->set_flashdata('flash', 'ditambahkan');
            redirect('dokter');
        }
    }

    public function isExist()
    {
        $username = $this->input->post('username');
        if ($this->Dokter_model->is_exist($username)) {
            echo "Username sudah terdaftar!";
        } else {
            echo "";
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Data Dokter';
        $data['dokter'] = $this->Dokter_model->getById($id);
        $data['admin'] = $this->db->get_where('admin', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/dokter/edit_data', $data);
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
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'no_telp' => $this->input->post('no_telp'),
            'email' => $this->input->post('email'),
            'no_sip' => $this->input->post('no_sip'),
            'no_str' => $this->input->post('no_str'),
            'tanggal_berlaku_sip' => $this->input->post('tanggal_berlaku_sip'),
            'tanggal_berlaku_str' => $this->input->post('tanggal_berlaku_str'),
            'username' => $this->input->post('username'),
            'password' => $password,
            'status' => $this->input->post('status')
        ];

        $this->Dokter_model->edit_data(array('id_dokter' => $this->input->post('id')), $data);
        $this->session->set_flashdata('flash', 'diubah');
        redirect('dokter');
    }

    public function detail_data($id)
    {
        $data = $this->Dokter_model->get_by_id($id);
        echo json_encode($data);
    }

    public function delete($id)
    {
        $this->Dokter_model->delete_data($id);
        echo json_encode(array("status" => true));
    }

    public function profil()
    {
        if ($this->session->userdata('akses') != '2') {
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        } else {
            $data['title'] = 'Profil Saya';
            $id = $this->session->userdata('id');

            $data['dokter'] = $this->Dokter_model->getById($id);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/dokter/sidebar', $data);
            $this->load->view('templates/dokter/topbar', $data);
            $this->load->view('dokter/profil/index', $data);
            $this->load->view('templates/footer');
            $this->session->set_userdata('previous_url', current_url());
        }
    }

    public function edit_profil()
    {
        if ($this->session->userdata('akses') != '2') {
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        } else {
            $data['title'] = 'Edit Profil';
            $id = $this->session->userdata('id');

            $data['dokter'] = $this->Dokter_model->getById($id);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/dokter/sidebar', $data);
            $this->load->view('templates/dokter/topbar', $data);
            $this->load->view('dokter/edit_profil/index', $data);
            $this->load->view('templates/footer');
            $this->session->set_userdata('previous_url', current_url());
        }
    }

    public function update_profil()
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'no_telp' => $this->input->post('no_telp'),
            'email' => $this->input->post('email'),
            'no_sip' => $this->input->post('no_sip'),
            'no_str' => $this->input->post('no_str'),
            'tanggal_berlaku_sip' => $this->input->post('tanggal_berlaku_sip'),
            'tanggal_berlaku_str' => $this->input->post('tanggal_berlaku_str'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'status' => $this->input->post('status')
        ];
        if (!empty($data['password'])) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        } else {
            // We don't save an empty password
            unset($data['password']);
        }
        $this->Dokter_model->edit_data(array('id_dokter' => $this->input->post('id')), $data);
        $this->session->set_flashdata('flash', 'diubah');
        redirect('dokter/profil');
    }
}
