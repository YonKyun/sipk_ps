<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
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
		$header['judul'] = 'Beranda';

		$this->load->view('include/header', $header);
		$this->load->view('beranda');
		$this->load->view('include/footer');
	}
}
