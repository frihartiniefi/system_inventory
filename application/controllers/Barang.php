<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('isLogin') != 1) {
			redirect('auth/login','refresh');
		}
		
		$this->load->model('Barang_model');
		$this->load->model('Pegawai_model');
		$this->load->model('Pengirim_model');
	}

	public function index()
	{
		redirect('barang/master','refresh');
	}

	public function master()
	{
		$data['barang'] = $this->Barang_model->get_barangAll();

		$this->load->view('include/header');
		$this->load->view('barang/master', $data);
		$this->load->view('include/footer');
	}

	public function add()
	{
		$data['action']			= base_url('barang/validate_add');

		$this->load->view('include/header');
		$this->load->view('barang/form_master', $data);
		$this->load->view('include/footer');
	}

	public function validate_add()
	{
		$this->form_validation->set_rules('kode','Kode Barang','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));
		$this->form_validation->set_rules('nama','Nama Barang','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));
        $this->form_validation->set_rules('merk','Merk','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));
       
		if($this->form_validation->run() == FALSE){
			$this->add();
		}else{
			$this->add_process();
		}
	}

	public function add_process()
	{
		$kode   = $this->input->post('kode');
		$nama   = $this->input->post('nama');

		$user_id = $this->session->userdata('id_user');

		$data = array(
			'kode_barang' 	=> $kode,
			'nama_alat' 	=> $nama,
			'merk'          => $merk,
			'created_by'	=> $user_id,
			'created_date'	=> date("Y-m-d H:i:s")
		);

		$process = $this->Barang_model->add_data($data);

		if ($process) {
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-success'>Berhasil Menyimpan Data !</div>");
			redirect('barang/master');
		}else{
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-danger'>Gagal Menyimpan Data !</div>");
			redirect('barang/master');
		}
	}

	public function edit($id)
	{
		$data['action']			= base_url('barang/validate_edit/').$id;
		$data['barang']			= $this->Barang_model->get_dataId($id);

		$this->load->view('include/header');
		$this->load->view('barang/form_master', $data);
		$this->load->view('include/footer');
	}

	public function validate_edit($id)
	{
		$this->form_validation->set_rules('kode','Kode Barang','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));
		$this->form_validation->set_rules('nama','Nama Barang','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));
		 $this->form_validation->set_rules('merk','Merk','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));
       
		if($this->form_validation->run() == FALSE){
			$this->edit($id);
		}else{
			$this->edit_process($id);
		}
	}

	public function edit_process($id)
	{
		$kode = $this->input->post('kode');
		$nama = $this->input->post('nama');
		$merk   = $this->input->post('merk');

		$user_id = $this->session->userdata('id_user');

		$data = array(
			'kode_barang' 	=> $kode,
			'nama_alat' 	=> $nama,
			'merk'          => $merk,
			'update_by'		=> $user_id,
			'update_date'	=> date("Y-m-d H:i:s")
		);

		$process = $this->Barang_model->update_data($data, $id);

		if ($process) {
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-success'>Berhasil Menyimpan Data !</div>");
			redirect('barang/master');
		}else{
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-danger'>Gagal Menyimpan Data !</div>");
			redirect('barang/master');
		}
	}

	public function get_detail_barang($id)
	{
		$data  = $this->Barang_model->get_dataId($id);

    	$res['barang']  = $data;
    	$res['error'] 	= false;
    	$res['msg'] 	= 'Sucsses';
    	echo json_encode($res);
	}

	public function delete($id)
	{
		$process 	= $this->Barang_model->delete_barang($id);

		if ($process) {
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-success'>Barang Berhasil di Hapus !</div>");
			redirect('barang/master');
		}else{
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-danger'>Barang Tidak di Temukan !</div>");
			redirect('barang/master');
		}
	}

	public function barang_masuk()
	{
		$data['action']			= base_url('barang/validate_barang_masuk');
		$data['barang']			= $this->Barang_model->get_barangAll();
		$data['pengirim']       = $this->Pengirim_model->getAll();
		$data['pegawai']		= $this->Pegawai_model->get_pegawai();

		$this->load->view('include/header');
		$this->load->view('barang/form_barang_masuk', $data);
		$this->load->view('include/footer');
	}

	public function validate_barang_masuk()
	{
        $this->form_validation->set_rules('date','Tanggal Masuk','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));
        $this->form_validation->set_rules('merk','Merk','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));
        $this->form_validation->set_rules('serial','Serial No.','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));
        $this->form_validation->set_rules('jumlah','Jumlah Barang','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));
       
		if($this->form_validation->run() == FALSE){
			$this->barang_masuk();
		}else{
			$this->process_barang_masuk();
		}
	}

	public function process_barang_masuk()
	{
		$kode_barang 	= $this->input->post('kode');
		$nama_alat		= $this->input->post('nama');
		$tgl_masuk		= $this->input->post('date');
		$merk 			= $this->input->post('merk');
		$serial_no		= $this->input->post('serial');
		$pengirim 		= $this->input->post('pengirim');
		$jumlah 		= $this->input->post('jumlah');
		$from 			= $this->input->post('from');
		$to 			= $this->input->post('to');

		$user_id = $this->session->userdata('id_user');

		$referensi = array();

		if (isset($_FILES['referensi']['name']) && $_FILES['referensi']['name'][0] != '' ) {

			for ($i=0; $i <count($_FILES['referensi']['name']); $i++) {

				$_FILES['file']['name']     = $_FILES['referensi']['name'][$i];
				$_FILES['file']['type']     = $_FILES['referensi']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['referensi']['tmp_name'][$i];
				$_FILES['file']['error']    = $_FILES['referensi']['error'][$i];
				$_FILES['file']['size']     = $_FILES['referensi']['size'][$i];

				$filext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
				$filename = basename($_FILES['file']['name'], '.'.$filext);

				$nmfile = $filename.'-'.$kode_barang.'-'.$this->generateRandomString().'.'.$filext;

				/* memanggil library upload ci */
				$config['upload_path']      = './uploads/referensi/';
				$config['allowed_types']    = 'pdf|doc|docx|jpg|jpeg|png';
				$config['max_size']         = '2048'; // 2 MB
				$config['file_name']        =  $nmfile; //nama yang terupload nantinya
				$config['overwrite'] 		= FALSE;

				if(!file_exists($config['upload_path'])) {
					mkdir($config['upload_path'], 0755, true);
				}
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('file')) {	              	
					$this->session->set_flashdata('error_message', $this->upload->display_errors());
					redirect('barang/barang_masuk', 'refresh');
				}else{
					$ref = $this->upload->data();

					$referensi[] = $ref['file_name'];
				}
			}
		}

		$file_ref = implode(",",$referensi);


        $data = array(
        	'kode_barang' 	=> $kode_barang,
        	'nama_alat'		=> $nama_alat,
        	'tanggal_masuk' => $tgl_masuk,
        	'merk'			=> $merk,
        	'no_serial'		=> $serial_no,
        	'referensi'		=> $file_ref,
        	'pengirim'		=> $pengirim,
        	'jumlah'		=> $jumlah,
        	'from'			=> $from,
        	'to'			=> $to,
        	'created_date'	=> date("Y-m-d H:i:s"),
        	'created_by'	=> $user_id
		);

        $process 	= $this->Barang_model->input_barang_masuk($data);

		if ($process) {

			$get_stock = $this->Barang_model->get_stock($kode_barang);

			$update_stock = $jumlah+$get_stock->stock;

			$stock = array(
				'stock' 	    => $update_stock,
				'update_date'	=> date("Y-m-d H:i:s"),
				'update_by'  	=> $user_id
			);

			$update = $this->Barang_model->update_stock($stock, $kode_barang);

			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-success'>Input Data Berhasil !</div>");
			redirect('barang/barang_masuk');
		}else{
			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-danger'>Input Data Gagal !</div>");
			redirect('barang/barang_masuk');
		}

	}

	public function barang_keluar()
	{
		$data['action']			= base_url('barang/validate_barang_keluar');
		$data['barang']			= $this->Barang_model->get_baranginStock();

		$this->load->view('include/header');
		$this->load->view('barang/form_barang_keluar', $data);
		$this->load->view('include/footer');
	}

	public function validate_barang_keluar()
	{
        $this->form_validation->set_rules('date','Tanggal Masuk','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));
        $this->form_validation->set_rules('merk','Merk','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));
        $this->form_validation->set_rules('serial','Serial No.','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));
        $this->form_validation->set_rules('jumlah','Jumlah Barang','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));
        $this->form_validation->set_rules('tujuan','Tujuan','trim|required',
        array(
                'required'  => '%s Harus Di isi.',
        ));
       
		if($this->form_validation->run() == FALSE){
			$this->barang_keluar();
		}else{
			$this->process_barang_keluar();
		}
	}

	public function process_barang_keluar()
	{
		$kode_barang 	= $this->input->post('kode');
		$nama_alat		= $this->input->post('nama');
		$tgl_keluar		= $this->input->post('date');
		$merk 			= $this->input->post('merk');
		$serial_no		= $this->input->post('serial');
		$jumlah 		= $this->input->post('jumlah');
		$tujuan 		= $this->input->post('tujuan');
		$keterangan		= $this->input->post('keterangan');

		$user_id = $this->session->userdata('id_user');

		$get_stock = $this->Barang_model->get_stock($kode_barang);

		if ($jumlah < $get_stock->stock) {
			
			$data = array(
				'kode_barang' 	=> $kode_barang,
				'nama_alat'		=> $nama_alat,
				'tanggal_keluar' => $tgl_keluar,
				'merk'			=> $merk,
				'no_serial'		=> $serial_no,
				'jumlah'		=> $jumlah,
				'tujuan'		=> $tujuan,
				'keterangan'	=> $keterangan,
				'created_date'	=> date("Y-m-d H:i:s"),
				'created_by'	=> $user_id
			);

			$process 	= $this->Barang_model->input_barang_keluar($data);

			if ($process) {

				$update_stock = $get_stock->stock-$jumlah;

				$stock = array(
					'stock' 	    => $update_stock,
					'update_date'	=> date("Y-m-d H:i:s"),
					'update_by'  	=> $user_id
				);

				$update = $this->Barang_model->update_stock($stock, $kode_barang);

				$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-success'>Input Data Berhasil !</div>");
				redirect('barang/barang_keluar');
			}else{
				$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-danger'>Input Data Gagal !</div>");
				redirect('barang/barang_keluar');
			}

		}else{

			$this->session->set_flashdata("error_message","<div class='alert alert-custom-position alert-danger'>Jumlah Melebihi Stock</div>");
			redirect('barang/barang_keluar');
		}

	}

	public function stock()
	{	
		$data['barang'] = $this->Barang_model->get_barangAll();

		$this->load->view('include/header');
		$this->load->view('barang/stock', $data);
		$this->load->view('include/footer');
	}

	public function print_stock()
	{	

		$data['barang'] = $this->Barang_model->get_stockAll();

		$view 	= $this->load->view('report/pdf_laporan_stock', $data, TRUE);
		$nmfile = 'Laporan Stock';

		$this->pdf->Print_toPdf($view, $nmfile, 'A4', 'portrait');
	}

	public function laporan()
	{
		$this->load->view('include/header');
		$this->load->view('barang/laporan');
		$this->load->view('include/footer');
	}

	public function laporan_cek()
	{

		$date = $this->input->get('daterange');

		$split 	= explode("-",$date);
		$from 	= $split[0];
		$to 	= $split[1];

		$user_type = $this->session->userdata('user_type');
		$user_id   = $this->session->userdata('id_user');

		if (isset($user_type) && $user_type == 2) {
			$data['barang_masuk'] = $this->Barang_model->get_itemIn_byId($user_id, $from, $to);
		}else{
			$data['barang_masuk'] = $this->Barang_model->get_itemIn_all($from, $to);
		}

		$refer = array();
		foreach ($data['barang_masuk'] as $k => $v) {
			$ref = $v->referensi;
			$v->ref_split = explode(",", $ref);

			$refer[] = $v->ref_split;
		}

		$data['barang_keluar'] = $this->Barang_model->get_itemOut_all($from, $to);

		$this->load->view('include/header');
		$this->load->view('barang/laporan', $data);
		$this->load->view('include/footer');
	}

	public function get_itemIn_detail($id)
	{
		$data['barang'] = $this->Barang_model->get_itemIn_detail($id);

		$id_dari   = $data['barang']->from;
		$id_kepada = $data['barang']->to;
		$pic_input = $data['barang']->created_by;
		$pengirim  = $data['barang']->pengirim; 

		$data['pic']	= $this->Pegawai_model->get_data_byId($pic_input);
		$data['dari']	= $this->Pegawai_model->get_data_byId($id_dari);
		$data['kepada']	= $this->Pegawai_model->get_data_byId($id_kepada);
		$data['pengirim'] = $this->Pengirim_model->get_data_byId($pengirim);

    	$res['detail']  = $data;
    	$res['error'] 	= false;
    	$res['msg'] 	= 'Sucsses';
    	echo json_encode($res);
	}

	public function get_itemOut_detail($id)
	{
		$data['barang'] = $this->Barang_model->get_itemOut_detail($id);

		$pic_input = $data['barang']->created_by; 

		$data['pic']	= $this->Pegawai_model->get_data_byId($pic_input);

    	$res['detail']  = $data;
    	$res['error'] 	= false;
    	$res['msg'] 	= 'Sucsses';
    	echo json_encode($res);
	}

	public function print_masuk()
	{	

		$get_range 	= urldecode($_REQUEST['range']);
		$date_range = json_decode($get_range);

		$date = '';
		foreach ($date_range as $k => $v) {
			$date = $v;
		}

		$split 	= explode("-",$date);
		$from 	= $split[0];
		$to 	= $split[1];

		$user_type = $this->session->userdata('user_type');
		$user_id   = $this->session->userdata('id_user');

		if (isset($user_type) && $user_type == 2) {
			$data['barang_masuk'] = $this->Barang_model->get_itemIn_byId($user_id, $from, $to);
		}else{
			$data['barang_masuk'] = $this->Barang_model->get_itemIn_all($from, $to);
		}

		$data['from'] 	= $from;
		$data['to']		= $to;

		$view 	= $this->load->view('report/pdf_laporan_masuk', $data, TRUE);
		$nmfile = 'Laporan Barang Masuk '.$from.'-'.$to;

		$this->pdf->Print_toPdf($view, $nmfile, 'A4', 'portrait');
	}

	public function print_keluar()
	{	

		$get_range 	= urldecode($_REQUEST['range']);
		$date_range = json_decode($get_range);

		$date = '';
		foreach ($date_range as $k => $v) {
			$date = $v;
		}

		$split 	= explode("-",$date);
		$from 	= $split[0];
		$to 	= $split[1];

		$data['barang_keluar'] = $this->Barang_model->get_itemOut_all($from, $to);

		$data['from'] 	= $from;
		$data['to']		= $to;

		$view 	= $this->load->view('report/pdf_laporan_keluar', $data, TRUE);
		$nmfile = 'Laporan Barang Keluar '.$from.'-'.$to;

		$this->pdf->Print_toPdf($view, $nmfile, 'A4', 'portrait');
	}

	private function generateRandomString($length = 3) 
	{
		$characters = '0123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

}

/* End of file Barang.php */
/* Location: ./application/controllers/Barang.php */ ?>