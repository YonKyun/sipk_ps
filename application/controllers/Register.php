<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
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

		$header['judul'] = 'Register';
		$this->load->view('include/header', $header);
		$this->load->view('register');
		$this->load->view('include/footer');
	}

	public function register()
	{
		$role = $this->input->post('role');
		$id_kejuaraan = $this->input->post('id_kejuaraan');
		$nama_user = $this->input->post('nama_user');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if (empty($role)) {
			$this->session->set_flashdata('danger', 'Role tidak boleh kosong!');
			redirect('register');
		}
		if ($role == 3) {
			if (empty($id_kejuaraan)) {
				$this->session->set_flashdata('danger', 'Silakan pilih Kejuaraan!');
				redirect('register');
			}
			if (1 > $this->db->get_where('kejuaraan', ['id_kejuaraan' => $id_kejuaraan, 'active' => 1])->num_rows()) {
				$this->session->set_flashdata('danger', 'Silakan pilih Kejuaraan dalam daftar!');
				redirect('register');
			}
			$session['panitia'] = true;
		} elseif ($role == 5) {
			$session['peserta'] = true;
		} else {
			$this->session->set_flashdata('danger', 'Silakan pilih Role dalam daftar!');
			redirect('register');
		}
		if (empty($nama_user)) {
			$this->session->set_flashdata('danger', 'Nama tidak boleh kosong!');
			redirect('register');
		}
		if (empty($username)) {
			$this->session->set_flashdata('danger', 'Username tidak boleh kosong!');
			redirect('register');
		}
		if (empty($password)) {
			$this->session->set_flashdata('danger', 'Kata Sandi tidak boleh kosong!');
			redirect('register');
		}
		if ($this->db->get_where('user', ['username' => $username])->num_rows() > 0) {
			$this->session->set_flashdata('danger', 'Username telah terdaftar!');
			redirect('register');
		}
		if ($role == 3) {
			$this->db->insert('user', ['id_kejuaraan' => $id_kejuaraan, 'nama_user' => $nama_user, 'username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT), 'role' => 3]);
			$this->session->set_flashdata('success', 'Pendaftaran berhasil, silakan tunggu sampai pendaftaran Anda diterima!');
			redirect('register');
		} else {
			$this->db->insert('user', ['nama_user' => $nama_user, 'username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT), 'role' => 5]);
			$session += [
				'login' => true,
				'id_user' => $this->db->insert_id(),
				'admin' => false
			];
			$this->session->set_userdata($session);
			redirect();
		}
	}
}
