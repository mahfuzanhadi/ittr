<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekap extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url();
            redirect($url);
        }
    }

    public function index()
    {
        $this->load->helper('url');
        $this->load->model('Transaksi_model');
        $data['title'] = 'Rekap Data';
        $data['dokter'] = $this->Transaksi_model->get_dokter();

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/rekap/index', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '3') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/perawat/sidebar', $data);
            $this->load->view('templates/perawat/topbar', $data);
            $this->load->view('admin/rekap/index', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '4') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/staf/sidebar', $data);
            $this->load->view('templates/staf/topbar', $data);
            $this->load->view('admin/rekap/index', $data);
            $this->load->view('templates/footer');
        }
        $this->session->set_userdata('previous_url', current_url());
    }

    // fetch rekap data    
    public function rangeDates()
    {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $dokter = $this->input->post('dokter');

        $data = array();
        $this->db->select('transaksi.id_transaksi as id_transaksi, transaksi.tanggal as tanggal, pasien.no_rekam_medis as no_rm, dokter.nama as dokter, pasien.nama as pasien, transaksi.total_biaya_obat as biaya_obat, transaksi.total_biaya_keseluruhan as total');
        $this->db->from('transaksi');
        $this->db->where('tanggal >= ', $start_date);
        $this->db->where('tanggal <= ', $end_date);
        $this->db->where('transaksi.id_dokter', $dokter);
        $this->db->where('sisa', 0);
        $this->db->join('dokter', 'dokter.id_dokter = transaksi.id_dokter', 'left');
        $this->db->join('pasien', 'pasien.id_pasien = transaksi.id_pasien', 'left');
        $query = $this->db->get()->result();
        $no = 0;
        foreach ($query as $row) {
            $no++;
            $arr_tindakan = array();
            $arr_biaya_tindakan = array();
            $rows = array();
            $data3[] = $row->total;
            $total_keseluruhan = "Rp " . number_format($row->total, 0, ',', '.');
            setlocale(LC_ALL, 'id-ID', 'id_ID');
            $tanggal = strftime("%d %B %Y", strtotime($row->tanggal));
            $biaya_obat = "Rp " . number_format($row->biaya_obat, 0, ',', '.');
            $id_transaksi = $row->id_transaksi;

            $detail_tindakan = $this->db->query("SELECT * FROM detail_tindakan WHERE id_transaksi = '" . $id_transaksi . "'")->result();
            $tindakan = $this->db->query('SELECT * from tindakan')->result();
            if ($biaya_obat == "Rp 0") {
                $total_biaya_obat = "";
            } else {
                $total_biaya_obat = $biaya_obat;
            }

            $rows[] = $no;
            $rows[] = '<a href="transaksi/detail_transaksi/' . $row->id_transaksi . '" style="color:#007bff; cursor: pointer">' . $tanggal . '</a>';
            $rows[] = '<a href="transaksi/rekam_medis/' . $row->no_rm . '" style="color:#007bff; cursor: pointer">' . $row->no_rm . '</a>';
            $rows[] = $row->pasien;
            $rows[] = $row->dokter;
            foreach ($detail_tindakan as $dt) {
                if ($dt->id_transaksi == $id_transaksi) {
                    $id_tindakan = $dt->id_tindakan;
                    foreach ((array) $tindakan as $t) {
                        if ($t->id_tindakan == $id_tindakan) {
                            $format_biaya = "Rp " .  number_format($dt->biaya_tindakan, 0, ',', '.');
                            $arr_tindakan[] = $t->nama;
                            $arr_biaya_tindakan[] = $format_biaya;
                        }
                    }
                }
            }
            $rows[] = join("<br>", $arr_tindakan);
            $rows[] = join("<br>", $arr_biaya_tindakan);
            $rows[] = $total_biaya_obat;
            $rows[] = $total_keseluruhan;
            $data[] = $rows;
        }

        // echo json_encode($data);
        if (!empty($data3)) {
            $data3 = $data3;
        } else {
            $data3 = 0;
        }
        echo json_encode(array($data, $data3));
    }
}
