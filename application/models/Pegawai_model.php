<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_model extends CI_Model {

	public function get_pegawai()
	{
		$query = $this->db->query("SELECT * FROM pegawai ORDER BY nama ASC")->result();

		return $query;
	}

	public function get_data($nip){
		$query = $this->db->query("SELECT * FROM pegawai WHERE nip = $nip LIMIT 1 ");
        $return = $query->row();

        return $return;
	}

	public function get_data_byId($id){
		$query = $this->db->query("SELECT * FROM pegawai WHERE id = $id LIMIT 1 ");
        $return = $query->row();

        return $return;
	}

	public function get_jabatan($id)
	{
		$query = $this->db->query("SELECT * FROM users_type WHERE id = $id LIMIT 1 ");
        $return = $query->row();

        return $return;
	}

	public function get_pegawai_workgroup($id)
	{
		$query = $this->db->query("SELECT * FROM pegawai WHERE workgroup_id = $id ORDER BY nama ASC")->result();

		return $query;
	}

	public function pegawai_workgroup_detail($id)
	{
		$query = $this->db->query("SELECT * FROM workgroup WHERE id = $id ")->row();

		return $query;
	}

	public function get_pagawai_noWorkgroup()
	{
		$query = $this->db->query("SELECT * FROM pegawai WHERE workgroup_id = 0 ORDER BY nama ASC")->result();

		return $query;
	}

	public function get_allRole()
	{
		$query = $this->db->query("SELECT * FROM users_type ORDER BY nama ASC")->result();

		return $query;
	}

	public function checkNipExist($nip){
		$limit = 1;
		$query = $this->db->get_where('pegawai', array('nip' => $nip), $limit);

		if ($query->num_rows() > 0){
			return true;
		}
        return false;
	}

	public function checkIdExist($id){
		$limit = 1;
		$query = $this->db->get_where('pegawai', array('id' => $id), $limit);

		if ($query->num_rows() > 0){
			return true;
		}
        return false;
	}

	public function count_workgroup($id)
	{
		$query = $this->db->query("SELECT nama FROM pegawai WHERE workgroup_id = $id ")->result();

		return $query;
	}

	public function add_data($data)
	{
		$this->db->insert('pegawai', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function update_data($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('pegawai', $data);

		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function update_data_nip($nip, $data)
	{
		$this->db->where('nip', $nip);
		$this->db->update('pegawai', $data);

		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function delete_pegawai($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('pegawai'); 
		
		return ($this->db->affected_rows() != 1) ? false : true;
	}

}

/* End of file Pegawai_model.php */
/* Location: ./application/models/Pegawai_model.php */ ?>