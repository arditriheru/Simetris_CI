<?php 

class dataKamar extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if($this->session->userdata('login') !='1')
		{
			$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<font size="4">Anda belum login</font>
				</div>');
			redirect('booking/login');
		}

		$this->load->model("mSimetris");
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] 		= "Kamar";
		$data['subtitle'] 	= "Tersedia";
		
		$where = array('6','29','24','26','7','28','27','31','30','25');
		$data['datakamar'] 	= $this->mSimetris->dataKamar($where)->result();

		$this->load->view('templates/header',$data);
		$this->load->view('booking/vMenu',$data);
		$this->load->view('booking/vDataKamar',$data);
		$this->load->view('templates/footer',$data);
	}

} 

?>