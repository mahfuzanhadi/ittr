<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perawat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Perawat_model');
        $this->load->library('form_validation');
        // $this->load->library('encrypt');
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url();
            redirect($url);
        }
    }

    public function index()
    {
        if ($this->session->userdata('akses') == 1) {
            $this->load->helper('url');
            $this->load->model('Perawat_model', 'perawat');
            $data['title'] = 'Data Perawat';
            $data['admin'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('admin/perawat/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/perawat/index', $data);
            $this->load->view('templates/footer');
            $this->session->set_userdata('previous_url', current_url());
        } else if ($this->session->userdata('akses') == 3) {
            redirect('perawat/profil');
        }
    }

    public function fetch_data()
    {
        $this->load->model('Perawat_model');
        $list = $this->Perawat_model->make_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $perawat) {
            $row = array();
            $no++;
            // $jk = $perawat->jenis_kelamin;
            // if ($jk == 1) {
            //     $jk = "Laki-laki";
            // } else {
            //     $jk = "Perempuan";
            // }
            $row[] = $no;
            $row[] = '<a onclick="detail_data(' . $perawat->id_perawat . ')" >' . $perawat->nama . '</a>';
            $row[] = $perawat->alamat;
            $row[] = $perawat->tempat_lahir;
            $row[] = $perawat->tanggal_lahir;
            $row[] = $perawat->jenis_kelamin;
            $row[] = $perawat->no_telp;
            if ($perawat->no_str == '') {
                $no_str = 'Tidak ada';
            } else {
                $no_str = $perawat->no_str;
            }
            $row[] = $no_str;
            if ($perawat->tanggal_berlaku_str == '0000-00-00') {
                $tanggal_berlaku_str = '';
            } else {
                $tanggal_berlaku_str = $perawat->tanggal_berlaku_str;
            }
            $row[] = $tanggal_berlaku_str;
            $row[] = $perawat->email;
            $row[] = $perawat->username;
            $row[] = $perawat->password;
            $row[] = '<a href="perawat/edit/' . $perawat->id_perawat . ' " class="btn btn-sm btn btn-success" ><i class="fas fa-edit"></i></a>&nbsp<button type="button" name="delete" onclick="delete_data(' . $perawat->id_perawat . ')" class="btn btn-sm btn btn-danger delete"><i class="fas fa-trash" style="width: 15px"></i></button>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST["draw"],
            "recordsTotal" => $this->Perawat_model->get_all_data(),
            "recordsFiltered" => $this->Perawat_model->get_filtered_data(),
            "data" => $data
        );

        //output to json format
        echo json_encode($output);
    }

    public function add()
    {
        $data['title'] = 'Tambah Data Perawat';
        $data['admin'] = $this->db->get_where('admin', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/perawat/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/perawat/add_data', $data);
        $this->load->view('templates/footer');
        $this->session->set_userdata('previous_url', current_url());

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
                'no_str' => $this->input->post('no_str'),
                'tanggal_berlaku_str' => $this->input->post('tanggal_berlaku_str'),
                'username' => $this->input->post('username'),
                'password' => $password,
                'email' => $this->input->post('email')
            ];

            $this->Perawat_model->add_data($data);
            $this->session->set_flashdata('flash', 'ditambahkan');
            redirect('perawat');
        }
    }

    public function isExist()
    {
        $username = $this->input->post('username');
        if ($this->Perawat_model->is_exist($username)) {
            echo "Username sudah terdaftar!";
        } else {
            echo "";
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Data Perawat';
        $data['perawat'] = $this->Perawat_model->getById($id);
        $data['admin'] = $this->db->get_where('admin', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/perawat/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/perawat/edit_data', $data);
        $this->load->view('templates/footer');
        $this->session->set_userdata('previous_url', current_url());
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
            'no_str' => $this->input->post('no_str'),
            'tanggal_berlaku_str' => $this->input->post('tanggal_berlaku_str'),
            'username' => $this->input->post('username'),
            'password' => $password,
            'email' => $this->input->post('email')
        ];

        $this->Perawat_model->edit_data(array('id_perawat' => $this->input->post('id')), $data);
        $this->session->set_flashdata('flash', 'diubah');
        redirect('perawat');
    }

    public function detail_data($id)
    {
        $data = $this->Perawat_model->get_by_id($id);
        echo json_encode($data);
    }

    public function delete($id)
    {
        $this->Perawat_model->delete_data($id);
        echo json_encode(array("status" => true));
    }

    public function profil()
    {
        if ($this->session->userdata('akses') != '3') {
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        } else {
            $data['title'] = 'Profil Saya';
            $id = $this->session->userdata('id_perawat');

            $data['perawat'] = $this->Perawat_model->getById($id);

            $this->load->view('templates/header', $data);
            $this->load->view('perawat/profil/sidebar', $data);
            $this->load->view('templates/perawat/topbar', $data);
            $this->load->view('perawat/profil/index', $data);
            $this->load->view('templates/footer');
            $this->session->set_userdata('previous_url', current_url());
        }
    }

    public function edit_profil()
    {
        if ($this->session->userdata('akses') != '3') {
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        } else {
            $data['title'] = 'Edit Profil';
            $id = $this->session->userdata('id_perawat');

            $data['perawat'] = $this->Perawat_model->getById($id);

            $this->load->view('templates/header', $data);
            $this->load->view('perawat/edit_profil/sidebar', $data);
            $this->load->view('templates/perawat/topbar', $data);
            $this->load->view('perawat/edit_profil/index', $data);
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
            'no_str' => $this->input->post('no_str'),
            'tanggal_berlaku_str' => $this->input->post('tanggal_berlaku_str'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'email' => $this->input->post('email')
        ];
        if (!empty($data['password'])) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        } else {
            // We don't save an empty password
            unset($data['password']);
        }
        $this->Perawat_model->edit_data(array('id_perawat' => $this->input->post('id')), $data);
        $this->session->set_flashdata('flash', 'diubah');
        redirect('perawat/profil');
    }
}
