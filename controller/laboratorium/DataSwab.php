<?php 

class dataSwab extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		// if($this->session->userdata('login') !='1')
		// {
		// 	$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissable">
		// 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		// 		<font size="4">Anda belum login</font>
		// 		</div>');
		// 	redirect('laboratorium/login');
		// }

		$this->load->model("mSimetris");
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] 		= "Registrasi";
		$data['subtitle'] 	= "SWAB Antigen";

		$data['antigen'] 	= $this->mSimetris->dataSwab()->result();
		$data['total'] 		= $this->mSimetris->dataSwab()->num_rows();

		$this->load->view('templates/header',$data);
		$this->load->view('booking/vMenu',$data);
		$this->load->view('laboratorium/vDataSwab',$data);
		$this->load->view('templates/footer',$data);
	}

	public function berkas($id)
	{
		$data['title'] 		= "Berkas";
		$data['subtitle'] 	= "Upload";

		$data['id'] = $id;

		$this->load->view('templates/header',$data);
		$this->load->view('booking/vMenu',$data);
		$this->load->view('laboratorium/vDataBerkas',$data);
		$this->load->view('templates/footer',$data);
	}

	public function pdf($id)
	{
		$data['title'] 		= "PDF";
		$data['subtitle'] 	= "Invoice";

		$no_inv = "INV".$id;

		$where 	= array(
			'id_booking_swab' 	=> $id,
		);

		$data['data'] 	= $this->mSimetris->dataSwabDetail($where)->result();
		$data['no_inv'] = $no_inv;

		$this->load->library('pdf');
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = $no_inv.".pdf";
		$this->pdf->view('laboratorium/vPrintDataInvoice', $data);

	}

	public function ubahOk($id)
	{
		$data = array('validasi' => 1);
		$where = array('id_booking_swab' => $id);

		$this->mSimetris->updateData('booking_swab',$data,$where);
		redirect('laboratorium/dataSwab/');
	}

	public function ubahNo($id)
	{
		$data = array('validasi' => 0);
		$where = array('id_booking_swab' => $id);

		$this->mSimetris->updateData('booking_swab',$data,$where);
		redirect('laboratorium/dataSwab/');
	}

}

?>