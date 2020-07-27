<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->session->set_userdata('previous_url', current_url());
	}

	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->session->userdata('masuk') != TRUE) {
			if ($this->form_validation->run() == false) {
				$data['title'] = 'Login Page';
				$this->load->view('templates/auth_header', $data);
				$this->load->view('auth/login');
				$this->load->view('templates/auth_footer');
			} else {
				//validasi success
				$this->_login();
			}
		} else {
			redirect('dashboard');
		}
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		// $admin = $this->db->get_where('admin', ['email' => $email])->row_array();
		$admin = $this->db->where('email', $email)->or_where('username', $email)->get('admin')->row_array();
		$dokter = $this->db->where('email', $email)->or_where('username', $email)->get('dokter')->row_array();
		$perawat = $this->db->where('email', $email)->or_where('username', $email)->get('perawat')->row_array();
		$staf = $this->db->where('email', $email)->or_where('username', $email)->get('staf')->row_array();

		if ($admin) {
			//usernya ada
			if (password_verify($password, $admin['password'])) {
				$data = [
					'id' => $admin['id_admin'],
					'email' => $admin['email'],
					'username' => $admin['username'],
					'nama' => $admin['nama']
				];
				// $this->session->sess_expiration = 14400; // 4 Hours
				$this->session->set_userdata($data);
				$this->session->set_userdata('masuk', TRUE);
				$this->session->set_userdata('akses', '1');
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
				redirect(base_url());
			}
		} else if ($dokter) {
			if (password_verify($password, $dokter['password'])) {
				$data = [
					'id' => $dokter['id_dokter'],
					'username' => $dokter['username'],
					'nama' => $dokter['nama'],
					'email' => $dokter['email'],
				];
				$this->session->set_userdata($data);
				$this->session->set_userdata('masuk', TRUE);
				$this->session->set_userdata('akses', '2');
				redirect('transaksi');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
				redirect(base_url());
			}
		} else if ($perawat) {
			if (password_verify($password, $perawat['password'])) {
				$data = [
					'id' => $perawat['id_perawat'],
					'username' => $perawat['username'],
					'nama' => $perawat['nama'],
					'email' => $perawat['email']
				];
				$this->session->set_userdata($data);
				$this->session->set_userdata('masuk', TRUE);
				$this->session->set_userdata('akses', '3');
				redirect('transaksi');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
				redirect(base_url());
			}
		} else if ($staf) {
			if (password_verify($password, $staf['password'])) {
				$data = [
					'id' => $staf['id_staf'],
					'username' => $staf['username'],
					'nama' => $staf['nama'],
					'email' => $staf['email']
				];
				$this->session->set_userdata($data);
				$this->session->set_userdata('masuk', TRUE);
				$this->session->set_userdata('akses', '4');
				redirect('transaksi');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
				redirect(base_url());
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User is not registered!</div>');
			redirect(base_url());
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('masuk');
		$this->session->unset_userdata('akses');
		$this->session->sess_destroy();
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
		redirect(base_url());
	}

	// public function registration()
	// {
	// 	$this->form_validation->set_rules('name', 'Name', 'required|trim');
	// 	$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[admin.email]', [
	// 		'is_unique' => 'This email has already registered!'
	// 	]);
	// 	$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
	// 		'matches' => 'Password dont match!',
	// 		'min_length' => 'Password too short'
	// 	]);
	// 	$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
	// 	if ($this->form_validation->run() == false) {
	// 		$data['title'] = 'User Registration';
	// 		$this->load->view('templates/auth_header', $data);
	// 		$this->load->view('auth/registration');
	// 		$this->load->view('templates/auth_footer');
	// 	} else {
	// 		$data = [
	// 			'username' => htmlspecialchars($this->input->post('username', true)),
	// 			'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
	// 			'nama' => htmlspecialchars($this->input->post('name', true)),
	// 			'email' => htmlspecialchars($this->input->post('email', true)),
	// 		];

	// 		$this->db->insert('admin', $data);
	// 		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your account has been created. Please login!</div>');
	// 		redirect('auth');
	// 	}
	// }
}
