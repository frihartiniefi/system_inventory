<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if ($this->session->userdata('isLogin') != 1) {
			redirect('auth/login','refresh');
		}

		$this->load->model('Pegawai_model');
		$this->load->model('Workgroup_model');
	}

	public function index()
	{
		$data['pegawai'] = $this->Pegawai_model->get_pegawai();

		$this->load->view('include/header');
		$this->load->view('pegawai/index', $data);
		$this->load->view('include/footer');
	}

	public function add()
	{
		$data['listworkgroup']  = $this->Workgroup_model->get_all();
		$data['role']			= $this->Pegawai_model->get_allRole();
		$data['action']			= base_url('pegawai/validate_add');

		$this->load->view('include/header');
		$this->load->view('pegawai/form', $data);
		$this->load->view('include/footer');
	}

	public function validate_add()
	{
		$this->form_validation->set_rules('nip','NIP','trim|required|is_unique[pegawai.nip]',
        array(
                'required'  => '%s Harus Di isi.',
                'is_unique' => '%s Sudah Terdaftar'
        ));
		$this->form_validation->set_rules('nama','Nama','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));
        $this->form_validation->set_rules('no_telp','No. Telephone','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));
        $this->form_validation->set_rules('email','Email','trim|required|valid_email',
        array(
                'required'  => '%s Harus Di isi.',
        ));
        $this->form_validation->set_rules('status_pegawai','Status Pegawai','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));
        $this->form_validation->set_rules('role','Role / Jabatan','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));

		if($this->form_validation->run() == FALSE){
			$this->add();
		}else{
			$this->addPegawai();
		}
	}

	public function addPegawai()
	{

		$nip 				= $this->input->post('nip');
		$nama 				= $this->input->post('nama');
		$no_telp 			= $this->input->post('no_telp');
		$email 				= $this->input->post('email');
		$status_pegawai 	= $this->input->post('status_pegawai');
		$type				= $this->input->post('role');

		$user_id = $this->session->userdata('id_user');

		$data = array(
			'nip' 			=> $nip,
			'nama' 			=> $nama,
			'no_telp'		=> $no_telp,
			'email' 		=> $email,
			'status_pegawai'=> ucfirst($status_pegawai),
			'user_type_id' 	=> $type,
			'created_by' 	=> $user_id,
			'created_date' 	=> date("Y-m-d H:i:s")
		);

		$set_password				= "newuser123";
		$myPassword['password'] 	= password_hash($set_password, PASSWORD_DEFAULT);

		$mergeData = array_merge($data, $myPassword);

		$process = $this->Pegawai_model->add_data($mergeData);

		if ($process) {
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-success'>Berhasil Menyimpan Data !</div>");
			redirect('pegawai');
		}else{
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-danger'>Tidak Dapat Menyimpan Data !</div>");
			redirect('pegawai');
		}
	}

	public function edit($id)
	{
		$data['listworkgroup']  = $this->Workgroup_model->get_all();
		$data['role']			= $this->Pegawai_model->get_allRole();
		$data['pegawai']		= $this->Pegawai_model->get_data_byId($id);
		$data['action']			= base_url('pegawai/validate_edit/').$id;

		$this->load->view('include/header');
		$this->load->view('pegawai/form', $data);
		$this->load->view('include/footer');
	}

	public function validate_edit($id)
	{
		$this->form_validation->set_rules('nip','NIP','trim|required|is_unique[pegawai.nip]',
        array(
                'required'  => '%s Harus Di isi.',
                'is_unique' => '%s Sudah Terdaftar'
        ));
		$this->form_validation->set_rules('nama','Nama','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));
        $this->form_validation->set_rules('no_telp','No. Telephone','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));
        $this->form_validation->set_rules('email','Email','trim|required|valid_email',
        array(
                'required'  => '%s Harus Di isi.',
        ));
        $this->form_validation->set_rules('status_pegawai','Status Pegawai','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));
        $this->form_validation->set_rules('role','Role / Jabatan','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));

		if($this->form_validation->run() == FALSE){
			$this->edit($id);
		}else{
			$this->editPegawai($id);
		}
	}

	public function editPegawai($id)
	{
		$nip 				= $this->input->post('nip');
		$nama 				= $this->input->post('nama');
		$no_telp 			= $this->input->post('no_telp');
		$email 				= $this->input->post('email');
		$status_pegawai 	= $this->input->post('status_pegawai');
		$type				= $this->input->post('role');

		$user_id = $this->session->userdata('id_user');

		$data = array(
			'nip' 			=> $nip,
			'nama' 			=> $nama,
			'no_telp'		=> $no_telp,
			'email' 		=> $email,
			'status_pegawai'=> ucfirst($status_pegawai),
			'user_type_id' 	=> $type,
			'update_by' 	=> $user_id,
			'update_date' 	=> date("Y-m-d H:i:s")
		);

		$process = $this->Pegawai_model->update_data($data, $id);

		if ($process) {
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-success'>Berhasil Menyimpan Data !</div>");
			redirect('pegawai');
		}else{
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-danger'>Tidak Dapat Menyimpan Data !</div>");
			redirect('pegawai');
		}
	}

	public function update_pegawai_workgroup()
	{
        $id = $this->input->post('id');
       	
       	$query = $this->db->query("UPDATE pegawai SET workgroup_id = 0 WHERE id = '$id' ");
    }

    public function delete($id)
	{
		$process 	= $this->Pegawai_model->delete_pegawai($id);

		if ($process) {
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-success'>Pegawai Berhasil di Hapus !</div>");
			redirect('pegawai');
		}else{
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-danger'>Pegawai Tidak di Temukan !</div>");
			redirect('pegawai');
		}
	}


	public function get_pagawai_noWorkgroup()
	{
		$datas = $this->Pegawai_model->get_pagawai_noWorkgroup();

		$res['data'] = $datas;
		$res['error'] = false;

		echo json_encode($res);
	}

	public function get_detail_pegawai($nip)
	{
		$data['pegawai']   = $this->Pegawai_model->get_data($nip);

		if ($data['pegawai']->workgroup_id != 0) {
			$data['workgroup_pegawai'] = $this->Pegawai_model->pegawai_workgroup_detail($data['pegawai']->workgroup_id);
		}

    	$res['pegawai'] = $data;
    	$res['error'] 	= false;
    	$res['msg'] 	= 'Sucsses';
    	echo json_encode($res);
	}

}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */ ?>