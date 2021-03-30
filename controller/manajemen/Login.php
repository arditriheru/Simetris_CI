<?php 

class login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model("mSimetris");
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] 		= "Login";
		$data['subtitle'] 	= "Manajemen";

		$this->load->view('templates/header',$data);
		$this->load->view('manajemen/vLogin',$data);
		$this->load->view('templates/footer',$data);
	}

	public function login()
	{
		$data['title'] 		= "Login";
		$data['subtitle'] 	= "Manajemen";

		$id 	  = $this->input->post('id_aplikasi');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$cek = $this->mSimetris->cekLogin2($username,$password,34); 

		if($cek == FALSE)
		{
			$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Username atau password salah
				</div>');
		}else{

			$akses = $this->mSimetris->hakAkses($username,$password,$id);
			$userdata = array(
				'id_petugas'  		=> $cek->id_petugas,
				'nama_petugas'     	=> $cek->nama,
				'login'  			=> '1',
			);
			$this->session->set_userdata($userdata);
			$this->session->set_userdata('akses','Admin');
			redirect('manajemen/dataManajemen');
		}

		$this->load->view('templates/header',$data);
		$this->load->view('manajemen/vLogin',$data);
		$this->load->view('templates/footer',$data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('manajemen/login');
	}

}

?>