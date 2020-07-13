<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dobat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dobat_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url();
            redirect($url);
        }
    }

    public function get_obat()
    {
        // Search term
        $searchTerm = $this->input->post('searchTerm');

        // Get data tindakan
        $response = $this->Dobat_model->getObat($searchTerm);

        echo json_encode($response);
    }

    public function get_harga()
    {
        $id_obat = $this->input->post('id', TRUE);
        $data = $this->Dobat_model->get_harga($id_obat);
        echo json_encode($data);
    }
}
