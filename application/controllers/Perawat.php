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
        // if ($this->session->userdata('akses') != 0) {
        //     $previous_url = $this->session->userdata('previous_url');
        //     redirect($previous_url);
        // } else if ($this->session->userdata('akses') == 1) {
        //     redirect('perawat/profil');
        // }

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
            $jk = $perawat->jenis_kelamin;
            if ($jk == 1) {
                $jk = "Laki-laki";
            } else {
                $jk = "Perempuan";
            }
            $row[] = $no;
            $row[] = '<a onclick="detail_data(' . $perawat->id_perawat . ')" >' . $perawat->nama . '</a>';
            $row[] = $perawat->alamat;
            $row[] = $perawat->tempat_lahir;
            $row[] = $perawat->tanggal_lahir;
            $row[] = $jk;
            $row[] = $perawat->no_telp;
            $row[] = $perawat->email;
            $row[] = $perawat->no_str;
            $row[] = $perawat->tanggal_berlaku_str;
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
        if ($this->Perawat_model->is_available($username)) {
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
        $data['title'] = 'Profil Saya';
        $data['perawat'] = $this->db->get_where('perawat', ['id_perawat' =>
        $this->session->userdata('id_perawat')])->row_array();
        $id = $this->session->userdata('id_perawat');

        $data['perawat'] = $this->Perawat_model->getById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('perawat/profil/sidebar', $data);
        $this->load->view('templates/perawat/topbar', $data);
        $this->load->view('perawat/profil/index', $data);
        $this->load->view('templates/footer');
        $this->session->set_userdata('previous_url', current_url());
    }

    public function edit_profil()
    {
        $data['title'] = 'Edit Profil';
        $data['perawat'] = $this->db->get_where('perawat', ['email' =>
        $this->session->userdata('email')])->row_array();
        $id = $this->session->userdata('id_perawat');

        $data['perawat'] = $this->Perawat_model->getById($id);

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('no_telp', 'No. Telp', 'required|numeric');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        // $this->form_validation->set_rules('no_str', 'No. STR', 'required|numeric');
        // $this->form_validation->set_rules('tanggal_berlaku_str', 'Tanggal Berlaku STR', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short'
        ]);
        $this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('perawat/edit_profil/sidebar', $data);
            $this->load->view('templates/perawat/topbar', $data);
            $this->load->view('perawat/edit_profil/index', $data);
            $this->load->view('templates/footer');
            $this->session->set_userdata('previous_url', current_url());
        } else {
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
                // 'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'password' => $this->input->post('password1'),
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
}
