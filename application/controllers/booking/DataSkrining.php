<?php 

class dataSkrining extends CI_Controller
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
		$data['title'] 		= "Skrining";
		$data['subtitle'] 	= "COVID-19";

		$this->load->view('templates/header',$data);
		$this->load->view('booking/vMenu',$data);
		$this->load->view('booking/vSkriningCovid',$data);
		$this->load->view('templates/footer',$data);
	}

	public function diagnosis()
	{

		$A1 = $this->input->post('a1');
		$A2 = $this->input->post('a2');
		$A3 = $this->input->post('a3');
		$B1 = $this->input->post('b1');
		$C1 = $this->input->post('c1');
		$C2 = $this->input->post('c2');
		$C3 = $this->input->post('c3');

		if($A1==1 && $A2==1 && $A3==1 && $B1==1 && $C1==1 ||
			$A1==1 && $A2==1 && $A3==1 && $B1==1 && $C2==1 ||
			$A1==1 && $A2==1 && $B1==1 && $C1==1 ||
			$A1==1 && $A2==1 && $B1==1 && $C2==1 ||
			$A1==1 && $A2==1 && $A3==1 && $C3==1 ||
			$A1==1 && $A2==1 && $A3==1 && $B1==1 ||
			$A1==1 && $A2==1 && $C3==1 ||
			$A1==1 && $C3==1 ||
			$A2==1 && $C3==1){

			$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<font size="4"><b>P.D.P</b> Curiga Pasien Dalam Pengawasan!</font></div>');
			redirect('booking/dataSkrining');

		}elseif($A1==1 && $B1==1 && $C1==1 ||
			$A2==1 && $B1==1 && $C1==1 ||
			$A1==1 && $B1==1 && $C2==1 ||
			$A2==1 && $B1==1 && $C2==1){

			$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<font size="4"><b>O.D.P</b> Curiga Orang Dalam Pengawasan!</font></div>');
			redirect('booking/dataSkrining');

		}elseif($C1==1 && $C2==1 && $C3==1){

			$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<font size="4"><b>O.T.G</b> Curiga Orang Tanpa Gejala!</font></div>');
			redirect('booking/dataSkrining');

		}elseif($C1==1 && $C2==1){

			$this->session->set_flashdata('alert','<div class="alert alert-warning alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<font size="4"><b>Aman</b> Wajib Skrining Lanjutan di UGD!</font></div>');
			redirect('booking/dataSkrining');

		}else{

			$this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<font size="4"><b>Aman</b> Pasien Aman!</font></div>');
			redirect('booking/dataSkrining');

		}
	}

}

?>