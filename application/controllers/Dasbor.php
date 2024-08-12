<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dasbor extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		global $header;
		$header['login'] = $this->session->userdata('login');

		if (!$header['login']) {
			redirect('login');
		}

		$header['admin'] = $this->session->userdata('admin');
		$header['bendahara'] = $this->session->userdata('bendahara');
		$header['panitia'] = $this->session->userdata('panitia');

		if ($header['panitia']) {
			$sudah = $this->UserModel->get_user_session()['approve'];
		}
		$header['panitia_belum'] = ($header['panitia'] and null == $sudah) ? true : false;
		$header['panitia_sudah'] = ($header['panitia'] and 1 == $sudah) ? true : false;

		$header['juri'] = $this->session->userdata('juri');
		$header['peserta'] = $this->session->userdata('peserta');

		if ($header['peserta']) {
			redirect();
		}

		$header['saya'] = $this->UserModel->get_user_session();
	}

	public function index()
	{
		global $header;
		$header['judul'] = 'Dashboard';
		$this->load->view('dasbor/include/header', $header);
		$this->load->view('dasbor/index');
		$this->load->view('dasbor/include/footer');
	}

	public function data_admin()
	{
		global $header;
		if (!$header['admin']) {
			redirect('dasbor');
		}
		$header['judul'] = 'Data Admin';
		$body['admin'] = $this->UserModel->get_admin_active();
		$this->load->view('dasbor/include/header', $header);
		$this->load->view('dasbor/data/admin', $body);
		$this->load->view('dasbor/include/footer');
	}

	public function tambah_admin()
	{
		global $header;
		if (!$header['admin']) {
			redirect('dasbor');
		}
		$nama_user = $this->input->post('nama_user');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if (empty($nama_user)) {
			$this->session->set_flashdata('danger', 'Nama tidak boleh kosong!');
			redirect('dasbor/data_admin');
		}
		if (empty($username)) {
			$this->session->set_flashdata('danger', 'Username tidak boleh kosong!');
			redirect('dasbor/data_admin');
		}
		if (empty($password)) {
			$this->session->set_flashdata('danger', 'Kata Sandi tidak boleh kosong!');
			redirect('dasbor/data_admin');
		}
		$this->db->insert('user', ['nama_user' => $nama_user, 'username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT), 'role' => 1]);
		$this->session->set_flashdata('success', 'Data Berhasil Ditambahkan!');
		redirect('dasbor/data_admin');
	}

	public function edit_admin($id_user = null)
	{
		global $header;
		if (!$header['admin']) {
			redirect('dasbor');
		}
		if (null == $id_user) {
			$this->session->set_flashdata('danger', 'Silakan pilih Admin!');
			redirect('dasbor/data_admin');
		}
		if (1 > $this->UserModel->get_admin_id_active_count($id_user)) {
			$this->session->set_flashdata('danger', 'Data tidak ada!');
			redirect('dasbor/data_admin');
		}
		$nama_user = $this->input->post('nama_user');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if (empty($nama_user)) {
			$this->session->set_flashdata('danger', 'Nama tidak boleh kosong!');
			redirect('dasbor/data_admin');
		}
		if (empty($username)) {
			$this->session->set_flashdata('danger', 'Username tidak boleh kosong!');
			redirect('dasbor/data_admin');
		}
		if (empty($password)) {
			$this->db->update('user', ['nama_user' => $nama_user, 'username' => $username], ['id_user' => $id_user]);
		} else {
			$this->db->update('user', ['nama_user' => $nama_user, 'username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT)], ['id_user' => $id_user]);
		}
		$this->session->set_flashdata('success', 'Data Berhasil Diperbarui!');
		redirect('dasbor/data_admin');
	}

	public function hapus_admin($id_user = null)
	{
		global $header;
		if (!$header['admin']) {
			redirect('dasbor');
		}
		if (null == $id_user) {
			$this->session->set_flashdata('danger', 'Silakan pilih Admin!');
			redirect('dasbor/data_admin');
		}
		if (1 > $this->UserModel->get_admin_id_active_count($id_user)) {
			$this->session->set_flashdata('danger', 'Data tidak ada!');
			redirect('dasbor/data_admin');
		}
		$this->db->update('user', ['active' => 0], ['id_user' => $id_user]);
		if ($id_user == $this->session->userdata('id_user')) {
			redirect('logout');
		}
		$this->session->set_flashdata('success', 'Data Berhasil Dihapus!');
		redirect('dasbor/data_admin');
	}

	public function data_bendahara()
	{
		global $header;
		if (!$header['admin']) {
			redirect('dasbor');
		}
		$header['judul'] = 'Data Bendahara';
		$body['bendahara'] = $this->UserModel->get_bendahara_active();
		$this->load->view('dasbor/include/header', $header);
		$this->load->view('dasbor/data/bendahara', $body);
		$this->load->view('dasbor/include/footer');
	}

	public function tambah_bendahara()
	{
		global $header;
		if (!$header['admin']) {
			redirect('dasbor');
		}
		$nama_user = $this->input->post('nama_user');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if (empty($nama_user)) {
			$this->session->set_flashdata('danger', 'Nama tidak boleh kosong!');
			redirect('dasbor/data_bendahara');
		}
		if (empty($username)) {
			$this->session->set_flashdata('danger', 'Username tidak boleh kosong!');
			redirect('dasbor/data_bendahara');
		}
		if (empty($password)) {
			$this->session->set_flashdata('danger', 'Kata Sandi tidak boleh kosong!');
			redirect('dasbor/data_bendahara');
		}
		$this->db->insert('user', ['nama_user' => $nama_user, 'username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT), 'role' => 2]);
		$this->session->set_flashdata('success', 'Data Berhasil Ditambahkan!');
		redirect('dasbor/data_bendahara');
	}

	public function edit_bendahara($id_user = null)
	{
		global $header;
		if (!$header['admin']) {
			redirect('dasbor');
		}
		if (null == $id_user) {
			$this->session->set_flashdata('danger', 'Silakan pilih Bendahara!');
			redirect('dasbor/data_bendahara');
		}
		if (1 > $this->UserModel->get_bendahara_id_active_count($id_user)) {
			$this->session->set_flashdata('danger', 'Data tidak ada!');
			redirect('dasbor/data_bendahara');
		}
		$nama_user = $this->input->post('nama_user');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if (empty($nama_user)) {
			$this->session->set_flashdata('danger', 'Nama tidak boleh kosong!');
			redirect('dasbor/data_bendahara');
		}
		if (empty($username)) {
			$this->session->set_flashdata('danger', 'Username tidak boleh kosong!');
			redirect('dasbor/data_bendahara');
		}
		if (empty($password)) {
			$this->db->update('user', ['nama_user' => $nama_user, 'username' => $username], ['id_user' => $id_user]);
		} else {
			$this->db->update('user', ['nama_user' => $nama_user, 'username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT)], ['id_user' => $id_user]);
		}
		$this->session->set_flashdata('success', 'Data Berhasil Diperbarui!');
		redirect('dasbor/data_bendahara');
	}

	public function hapus_bendahara($id_user = null)
	{
		global $header;
		if (!$header['admin']) {
			redirect('dasbor');
		}
		if (null == $id_user) {
			$this->session->set_flashdata('danger', 'Silakan pilih Bendahara!');
			redirect('dasbor/data_bendahara');
		}
		if (1 > $this->UserModel->get_bendahara_id_active_count($id_user)) {
			$this->session->set_flashdata('danger', 'Data tidak ada!');
			redirect('dasbor/data_bendahara');
		}
		$this->db->update('user', ['active' => 0], ['id_user' => $id_user]);
		if ($id_user == $this->session->userdata('id_user')) {
			redirect('logout');
		}
		$this->session->set_flashdata('success', 'Data Berhasil Dihapus!');
		redirect('dasbor/data_bendahara');
	}

	public function data_panitia()
	{
		global $header;
		if (!$header['admin']) {
			redirect('dasbor');
		}
		$header['judul'] = 'Data Panitia';
		$body['panitia'] = $this->UserModel->get_panitia_active();
		$body['kejuaraan'] = $this->DataModel->get_kejuaraan_active();
		$this->load->view('dasbor/include/header', $header);
		$this->load->view('dasbor/data/panitia', $body);
		$this->load->view('dasbor/include/footer');
	}

	public function tambah_panitia()
	{
		global $header;
		if (!$header['admin']) {
			redirect('dasbor');
		}
		$id_kejuaraan = $this->input->post('id_kejuaraan');
		$nama_user = $this->input->post('nama_user');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if (empty($id_kejuaraan)) {
			$this->session->set_flashdata('danger', 'Silakan pilih Kejuaraan!');
			redirect('dasbor/data_panitia');
		}
		if (empty($nama_user)) {
			$this->session->set_flashdata('danger', 'Nama tidak boleh kosong!');
			redirect('dasbor/data_panitia');
		}
		if (empty($username)) {
			$this->session->set_flashdata('danger', 'Username tidak boleh kosong!');
			redirect('dasbor/data_panitia');
		}
		if (empty($password)) {
			$this->session->set_flashdata('danger', 'Kata Sandi tidak boleh kosong!');
			redirect('dasbor/data_panitia');
		}
		$this->db->insert('user', ['id_kejuaraan' => $id_kejuaraan, 'nama_user' => $nama_user, 'username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT), 'role' => 3]);
		$this->session->set_flashdata('success', 'Data Berhasil Ditambahkan!');
		redirect('dasbor/data_panitia');
	}

	public function edit_panitia($id_user = null)
	{
		global $header;
		if (!$header['admin']) {
			redirect('dasbor');
		}
		if (null == $id_user) {
			$this->session->set_flashdata('danger', 'Silakan pilih Panitia!');
			redirect('dasbor/data_panitia');
		}
		if (1 > $this->UserModel->get_panitia_id_active_count($id_user)) {
			$this->session->set_flashdata('danger', 'Data tidak ada!');
			redirect('dasbor/data_panitia');
		}
		$id_kejuaraan = $this->input->post('id_kejuaraan');
		$nama_user = $this->input->post('nama_user');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if (empty($id_kejuaraan)) {
			$this->session->set_flashdata('danger', 'Silakan pilih Kejuaraan!');
			redirect('dasbor/data_panitia');
		}
		if (empty($nama_user)) {
			$this->session->set_flashdata('danger', 'Nama tidak boleh kosong!');
			redirect('dasbor/data_panitia');
		}
		if (empty($username)) {
			$this->session->set_flashdata('danger', 'Username tidak boleh kosong!');
			redirect('dasbor/data_panitia');
		}
		if (empty($password)) {
			$this->db->update('user', ['id_kejuaraan' => $id_kejuaraan, 'nama_user' => $nama_user, 'username' => $username], ['id_user' => $id_user]);
		} else {
			$this->db->update('user', ['id_kejuaraan' => $id_kejuaraan, 'nama_user' => $nama_user, 'username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT)], ['id_user' => $id_user]);
		}
		$this->session->set_flashdata('success', 'Data Berhasil Diperbarui!');
		redirect('dasbor/data_panitia');
	}

	public function hapus_panitia($id_user = null)
	{
		global $header;
		if (!$header['admin']) {
			redirect('dasbor');
		}
		if (null == $id_user) {
			$this->session->set_flashdata('danger', 'Silakan pilih Panitia!');
			redirect('dasbor/data_panitia');
		}
		if (1 > $this->UserModel->get_panitia_id_active_count($id_user)) {
			$this->session->set_flashdata('danger', 'Data tidak ada!');
			redirect('dasbor/data_panitia');
		}
		$this->db->update('user', ['active' => 0], ['id_user' => $id_user]);
		if ($id_user == $this->session->userdata('id_user')) {
			redirect('logout');
		}
		$this->session->set_flashdata('success', 'Data Berhasil Dihapus!');
		redirect('dasbor/data_panitia');
	}

	public function data_juri()
	{
		global $header;
		if (!$header['admin']) {
			redirect('dasbor');
		}
		$header['judul'] = 'Data Juri';
		$body['juri'] = $this->UserModel->get_juri_active();
		$this->load->view('dasbor/include/header', $header);
		$this->load->view('dasbor/data/juri', $body);
		$this->load->view('dasbor/include/footer');
	}

	public function tambah_juri()
	{
		global $header;
		if (!$header['admin']) {
			redirect('dasbor');
		}
		$nama_user = $this->input->post('nama_user');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if (empty($nama_user)) {
			$this->session->set_flashdata('danger', 'Nama tidak boleh kosong!');
			redirect('dasbor/data_juri');
		}
		if (empty($username)) {
			$this->session->set_flashdata('danger', 'Username tidak boleh kosong!');
			redirect('dasbor/data_juri');
		}
		if (empty($password)) {
			$this->session->set_flashdata('danger', 'Kata Sandi tidak boleh kosong!');
			redirect('dasbor/data_juri');
		}
		$this->db->insert('user', ['nama_user' => $nama_user, 'username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT), 'role' => 4]);
		$this->session->set_flashdata('success', 'Data Berhasil Ditambahkan!');
		redirect('dasbor/data_juri');
	}

	public function edit_juri($id_user = null)
	{
		global $header;
		if (!$header['admin']) {
			redirect('dasbor');
		}
		if (null == $id_user) {
			$this->session->set_flashdata('danger', 'Silakan pilih Juri!');
			redirect('dasbor/data_juri');
		}
		if (1 > $this->UserModel->get_juri_id_active_count($id_user)) {
			$this->session->set_flashdata('danger', 'Data tidak ada!');
			redirect('dasbor/data_juri');
		}
		$nama_user = $this->input->post('nama_user');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if (empty($nama_user)) {
			$this->session->set_flashdata('danger', 'Nama tidak boleh kosong!');
			redirect('dasbor/data_juri');
		}
		if (empty($username)) {
			$this->session->set_flashdata('danger', 'Username tidak boleh kosong!');
			redirect('dasbor/data_juri');
		}
		if (empty($password)) {
			$this->db->update('user', ['nama_user' => $nama_user, 'username' => $username], ['id_user' => $id_user]);
		} else {
			$this->db->update('user', ['nama_user' => $nama_user, 'username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT)], ['id_user' => $id_user]);
		}
		$this->session->set_flashdata('success', 'Data Berhasil Diperbarui!');
		redirect('dasbor/data_juri');
	}

	public function hapus_juri($id_user = null)
	{
		global $header;
		if (!$header['admin']) {
			redirect('dasbor');
		}
		if (null == $id_user) {
			$this->session->set_flashdata('danger', 'Silakan pilih Juri!');
			redirect('dasbor/data_juri');
		}
		if (1 > $this->UserModel->get_juri_id_active_count($id_user)) {
			$this->session->set_flashdata('danger', 'Data tidak ada!');
			redirect('dasbor/data_juri');
		}
		$this->db->update('user', ['active' => 0], ['id_user' => $id_user]);
		if ($id_user == $this->session->userdata('id_user')) {
			redirect('logout');
		}
		$this->session->set_flashdata('success', 'Data Berhasil Dihapus!');
		redirect('dasbor/data_juri');
	}

	public function data_peserta()
	{
		global $header;
		if (!$header['admin']) {
			redirect('dasbor');
		}
		$header['judul'] = 'Data Peserta';
		$body['peserta'] = $this->UserModel->get_peserta_active();
		$this->load->view('dasbor/include/header', $header);
		$this->load->view('dasbor/data/peserta', $body);
		$this->load->view('dasbor/include/footer');
	}

	public function tambah_peserta()
	{
		global $header;
		if (!$header['admin']) {
			redirect('dasbor');
		}
		$nama_user = $this->input->post('nama_user');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if (empty($nama_user)) {
			$this->session->set_flashdata('danger', 'Nama tidak boleh kosong!');
			redirect('dasbor/data_peserta');
		}
		if (empty($username)) {
			$this->session->set_flashdata('danger', 'Username tidak boleh kosong!');
			redirect('dasbor/data_peserta');
		}
		if (empty($password)) {
			$this->session->set_flashdata('danger', 'Kata Sandi tidak boleh kosong!');
			redirect('dasbor/data_peserta');
		}
		$this->db->insert('user', ['nama_user' => $nama_user, 'username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT)]);
		$this->session->set_flashdata('success', 'Data Berhasil Ditambahkan!');
		redirect('dasbor/data_peserta');
	}

	public function edit_peserta($id_user = null)
	{
		global $header;
		if (!$header['admin']) {
			redirect('dasbor');
		}
		if (null == $id_user) {
			$this->session->set_flashdata('danger', 'Silakan pilih Peserta!');
			redirect('dasbor/data_peserta');
		}
		if (1 > $this->UserModel->get_peserta_id_active_count($id_user)) {
			$this->session->set_flashdata('danger', 'Data tidak ada!');
			redirect('dasbor/data_peserta');
		}
		$nama_user = $this->input->post('nama_user');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if (empty($nama_user)) {
			$this->session->set_flashdata('danger', 'Nama tidak boleh kosong!');
			redirect('dasbor/data_peserta');
		}
		if (empty($username)) {
			$this->session->set_flashdata('danger', 'Username tidak boleh kosong!');
			redirect('dasbor/data_peserta');
		}
		if (empty($password)) {
			$this->db->update('user', ['nama_user' => $nama_user, 'username' => $username], ['id_user' => $id_user]);
		} else {
			$this->db->update('user', ['nama_user' => $nama_user, 'username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT)], ['id_user' => $id_user]);
		}
		$this->session->set_flashdata('success', 'Data Berhasil Diperbarui!');
		redirect('dasbor/data_peserta');
	}

	public function hapus_peserta($id_user = null)
	{
		global $header;
		if (!$header['admin']) {
			redirect('dasbor');
		}
		if (null == $id_user) {
			$this->session->set_flashdata('danger', 'Silakan pilih Peserta!');
			redirect('dasbor/data_peserta');
		}
		if (1 > $this->UserModel->get_peserta_id_active_count($id_user)) {
			$this->session->set_flashdata('danger', 'Data tidak ada!');
			redirect('dasbor/data_peserta');
		}
		$this->db->update('user', ['active' => 0], ['id_user' => $id_user]);
		$this->session->set_flashdata('success', 'Data Berhasil Dihapus!');
		redirect('dasbor/data_peserta');
	}

	public function data_kejuaraan()
	{
		global $header;
		if (!$header['admin'] and !$header['panitia']) {
			redirect('dasbor');
		}
		$header['judul'] = 'Data Kejuaraan';
		$body['kejuaraan'] = $this->DataModel->get_kejuaraan_active();
		$this->load->view('dasbor/include/header', $header);
		$this->load->view('dasbor/data/kejuaraan', $body);
		$this->load->view('dasbor/include/footer');
	}

	public function tambah_kejuaraan()
	{
		global $header;
		if (!$header['admin']) {
			redirect('dasbor');
		}
		$nama_kejuaraan = $this->input->post('nama_kejuaraan');
		$warna = $this->input->post('warna');
		$waktu_awal = strtotime($this->input->post('waktu_awal'));
		$waktu_akhir = strtotime($this->input->post('waktu_akhir'));
		if (empty($nama_kejuaraan)) {
			$this->session->set_flashdata('danger', 'Nama Kejuaraan tidak boleh kosong!');
			redirect('dasbor/data_kejuaraan');
		}
		if (empty($warna)) {
			$this->session->set_flashdata('danger', 'Warna tidak boleh kosong!');
			redirect('dasbor/data_kejuaraan');
		}
		if (empty($waktu_awal)) {
			$this->session->set_flashdata('danger', 'Waktu Awal tidak boleh kosong!');
			redirect('dasbor/data_kejuaraan');
		}
		if (empty($waktu_akhir)) {
			$this->session->set_flashdata('danger', 'Waktu Akhir tidak boleh kosong!');
			redirect('dasbor/data_kejuaraan');
		}
		$this->db->insert('kejuaraan', ['nama_kejuaraan' => $nama_kejuaraan, 'warna' => $warna, 'waktu_awal' => $waktu_awal, 'waktu_akhir' => $waktu_akhir]);
		$config['upload_path'] = 'assets/uploads/images/kejuaraan/';
		$config['allowed_types'] = '*';
		$config['file_name'] = $this->db->insert_id() . '.png';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('gambar');
		$this->session->set_flashdata('success', 'Data Berhasil Ditambahkan!');
		redirect('dasbor/data_kejuaraan');
	}

	public function juara_kejuaraan($id_kejuaraan = null)
	{
		global $header;
		if (!$header['panitia']) {
			redirect('dasbor');
		}
		if (null == $id_kejuaraan) {
			$this->session->set_flashdata('danger', 'Silakan pilih Kejuaraan!');
			redirect('dasbor/data_kejuaraan');
		}
		if (1 > $this->DataModel->get_kejuaraan_id_active_count($id_kejuaraan)) {
			$this->session->set_flashdata('danger', 'Data tidak ada!');
			redirect('dasbor/data_kejuaraan');
		}
		$this->db->update('kejuaraan', ['seni1_putra1' => $this->input->post('seni1_putra1'), 'seni1_putra2' => $this->input->post('seni1_putra2'), 'seni1_putra3' => $this->input->post('seni1_putra3'), 'seni1_putri1' => $this->input->post('seni1_putri1'), 'seni1_putri2' => $this->input->post('seni1_putri2'), 'seni1_putri3' => $this->input->post('seni1_putri3'), 'seni2_putra1' => $this->input->post('seni2_putra1'), 'seni2_putra2' => $this->input->post('seni2_putra2'), 'seni2_putra3' => $this->input->post('seni2_putra3'), 'seni2_putri1' => $this->input->post('seni2_putri1'), 'seni2_putri2' => $this->input->post('seni2_putri2'), 'seni2_putri3' => $this->input->post('seni2_putri3'), 'seni3_putra1' => $this->input->post('seni3_putra1'), 'seni3_putra2' => $this->input->post('seni3_putra2'), 'seni3_putra3' => $this->input->post('seni3_putra3'), 'seni3_putri1' => $this->input->post('seni3_putri1'), 'seni3_putri2' => $this->input->post('seni3_putri2'), 'seni3_putri3' => $this->input->post('seni3_putri3'), 'tanding_putra1' => $this->input->post('tanding_putra1'), 'tanding_putra2' => $this->input->post('tanding_putra2'), 'tanding_putra3' => $this->input->post('tanding_putra3'), 'tanding_putri1' => $this->input->post('tanding_putri1'), 'tanding_putri2' => $this->input->post('tanding_putri2'), 'tanding_putri3' => $this->input->post('tanding_putri3')], ['id_kejuaraan' => $id_kejuaraan]);
		$this->session->set_flashdata('success', 'Data Berhasil Diperbarui!');
		redirect('dasbor/data_kejuaraan');
	}

	public function edit_kejuaraan($id_kejuaraan = null)
	{
		global $header;
		if (!$header['admin']) {
			redirect('dasbor');
		}
		if (null == $id_kejuaraan) {
			$this->session->set_flashdata('danger', 'Silakan pilih Kejuaraan!');
			redirect('dasbor/data_kejuaraan');
		}
		if (1 > $this->DataModel->get_kejuaraan_id_active_count($id_kejuaraan)) {
			$this->session->set_flashdata('danger', 'Data tidak ada!');
			redirect('dasbor/data_kejuaraan');
		}
		$nama_kejuaraan = $this->input->post('nama_kejuaraan');
		$warna = $this->input->post('warna');
		$waktu_awal = strtotime($this->input->post('waktu_awal'));
		$waktu_akhir = strtotime($this->input->post('waktu_akhir'));
		if (empty($nama_kejuaraan)) {
			$this->session->set_flashdata('danger', 'Nama tidak boleh kosong!');
			redirect('dasbor/data_kejuaraan');
		}
		if (empty($warna)) {
			$this->session->set_flashdata('danger', 'Warna tidak boleh kosong!');
			redirect('dasbor/data_kejuaraan');
		}
		if (empty($waktu_awal)) {
			$this->session->set_flashdata('danger', 'Waktu Awal tidak boleh kosong!');
			redirect('dasbor/data_kejuaraan');
		}
		if (empty($waktu_akhir)) {
			$this->session->set_flashdata('danger', 'Waktu Akhir tidak boleh kosong!');
			redirect('dasbor/data_kejuaraan');
		}
		$this->db->update('kejuaraan', ['nama_kejuaraan' => $nama_kejuaraan, 'warna' => $warna, 'waktu_awal' => $waktu_awal, 'waktu_akhir' => $waktu_akhir], ['id_kejuaraan' => $id_kejuaraan]);
		$config['upload_path'] = 'assets/uploads/images/kejuaraan/';
		$config['allowed_types'] = '*';
		$config['file_name'] = $id_kejuaraan . '.png';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('gambar');
		$this->session->set_flashdata('success', 'Data Berhasil Diperbarui!');
		redirect('dasbor/data_kejuaraan');
	}

	public function upload_proposal($id_kejuaraan = null)
	{
		global $header;
		if (!$header['panitia']) {
			redirect('dasbor');
		}
		if (null == $id_kejuaraan) {
			$this->session->set_flashdata('danger', 'Silakan pilih Kejuaraan!');
			redirect('dasbor/data_kejuaraan');
		}
		if (1 > $this->DataModel->get_kejuaraan_id_active_count($id_kejuaraan)) {
			$this->session->set_flashdata('danger', 'Data tidak ada!');
			redirect('dasbor/data_kejuaraan');
		}
		$config['upload_path'] = 'assets/uploads/documents/proposal/';
		$config['allowed_types'] = '*';
		$config['file_name'] = $id_kejuaraan . '.pdf';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('proposal');
		$this->session->set_flashdata('success', 'Data Berhasil Diperbarui!');
		redirect('dasbor/data_kejuaraan');
	}

	public function hapus_kejuaraan($id_kejuaraan = null)
	{
		global $header;
		if (!$header['admin']) {
			redirect('dasbor');
		}
		if (null == $id_kejuaraan) {
			$this->session->set_flashdata('danger', 'Silakan pilih Kejuaraan!');
			redirect('dasbor/data_kejuaraan');
		}
		if (1 > $this->DataModel->get_kejuaraan_id_active_count($id_kejuaraan)) {
			$this->session->set_flashdata('danger', 'Data tidak ada!');
			redirect('dasbor/data_kejuaraan');
		}
		$this->db->update('kejuaraan', ['active' => 0], ['id_kejuaraan' => $id_kejuaraan]);
		$this->session->set_flashdata('success', 'Data Berhasil Dihapus!');
		redirect('dasbor/data_kejuaraan');
	}

	public function approve_panitia()
	{
		global $header;
		if (!$header['bendahara']) {
			redirect('dasbor');
		}

		$header['judul'] = 'Approve Panitia';
		$header['user'] = $this->UserModel->get_panitia_belum_active();

		$this->load->view('dasbor/include/header', $header);
		$this->load->view('dasbor/approve_panitia');
		$this->load->view('dasbor/include/footer');
	}

	public function terima_panitia($id_user = null)
	{
		global $header;
		if (!$header['bendahara']) {
			redirect('dasbor');
		}
		if (null == $id_user) {
			$this->session->set_flashdata('danger', 'Silakan pilih Panitia!');
			redirect('dasbor/approve_panitia');
		}
		if (1 > $this->UserModel->get_panitia_belum_id_active_count($id_user)) {
			$this->session->set_flashdata('danger', 'Data tidak ada!');
			redirect('dasbor/approve_panitia');
		}
		$this->db->update('user', ['approve' => 1], ['id_user' => $id_user]);
		$this->session->set_flashdata('success', 'Panitia Berhasil Diterima!');
		redirect('dasbor/approve_panitia');
	}

	public function hapus_bukti($id_user = null)
	{
		global $header;
		if (!$header['bendahara']) {
			redirect('dasbor');
		}
		if (null == $id_user) {
			$this->session->set_flashdata('danger', 'Silakan pilih Pendaftaran!');
			redirect('dasbor/approve_panitia');
		}
		if (1 > $this->UserModel->get_panitia_belum_id_active_count($id_user)) {
			$this->session->set_flashdata('danger', 'Data tidak ada!');
			redirect('dasbor/approve_panitia');
		}
		unlink('assets/uploads/images/bukti_panitia/' . $id_user . '.png');
		$this->session->set_flashdata('success', 'Bukti Berhasil Dihapus!');
		redirect('dasbor/approve_panitia');
	}

	public function upload_bukti()
	{
		global $header;
		if (!$header['panitia_belum']) {
			redirect('dasbor');
		}
		$header['judul'] = 'Upload Bukti Pembayaran';
		$this->load->view('dasbor/include/header', $header);
		$this->load->view('dasbor/upload_bukti');
		$this->load->view('dasbor/include/footer');
	}

	public function upload_bukti_aksi()
	{
		global $header;
		if (!$header['panitia_belum']) {
			redirect('dasbor');
		}
		$config['upload_path'] = 'assets/uploads/images/bukti_panitia/';
		$config['allowed_types'] = '*';
		$config['file_name'] = $this->session->userdata('id_user') . '.png';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('bukti_panitia');
		$this->session->set_flashdata('success', 'Bukti Berhasil Diupload!');
		redirect('dasbor/upload_bukti');
	}

	public function pendaftaran()
	{
		global $header;
		if (!$header['panitia_sudah']) {
			redirect('dasbor');
		}

		$id_kejuaraan = $this->UserModel->get_user_session()['id_kejuaraan'];
		$jenis_kelamin = $this->input->get('jenis_kelamin') ?? 'Laki-laki';
		$kelas = $this->input->get('kelas') ?? 'Tunggal';
		$kategori = $this->input->get('kategori') ?? 'Seni';

		$row = $this->DataModel->get_kejuaraan_id_active($id_kejuaraan);

		$header['judul'] = 'Pendaftaran Peserta';

		$body['tampil'] = (empty($jenis_kelamin) or empty($kategori) or empty($kelas)) ? false : true;

		$body['kejuaraan'] = $row['nama_kejuaraan'];
		if ($body['tampil']) {
			$body['jenis_kelamin'] = $jenis_kelamin;
			$body['kategori'] = $kategori;
			$body['kelas'] = $kelas;
			$body['pendaftaran'] = $this->DataModel->get_pendaftaran($id_kejuaraan, $jenis_kelamin, $kategori, $kelas);
		}

		$this->load->view('dasbor/include/header', $header);
		$this->load->view('dasbor/pendaftaran', $body);
		$this->load->view('dasbor/include/footer');
	}

	public function terima_pendaftaran($id_pendaftaran = null)
	{
		global $header;
		if (!$header['panitia_sudah']) {
			redirect('dasbor');
		}
		if (null == $id_pendaftaran) {
			$this->session->set_flashdata('danger', 'Silakan pilih Pendaftaran!');
			redirect('dasbor/pendaftaran');
		}
		if (1 > $this->DataModel->get_pendaftaran_id_active_count($id_pendaftaran)) {
			$this->session->set_flashdata('danger', 'Data tidak ada!');
			redirect('dasbor/pendaftaran');
		}
		$this->db->update('pendaftaran', ['approve' => 1], ['id_pendaftaran' => $id_pendaftaran]);
		$this->session->set_flashdata('success', 'Data Berhasil Diterima!');
		redirect('dasbor/pendaftaran/' . $id_pendaftaran . '?jenis_kelamin=' . $this->input->get('jenis_kelamin') . '&kategori=' . $this->input->get('kategori') . '&kelas=' . $this->input->get('kelas'));
	}

	public function hapus_pendaftaran($id_pendaftaran = null)
	{
		global $header;
		if (!$header['panitia_sudah']) {
			redirect('dasbor');
		}
		if (null == $id_pendaftaran) {
			$this->session->set_flashdata('danger', 'Silakan pilih Pendaftaran!');
			redirect('dasbor/pendaftaran');
		}
		if (1 > $this->DataModel->get_pendaftaran_id_active_count($id_pendaftaran)) {
			$this->session->set_flashdata('danger', 'Data tidak ada!');
			redirect('dasbor/pendaftaran');
		}
		$this->db->update('pendaftaran', ['active' => 0], ['id_pendaftaran' => $id_pendaftaran]);
		$this->session->set_flashdata('success', 'Data Berhasil Dihapus!');
		redirect('dasbor/pendaftaran/' . $id_pendaftaran . '?jenis_kelamin=' . $this->input->get('jenis_kelamin') . '&kategori=' . $this->input->get('kategori') . '&kelas=' . $this->input->get('kelas'));
	}

	public function input_skor()
	{
		global $header;
		if (!$header['juri']) {
			redirect('dasbor');
		}
		$header['judul'] = 'Input Skor';
		$body['kejuaraan'] = $this->DataModel->get_kejuaraan_active();
		$this->load->view('dasbor/include/header', $header);
		$this->load->view('dasbor/input_skor', $body);
		$this->load->view('dasbor/include/footer');
	}

	public function input_skor_detail($id_kejuaraan = null)
	{
		global $header;
		if (!$header['juri']) {
			redirect('dasbor');
		}
		if (null == $id_kejuaraan) {
			$this->session->set_flashdata('danger', 'Silakan pilih Kejuaraan!');
			redirect('dasbor/input_skor');
		}
		if (1 > $this->DataModel->get_kejuaraan_id_active_count($id_kejuaraan)) {
			$this->session->set_flashdata('danger', 'Data tidak ada!');
			redirect('dasbor/input_skor');
		}
		$jenis_kelamin = $this->input->get('jenis_kelamin');
		$kelas = $this->input->get('kelas');
		$kategori = $this->input->get('kategori');
		if (empty($jenis_kelamin)) {
			$this->session->set_flashdata('danger', 'Silakan pilih Jenis Kelamin!');
			redirect('dasbor/input_skor');
		}
		if (empty($kategori)) {
			$this->session->set_flashdata('danger', 'Silakan pilih Kategori!');
			redirect('dasbor/input_skor');
		}
		if (empty($kelas)) {
			$this->session->set_flashdata('danger', 'Silakan pilih Kelas!');
			redirect('dasbor/input_skor');
		}
		$row = $this->DataModel->get_kejuaraan_id_active($id_kejuaraan);
		$header['judul'] = 'Input Skor Peserta';
		$body['kejuaraan'] = $row['nama_kejuaraan'];
		$body['jenis_kelamin'] = $jenis_kelamin;
		$body['kategori'] = $kategori;
		$body['kelas'] = $kelas;
		$body['bagan'] = ('Tanding' == $kategori) ? $this->DataModel->get_bagan($id_kejuaraan, $jenis_kelamin, $kelas) : null;
		$body['seni'] = ('Seni' == $kategori) ? $this->DataModel->get_pendaftaran($id_kejuaraan, $jenis_kelamin, $kategori, $kelas) : null;
		$this->load->view('dasbor/include/header', $header);
		$this->load->view('dasbor/input_skor_detail', $body);
		$this->load->view('dasbor/include/footer');
	}

	public function input_skor_aksi($id_bagan = null)
	{
		global $header;

		if (!$header['juri']) {
			redirect('dasbor');
		}

		if (null == $id_bagan) {
			$this->session->set_flashdata('danger', 'Silakan pilih Bagan!');
			redirect('dasbor/input_skor');
		}

		if (1 > $this->DataModel->get_bagan_id_count($id_bagan)) {
			$this->session->set_flashdata('danger', 'Data tidak ada!');
			redirect('dasbor/input_skor');
		} else {
			$row = $this->DataModel->get_bagan_id($id_bagan);
		}

		$skor = $this->input->post('skor');
		$id_kejuaraan = $this->input->post('id_kejuaraan');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$kategori = $this->input->post('kategori');
		$kelas = $this->input->post('kelas');
		$babak = $row['babak'];

		if (0 > $skor) {
			$this->session->set_flashdata('danger', 'Skor tidak boleh kosong!');
			redirect('dasbor/input_skor_detail/' . $id_bagan);
		}

		if ('Tanding' == $kategori) {

			$this->db->update('bagan', ['skor' => $skor], ['id_bagan' => $id_bagan]);

			$query = $this->db
				->select('bagan.*, user.nama_user')
				->from('bagan')
				->join('user', 'bagan.id_user = user.id_user')
				->where(['bagan.id_kejuaraan' => $id_kejuaraan, 'bagan.jenis_kelamin' => $jenis_kelamin, 'kelas' => $kelas, 'babak' => $babak])
				->get()
				->result_array();

			foreach ($query as $index => $bagan) {
				$index_next = $index + 1;
				$index_prev = $index - 1;
				$id_sekarang = $bagan['id_bagan'];
				$id_selanjutnya = isset($query[$index_next]) ? $query[$index_next]['id_bagan'] : null;
				$id_sebelumnya = isset($query[$index_prev]) ? $query[$index_prev]['id_bagan'] : null;
				if ($id_bagan == $bagan['id_bagan']) {
					$skor_index_sekarang = $bagan['skor'];
					if ($index_next % 2 == 1) {
						if (isset($query[$index_next])) {
							$skor_index_selanjutnya = $query[$index_next]['skor'];
							if ($skor_index_sekarang > $skor_index_selanjutnya) {
								$id_pemenang = $id_sekarang;
								$id_pasangan = $id_selanjutnya;
							} else {
								$id_pemenang = $id_selanjutnya;
								$id_pasangan = $id_sekarang;
							}
						} else {
							$id_pemenang = $id_sekarang;
							$id_pasangan = $id_selanjutnya;
						}
					} else {
						$skor_index_sebelumnya = $query[$index_prev]['skor'];
						if ($skor_index_sekarang > $skor_index_sebelumnya) {
							$id_pemenang = $id_sekarang;
							$id_pasangan = $id_sebelumnya;
						} else {
							$id_pemenang = $id_sebelumnya;
							$id_pasangan = $id_sekarang;
						}
					}
				}
			}

			if (count($query) > 2) {

				if (null != $id_pasangan) {
					$bagan_pasangan = $this->DataModel->get_bagan_id($id_pasangan);

					$this->db->delete('bagan', ['id_pendaftaran' => $bagan_pasangan['id_pendaftaran'], 'id_user' => $bagan_pasangan['id_user'], 'id_kejuaraan' => $id_kejuaraan, 'nama' => $bagan_pasangan['nama'], 'jenis_kelamin' => $jenis_kelamin, 'kelas' => $kelas, 'babak' => $babak + 1]);
				}

				$bagan_pemenang = $this->DataModel->get_bagan_id($id_pemenang);

				$this->db->delete('bagan', ['id_pendaftaran' => $bagan_pemenang['id_pendaftaran'], 'id_user' => $bagan_pemenang['id_user'], 'id_kejuaraan' => $id_kejuaraan, 'nama' => $bagan_pemenang['nama'], 'jenis_kelamin' => $jenis_kelamin, 'kelas' => $kelas, 'babak' => $babak + 1]);

				$this->db->insert('bagan', ['id_pendaftaran' => $bagan_pemenang['id_pendaftaran'], 'id_user' => $bagan_pemenang['id_user'], 'id_kejuaraan' => $id_kejuaraan, 'nama' => $bagan_pemenang['nama'], 'jenis_kelamin' => $jenis_kelamin, 'kelas' => $kelas, 'babak' => $babak + 1]);
			}

			$gender = 'putr' . (($jenis_kelamin == 'Laki-laki') ? 'a' : 'i');

			$juara_tanding = $this->db->get_where('bagan', [
				'id_kejuaraan' => $id_kejuaraan,
				'jenis_kelamin' => $jenis_kelamin,
				'kelas' => $kelas
			])->result_array();

			if (count($juara_tanding) > 0) {
				// Sort based on babak descending, then skor descending
				usort($juara_tanding, function ($a, $b) {
					if ($a['babak'] == $b['babak']) {
						return $b['skor'] - $a['skor'];
					}
					return $b['babak'] - $a['babak'];
				});

				// Determine the number of winners to set
				$num_winners = min(count($juara_tanding), 3);

				// Update the winners
				for ($i = 1; $i <= $num_winners; $i++) {
					$this->db->update('kejuaraan', ["tanding_{$gender}$i" => $juara_tanding[$i - 1]['id_pendaftaran']], ['id_kejuaraan' => $id_kejuaraan]);
				}
			}
		} else {
			$id_pendaftaran = $this->input->post('id_pendaftaran');
			$skor_seni = $this->input->post('skor_seni');

			$this->db->update('pendaftaran', ['skor_seni' => $skor_seni], ['id_pendaftaran' => $id_pendaftaran]);

			$class = ('Tunggal' == $kelas) ? 1 : (('Ganda' == $kelas) ? 2 : 3);
			$gender = 'putr' . (($jenis_kelamin == 'Laki-laki') ? 'a' : 'i');

			$juara_seni = $this->db->get_where('pendaftaran', [
				'id_kejuaraan' => $id_kejuaraan,
				'jenis_kelamin' => $jenis_kelamin,
				'kategori' => 'Seni',
				'kelas' => $kelas
			])->result_array();

			if (count($juara_seni) > 0) {
				// Sort based on skor_seni descending, then berat_badan descending
				usort($juara_seni, function ($a, $b) {
					if ($a['skor_seni'] == $b['skor_seni']) {
						return $b['berat_badan'] - $a['berat_badan'];
					}
					return $b['skor_seni'] - $a['skor_seni'];
				});

				// Determine the number of winners to set
				$num_winners = min(count($juara_seni), 3);

				// Update the winners
				for ($i = 1; $i <= $num_winners; $i++) {
					$this->db->update('kejuaraan', ["seni{$class}_$gender$i" => $juara_seni[$i - 1]['id_pendaftaran']], ['id_kejuaraan' => $id_kejuaraan]);
				}
			}
		}

		$this->session->set_flashdata('success', 'Skor Berhasil Diperbarui!');
		redirect('dasbor/input_skor_detail/' . $id_kejuaraan . '?jenis_kelamin=' . $jenis_kelamin . '&kategori=' . $this->input->post('kategori') . '&kelas=' . $kelas);
	}

	public function bagan_pertandingan()
	{
		global $header;
		if ($header['bendahara'] and $header['panitia_belum']) {
			redirect('dasbor');
		}
		$header['judul'] = 'Bagan Pertandingan';
		$user = $this->UserModel->get_user_session();
		$header['user'] = $user;
		$body['kejuaraan'] = $this->DataModel->get_kejuaraan_active();
		$this->load->view('dasbor/include/header', $header);
		$this->load->view('dasbor/bagan_pertandingan', $body);
		$this->load->view('dasbor/include/footer');
	}

	public function bagan_generate()
	{
		global $header;
		if (!$header['panitia_sudah']) {
			redirect('dasbor');
		}

		$id_kejuaraan = $header['saya']['id_kejuaraan'];
		$jenis_kelamin = $this->input->get('jenis_kelamin');
		$kelas = $this->input->get('kelas');

		$this->db->where(['id_kejuaraan' => $id_kejuaraan, 'jenis_kelamin' => $jenis_kelamin, 'kelas' => $kelas, 'babak' => 1]);
		$this->db->delete('bagan');

		$query = $this->db
			->select('pendaftaran.id_pendaftaran, pendaftaran.id_user, pendaftaran.id_kejuaraan, pendaftaran.nama, pendaftaran.jenis_kelamin, pendaftaran.kelas, 1 AS babak')
			->from('pendaftaran')
			->join('user', 'pendaftaran.id_user = user.id_user')
			->where(['pendaftaran.id_kejuaraan' => $id_kejuaraan, 'pendaftaran.jenis_kelamin' => $jenis_kelamin, 'kelas' => $kelas, 'pendaftaran.approve' => 1, 'pendaftaran.active' => 1])
			->get()
			->result_array();

		shuffle($query);

		$this->db->insert_batch('bagan', $query);
	}

	public function load_bagan()
	{
		global $header;
		if ($header['bendahara'] and $header['panitia_belum']) {
			redirect('dasbor');
		}

		$id_kejuaraan = ($header['admin'] or $header['juri']) ? $this->input->get('id_kejuaraan') : $header['saya']['id_kejuaraan'];
		// $id_kejuaraan = (empty($this->input->get('id_kejuaraan'))) ? $header['saya']['id_kejuaraan'] : $this->input->get('id_kejuaraan');
		$jenis_kelamin = $this->input->get('jenis_kelamin');
		$kelas = $this->input->get('kelas');

		$baganData = [
			'teams' => [],
			'results' => [],
		];

		for ($babak = 1;; $babak++) {
			$queryBabak = $this->db
				->select('bagan.*, user.nama_user')
				->from('bagan')
				->join('user', 'bagan.id_user = user.id_user')
				->where(['bagan.id_kejuaraan' => $id_kejuaraan, 'bagan.jenis_kelamin' => $jenis_kelamin, 'kelas' => $kelas, 'babak' => $babak])
				->get()
				->result_array();

			$jumlah_peserta = count($queryBabak);
			$jumlah_peserta_dibutuhkan = (1 == $jumlah_peserta) ? 2 : pow(2, ceil(log($jumlah_peserta, 2)));

			if (empty($queryBabak)) {
				break;
			}

			for ($i = $jumlah_peserta; $i < $jumlah_peserta_dibutuhkan; $i++) {
				// $queryBabak[] = ['nama_user' => null, 'id_user' => null, 'skor' => null];
				$queryBabak[] = ['nama' => null, 'id_user' => null, 'skor' => null];
			}

			$teamsBabak = array_chunk($queryBabak, 2);

			foreach ($teamsBabak as $team) {
				if (1 == $babak) {
					$baganData['teams'][] = [
						// $team[0]['nama_user'],
						// $team[1]['nama_user']
						$team[0]['nama'],
						$team[1]['nama']
					];
				}

				$baganData['results'][$babak - 1][] = [
					!is_null($team[0]['skor']) ? (int) $team[0]['skor'] : null,
					!is_null($team[1]['skor']) ? (int) $team[1]['skor'] : null
				];
			}
		}

		header('Content-Type: application/json');
		echo json_encode($baganData);
	}

	public function simpan_riwayat()
	{
		global $header;
		if (!$header['panitia_sudah']) {
			redirect('dasbor');
		}

		$user = $this->UserModel->get_user_session();
		$kejuaraan = $this->db->get_where('kejuaraan', ['id_kejuaraan' => $user['id_kejuaraan']])->row_array();

		$nama_kejuaraan = $kejuaraan['nama_kejuaraan'];
		$jenis_kelamin = $this->input->post('jenis_kelamin', true);
		$kelas = $this->input->post('kelas', true);
		$judul = $this->input->post('judul', true);
		$waktu_awal = date('Y-m-d', $kejuaraan['waktu_awal']);
		$waktu_akhir = date('Y-m-d', $kejuaraan['waktu_akhir']);

		$this->db->insert('riwayat', ['id_user' => $user['id_user'], 'judul' => $judul, 'nama_kejuaraan' => $nama_kejuaraan, 'jenis_kelamin' => $jenis_kelamin, 'kelas' => $kelas, 'waktu_awal' => $waktu_awal, 'waktu_akhir' => $waktu_akhir]);
		$id_riwayat = $this->db->insert_id();

		$bagan = $this->db->get_where('bagan', ['id_kejuaraan' => $user['id_kejuaraan'], 'jenis_kelamin' => $jenis_kelamin, 'kelas' => $kelas])->result_array();

		foreach ($bagan as $b) {
			$this->db->insert('catatan', ['id_riwayat' => $id_riwayat, 'babak' => $b['babak'], 'nama' => $b['nama'], 'skor' => $b['skor']]);
		}

		$this->session->set_flashdata('success', 'Riwayat Pertandingan Berhasil Disimpan!');
		redirect('dasbor/bagan_pertandingan');
	}

	public function riwayat_pertandingan()
	{
		global $header;
		if ($header['bendahara'] and $header['panitia_belum']) {
			redirect('dasbor');
		}
		$header['judul'] = 'Riwayat Pertandingan';
		$user = $this->UserModel->get_user_session();
		$header['user'] = $user;
		$body['riwayat'] = $this->DataModel->get_riwayat_active();
		$this->load->view('dasbor/include/header', $header);
		$this->load->view('dasbor/riwayat_pertandingan', $body);
		$this->load->view('dasbor/include/footer');
	}

	public function detail_riwayat($id_riwayat = null)
	{
		global $header;
		if ($header['bendahara'] and $header['panitia_belum']) {
			redirect('dasbor');
		}
		if (null == $id_riwayat) {
			$this->session->set_flashdata('danger', 'Silakan pilih Riwayat!');
			redirect('dasbor/riwayat_pertandingan');
		}
		if (1 > $this->DataModel->get_riwayat_id_active_count($id_riwayat)) {
			$this->session->set_flashdata('danger', 'Data tidak ada!');
			redirect('dasbor/riwayat_pertandingan');
		}
		$header['judul'] = 'Detail Riwayat';
		$user = $this->UserModel->get_user_session();
		$header['user'] = $user;
		$body['row'] = $this->DataModel->get_riwayat_id_active($id_riwayat);
		$this->load->view('dasbor/include/header', $header);
		$this->load->view('dasbor/detail_riwayat', $body);
		$this->load->view('dasbor/include/footer');
	}

	public function load_bagan2()
	{
		global $header;
		if ($header['bendahara'] and $header['panitia_belum']) {
			redirect('dasbor');
		}

		$id_riwayat = $this->input->get('id_riwayat', true);

		$baganData = [
			'teams' => [],
			'results' => [],
		];

		for ($babak = 1;; $babak++) {
			$queryBabak = $this->db
				->select('catatan.*')
				->from('catatan')
				->where(['catatan.id_riwayat' => $id_riwayat, 'babak' => $babak])
				->get()
				->result_array();

			$jumlah_peserta = count($queryBabak);
			$jumlah_peserta_dibutuhkan = (1 == $jumlah_peserta) ? 2 : pow(2, ceil(log($jumlah_peserta, 2)));

			if (empty($queryBabak)) {
				break;
			}

			for ($i = $jumlah_peserta; $i < $jumlah_peserta_dibutuhkan; $i++) {
				// $queryBabak[] = ['nama_user' => null, 'id_user' => null, 'skor' => null];
				$queryBabak[] = ['nama' => null, 'id_user' => null, 'skor' => null];
			}

			$teamsBabak = array_chunk($queryBabak, 2);

			foreach ($teamsBabak as $team) {
				if (1 == $babak) {
					$baganData['teams'][] = [
						// $team[0]['nama_user'],
						// $team[1]['nama_user']
						$team[0]['nama'],
						$team[1]['nama']
					];
				}

				$baganData['results'][$babak - 1][] = [
					!is_null($team[0]['skor']) ? (int) $team[0]['skor'] : null,
					!is_null($team[1]['skor']) ? (int) $team[1]['skor'] : null
				];
			}
		}

		header('Content-Type: application/json');
		echo json_encode($baganData);
	}

	public function edit_riwayat($id_riwayat = null)
	{
		global $header;
		if (!$header['admin']) {
			redirect('dasbor');
		}
		if (null == $id_riwayat) {
			$this->session->set_flashdata('danger', 'Silakan pilih Riwayat!');
			redirect('dasbor/riwayat_pertandingan');
		}
		if (1 > $this->DataModel->get_riwayat_id_active_count($id_riwayat)) {
			$this->session->set_flashdata('danger', 'Data tidak ada!');
			redirect('dasbor/riwayat_pertandingan');
		}
		$judul = $this->input->post('judul');
		if (empty($judul)) {
			$this->session->set_flashdata('danger', 'Judul tidak boleh kosong!');
			redirect('dasbor/riwayat_pertandingan');
		}
		$this->db->update('riwayat', ['judul' => $judul], ['id_riwayat' => $id_riwayat]);
		$this->session->set_flashdata('success', 'Data Berhasil Diperbarui!');
		redirect('dasbor/riwayat_pertandingan');
	}

	public function hapus_riwayat($id_riwayat = null)
	{
		global $header;
		if ($header['bendahara'] and $header['panitia_belum']) {
			redirect('dasbor');
		}
		if (null == $id_riwayat) {
			$this->session->set_flashdata('danger', 'Silakan pilih Riwayat!');
			redirect('dasbor/riwayat_pertandingan');
		}
		if (1 > $this->DataModel->get_riwayat_id_active_count($id_riwayat)) {
			$this->session->set_flashdata('danger', 'Data tidak ada!');
			redirect('dasbor/riwayat_pertandingan');
		}
		$this->db->update('riwayat', ['active' => 0], ['id_riwayat' => $id_riwayat]);
		$this->db->update('catatan', ['active' => 0], ['id_riwayat' => $id_riwayat]);
		$this->session->set_flashdata('success', 'Data Berhasil Dihapus!');
		redirect('dasbor/riwayat_pertandingan');
	}

	public function edit_profil()
	{
		global $header;
		$header['judul'] = 'Edit Profil';
		$user = $this->UserModel->get_user_session();
		$header['user'] = $user;
		$body['user'] = $user;
		$this->load->view('dasbor/include/header', $header);
		$this->load->view('dasbor/edit_profil', $body);
		$this->load->view('dasbor/include/footer');
	}

	public function edit_profil_aksi()
	{
		$nama_user = $this->input->post('nama_user');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if (empty($nama_user)) {
			$this->session->set_flashdata('danger', 'Nama tidak boleh kosong!');
			redirect('dasbor/edit_profil');
		}
		if (empty($username)) {
			$this->session->set_flashdata('danger', 'Username tidak boleh kosong!');
			redirect('dasbor/edit_profil');
		}
		if (empty($password)) {
			$data = ['nama_user' => $nama_user, 'username' => $username];
		} else {
			$data = ['nama_user' => $nama_user, 'username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT)];
		}
		$this->db->update('user', $data, ['id_user' => $this->session->userdata('id_user')]);
		$this->session->set_flashdata('success', 'Data Berhasil Diperbarui!');
		redirect('dasbor/edit_profil');
	}
}
