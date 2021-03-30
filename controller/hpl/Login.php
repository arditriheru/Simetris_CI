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
		$data['subtitle'] 	= "HPL Register";

		$this->load->view('templates/header',$data);
		$this->load->view('hpl/vLogin',$data);
		$this->load->view('templates/footer',$data);
	}

	public function login()
	{
		$data['title'] 		= "Login";
		$data['subtitle'] 	= "HPL Register";

		$id 	  = $this->input->post('id_aplikasi');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$cek = $this->mSimetris->cekLogin($username,$password);

		if($cek == FALSE)
		{
			$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Username atau password salah!
				</div>');
		}else{

			$akses = $this->mSimetris->hakAkses($username,$password,$id);
			$userdata = array(
				'hpl_id_petugas'  		=> $cek->id_petugas,
				'hpl_nama_petugas'     	=> $cek->nama,
				'login'  				=> '1',
				'hello'     			=> $cek->nama,
			);

			switch ($akses->id_aplikasi) {
				case 1 : 
				$this->session->set_userdata($userdata);
				$this->session->set_userdata('hpl_akses','Admin');
				redirect('hpl/dataHpl');
				break;

				case !1 :
				$this->session->set_userdata($userdata);
				$this->session->set_userdata('hpl_akses','Operator');
				redirect('hpl/dataHpl');
				break;

				default : break;
			}
		}

		$this->load->view('templates/header',$data);
		$this->load->view('hpl/vLogin',$data);
		$this->load->view('templates/footer',$data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('hpl/login');
	}

}

?>