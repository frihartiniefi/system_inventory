<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workgroup extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('isLogin') != 1) {
			redirect('auth/login','refresh');
		}

		$this->load->model('Workgroup_model');
		$this->load->model('Pegawai_model');
	}

	public function index()
	{
		$data['workgroup'] 	= $this->Workgroup_model->get_all();
		
		$count_pegawai = array();
		foreach ($data['workgroup'] as $key => $v) {
			$pegawai = $this->Pegawai_model->count_workgroup($v->id);

			$v->total_pegawai = $pegawai;

			$count_pegawai[] = $v;
		}

		$this->load->view('include/header');
		$this->load->view('workgroup/index', $data);
		$this->load->view('include/footer');
	}

	public function add()
	{
		$data['listPegawai'] = $this->Pegawai_model->get_pegawai();
		$data['action']			= base_url('workgroup/addWorkgroup');

		$this->load->view('include/header');
		$this->load->view('workgroup/form', $data);
		$this->load->view('include/footer');
	}

	public function addWorkgroup()
	{
		$nama		= $this->input->post('nama');
		$unit		= $this->input->post('unit');
		$bagian		= $this->input->post('bagian');
		$anggota	= $this->input->post('anggota');

		$user_id = $this->session->userdata('id_user');

		$data = array(
			'nama' 			=> $nama,
			'unit_kerja' 	=> $unit,
			'sub_bagian'	=> $bagian,
			'created_date'	=> date("Y-m-d H:i:s"),
			'created_by'	=> $user_id
		);

		$add_data 		= $this->Workgroup_model->add_data($data);
		$id_workgroup 	= $this->db->insert_id();

		if ($add_data) {

			$data_pegawai = array(
				'workgroup_id'	=> $id_workgroup,
				'update_date'	=> date("Y-m-d H:i:s"),
				'update_by'		=> $user_id
			);

			foreach ($anggota as $k => $v) {

				$update_pegawai = $this->Pegawai_model->update_data($data_pegawai, $v);
			}

			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-success'>Berhasil Menyimpan Data !</div>");
			redirect('workgroup');
			
		}else{
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-danger'>Tidak Dapat Menyimpan Data !</div>");
			redirect('workgroup');
		}
	}

	public function edit($id)
	{
		$data['workgroup'] 		= $this->Workgroup_model->get_detail($id);
		$data['listPegawai'] 	= $this->Pegawai_model->get_pegawai();
		$data['action']			= base_url('workgroup/editWorkgroup/').$id;

		$this->load->view('include/header');
		$this->load->view('workgroup/form', $data);
		$this->load->view('include/footer');

	}

	public function editWorkgroup($id)
	{
		$nama		= $this->input->post('nama');
		$unit		= $this->input->post('unit');
		$bagian		= $this->input->post('bagian');
		$anggota	= $this->input->post('anggota');

		$user_id = $this->session->userdata('id_user');

		$data = array(
			'nama' 			=> $nama,
			'unit_kerja' 	=> $unit,
			'sub_bagian'	=> $bagian,
			'update_date'	=> date("Y-m-d H:i:s"),
			'update_by'		=> $user_id
		);

		$update_data 		= $this->Workgroup_model->update_data($data, $id);

		if ($update_data) {

			$data_pegawai = array(
				'workgroup_id'	=> $id,
				'update_date'	=> date("Y-m-d H:i:s"),
				'update_by'		=> $user_id
			);

			foreach ($anggota as $k => $v) {

				$update_pegawai = $this->Pegawai_model->update_data($data_pegawai, $v);
			}

			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-success'>Berhasil Menyimpan Data !</div>");
			redirect('workgroup');
			
		}else{
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-danger'>Tidak Dapat Menyimpan Data !</div>");
			redirect('workgroup');
		}
	}

	public function delete($id)
	{
		$process 	= $this->Workgroup_model->delete_workgroup($id);

		if ($process) {
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-success'>Workgroup Berhasil di Hapus !</div>");
			redirect('workgroup');
		}else{
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-danger'>Workgroup Tidak di Temukan !</div>");
			redirect('workgroup');
		}
	}

	public function detail_workgroup($id)
	{
		$workgroup = $this->Workgroup_model->get_detail($id);
		$pegawai   = $this->Pegawai_model->get_pegawai_workgroup($id);

    	$res['workgroup'] = $workgroup;
    	$res['pegawai']   = $pegawai;
    	$res['error'] = false;
    	$res['msg'] = 'Sucsses';
    	echo json_encode($res);
	}




}

/* End of file Workgroup.php */
/* Location: ./application/controllers/Workgroup.php */ ?>