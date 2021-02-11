<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pegawai_model');
		$this->load->model('Workgroup_model');

		$this->mail_config = array(
			'protocol'  => 'smtp',
			'smtp_crypto'=>'tls',
			'smtp_host' => 'smtp.googlemail.com',
			'smtp_port' =>  587,
			'smtp_user' => 'frihartiniefi@gmail.com',
			'smtp_pass' => 'Jkt041197',
			'mailtype'  => 'html',
			'charset'   => 'utf-8'
		);

		// $this->mail_config = array(
		// 	'protocol' => 'smtp',
		// 	'smtp_crypto'=>'tls',
		// 	'smtp_host' => 'smtp.mailtrap.io',
		// 	'smtp_port' => 2525,
		// 	'smtp_user' => '53a8cbc545f3d0',
		// 	'smtp_pass' => 'c5edb5438c9b1c',
		// 	'crlf' => "\r\n",
		// 	'newline' => "\r\n"
		// );
	}

	public function login()
	{
		$this->load->view('login');
	}

	public function Validate_login()
	{	

		$this->form_validation->set_rules('nip','NIP','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));
		$this->form_validation->set_rules('password','Password','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));

		if($this->form_validation->run() == FALSE){
			$this->login();
		}else{
			$this->login_now();
		}
	}

	public function login_now()
	{
		$nip 		= $this->input->post('nip');
		$password 	= $this->input->post('password');

		$cek_peg 	= $this->Pegawai_model->checkNipExist($nip); //cek pegawai mengunakan nip

		if ($cek_peg) {
			
			$data_peg 		= $this->Pegawai_model->get_data($nip); //ambil dara pegawai parameter nip
			$data_jabatan	= $this->Pegawai_model->get_jabatan($data_peg->user_type_id); // ambil data jabatan
			$data_workgroup = $this->Workgroup_model->get_workgroup_data($data_peg->workgroup_id); // ambil data workgroup bedasarkan workgroup_id pegawai

			$cek_password = password_verify($password, $data_peg->password); // 1 = true , '' = false

			if ($cek_password == 1) {
				
				$sess_array = array(
					'isLogin' 				=> 1,
					'id_user'				=> $data_peg->id,
					'nama' 					=> $data_peg->nama,
					'nip' 					=> $data_peg->nip,
					'no_telp' 				=> $data_peg->no_telp,
					'status_pegawai' 		=> $data_peg->status_pegawai,
					'unit_kerja'			=> isset($data_workgroup->unit_kerja)?$data_workgroup->unit_kerja:'',
					'subbagian'				=> isset($data_workgroup->sub_bagian)?$data_workgroup->sub_bagian:'',
					'user_type'				=> $data_peg->user_type_id,
					'jabatan'				=> $data_jabatan->nama,
					'email' 				=> $data_peg->email,
				);

				$this->session->set_userdata($sess_array);
				redirect('dashboard','refresh');
			} else {
				$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-danger'>Password Anda Salah !</div>");
				redirect('auth/login');
			}			
		} else {
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-danger'>NIP Belum Terdaftar !</div>");
			redirect('auth/login');
		}
	}

	public function logout() 
	{	
		$this->session->sess_destroy();
		redirect('auth/login');
	}

	public function change_password()
	{	
		if ($this->session->userdata('isLogin') != 1) {
			redirect('auth/login','refresh');
		}else{
			$this->load->view('include/header');
			$this->load->view('change_password');
			$this->load->view('include/footer');
		}
	}

	public function validate_password()
	{
		$this->form_validation->set_rules('old_password','Password Lama','trim|required',
			array(
				'required'  => '%s harus di isi.',
			));
		$this->form_validation->set_rules('new_password','Password Baru','trim|required|min_length[8]',
			array(
				'required'  => '%s harus di isi.',
                'min_length' => 'Password panjangnya harus 8 Karakter'
			));
		$this->form_validation->set_rules('new_password2','Konfirmasi Password','trim|required|matches[new_password]',
			array(
				'required'  => '%s harus di isi.',
                'matches'	=> 'Password tidak sama.'
			));

		if($this->form_validation->run() == FALSE){
			$this->change_password();
		}else{
			$this->change_password_now();
		}
	}

	public function change_password_now()
	{
		$user_id = $this->session->userdata('id_user');

		$old = $this->input->post('old_password');
		$new = $this->input->post('new_password');
		$new2= $this->input->post('new_password2');

		if ($new == $new2) {
			$cek_pegawai = $this->Pegawai_model->checkIdExist($user_id);

			if ($cek_pegawai) {
				
				$data_pegawai = $this->Pegawai_model->get_data_byId($user_id);

				$cek_password = password_verify($old, $data_pegawai->password);
				// 1 = true , '' = false

				if ($cek_password == 1) {
					
					$encrypt_password = password_hash($new, PASSWORD_DEFAULT);

					$data = array(
						'password'  	=> $encrypt_password,
						'update_by' 	=> $user_id,
						'update_date'	=> date("Y-m-d H:i:s")

					);

					$process = $this->Pegawai_model->update_data($data, $user_id);

					if ($process) {
						$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-success'>Pergantian Password Behasil.</div>");
						redirect('auth/change_password');
					}else{
						$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-danger'>Gagal Mengganti Password, Coba Beberapa Saat Lagi !</div>");
						redirect('auth/change_password');
					}

				}else{
					$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-danger'>Password Lama Anda Tidak Sama.</div>");
					redirect('auth/change_password');
				}

			}else{
				$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-danger'>Data Pegawai Tidak diTemukan .</div>");
				redirect('auth/change_password');
			}

		}else{
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-danger'>Password Tidak Sama !</div>");
			redirect('auth/change_password');
		}
	}

	public function forgotPassword()
	{
		$nip = $this->input->post('nip');
		$email = $this->input->post('email');

		if (isset($email) && $email != '') {

			$new_password = $this->random_code();

			$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

			$data = array(
				'password'    => $password_hash,
				'update_date' => date("Y-m-d H:i:s"),
				'update_by'   => 0,
			);

			$update_data = $this->Pegawai_model->update_data_nip($nip, $data);

			if ($update_data) {
				
				$data['password'] = $new_password;

				$this->email->initialize($this->mail_config);
				$this->email->set_mailtype("html");
				$this->email->set_newline("\r\n");

				$this->email->to($email);
				$this->email->cc('rizki1471@gmail.com');
				$this->email->from('no-reply@dephub.com','Portal Suku Cadang Balai Teknik');
				$this->email->subject('Password Anda Telah di Reset!');				
				$message = $this->load->view('mail/new_forgot_email',$data,TRUE);
				$this->email->message($message);
				$this->email->send();
				

				$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-success'>Silahkan Cek Email Anda Untuk Password Baru !</div>");
				redirect('auth/login');

			}else{
				$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-danger'>Gagal Reset Password!</div>");
				redirect('auth/login');
			}

		}else{
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-danger'>Email Harus di isi !</div>");
			redirect('auth/login');
		}
	}

	public function cek_pegawai($nip)
	{

		$pegawai   = $this->Pegawai_model->get_data($nip);

		if (!isset($pegawai) && $pegawai == '' ) {
			$data['res']    = 'NIP Tidak di Temukan!';
			$data['status'] = 'false';
		}else {
			$data['res']    = 'NIP Valid';
			$data['status'] = 'true';
		}

		$res['data']    = $data;
    	$res['error'] 	= false;
    	$res['msg'] 	= 'Sucsses';

    	echo json_encode($res);
	}

	public function random_code($length = 10)
	{
		$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */ ?>