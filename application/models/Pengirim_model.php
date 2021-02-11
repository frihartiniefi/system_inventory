<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengirim_model extends CI_Model {

	
	public function getAll()
	{
		$q = $this->db->query(" SELECT * FROM pengirim ORDER BY id ASC")->result();

		return $q;
	}

	public function add_data($data)
	{
		$this->db->insert('pengirim', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function get_data_byId($id)
	{
		$q = $this->db->query(" SELECT * FROM pengirim WHERE id = $id ")->row();

		return $q;
	}

	public function edit_data($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('pengirim', $data);

		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function delete_data($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('pengirim'); 
		
		return ($this->db->affected_rows() != 1) ? false : true;
	}

}

/* End of file Penerima_model.php */
/* Location: ./application/models/Penerima_model.php */ ?>