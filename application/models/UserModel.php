<?php

class UserModel extends CI_Model
{

	public function get_admin_active()
	{
		return $this->db->get_where('user', ['role' => 1, 'active' => 1])->result_array();
	}

	public function get_admin_id_active($id_user)
	{
		return $this->db->get_where('user', ['id_user' => $id_user, 'role' => 1, 'active' => 1])->row_array();
	}

	public function get_admin_id_active_count($id_user)
	{
		return $this->db->get_where('user', ['id_user' => $id_user, 'role' => 1, 'active' => 1])->num_rows();
	}

	public function get_bendahara_active()
	{
		return $this->db->get_where('user', ['role' => 2, 'active' => 1])->result_array();
	}

	public function get_bendahara_id_active($id_user)
	{
		return $this->db->get_where('user', ['id_user' => $id_user, 'role' => 2, 'active' => 1])->row_array();
	}

	public function get_bendahara_id_active_count($id_user)
	{
		return $this->db->get_where('user', ['id_user' => $id_user, 'role' => 2, 'active' => 1])->num_rows();
	}

	public function get_panitia_active()
	{
		$this->db->select('user.*, kejuaraan.nama_kejuaraan');
		$this->db->from('user');
		$this->db->join('kejuaraan', 'user.id_kejuaraan = kejuaraan.id_kejuaraan');
		$this->db->where(['user.role' => 3, 'user.active' => 1]);

		return $this->db->get()->result_array();
	}

	public function get_panitia_id_active($id_user)
	{
		$this->db->select('user.*, kejuaraan.nama_kejuaraan');
		$this->db->from('user');
		$this->db->join('kejuaraan', 'user.id_kejuaraan = kejuaraan.id_kejuaraan');
		$this->db->where(['id_user' => $id_user, 'user.role' => 3, 'user.active' => 1]);

		return $this->db->get()->row_array();
	}

	public function get_panitia_id_active_count($id_user)
	{
		return $this->db->get_where('user', ['id_user' => $id_user, 'role' => 3, 'active' => 1])->num_rows();
	}

	public function get_panitia_belum_active()
	{
		$this->db->select('user.*, kejuaraan.nama_kejuaraan');
		$this->db->from('user');
		$this->db->join('kejuaraan', 'user.id_kejuaraan = kejuaraan.id_kejuaraan');
		$this->db->where(['user.role' => 3, 'user.approve' => null, 'user.active' => 1]);

		return $this->db->get()->result_array();
	}

	public function get_panitia_belum_id_active($id_user)
	{
		$this->db->select('user.*, kejuaraan.nama_kejuaraan');
		$this->db->from('user');
		$this->db->join('kejuaraan', 'user.id_kejuaraan = kejuaraan.id_kejuaraan');
		$this->db->where(['id_user' => $id_user, 'user.role' => 3, 'user.approve' => null, 'user.active' => 1]);

		return $this->db->get()->row_array();
	}

	public function get_panitia_belum_id_active_count($id_user)
	{
		return $this->db->get_where('user', ['id_user' => $id_user, 'role' => 3, 'user.approve' => null, 'active' => 1])->num_rows();
	}

	public function get_panitia_sudah_active()
	{
		$this->db->select('user.*, kejuaraan.nama_kejuaraan');
		$this->db->from('user');
		$this->db->join('kejuaraan', 'user.id_kejuaraan = kejuaraan.id_kejuaraan');
		$this->db->where(['user.role' => 3, 'user.approve' => 1, 'user.active' => 1]);

		return $this->db->get()->result_array();
	}

	public function get_panitia_sudah_id_active($id_user)
	{
		$this->db->select('user.*, kejuaraan.nama_kejuaraan');
		$this->db->from('user');
		$this->db->join('kejuaraan', 'user.id_kejuaraan = kejuaraan.id_kejuaraan');
		$this->db->where(['id_user' => $id_user, 'user.role' => 3, 'user.approve' => 1, 'user.active' => 1]);

		return $this->db->get()->row_array();
	}

	public function get_panitia_sudah_id_active_count($id_user)
	{
		return $this->db->get_where('user', ['id_user' => $id_user, 'role' => 3, 'user.approve' => 1, 'active' => 1])->num_rows();
	}

	public function get_juri_active()
	{
		return $this->db->get_where('user', ['role' => 4, 'active' => 1])->result_array();
	}

	public function get_juri_id_active($id_user)
	{
		return $this->db->get_where('user', ['id_user' => $id_user, 'role' => 4, 'active' => 1])->row_array();
	}

	public function get_juri_id_active_count($id_user)
	{
		return $this->db->get_where('user', ['id_user' => $id_user, 'role' => 4, 'active' => 1])->num_rows();
	}

	public function get_peserta_active()
	{
		return $this->db->get_where('user', ['role' => 5, 'active' => 1])->result_array();
	}

	public function get_peserta_id_active($id_user)
	{
		return $this->db->get_where('user', ['id_user' => $id_user, 'role' => 5, 'active' => 1])->row_array();
	}

	public function get_peserta_id_active_count($id_user)
	{
		return $this->db->get_where('user', ['id_user' => $id_user, 'role' => 5, 'active' => 1])->num_rows();
	}

	public function get_user_active()
	{
		return $this->db->get_where('user', ['active' => 1])->result_array();
	}

	public function get_user_id_active($id_user)
	{
		return $this->db->get_where('user', ['id_user' => $id_user, 'active' => 1])->row_array();
	}

	public function get_user_id_active_count($id_user)
	{
		return $this->db->get_where('user', ['id_user' => $id_user, 'active' => 1])->num_rows();
	}

	public function get_user_session()
	{
		return $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();
	}
}
