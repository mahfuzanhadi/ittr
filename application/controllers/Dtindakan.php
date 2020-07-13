<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dtindakan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dtindakan_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url();
            redirect($url);
        }
    }

    public function get_tindakan()
    {
        // Search term
        $searchTerm = $this->input->post('searchTerm');

        // Get data tindakan
        $response = $this->Dtindakan_model->getTindakan($searchTerm);

        echo json_encode($response);
    }

    public function get_biaya()
    {
        $id_tindakan = $this->input->post('id', TRUE);
        $data = $this->Dtindakan_model->get_biaya($id_tindakan);
        echo json_encode($data);
    }
}
