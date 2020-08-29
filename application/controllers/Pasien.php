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
        $data['title'] = 'Data Pasien';

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/pasien/index', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '2') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/dokter/sidebar', $data);
            $this->load->view('templates/dokter/topbar', $data);
            $this->load->view('admin/pasien/readonly', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '3') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/perawat/sidebar', $data);
            $this->load->view('templates/perawat/topbar', $data);
            $this->load->view('admin/pasien/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/staf/sidebar', $data);
            $this->load->view('templates/staf/topbar', $data);
            $this->load->view('admin/pasien/readonly', $data);
            $this->load->view('templates/footer');
        }
        $this->session->set_userdata('previous_url', current_url());
    }

    public function fetch_data()
    {
        $list = $this->Pasien_model->make_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pasien) {
            $row = array();
            $no++;
            $row[] = $no;
            $row[] = '<a href="pasien/rekam_medis/' . $pasien->id_pasien . '" >' . $pasien->no_rekam_medis;
            $row[] = '<a style="cursor: pointer; color:#007bff;" onclick="detail_data(' . $pasien->id_pasien . ')" >' . $pasien->nama . '</a>';
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
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/pasien/add_data', $data);
            $this->load->view('templates/footer');
            $this->session->set_userdata('previous_url', current_url());
        } else if ($this->session->userdata('akses') == 3) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/perawat/sidebar', $data);
            $this->load->view('templates/perawat/topbar', $data);
            $this->load->view('admin/pasien/add_data', $data);
            $this->load->view('templates/footer');
            $this->session->set_userdata('previous_url', current_url());
        } else {
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
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
                'alamat' => nl2br($this->input->post('alamat')),
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
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/pasien/edit_data', $data);
            $this->load->view('templates/footer');
            $this->session->set_userdata('previous_url', current_url());
        } else if ($this->session->userdata('akses') == 3) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/perawat/sidebar', $data);
            $this->load->view('templates/perawat/topbar', $data);
            $this->load->view('admin/pasien/edit_data', $data);
            $this->load->view('templates/footer');
            $this->session->set_userdata('previous_url', current_url());
        } else {
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
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

    public function rekam_medis($id)
    {
        $data['title'] = 'Data Rekam Medis';
        $this->load->model('Transaksi_model');

        $data['pasien'] = $this->Pasien_model->getById($id);
        $data['transaksi'] = $this->Pasien_model->get_transaksi_by_id($id);
        $data['dokter'] = $this->Transaksi_model->get_all_dokter();
        $data['perawat'] = $this->Transaksi_model->get_perawat();
        $data['detail_tindakan'] = $this->Transaksi_model->get_detail_tindakan();
        $data['tindakan'] = $this->Transaksi_model->get_tindakan();
        $data['detail_obat'] = $this->Transaksi_model->get_detail_biaya_obat();
        $data['obat'] = $this->Transaksi_model->get_obat();

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/pasien/rekam_medis', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '2') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/dokter/sidebar', $data);
            $this->load->view('templates/dokter/topbar', $data);
            $this->load->view('admin/pasien/rekam_medis', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '3') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/perawat/sidebar', $data);
            $this->load->view('templates/perawat/topbar', $data);
            $this->load->view('admin/pasien/rekam_medis', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/staf/sidebar', $data);
            $this->load->view('templates/staf/topbar', $data);
            $this->load->view('admin/pasien/rekam_medis', $data);
            $this->load->view('templates/footer');
        }
        $this->session->set_userdata('previous_url', current_url());
    }

    public function delete($id)
    {
        $this->Pasien_model->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
