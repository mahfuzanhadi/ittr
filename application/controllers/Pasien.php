<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pasien_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url();
            redirect($url);
        }
    }

    public function index()
    {
        $this->load->helper('url');
        $this->load->model('Pasien_model', 'pasien');
        $data['title'] = 'Data Pasien';

        if ($this->session->userdata('akses') == '1') {
            $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('admin/pasien/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/pasien/index', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '3') {
            $data['perawat'] = $this->db->get_where('perawat', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('perawat/pasien/sidebar', $data);
            $this->load->view('templates/perawat/topbar', $data);
            $this->load->view('perawat/pasien/index', $data);
            $this->load->view('templates/footer');
        }
        $this->session->set_userdata('previous_url', current_url());
    }

    public function fetch_data()
    {
        $this->load->model('Pasien_model');
        $list = $this->Pasien_model->make_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pasien) {
            $row = array();
            $no++;
            // $tanggal_lahir = $pasien->tanggal_lahir;
            // $dob = new DateTime($tanggal_lahir);
            // $now = new DateTime();
            // $difference = $now->diff($dob);
            // $age = $difference->y;
            // $umur = floor((time() - strtotime($tanggal_lahir)) / 31556926);
            // $age = intval($umur);
            // $jk = $pasien->jenis_kelamin;
            // if ($jk == 1) {
            //     $jk = "Laki-laki";
            // } else {
            //     $jk = "Perempuan";
            // }
            $row[] = $no;
            $row[] = $pasien->no_rekam_medis;
            $row[] = '<a onclick="detail_data(' . $pasien->id_pasien . ')" >' . $pasien->nama . '</a>';
            $row[] = $pasien->tanggal_lahir;
            $row[] = $pasien->jenis_kelamin;
            $row[] = $pasien->alamat;
            $row[] = $pasien->tanggal_lahir;
            $row[] = $pasien->pekerjaan;
            $row[] = $pasien->no_telp;
            $row[] = $pasien->riwayat_penyakit;
            $row[] = $pasien->alergi_obat;
            $row[] = $pasien->username;
            $row[] = $pasien->password;
            $row[] = $pasien->email;
            $row[] = '<a href="pasien/edit/' . $pasien->id_pasien . ' " class="btn btn-sm btn btn-success" ><i class="fas fa-edit"></i></a>&nbsp<button type="button" name="delete" onclick="delete_data(' . $pasien->id_pasien . ')" class="btn btn-sm btn btn-danger delete"><i class="fas fa-trash" style="width: 15px"></i></button>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST["draw"],
            "recordsTotal" => $this->Pasien_model->get_all_data(),
            "recordsFiltered" => $this->Pasien_model->get_filtered_data(),
            "data" => $data
        );

        //output to json format
        echo json_encode($output);
    }

    public function add()
    {
        $data['title'] = 'Tambah Data Pasien';
        $data['last'] = $this->Pasien_model->get_biggest_record();

        if ($this->session->userdata('akses') == 1) {
            $data['admin'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('admin/pasien/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/pasien/add_data', $data);
            $this->load->view('templates/footer');
            $this->session->set_userdata('previous_url', current_url());
        } else if ($this->session->userdata('akses') == 3) {
            $data['perawat'] = $this->db->get_where('perawat', ['email' =>
            $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('perawat/pasien/sidebar', $data);
            $this->load->view('templates/perawat/topbar', $data);
            $this->load->view('perawat/pasien/add_data', $data);
            $this->load->view('templates/footer');
            $this->session->set_userdata('previous_url', current_url());
        }

        $nama = $this->input->post('nama');
        if (isset($nama)) {
            $password = $this->input->post('password');
            if ($password == '') {
                $password = '';
            } else {
                $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }
            $data = [
                'no_rekam_medis' => $this->input->post('no_rekam_medis'),
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'pekerjaan' => $this->input->post('pekerjaan'),
                'no_telp' => $this->input->post('no_telp'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'riwayat_penyakit' => $this->input->post('riwayat_penyakit'),
                'alergi_obat' => $this->input->post('alergi_obat'),
                'username' => $this->input->post('username'),
                'password' => $password,
                'email' => $this->input->post('email')
            ];

            $this->Pasien_model->add_data($data);
            $this->session->set_flashdata('flash', 'ditambahkan');
            redirect('pasien');
        }
    }

    public function isExist()
    {
        $no_rekam_medis = $this->input->post('no_rekam_medis');
        if ($this->Pasien_model->is_exist($no_rekam_medis)) {
            echo "Nomor Rekam Medis sudah terdaftar!";
        } else {
            echo "";
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Data Pasien';
        $data['pasien'] = $this->Pasien_model->getById($id);

        if ($this->session->userdata('akses') == 1) {
            $data['admin'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('admin/pasien/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/pasien/edit_data', $data);
            $this->load->view('templates/footer');
            $this->session->set_userdata('previous_url', current_url());
        } else if ($this->session->userdata('akses') == 3) {
            $data['perawat'] = $this->db->get_where('perawat', ['email' =>
            $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('perawat/pasien/sidebar', $data);
            $this->load->view('templates/perawat/topbar', $data);
            $this->load->view('perawat/pasien/edit_data', $data);
            $this->load->view('templates/footer');
            $this->session->set_userdata('previous_url', current_url());
        }
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
            'no_rekam_medis' => $this->input->post('no_rekam_medis'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'no_telp' => $this->input->post('no_telp'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'riwayat_penyakit' => $this->input->post('riwayat_penyakit'),
            'alergi_obat' => $this->input->post('alergi_obat'),
            'username' => $this->input->post('username'),
            'password' => $password,
            'email' => $this->input->post('email')
        ];

        $this->Pasien_model->edit_data(array('id_pasien' => $this->input->post('id')), $data);
        $this->session->set_flashdata('flash', 'diubah');
        redirect('pasien');
    }

    public function detail_data($id)
    {
        $data = $this->Pasien_model->get_by_id($id);
        echo json_encode($data);
    }

    public function delete($id)
    {
        $this->Pasien_model->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
