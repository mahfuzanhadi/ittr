<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transaksi_model');
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
        $this->load->model('Transaksi_model', 'transaksi');
        $data['title'] = 'Data Rekam Medis';
        $data['pasien'] = $this->Transaksi_model->get_pasien();
        $data['dokter'] = $this->Transaksi_model->get_dokter();
        $data['perawat'] = $this->Transaksi_model->get_perawat();
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/transaksi/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/transaksi/index', $data);
        $this->load->view('templates/footer');
    }

    public function fetch_data()
    {
        $this->load->model('Transaksi_model');
        $list = $this->Transaksi_model->make_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $transaksi) {
            $row = array();
            $no++;
            $metode_pembayaran = $transaksi->metode_pembayaran;
            $base = base_url('uploads/rontgen/' . $transaksi->foto_rontgen);
            if ($metode_pembayaran == 1) {
                $metode_pembayaran = "Cash";
            } else if ($metode_pembayaran == 2) {
                $metode_pembayaran = "Kredit";
            } else if ($metode_pembayaran == 3) {
                $metode_pembayaran = "Debit";
            } else if ($metode_pembayaran == 4) {
                $metode_pembayaran = "Transfer";
            } else {
                $metode_pembayaran = "";
            }

            $row[] = $no;
            $row[] = '<a href="transaksi/detail/' . $transaksi->id_transaksi . '" >' . $transaksi->no_rekam_medis . '</a>';
            $row[] = $transaksi->nama_pasien;
            $row[] = $transaksi->nama_dokter;
            $row[] = $transaksi->nama_perawat;
            $row[] = $transaksi->tanggal;
            $row[] = $transaksi->diagnosa;
            $row[] = $transaksi->total_biaya_tindakan;
            $row[] = $transaksi->total_biaya_obat;
            $row[] = '<img width="64px" height="64px" src="' . $base . '"/>';
            // $row[] = $transaksi->foto_rontgen;
            $row[] = $transaksi->keterangan;
            $row[] = $transaksi->jam_mulai;
            $row[] = $transaksi->jam_selesai;
            $row[] = $transaksi->total_biaya_keseluruhan;
            $row[] = $metode_pembayaran;
            $row[] = '<a href="transaksi/edit/' . $transaksi->id_transaksi . ' " class="btn btn-sm btn btn-success" ><i class="fas fa-edit"></i></a>&nbsp<button type="button" name="delete" onclick="delete_data(' . $transaksi->id_transaksi . ')" class="btn btn-sm btn btn-danger delete"><i class="fas fa-trash" style="width: 15px"></i></button>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST["draw"],
            "recordsTotal" => $this->Transaksi_model->get_all_data(),
            "recordsFiltered" => $this->Transaksi_model->get_filtered_data(),
            "data" => $data
        );

        //output to json format
        echo json_encode($output);
    }

    public function add()
    {
        $data['title'] = 'Tambah Data Rekam Medis';
        $this->load->model('Transaksi_model');
        $this->load->model('Dtindakan_model');
        $this->load->model('Dobat_model');
        $data['dokter'] = $this->Transaksi_model->get_dokter();
        $data['perawat'] = $this->Transaksi_model->get_perawat();
        // $data['tindakan'] = $this->Dtindakan_model->get_tindakan();
        $data['admin'] = $this->db->get_where('admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/transaksi/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/transaksi/form_add', $data);
        $this->load->view('templates/footer');


        $no_rekam_medis = $this->input->post('no_rekam_medis');
        if (isset($no_rekam_medis)) {
            $id_pasien = $this->Transaksi_model->get_id_pasien($no_rekam_medis);

            $config['upload_path'] = './uploads/rontgen/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('foto_rontgen')) {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('admin/transaksi/form_add', $error);
                $foto = "default.jpg";
            } else {
                // $foto = $this->upload->data();
                $sukses = array('file' => $this->upload->data());
                $foto = $sukses['file']['file_name'];
            }

            $jam_selesai = date('H:i');
            $tanggal = date('Y-m-d');
            $data = [
                'id_transaksi' => $this->input->post('id_transaksi'),
                'id_pasien' => $id_pasien,
                'id_dokter' => $this->input->post('dokter'),
                'id_perawat' => $this->input->post('perawat'),
                'tanggal' => $tanggal,
                'diagnosa' => $this->input->post('diagnosa'),
                'total_biaya_tindakan' => $this->input->post('total_biaya_tindakan'),
                'total_biaya_obat' => $this->input->post('total_biaya_obat'),
                'foto_rontgen' => $foto,
                'keterangan' => $this->input->post('keterangan'),
                'jam_mulai' => $this->input->post('jam_mulai'),
                'jam_selesai' => $jam_selesai,
                'total_biaya_keseluruhan' => $this->input->post('total_biaya_keseluruhan'),
                'metode_pembayaran' => $this->input->post('metode_pembayaran'),
            ];

            $this->Transaksi_model->add_data($data);

            $last_transaksi = $this->Dtindakan_model->get_last_transaksi();
            foreach ($last_transaksi as $last) {
                $last;
            }
            $data = [
                'id_detail_tindakan' => $this->input->post('id_detail_tindakan'),
                'id_transaksi' => $last,
                'id_tindakan' => $this->input->post('tindakan'),
                'biaya_tindakan' => $this->input->post('biaya')
            ];
            $this->Dtindakan_model->add_data($data);

            $tindakan2 = $this->input->post('tindakan2');
            if ($tindakan2 != '') {
                $data2 = [
                    'id_detail_tindakan' => $this->input->post('id_detail_tindakan'),
                    'id_transaksi' => $last,
                    'id_tindakan' => $this->input->post('tindakan2'),
                    'biaya_tindakan' => $this->input->post('biaya2')
                ];
                $this->Dtindakan_model->add_data($data2);
                $this->Dtindakan_model->total_biaya_tindakan();
            } else {
                $this->Dtindakan_model->total_biaya_tindakan();
            }

            $biaya_obat = $this->input->post('harga');
            $jumlah_obat = $this->input->post('jumlah');
            $total_biaya_obat = $biaya_obat * $jumlah_obat;
            $data = [
                'id_detail_biaya_obat' => $this->input->post('id_detail_biaya_obat'),
                'id_transaksi' => $last,
                'id_obat' => $this->input->post('obat'),
                'dosis' => $this->input->post('dosis'),
                'jumlah_obat' => $this->input->post('jumlah'),
                'biaya_obat' => $total_biaya_obat
            ];
            $this->Dobat_model->add_data($data);

            $obat2 = $this->input->post('obat2');
            if ($obat2 != '') {

                $biaya_obat2 = $this->input->post('harga2');
                $jumlah_obat2 = $this->input->post('jumlah2');
                $total_biaya_obat2 = $biaya_obat2 * $jumlah_obat2;
                $data2 = [
                    'id_detail_biaya_obat' => $this->input->post('id_detail_biaya_obat'),
                    'id_transaksi' => $last,
                    'id_obat' => $this->input->post('obat2'),
                    'dosis' => $this->input->post('dosis2'),
                    'jumlah_obat' => $this->input->post('jumlah2'),
                    'biaya_obat' => $total_biaya_obat2
                ];
                $this->Dobat_model->add_data($data2);
                $this->Dobat_model->total_biaya_obat();
                $this->Dobat_model->total_biaya_keseluruhan();

                $this->session->set_flashdata('flash', 'ditambahkan');
                redirect('transaksi');
            } else {
                $this->Dobat_model->total_biaya_obat();
                $this->Dobat_model->total_biaya_keseluruhan();
                $this->session->set_flashdata('flash', 'ditambahkan');
                redirect('transaksi');
            }
        }
    }

    public function isExist()
    {
        $no_rekam_medis = $this->input->post('no_rekam_medis');
        $id_pasien = $this->Transaksi_model->get_id_pasien($no_rekam_medis);
        if (!$id_pasien) {
            echo "Nomor Rekam Medis tidak ditemukan";
        } else {
            echo "";
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Data Rekam Medis';
        $this->load->model('Transaksi_model');
        $this->load->model('Dtindakan_model');
        $this->load->model('Dobat_model');
        $data['pasien'] = $this->Transaksi_model->get_pasien();
        $data['dokter'] = $this->Transaksi_model->get_dokter();
        $data['perawat'] = $this->Transaksi_model->get_perawat();
        $data['admin'] = $this->db->get_where('admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['transaksi'] = $this->Transaksi_model->getById($id);
        // $data['detail_tindakan'] = $this->Transaksi_model->getDetailTindakan($id);
        // $data['detail_obat'] = $this->Transaksi_model->getDetailObat($id);
        $data['detail_tindakan'] = $this->Dtindakan_model->getDtindakan1($id);
        $data['nama_tindakan'] = $this->Dtindakan_model->getTindakan1($id);
        $data['detail_tindakan2'] = $this->Dtindakan_model->getDtindakan2($id);
        $data['nama_tindakan2'] = $this->Dtindakan_model->getTindakan2($id);

        $data['detail_obat'] = $this->Dobat_model->getDobat1($id);
        $data['nama_obat'] = $this->Dobat_model->getObat1($id);
        $data['detail_obat2'] = $this->Dobat_model->getDobat2($id);
        $data['nama_obat2'] = $this->Dobat_model->getObat2($id);

        $this->load->view('templates/header', $data);
        $this->load->view('admin/transaksi/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/transaksi/form_edit', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $this->load->model('Transaksi_model');
        $this->load->model('Dtindakan_model');
        $this->load->model('Dobat_model');
        $no_rekam_medis = $this->input->post('no_rekam_medis');
        if (isset($no_rekam_medis)) {
            $id_pasien = $this->Transaksi_model->get_id_pasien($no_rekam_medis);

            if (!empty($_FILES["foto_rontgen"])) {
                // $this->foto_rontgen = $this->Transaksi_model->_uploadImage();
                $config['upload_path'] = './uploads/rontgen/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['overwrite'] = true;

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('foto_rontgen')) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('admin/transaksi/edit_data', $error);
                    // $foto = "default.jpg";
                    $foto = $this->input->post('old_image');
                } else {
                    // $foto = $this->upload->data();
                    $sukses = array('file' => $this->upload->data());
                    $foto = $sukses['file']['file_name'];
                }
            } else {
                $foto = $this->input->post('old_image');
            }

            $data = [
                'id_transaksi' => $this->input->post('id_transaksi'),
                'id_pasien' => $id_pasien,
                'id_dokter' => $this->input->post('dokter'),
                'id_perawat' => $this->input->post('perawat'),
                'tanggal' => $this->input->post('tanggal'),
                'diagnosa' => $this->input->post('diagnosa'),
                'total_biaya_tindakan' => $this->input->post('total_biaya_tindakan'),
                'total_biaya_obat' => $this->input->post('total_biaya_obat'),
                'foto_rontgen' => $foto,
                'keterangan' => $this->input->post('keterangan'),
                'jam_mulai' => $this->input->post('jam_mulai'),
                'jam_selesai' => $this->input->post('jam_selesai'),
                'total_biaya_keseluruhan' => $this->input->post('total_biaya_keseluruhan'),
                'metode_pembayaran' => $this->input->post('metode_pembayaran'),
            ];

            $this->Transaksi_model->edit_data(array('id_transaksi' => $this->input->post('id_transaksi')), $data);

            $data = [
                'id_detail_tindakan' => $this->input->post('id_detail_tindakan1'),
                'id_transaksi' => $this->input->post('id_transaksi'),
                'id_tindakan' => $this->input->post('tindakan'),
                'biaya_tindakan' => $this->input->post('biaya')
            ];
            $this->Dtindakan_model->edit_data(array('id_detail_tindakan' => $this->input->post('id_detail_tindakan1')), $data);

            $tindakan2 = $this->input->post('tindakan2');
            $id_detail_tindakan2 = $this->input->post('id_detail_tindakan2');
            if ($tindakan2 != '') {
                $data2 = [
                    'id_detail_tindakan' => $this->input->post('id_detail_tindakan2'),
                    'id_transaksi' => $this->input->post('id_transaksi'),
                    'id_tindakan' => $this->input->post('tindakan2'),
                    'biaya_tindakan' => $this->input->post('biaya2')
                ];
                $this->Dtindakan_model->edit_data(array('id_detail_tindakan' => $this->input->post('id_detail_tindakan2')), $data2);
                $this->Dtindakan_model->edit_total_biaya_tindakan($this->input->post('id_transaksi'));
            } else if ($id_detail_tindakan2 == '') {
                $data2 = [
                    'id_detail_tindakan' => $this->input->post('id_detail_tindakan2'),
                    'id_transaksi' => $this->input->post('id_transaksi'),
                    'id_tindakan' => $this->input->post('tindakan2'),
                    'biaya_tindakan' => $this->input->post('biaya2')
                ];
                $this->Dtindakan_model->add_data($data2);
                $this->Dtindakan_model->edit_total_biaya_tindakan($this->input->post('id_transaksi'));
            } else {
                $this->Dtindakan_model->edit_total_biaya_tindakan($this->input->post('id_transaksi'));
            }

            $biaya_obat = $this->input->post('harga');
            $jumlah_obat = $this->input->post('jumlah');
            $total_biaya_obat = $biaya_obat * $jumlah_obat;
            $data = [
                'id_detail_biaya_obat' => $this->input->post('id_detail_biaya_obat1'),
                'id_transaksi' => $this->input->post('id_transaksi'),
                'id_obat' => $this->input->post('obat'),
                'dosis' => $this->input->post('dosis'),
                'jumlah_obat' => $this->input->post('jumlah'),
                'biaya_obat' => $total_biaya_obat
            ];
            $this->Dobat_model->edit_data(array('id_detail_biaya_obat' => $this->input->post('id_detail_biaya_obat1')), $data);

            $obat2 = $this->input->post('obat2');
            if ($obat2 != '') {

                $biaya_obat2 = $this->input->post('harga2');
                $jumlah_obat2 = $this->input->post('jumlah2');
                $total_biaya_obat2 = $biaya_obat2 * $jumlah_obat2;
                $data2 = [
                    'id_detail_biaya_obat' => $this->input->post('id_detail_biaya_obat2'),
                    'id_transaksi' => $this->input->post('id_transaksi'),
                    'id_obat' => $this->input->post('obat2'),
                    'dosis' => $this->input->post('dosis2'),
                    'jumlah_obat' => $this->input->post('jumlah2'),
                    'biaya_obat' => $total_biaya_obat2
                ];
                $this->Dobat_model->edit_data(array('id_detail_biaya_obat' => $this->input->post('id_detail_biaya_obat2')), $data2);
                // $this->Dobat_model->total_biaya_obat();
                $this->Dobat_model->edit_total_biaya_obat($this->input->post('id_transaksi'));
                $this->Dobat_model->total_biaya_keseluruhan();

                $this->session->set_flashdata('flash', 'ditambahkan');
                redirect('transaksi');
            } else {
                // $this->Dobat_model->total_biaya_obat();
                $this->Dobat_model->edit_total_biaya_obat($this->input->post('id_transaksi'));
                $this->Dobat_model->total_biaya_keseluruhan();
                $this->session->set_flashdata('flash', 'ditambahkan');
                redirect('transaksi');
            }
        }
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Data Rekam Medis';
        $data['pasien'] = $this->Transaksi_model->get_pasien();
        $data['dokter'] = $this->Transaksi_model->get_dokter();
        $data['perawat'] = $this->Transaksi_model->get_perawat();
        $data['admin'] = $this->db->get_where('admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['transaksi'] = $this->Transaksi_model->getById($id);
        $this->load->view('templates/header', $data);
        $this->load->view('admin/transaksi/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/transaksi/detail_data', $data);
        $this->load->view('templates/footer');
        // echo json_encode($data);
    }

    public function delete($id)
    {
        $this->Transaksi_model->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
