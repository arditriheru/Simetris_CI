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

		$this->load->view('templates/header', $data);
		$this->load->view('manajemen/vLogin', $data);
		$this->load->view('templates/footer', $data);
	}

	public function login()
	{
		$data['title'] 		= "Login";
		$data['subtitle'] 	= "Manajemen";

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$where = array(
			'username' => $username,
			'password' => md5($password),
		);

		$query = $this->mSimetris->login('*', 'admin', $where);

		if ($query !== FALSE) {
			$user = $this->mSimetris->selectData('admin', '*', $where, 'id_admin ASC')->row();

			$userdata = array(
				'id_petugas'  		=> $user->id_petugas,
				'nama_petugas'  	=> $user->nama,
				'id_unit'     		=> $user->id_unit,
				'akses'     		=> 'Admin',
				'manajemen_login'	=> '1',
				'hello'  			=> $user->nama,
			);

			$this->session->set_userdata($userdata);
			redirect('manajemen/dataManajemen');
		} else {
			$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Username atau password salah
				</div>');
		}

		// $cek = $this->mSimetris->cekLogin2($username, $password);

		// if ($cek == FALSE) {
		// 	$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
		// 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		// 		Username atau password salah
		// 		</div>');
		// } else {

		// 	$akses = $this->mSimetris->hakAkses($username, $password);
		// 	$userdata = array(
		// 		'id_petugas'  		=> $cek->id_petugas,
		// 		'nama_petugas'     	=> $cek->nama,
		// 		'login'  			=> '1',
		// 	);
		// 	$this->session->set_userdata($userdata);
		// 	$this->session->set_userdata('akses', 'Admin');
		// 	redirect('manajemen/dataManajemen');
		// }

		$this->load->view('templates/header', $data);
		$this->load->view('manajemen/vLogin', $data);
		$this->load->view('templates/footer', $data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('manajemen/login');
	}
}
