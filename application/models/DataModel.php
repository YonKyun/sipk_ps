<?php

class DataModel extends CI_Model
{

	public function get_bagan($id_kejuaraan, $jenis_kelamin, $kelas)
	{
		return $this->db->get_where('bagan', ['id_kejuaraan' => $id_kejuaraan, 'jenis_kelamin' => $jenis_kelamin, 'kelas' => $kelas])->result_array();
	}

	public function get_bagan_id($id)
	{
		return $this->db->get_where('bagan', ['id_bagan' => $id])->row_array();
	}

	public function get_bagan_id_count($id)
	{
		return $this->db->get_where('bagan', ['id_bagan' => $id])->num_rows();
	}

	public function get_kejuaraan_active()
	{
		return $this->db->get_where('kejuaraan', ['active' => 1])->result_array();
	}

	public function get_kejuaraan_id_active($id)
	{
		return $this->db->get_where('kejuaraan', ['id_kejuaraan' => $id, 'active' => 1])->row_array();
	}

	public function get_kejuaraan_id_active_count($id)
	{
		return $this->db->get_where('kejuaraan', ['id_kejuaraan' => $id, 'active' => 1])->num_rows();
	}

	public function get_riwayat_active()
	{
		return $this->db->get_where('riwayat', ['active' => 1])->result_array();
	}

	public function get_riwayat_id_active($id)
	{
		return $this->db->get_where('riwayat', ['id_riwayat' => $id, 'active' => 1])->row_array();
	}

	public function get_riwayat_id_active_count($id)
	{
		return $this->db->get_where('riwayat', ['id_riwayat' => $id, 'active' => 1])->num_rows();
	}

	public function get_pendaftaran($id_kejuaraan, $jenis_kelamin, $kategori, $kelas)
	{
		return $this->db->get_where('pendaftaran', ['id_kejuaraan' => $id_kejuaraan, 'jenis_kelamin' => $jenis_kelamin, 'kategori' => $kategori, 'kelas' => $kelas, 'active' => 1])->result_array();
	}

	public function get_pendaftaran_active()
	{
		return $this->db->get_where('pendaftaran', ['active' => 1])->result_array();
	}

	public function get_pendaftaran_id_active($id)
	{
		return $this->db->get_where('pendaftaran', ['id_pendaftaran' => $id, 'active' => 1])->row_array();
	}

	public function get_pendaftaran_id_active_count($id)
	{
		return $this->db->get_where('pendaftaran', ['id_pendaftaran' => $id, 'active' => 1])->num_rows();
	}
}
