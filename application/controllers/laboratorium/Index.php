<?php 

class index extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if($this->session->userdata('login') !='1')
		{
			$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<font size="4"><b>Anda belum login!</b></font>
				</div>');
			redirect('laboratorium/login');
		}

		$this->load->model("mSimetris");
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] 		= "Dashboard";
		$data['subtitle'] 	= "Laboratorium";

		$this->load->view('templates/header',$data);
		$this->load->view('laboratorium/vMenu',$data);
		$this->load->view('laboratorium/vDashboard',$data);
		$this->load->view('templates/footer',$data);
	}

}
?>