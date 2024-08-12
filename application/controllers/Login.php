<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		global $header;
		$header['login'] = $this->session->userdata('login');
		$header['admin'] = $this->session->userdata('admin');
		$header['peserta'] = $this->session->userdata('peserta');
	}

	public function index()
	{
		global $header;

		if ($this->session->userdata('login')) {
			redirect(($header['admin']) ? 'dasbor' : '');
		}

		$header['judul'] = 'Login';
		$this->load->view('include/header', $header);
		$this->load->view('login');
		$this->load->view('include/footer');
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if (empty($username)) {
			$this->session->set_flashdata('danger', 'Username tidak boleh kosong!');
			redirect('login');
		}
		if (empty($password)) {
			$this->session->set_flashdata('danger', 'Kata Sandi tidak boleh kosong!');
			redirect('login');
		}
		$sql = $this->db->get_where('user', ['username' => $username]);
		if ($sql->num_rows() > 0) {
			$get = $sql->row_array();
			if (password_verify($password, $get['password'])) {
				$peserta = (5 == $get['role']) ? true : false;
				$session = array(
					'login' => true,
					'id_user' => $get['id_user'],
					'admin' => (1 == $get['role']) ? true : false,
					'bendahara' => (2 == $get['role']) ? true : false,
					'panitia' => (3 == $get['role']) ? true : false,
					'juri' => (4 == $get['role']) ? true : false,
					'peserta' => $peserta
				);
				$this->session->set_userdata($session);
				redirect(($peserta) ? '' : 'dasbor');
			} else {
				$this->session->set_flashdata('danger', 'Kata Sandi Salah!');
				redirect('login');
			}
		} else {
			$this->session->set_flashdata('danger', 'Username tidak ditemukan!');
			redirect('login');
		}
	}
}
