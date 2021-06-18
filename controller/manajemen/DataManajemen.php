<?php 

class dataManajemen extends CI_Controller
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
			redirect('manajemen/login');
		}

		$this->load->model("mSimetris");
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] 		= "Dashboard";
		$data['subtitle'] 	= getDateIndo();

		$this->load->view('templates/header',$data);
		$this->load->view('manajemen/vMenu',$data);
		$this->load->view('manajemen/vDashboard',$data);
		$this->load->view('templates/footer',$data);

	}

	public function exportCustom()
	{
		$data['data'] = $this->db->query("
			SELECT nama FROM mr_pasien WHERE tgl_lahir BETWEEN '2020-06-18' AND '2021-06-18'")->result();

		$this->load->view('templates/header',$data);
		$this->load->view('manajemen/vMenu',$data);
		$this->load->view('manajemen/vExportCustom',$data);
		$this->load->view('templates/footer',$data);

	}

}
