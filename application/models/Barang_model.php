<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model {

	public function get_barangAll()
	{
		$query = $this->db->query("SELECT * FROM barang ORDER BY kode_barang ASC")->result();

		return $query;
	}

	public function get_baranginStock()
	{
		$query = $this->db->query("SELECT * FROM barang WHERE stock != 0 ORDER BY kode_barang ASC")->result();

		return $query;
	}

	public function get_stockAll()
	{
		$query = $this->db->query("SELECT * FROM barang WHERE stock != 0 ORDER BY kode_barang ASC")->result();

		return $query;
	}

	public function get_dataId($id){
		$query = $this->db->query("SELECT * FROM barang WHERE id = $id LIMIT 1 ");
        $return = $query->row();

        return $return;
	}

	public function add_data($data)
	{
		$this->db->insert('barang', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function get_itemIn_byId($user_id, $from, $to)
	{
		$query = $this->db->query("SELECT a.*, b.nama_pengirim
			                       FROM log_barang_masuk a 
			                       LEFT JOIN pengirim b ON b.id = a.pengirim
			                       WHERE a.tanggal_masuk 
			                       BETWEEN '$from' AND '$to' AND a.kepada = '$user_id' ");

		return $query->result();
	}

	public function get_itemIn_all($from, $to)
	{
		$query = $this->db->query("SELECT a.*, b.nama_pengirim
			                       FROM log_barang_masuk a 
			                       LEFT JOIN pengirim b ON b.id = a.pengirim
			                       WHERE a.tanggal_masuk
			                       BETWEEN '$from' AND '$to'");

		return $query->result();
	}

	public function get_itemOut_all($from, $to)
	{
		$query = $this->db->query("SELECT * FROM log_barang_keluar WHERE tanggal_keluar BETWEEN '$from' AND '$to'");

		return $query->result();
	}

	public function get_itemIn_detail($id)
	{
		$query = $this->db->query("SELECT * FROM log_barang_masuk WHERE id = '$id' ");

		return $query->row();
	}

	public function get_itemOut_detail($id)
	{
		$query = $this->db->query("SELECT * FROM log_barang_keluar WHERE id = '$id' ");

		return $query->row();
	}

	public function get_stock($kode_barang)
	{
		$query = $this->db->query("SELECT stock FROM barang WHERE kode_barang = '$kode_barang' ");

		return $query->row();
	}


	public function input_barang_masuk($data)
	{
		$this->db->insert('log_barang_masuk', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function input_barang_keluar($data)
	{
		$this->db->insert('log_barang_keluar', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function update_data($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('barang', $data);

		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function update_stock($data, $kode_barang)
	{
		$this->db->where('kode_barang', $kode_barang);
		$this->db->update('barang', $data);

		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function delete_barang($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('barang'); 
		
		return ($this->db->affected_rows() != 1) ? false : true;
	}

}

/* End of file Barang_model.php */
/* Location: ./application/models/Barang_model.php */ ?>