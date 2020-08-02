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
    }

    public function index()
    {
        $this->load->helper('url');
        $data['title'] = 'Data Transaksi';
        $data['pasien'] = $this->Transaksi_model->get_pasien();
        $data['dokter'] = $this->Transaksi_model->get_dokter();
        $data['perawat'] = $this->Transaksi_model->get_perawat();

        if ($this->session->userdata('akses') == '1') { //IF USER = ADMINISTRATOR
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/transaksi/index', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '2') { //IF USER = DOKTER
            $this->load->view('templates/header', $data);
            $this->load->view('templates/dokter/sidebar', $data);
            $this->load->view('templates/dokter/topbar', $data);
            $this->load->view('dokter/transaksi/index', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '3') { //IF USER = PERAWAT
            $this->load->view('templates/header', $data);
            $this->load->view('templates/perawat/sidebar', $data);
            $this->load->view('templates/perawat/topbar', $data);
            $this->load->view('perawat/transaksi/index', $data);
            $this->load->view('templates/footer');
        } else { //IF USER = STAF ADMINISTRASI
            $this->load->view('templates/header', $data);
            $this->load->view('templates/staf/sidebar', $data);
            $this->load->view('templates/staf/topbar', $data);
            $this->load->view('staf/transaksi/index', $data);
            $this->load->view('templates/footer');
        }
        $this->session->set_userdata('previous_url', current_url());
    }

    // fetch transaksi/rekam medis data
    public function fetch_data()
    {
        $list = $this->Transaksi_model->make_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $transaksi) {
            $row = array();
            $diagnosa = array();
            $nama_tindakan = array();
            $no++;
            // $base = base_url('uploads/rontgen/' . $transaksi->foto_rontgen);
            $metode_pembayaran = $transaksi->metode_pembayaran;
            if ($metode_pembayaran == 0) {
                $color = "#FF0000";
                $metode_pembayaran = "BB";
            } else {
                $color = "#008000";
                $metode_pembayaran = "L";
            }

            setlocale(LC_ALL, 'id-ID', 'id_ID');
            $tanggal = strftime("%d %B %Y", strtotime($transaksi->tanggal));

            $detail_tindakan = $this->Transaksi_model->get_transaksi_tindakan($transaksi->id_transaksi);
            $tindakan = $this->Transaksi_model->get_tindakan();

            if ($this->session->userdata('akses') == '1') { //IF USER = ADMINISTRATOR
                $row[] = $no;
                $row[] = '<a style="color:' . $color . '; cursor: pointer" onclick="detail_data(' . $transaksi->id_transaksi . ')" >' . $metode_pembayaran . '</a>';
                $row[] = '<a href="transaksi/detail_transaksi/' . $transaksi->id_transaksi . '"  style="color:#007bff; cursor: pointer">' . $tanggal . '</a>';
                $row[] = '<a href="transaksi/rekam_medis/' . $transaksi->no_rekam_medis . '" style="color:#007bff; cursor: pointer">' . $transaksi->no_rekam_medis . '</a>';
                $row[] = $transaksi->nama_pasien;
                $row[] = $transaksi->nama_dokter;
                foreach ($detail_tindakan as $dt) {
                    if ($dt->diagnosa != '') {
                        $diagnosa[] = ' ' . $dt->diagnosa;
                    }
                    foreach ($tindakan as $t) {
                        if ($t->id_tindakan == $dt->id_tindakan) {
                            $nama_tindakan[] = ' ' . $t->nama;
                        }
                    }
                }
                foreach ($diagnosa as $key => $value) {
                    if (empty($value)) {
                        unset($diagnosa[$key]);
                    }
                }
                $row[] = $diagnosa;
                $row[] = $nama_tindakan;
                $row[] = $transaksi->total_biaya_tindakan;
                $row[] = $transaksi->total_biaya_obat;
                // $row[] = '<img width="64px" height="64px" src="' . $base . '"/>';
                $row[] = $transaksi->total_biaya_keseluruhan;
                $row[] = '<a href="transaksi/edit/' . $transaksi->id_transaksi . ' " class="btn btn-sm btn btn-success" ><i class="fas fa-edit"></i></a>&nbsp<button type="button" name="delete" onclick="delete_data(' . $transaksi->id_transaksi . ')" class="btn btn-sm btn btn-danger delete"><i class="fas fa-trash" style="width: 15px"></i></button>';
                $data[] = $row;
            } else if ($this->session->userdata('akses') == '2') {
                $row[] = $no;
                $row[] = '<a href="transaksi/detail_transaksi/' . $transaksi->id_transaksi . '"  style="color:#007bff; cursor: pointer">' . $tanggal . '</a>';
                $row[] = '<a href="transaksi/rekam_medis/' . $transaksi->no_rekam_medis . '" style="color:#007bff; cursor: pointer">' . $transaksi->no_rekam_medis . '</a>';
                $row[] = $transaksi->nama_pasien;
                $row[] = $transaksi->nama_dokter;
                foreach ($detail_tindakan as $dt) {
                    if ($dt->diagnosa != '') {
                        $diagnosa[] = ' ' . $dt->diagnosa;
                    }
                    foreach ($tindakan as $t) {
                        if ($t->id_tindakan == $dt->id_tindakan) {
                            $nama_tindakan[] = ' ' . $t->nama;
                        }
                    }
                }
                foreach ($diagnosa as $key => $value) {
                    if (empty($value)) {
                        unset($diagnosa[$key]);
                    }
                }
                $row[] = $diagnosa;
                $row[] = $nama_tindakan;
                $row[] = $transaksi->total_biaya_tindakan;
                $row[] = $transaksi->total_biaya_obat;
                $row[] = $transaksi->total_biaya_keseluruhan;
                $row[] = '<a href="transaksi/edit/' . $transaksi->id_transaksi . ' " class="btn btn-sm btn btn-success" ><i class="fas fa-edit"></i></a>&nbsp<button type="button" name="delete" onclick="delete_data(' . $transaksi->id_transaksi . ')" class="btn btn-sm btn btn-danger delete"><i class="fas fa-trash" style="width: 15px"></i></button>';
                $data[] = $row;
            } else { //IF USER == PERAWAT / STAF ADMINISTRASI
                $row[] = $no;
                $row[] = '<a style="color:' . $color . '; cursor: pointer" onclick="detail_data(' . $transaksi->id_transaksi . ')" >' . $metode_pembayaran . '</a>';
                $row[] = '<a href="transaksi/detail_transaksi/' . $transaksi->id_transaksi . '"  style="color:#007bff; cursor: pointer">' . $tanggal . '</a>';
                $row[] = '<a href="transaksi/rekam_medis/' . $transaksi->no_rekam_medis . '" style="color:#007bff; cursor: pointer">' . $transaksi->no_rekam_medis . '</a>';
                $row[] = $transaksi->nama_pasien;
                $row[] = $transaksi->nama_dokter;
                foreach ($detail_tindakan as $dt) {
                    if ($dt->diagnosa != '') {
                        $diagnosa[] = ' ' . $dt->diagnosa;
                    }
                    foreach ($tindakan as $t) {
                        if ($t->id_tindakan == $dt->id_tindakan) {
                            $nama_tindakan[] = ' ' . $t->nama;
                        }
                    }
                }
                foreach ($diagnosa as $key => $value) {
                    if (empty($value)) {
                        unset($diagnosa[$key]);
                    }
                }
                $row[] = $diagnosa;
                $row[] = $nama_tindakan;
                $row[] = $transaksi->total_biaya_tindakan;
                $row[] = $transaksi->total_biaya_obat;
                $row[] = $transaksi->total_biaya_keseluruhan;
                $data[] = $row;
            }
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

    public function get_tindakan()
    {
        // Search term
        $searchTerm = $this->input->post('searchTerm');

        // Get data tindakan
        $response = $this->Transaksi_model->getTindakan($searchTerm);

        echo json_encode($response);
    }

    public function get_biaya()
    {
        $id_tindakan = $this->input->post('id', TRUE);
        $data = $this->Transaksi_model->get_biaya($id_tindakan);
        echo json_encode($data);
    }

    public function get_obat()
    {
        // Search term
        $searchTerm = $this->input->post('searchTerm');

        // Get data tindakan
        $response = $this->Transaksi_model->getObat($searchTerm);

        echo json_encode($response);
    }

    public function get_harga()
    {
        $id_obat = $this->input->post('id', TRUE);
        $data = $this->Transaksi_model->get_harga($id_obat);
        echo json_encode($data);
    }

    // Function to add data transaksi
    public function add()
    {
        $data['title'] = 'Tambah Data Transaksi';
        $data['dokter'] = $this->Transaksi_model->get_dokter();
        $data['perawat'] = $this->Transaksi_model->get_perawat();

        if ($this->session->userdata('akses') == 1) { //IF USER = ADMINISTRATOR
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/transaksi/form_add', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == 2) { //IF USER = DOKTER
            $this->load->view('templates/header', $data);
            $this->load->view('templates/dokter/sidebar', $data);
            $this->load->view('templates/dokter/topbar', $data);
            $this->load->view('dokter/transaksi/form_add', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == 3) { //IF USER = PERAWAT
            $this->load->view('templates/header', $data);
            $this->load->view('templates/perawat/sidebar', $data);
            $this->load->view('templates/perawat/topbar', $data);
            $this->load->view('perawat/transaksi/form_add', $data);
            $this->load->view('templates/footer');
        } else { //IF USER = STAF ADMINISTRASI
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        }
        $this->session->set_userdata('previous_url', current_url());

        // ISI DATA TABEL TRANSAKSI
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
                $sukses = array('file' => $this->upload->data());
                $foto = $sukses['file']['file_name'];
            }

            $jam_selesai = date('H:i');
            $tanggal = date('Y-m-d');
            $metode_pembayaran = $this->input->post('metode_pembayaran');
            if ($metode_pembayaran == '') {
                $metode_pembayaran = 0;
            } else {
                $metode_pembayaran = $this->input->post('metode_pembayaran');
            }

            $added_by = $this->session->userdata('nama');

            $data = [
                'id_transaksi' => $this->input->post('id_transaksi'),
                'id_pasien' => $id_pasien,
                'id_dokter' => $this->input->post('dokter'),
                'id_perawat' => $this->input->post('perawat'),
                'tanggal' => $tanggal,
                'total_biaya_tindakan' => $this->input->post('total_biaya_tindakan'),
                'total_biaya_obat' => $this->input->post('total_biaya_obat'),
                'foto_rontgen' => $foto,
                'keterangan' => nl2br($this->input->post('keterangan')),
                'jam_mulai' => $this->input->post('jam_mulai'),
                'jam_selesai' => $jam_selesai,
                'total_biaya_keseluruhan' => $this->input->post('total_biaya_keseluruhan'),
                'metode_pembayaran' => $metode_pembayaran,
                'added_by' => $added_by,
            ];

            $this->Transaksi_model->add_data($data);

            //ISI DATA TABEL DETAIL TINDAKAN
            $last_transaksi = $this->Transaksi_model->get_last_transaksi();
            foreach ($last_transaksi as $last) {
                $last;
            }

            $tindakan = $this->input->post('tindakan');
            $diagnosa = $this->input->post('diagnosa');
            $biaya_tindakan = $this->input->post('biaya');
            if ($tindakan != '') {
                foreach ($tindakan as $key => $value) {
                    $data = [
                        'id_detail_tindakan' => $this->input->post('id_detail_tindakan'),
                        'id_transaksi' => $last,
                        'id_tindakan' => $value,
                        'diagnosa' => $diagnosa[$key],
                        'biaya_tindakan' => $biaya_tindakan[$key]
                    ];
                    $this->Transaksi_model->add_data_detail_tindakan($data);
                }
            }
            $this->Transaksi_model->total_biaya_tindakan();

            //ISI DATA TABEL DETAIL OBAT
            $obat = $this->input->post('obat');
            $dosis = $this->input->post('dosis');
            $harga = $this->input->post('harga');
            $jumlah = $this->input->post('jumlah');

            if ($obat != '') {
                foreach ($obat as $key => $value) {
                    $total_biaya_obat = $harga[$key] * $jumlah[$key];
                    $data = [
                        'id_detail_biaya_obat' => $this->input->post('id_detail_biaya_obat'),
                        'id_transaksi' => $last,
                        'id_obat' => $value,
                        'dosis' => $dosis[$key],
                        'jumlah_obat' => $jumlah[$key],
                        'biaya_obat' => $total_biaya_obat
                    ];

                    $this->Transaksi_model->kurangi_stok($jumlah[$key], $value); //fungsi update stok pada tabel obat
                    $this->Transaksi_model->add_data_biaya_obat($data);
                }
            }
            $this->Transaksi_model->total_biaya_obat();
            $this->Transaksi_model->total_biaya_keseluruhan();
            $this->session->set_flashdata('flash', 'ditambahkan');
            redirect('transaksi');
        }
    }

    // Function to show data for edit data transaksi
    public function edit($id)
    {
        $data['title'] = 'Edit Data Transaksi';
        $data['pasien'] = $this->Transaksi_model->get_pasien();
        $data['dokter'] = $this->Transaksi_model->get_dokter();
        $data['perawat'] = $this->Transaksi_model->get_perawat();

        $data['transaksi'] = $this->Transaksi_model->getById($id);
        $data['detail_tindakan'] = $this->Transaksi_model->get_detail_tindakan();
        $data['tindakan'] = $this->Transaksi_model->get_tindakan();
        $data['detail_obat'] = $this->Transaksi_model->get_detail_biaya_obat();
        $data['obat'] = $this->Transaksi_model->get_obat();

        if ($this->session->userdata('akses') == 1) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/transaksi/form_edit', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == 2) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/dokter/sidebar', $data);
            $this->load->view('templates/dokter/topbar', $data);
            $this->load->view('dokter/transaksi/form_edit', $data);
            $this->load->view('templates/footer');
        } else {
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        }
        $this->session->set_userdata('previous_url', current_url());
    }

    // Function to update edited data rekam medis
    public function update()
    {
        $this->load->model('Transaksi_model');
        $no_rekam_medis = $this->input->post('no_rekam_medis');
        if (isset($no_rekam_medis)) {
            $id_pasien = $this->Transaksi_model->get_id_pasien($no_rekam_medis);

            if (!empty($_FILES["foto_rontgen"])) {
                $config['upload_path'] = './uploads/rontgen/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['overwrite'] = true;

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('foto_rontgen')) {
                    $foto = $this->input->post('old_image');
                } else {
                    $sukses = array('file' => $this->upload->data());
                    $foto = $sukses['file']['file_name'];
                }
            } else {
                $foto = $this->input->post('old_image');
            }

            $metode_pembayaran = $this->input->post('metode_pembayaran');
            if ($metode_pembayaran == '') {
                $metode_pembayaran = 0;
            } else {
                $metode_pembayaran = $this->input->post('metode_pembayaran');
            }

            $added_by = $this->session->userdata('nama');

            $data = [
                'id_transaksi' => $this->input->post('id_transaksi'),
                'id_pasien' => $id_pasien,
                'id_dokter' => $this->input->post('dokter'),
                'id_perawat' => $this->input->post('perawat'),
                'tanggal' => $this->input->post('tanggal'),
                'total_biaya_tindakan' => $this->input->post('total_biaya_tindakan'),
                'total_biaya_obat' => $this->input->post('total_biaya_obat'),
                'foto_rontgen' => $foto,
                'keterangan' => nl2br($this->input->post('keterangan')),
                'jam_mulai' => $this->input->post('jam_mulai'),
                'jam_selesai' => $this->input->post('jam_selesai'),
                'total_biaya_keseluruhan' => $this->input->post('total_biaya_keseluruhan'),
                'metode_pembayaran' => $metode_pembayaran,
                'added_by' => $added_by
            ];

            $this->Transaksi_model->edit_data(array('id_transaksi' => $this->input->post('id_transaksi')), $data);

            //UPDATE DETAIL TINDAKAN
            $id_detail_tindakan = $this->input->post('id_detail_tindakan');
            $tindakan = $this->input->post('tindakan');
            $diagnosa = $this->input->post('diagnosa');
            $biaya_tindakan = $this->input->post('biaya');
            if ($tindakan != '') {
                foreach ($tindakan as $key => $value) {
                    $data = [
                        'id_detail_tindakan' => $id_detail_tindakan[$key],
                        'id_transaksi' => $this->input->post('id_transaksi'),
                        'id_tindakan' => $value,
                        'diagnosa' => $diagnosa[$key],
                        'biaya_tindakan' => $biaya_tindakan[$key]
                    ];
                    $this->Transaksi_model->edit_data_detail_tindakan(array('id_detail_tindakan' => $id_detail_tindakan[$key]), $data);
                }
                $this->Transaksi_model->edit_total_biaya_tindakan($this->input->post('id_transaksi'));
            }

            //UPDATE DATA DETAIL OBAT
            $id_detail_biaya_obat = $this->input->post('id_detail_biaya_obat');
            $obat = $this->input->post('obat');
            $dosis = $this->input->post('dosis');
            $harga = $this->input->post('harga');
            $jumlah = $this->input->post('jumlah');

            if ($obat != '') {
                foreach ($obat as $key => $value) {
                    $total_biaya_obat = $harga[$key] * $jumlah[$key];
                    $data = [
                        'id_detail_biaya_obat' => $id_detail_biaya_obat[$key],
                        'id_transaksi' => $this->input->post('id_transaksi'),
                        'id_obat' => $value,
                        'dosis' => $dosis[$key],
                        'jumlah_obat' => $jumlah[$key],
                        'biaya_obat' => $total_biaya_obat
                    ];

                    $this->Transaksi_model->update_stok($jumlah[$key], $value, $id_detail_biaya_obat[$key]); //fungsi update stok pada tabel obat
                    $this->Transaksi_model->edit_data_biaya_obat(array('id_detail_biaya_obat' => $id_detail_biaya_obat[$key]), $data);
                }
                $this->Transaksi_model->edit_total_biaya_obat($this->input->post('id_transaksi'));
                $this->Transaksi_model->edit_total_biaya_keseluruhan($this->input->post('id_transaksi'));
            }
            $this->session->set_flashdata('flash', 'diubah');
            redirect('transaksi');
        }
    }

    // Function to check if no_rekam_medis already exist
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

    // Function get detail data rekam medis by id_transaksi
    public function detail_data($id)
    {
        $data = $this->Transaksi_model->get_detail_transaksi($id);
        echo json_encode($data);
    }

    // Function tampilkan data transaksi by id_transaksi
    public function detail_transaksi($id)
    {
        $this->load->model('Pasien_model');
        $data['title'] = 'Detail Transaksi';

        $data['transaksi'] = $this->Transaksi_model->getById($id);
        $data['pasien'] = $this->Transaksi_model->get_pasien();
        $data['dokter'] = $this->Transaksi_model->get_dokter();
        $data['perawat'] = $this->Transaksi_model->get_perawat();
        $data['detail_tindakan'] = $this->Transaksi_model->get_detail_tindakan();
        $data['tindakan'] = $this->Transaksi_model->get_tindakan();
        $data['detail_obat'] = $this->Transaksi_model->get_detail_biaya_obat();
        $data['obat'] = $this->Transaksi_model->get_obat();

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/transaksi/detail_transaksi', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '2') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/dokter/sidebar', $data);
            $this->load->view('templates/dokter/topbar', $data);
            $this->load->view('dokter/transaksi/detail_transaksi', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '3') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/perawat/sidebar', $data);
            $this->load->view('templates/perawat/topbar', $data);
            $this->load->view('perawat/transaksi/detail_transaksi', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/staf/sidebar', $data);
            $this->load->view('templates/staf/topbar', $data);
            $this->load->view('staf/transaksi/detail_transaksi', $data);
            $this->load->view('templates/footer');
        }
    }

    // Function tampilkan seluruh data rekam medis pasien by no_rekam_medis
    public function rekam_medis($no_rekam_medis)
    {
        $this->load->model('Pasien_model');
        $data['title'] = 'Data Rekam Medis';
        $id = $this->Transaksi_model->get_id_pasien($no_rekam_medis);

        $data['pasien'] = $this->Pasien_model->getById($id);
        $data['transaksi'] = $this->Pasien_model->get_transaksi_by_id($id);
        $data['dokter'] = $this->Transaksi_model->get_dokter();
        $data['perawat'] = $this->Transaksi_model->get_perawat();
        $data['detail_tindakan'] = $this->Transaksi_model->get_detail_tindakan();
        $data['tindakan'] = $this->Transaksi_model->get_tindakan();
        $data['detail_obat'] = $this->Transaksi_model->get_detail_biaya_obat();
        $data['obat'] = $this->Transaksi_model->get_obat();

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/transaksi/rekam_medis', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '2') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/dokter/sidebar', $data);
            $this->load->view('templates/dokter/topbar', $data);
            $this->load->view('dokter/transaksi/rekam_medis', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '3') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/perawat/sidebar', $data);
            $this->load->view('templates/perawat/topbar', $data);
            $this->load->view('perawat/transaksi/rekam_medis', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/staf/sidebar', $data);
            $this->load->view('templates/staf/topbar', $data);
            $this->load->view('staf/transaksi/rekam_medis', $data);
            $this->load->view('templates/footer');
        }
    }

    // Function to update data transaksi (metode pembayaran)
    public function update_transaksi()
    {
        $data = $this->input->post('metode_pembayaran');
        $id = $this->input->post('id_transaksi');
        $this->Transaksi_model->update_metode_pembayaran($id, $data);
        $this->session->set_flashdata('flash', 'diubah');
        redirect('transaksi');
    }

    // Function to delete data transaksi
    public function delete($id)
    {
        $this->Transaksi_model->delete_stok($id);
        $this->Transaksi_model->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
