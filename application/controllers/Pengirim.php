<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengirim extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pengirim_model');
	}

	public function index()
	{
		$data['pengirim'] = $this->Pengirim_model->getAll();

		$this->load->view('include/header');
		$this->load->view('pengirim/index', $data);
		$this->load->view('include/footer');
	}

	public function add()
	{
		$data['action']	= base_url('pengirim/validate_add');

		$this->load->view('include/header');
		$this->load->view('pengirim/form', $data);
		$this->load->view('include/footer');
	}

	public function validate_add()
	{

		$this->form_validation->set_rules('nama','Nama','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));

		if($this->form_validation->run() == FALSE){
			$this->add();
		}else{
			$this->addPengirim();
		}
	}

	public function addPengirim()
	{
		$nama 				= $this->input->post('nama');

		$user_id = $this->session->userdata('id_user');

		$data = array(
			'nama_pengirim'	=> $nama,
			'created_by' 	=> $user_id,
			'created_date' 	=> date("Y-m-d H:i:s")
		);

		$process = $this->Pengirim_model->add_data($data);

		if ($process) {
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-success'>Berhasil Menyimpan Data !</div>");
			redirect('pengirim');
		}else{
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-danger'>Tidak Dapat Menyimpan Data !</div>");
			redirect('pengirim');
		}
	}

	public function edit($id)
	{
		$data['pengirim']		= $this->Pengirim_model->get_data_byId($id);
		$data['action']			= base_url('pengirim/validate_edit/').$id;

		$this->load->view('include/header');
		$this->load->view('pengirim/form', $data);
		$this->load->view('include/footer');
	}

	public function validate_edit($id)
	{

		$this->form_validation->set_rules('nama','Nama','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));

		if($this->form_validation->run() == FALSE){
			$this->edit($id);
		}else{
			$this->editPengirim($id);
		}
	}

	public function editPengirim($id)
	{
		$nama 	 = $this->input->post('nama');

		$user_id = $this->session->userdata('id_user');

		$data = array(
			'nama_pengirim'	=> $nama,
			'update_by' 	=> $user_id,
			'update_date' 	=> date("Y-m-d H:i:s")
		);

		$process = $this->Pengirim_model->edit_data($id, $data);

		if ($process) {
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-success'>Berhasil Edit Data !</div>");
			redirect('pengirim');
		}else{
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-danger'>Tidak Dapat Edit Data !</div>");
			redirect('pengirim');
		}
	}

	public function delete($id)
	{
		$process 	= $this->Pengirim_model->delete_data($id);

		if ($process) {
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-success'>Pegawai Berhasil di Hapus !</div>");
			redirect('pengirim');
		}else{
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-danger'>Pegawai Tidak di Temukan !</div>");
			redirect('pengirim');
		}
	}

}

/* End of file Penerima.php */
/* Location: ./application/controllers/Penerima.php */ ?>