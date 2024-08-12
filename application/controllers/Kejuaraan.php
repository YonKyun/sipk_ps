<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kejuaraan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		global $header;
		$header['login'] = $this->session->userdata('login');
		$header['admin'] = $this->session->userdata('admin');
		$header['panitia'] = $this->session->userdata('panitia');
		$header['juri'] = $this->session->userdata('juri');
		$header['peserta'] = $this->session->userdata('peserta');
	}

	public function index()
	{
		global $header;

		$header['judul'] = 'Kejuaraan';

		$body['kejuaraan'] = $this->DataModel->get_kejuaraan_active();

		$this->load->view('include/header', $header);
		$this->load->view('kejuaraan', $body);
		$this->load->view('include/footer');
	}

	public function kejuaraan_detail($id_kejuaraan = null)
	{
		global $header;

		if (null == $id_kejuaraan) {
			redirect('kejuaraan');
		}

		$kejuaraan = $this->DataModel->get_kejuaraan_id_active($id_kejuaraan);

		if (null == $kejuaraan) {
			redirect('kejuaraan');
		}

		$header['judul'] = $kejuaraan['nama_kejuaraan'];

		$body['row'] = $kejuaraan;
		$body['sudah'] = ($header['login'] and 0 < $this->db->get_where('pendaftaran', ['id_user' => $this->session->userdata('id_user'), 'id_kejuaraan' => $id_kejuaraan, 'active' => 1])->num_rows()) ? true : false;
		$body['user'] = ($header['login']) ? $this->UserModel->get_user_session() : null;
		$body['seni1'] = [
			'putra1' => (null == $kejuaraan['seni1_putra1'] or 0 == $kejuaraan['seni1_putra1']) ? '-' : $this->DataModel->get_pendaftaran_id_active($kejuaraan['seni1_putra1'])['nama'],
			'putra2' => (null == $kejuaraan['seni1_putra2'] or 0 == $kejuaraan['seni1_putra2']) ? '-' : $this->DataModel->get_pendaftaran_id_active($kejuaraan['seni1_putra2'])['nama'],
			'putra3' => (null == $kejuaraan['seni1_putra3'] or 0 == $kejuaraan['seni1_putra3']) ? '-' : $this->DataModel->get_pendaftaran_id_active($kejuaraan['seni1_putra3'])['nama'],
			'putri1' => (null == $kejuaraan['seni1_putri1'] or 0 == $kejuaraan['seni1_putri1']) ? '-' : $this->DataModel->get_pendaftaran_id_active($kejuaraan['seni1_putri1'])['nama'],
			'putri2' => (null == $kejuaraan['seni1_putri2'] or 0 == $kejuaraan['seni1_putri2']) ? '-' : $this->DataModel->get_pendaftaran_id_active($kejuaraan['seni1_putri2'])['nama'],
			'putri3' => (null == $kejuaraan['seni1_putri3'] or 0 == $kejuaraan['seni1_putri3']) ? '-' : $this->DataModel->get_pendaftaran_id_active($kejuaraan['seni1_putri3'])['nama']
		];
		$body['seni2'] = [
			'putra1' => (null == $kejuaraan['seni2_putra1'] or 0 == $kejuaraan['seni2_putra1']) ? '-' : $this->DataModel->get_pendaftaran_id_active($kejuaraan['seni2_putra1'])['nama'],
			'putra2' => (null == $kejuaraan['seni2_putra2'] or 0 == $kejuaraan['seni2_putra2']) ? '-' : $this->DataModel->get_pendaftaran_id_active($kejuaraan['seni2_putra2'])['nama'],
			'putra3' => (null == $kejuaraan['seni2_putra3'] or 0 == $kejuaraan['seni2_putra3']) ? '-' : $this->DataModel->get_pendaftaran_id_active($kejuaraan['seni2_putra3'])['nama'],
			'putri1' => (null == $kejuaraan['seni2_putri1'] or 0 == $kejuaraan['seni2_putri1']) ? '-' : $this->DataModel->get_pendaftaran_id_active($kejuaraan['seni2_putri1'])['nama'],
			'putri2' => (null == $kejuaraan['seni2_putri2'] or 0 == $kejuaraan['seni2_putri2']) ? '-' : $this->DataModel->get_pendaftaran_id_active($kejuaraan['seni2_putri2'])['nama'],
			'putri3' => (null == $kejuaraan['seni2_putri3'] or 0 == $kejuaraan['seni2_putri3']) ? '-' : $this->DataModel->get_pendaftaran_id_active($kejuaraan['seni2_putri3'])['nama']
		];
		$body['seni3'] = [
			'putra1' => (null == $kejuaraan['seni3_putra1'] or 0 == $kejuaraan['seni3_putra1']) ? '-' : $this->DataModel->get_pendaftaran_id_active($kejuaraan['seni3_putra1'])['nama'],
			'putra2' => (null == $kejuaraan['seni3_putra2'] or 0 == $kejuaraan['seni3_putra2']) ? '-' : $this->DataModel->get_pendaftaran_id_active($kejuaraan['seni3_putra2'])['nama'],
			'putra3' => (null == $kejuaraan['seni3_putra3'] or 0 == $kejuaraan['seni3_putra3']) ? '-' : $this->DataModel->get_pendaftaran_id_active($kejuaraan['seni3_putra3'])['nama'],
			'putri1' => (null == $kejuaraan['seni3_putri1'] or 0 == $kejuaraan['seni3_putri1']) ? '-' : $this->DataModel->get_pendaftaran_id_active($kejuaraan['seni3_putri1'])['nama'],
			'putri2' => (null == $kejuaraan['seni3_putri2'] or 0 == $kejuaraan['seni3_putri2']) ? '-' : $this->DataModel->get_pendaftaran_id_active($kejuaraan['seni3_putri2'])['nama'],
			'putri3' => (null == $kejuaraan['seni3_putri3'] or 0 == $kejuaraan['seni3_putri3']) ? '-' : $this->DataModel->get_pendaftaran_id_active($kejuaraan['seni3_putri3'])['nama']
		];
		$body['tanding'] = [
			'putra1' => (null == $kejuaraan['tanding_putra1'] or 0 == $kejuaraan['tanding_putra1']) ? '-' : $this->DataModel->get_pendaftaran_id_active($kejuaraan['tanding_putra1'])['nama'],
			'putra2' => (null == $kejuaraan['tanding_putra2'] or 0 == $kejuaraan['tanding_putra2']) ? '-' : $this->DataModel->get_pendaftaran_id_active($kejuaraan['tanding_putra2'])['nama'],
			'putra3' => (null == $kejuaraan['tanding_putra3'] or 0 == $kejuaraan['tanding_putra3']) ? '-' : $this->DataModel->get_pendaftaran_id_active($kejuaraan['tanding_putra3'])['nama'],
			'putri1' => (null == $kejuaraan['tanding_putri1'] or 0 == $kejuaraan['tanding_putri1']) ? '-' : $this->DataModel->get_pendaftaran_id_active($kejuaraan['tanding_putri1'])['nama'],
			'putri2' => (null == $kejuaraan['tanding_putri2'] or 0 == $kejuaraan['tanding_putri2']) ? '-' : $this->DataModel->get_pendaftaran_id_active($kejuaraan['tanding_putri2'])['nama'],
			'putri3' => (null == $kejuaraan['tanding_putri3'] or 0 == $kejuaraan['tanding_putri3']) ? '-' : $this->DataModel->get_pendaftaran_id_active($kejuaraan['tanding_putri3'])['nama']
		];

		$this->load->view('include/header', $header);
		$this->load->view('kejuaraan_detail', $body);
		$this->load->view('include/footer');
	}

	public function kejuaraan_daftar($id_kejuaraan = null)
	{
		global $header;

		if (null == $id_kejuaraan) {
			redirect('kejuaraan');
		}

		if (null == $this->DataModel->get_kejuaraan_id_active($id_kejuaraan)) {
			redirect('kejuaraan');
		}

		if (!$header['login'] or !$header['peserta']) {
			redirect('kejuaraan/kejuaraan_detail/' . $id_kejuaraan);
		}

		$id_user = $this->session->userdata('id_user');

		if (0 < $this->db->get_where('pendaftaran', ['id_user' => $id_user, 'id_kejuaraan' => $id_kejuaraan, 'active' => 1])->num_rows()) {
			redirect('kejuaraan/kejuaraan_detail/' . $id_kejuaraan);
		}

		$nama = $this->input->post('nama');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$berat_badan = $this->input->post('berat_badan');
		$kategori = $this->input->post('kategori');
		$kelas = $this->input->post('kelas');

		if (empty($nama)) {
			redirect('kejuaraan/kejuaraan_detail/' . $id_kejuaraan);
		}

		if (empty($jenis_kelamin)) {
			redirect('kejuaraan/kejuaraan_detail/' . $id_kejuaraan);
		}

		if ('Laki-laki' !== $jenis_kelamin and 'Perempuan' !== $jenis_kelamin) {
			redirect('kejuaraan/kejuaraan_detail/' . $id_kejuaraan);
		}

		if (empty($kategori)) {
			redirect('kejuaraan/kejuaraan_detail/' . $id_kejuaraan);
		}

		if ('Seni' == $kategori) {
			if (empty($kelas)) {
				redirect('kejuaraan/kejuaraan_detail/' . $id_kejuaraan);
			}
			if ('Tunggal' !== $kelas and 'Ganda' !== $kelas and 'Regu' !== $kelas) {
				redirect('kejuaraan/kejuaraan_detail/' . $id_kejuaraan);
			}
			$update_user = ['jenis_kelamin' => $jenis_kelamin];
		} elseif ('Tanding' == $kategori) {
			if (empty($berat_badan)) {
				redirect('kejuaraan/kejuaraan_detail/' . $id_kejuaraan);
			}
			if ('Laki-laki' == $jenis_kelamin) {
				if (45 > $berat_badan) {
					$kelas = 'Bebas';
				} elseif (50 >= $berat_badan) {
					$kelas = 'A';
				} elseif (55 >= $berat_badan) {
					$kelas = 'B';
				} elseif (60 >= $berat_badan) {
					$kelas = 'C';
				} elseif (65 >= $berat_badan) {
					$kelas = 'D';
				} elseif (70 >= $berat_badan) {
					$kelas = 'E';
				} elseif (75 >= $berat_badan) {
					$kelas = 'F';
				} elseif (80 >= $berat_badan) {
					$kelas = 'G';
				} elseif (85 >= $berat_badan) {
					$kelas = 'H';
				} elseif (90 >= $berat_badan) {
					$kelas = 'I';
				} elseif (95 >= $berat_badan) {
					$kelas = 'J';
				} elseif (110 >= $berat_badan) {
					$kelas = 'Open 1';
				} elseif (110 < $berat_badan) {
					$kelas = 'Open 2';
				}
			} else {
				if (45 > $berat_badan) {
					$kelas = 'Bebas';
				} elseif (50 >= $berat_badan) {
					$kelas = 'A';
				} elseif (55 >= $berat_badan) {
					$kelas = 'B';
				} elseif (60 >= $berat_badan) {
					$kelas = 'C';
				} elseif (65 >= $berat_badan) {
					$kelas = 'D';
				} elseif (70 >= $berat_badan) {
					$kelas = 'E';
				} elseif (75 >= $berat_badan) {
					$kelas = 'F';
				} elseif (80 >= $berat_badan) {
					$kelas = 'G';
				} elseif (85 >= $berat_badan) {
					$kelas = 'H';
				} elseif (100 >= $berat_badan) {
					$kelas = 'Open 1';
				} elseif (100 < $berat_badan) {
					$kelas = 'Open 2';
				}
			}
			$update_user = ['nama_user' => $nama, 'jenis_kelamin' => $jenis_kelamin, 'berat_badan' => $berat_badan];
		} else {
			redirect('kejuaraan/kejuaraan_detail/' . $id_kejuaraan);
		}

		if (!isset($kelas)) {
			redirect('kejuaraan/kejuaraan_detail/' . $id_kejuaraan);
		}

		$this->db->insert('pendaftaran', ['id_user' => $id_user, 'id_kejuaraan' => $id_kejuaraan, 'nama' => $nama, 'jenis_kelamin' => $jenis_kelamin, 'berat_badan' => $berat_badan, 'kategori' => $kategori, 'kelas' => $kelas, 'waktu' => time()]);

		$config['upload_path'] = 'assets/uploads/images/bukti/';
		$config['allowed_types'] = '*';
		$config['file_name'] = $this->db->insert_id() . '.png';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('bukti');

		unset($this->upload);
		$config['upload_path'] = 'assets/uploads/documents/pendaftaran/';
		$config['allowed_types'] = '*';
		$config['file_name'] = $this->db->insert_id() . '_kk.pdf';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('kk');

		unset($this->upload);
		$config['upload_path'] = 'assets/uploads/documents/pendaftaran/';
		$config['allowed_types'] = '*';
		$config['file_name'] = $this->db->insert_id() . '_surat.pdf';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('surat');

		unset($this->upload);
		$config['upload_path'] = 'assets/uploads/documents/pendaftaran/';
		$config['allowed_types'] = '*';
		$config['file_name'] = $this->db->insert_id() . '_ktp.pdf';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('ktp');

		unset($this->upload);
		$config['upload_path'] = 'assets/uploads/documents/pendaftaran/';
		$config['allowed_types'] = '*';
		$config['file_name'] = $this->db->insert_id() . '_formulir.pdf';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('formulir');

		$this->db->update('user', $update_user, ['id_user' => $id_user]);

		$this->session->set_flashdata('success', 'Pendaftaran berhasil!');
		redirect('kejuaraan/kejuaraan_detail/' . $id_kejuaraan);
	}

	public function load_bagan()
	{
		$id_kejuaraan = $this->input->get('id_kejuaraan');
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
				$team0 = $team[0]['nama'] . ((empty($team[0]['skor'])) ? '' : ' (' . $team[0]['skor'] . ')');
				$team1 = $team[1]['nama'] . ((empty($team[1]['skor'])) ? '' : ' (' . $team[1]['skor'] . ')');
				if (1 == $babak) {
					$baganData['teams'][] = [
						// $team[0]['nama_user'],
						// $team[1]['nama_user']
						(empty($team0)) ? null : $team0,
						(empty($team1)) ? null : $team1
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
}
