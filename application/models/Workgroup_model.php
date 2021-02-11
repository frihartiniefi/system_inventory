<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workgroup_model extends CI_Model {

	public function get_all()
	{
		$query = $this->db->query("SELECT * FROM workgroup ORDER BY nama ASC")->result();

		return $query;
	}

	public function get_detail($id)
	{
		$query = $this->db->query("SELECT * FROM workgroup WHERE id = $id");

		return $query->row();
	}

	public function get_workgroup_data($id)
	{
		$query = $this->db->query("SELECT * FROM workgroup WHERE id = $id LIMIT 1 ");
        $return = $query->row();

        return $return;
	}

	public function add_data($data)
	{
		$this->db->insert('workgroup', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function update_data($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('workgroup', $data);

		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function delete_workgroup($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('workgroup'); 
		
		return ($this->db->affected_rows() != 1) ? false : true;
	}

}

/* End of file Workgroup_model.php */
/* Location: ./application/models/Workgroup_model.php */ ?>