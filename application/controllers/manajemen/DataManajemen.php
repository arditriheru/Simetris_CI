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
			SELECT SUBSTRING_INDEX(telp,'/',1) AS telp,id_catatan_medik, nama, nama_ortu, tgl_lahir
			FROM mr_pasien
			WHERE tgl_lahir BETWEEN '2019-02-15' AND '2021-02-15'
			ORDER BY tgl_lahir ASC")->result();

		$this->load->view('templates/header',$data);
		$this->load->view('manajemen/vMenu',$data);
		$this->load->view('manajemen/vExportCustom',$data);
		$this->load->view('templates/footer',$data);

	}

}

?>