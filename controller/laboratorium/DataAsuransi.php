<?php 

class dataAsuransi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		// if($this->session->userdata('login') !='1')
		// {
		// 	$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissable">
		// 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		// 		<font size="4"><b>Anda belum login!</b></font>
		// 		</div>');
		// 	redirect('manajemen/login');
		// }

		$this->load->model("mSimetris");
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] 		= "Invoice";
		$data['subtitle'] 	= "Pemeriksaan";

		$this->load->view('templates/header',$data);
		$this->load->view('laboratorium/vMenu',$data);
		$this->load->view('laboratorium/asuransi/vDataAsuransi',$data);
		$this->load->view('templates/footer',$data);

	}

	public function cariData()
	{
		$data['title'] 		= "Invoice";
		$data['subtitle'] 	= "Pemeriksaan";

		$id 				= $this->input->post('id');
		$data['data'] 		= $this->mSimetris->cariDataAsuranri($id)->result();

		$this->load->view('templates/header',$data);
		$this->load->view('laboratorium/vMenu',$data);
		$this->load->view('laboratorium/asuransi/vDataAsuransi',$data);
		$this->load->view('templates/footer',$data);
	}

	public function printData($id)
	{
		$data['title'] 		= "Detail";
		$data['subtitle'] 	= "Pemeriksaan";

		$data['data'] 	= $this->mSimetris->dataKlaimAsuransi($id)->result();
		$biodata 		= $this->mSimetris->dataKlaimAsuransi($id)->result();

		foreach ($biodata as $d) {
			$data['id_catatan_medik'] 	= $d->id_catatan_medik;
			$data['nama_sex'] 			= $d->nama_sex;
			$data['nama_pasien'] 		= $d->nama_pasien;
			$data['alamat'] 			= $d->alamat;
			$data['tgl_lahir'] 			= $d->tgl_lahir;
			$data['nama_dokter'] 		= $d->nama_dokter;
			$data['tgl_kunj'] 			= $d->tgl_kunj;
			$data['jam_kunj'] 			= $d->jam_kunj;
		}

		$this->load->view('templates/print',$data);
		$this->load->view('laboratorium/asuransi/vPrintDataAsuransi',$data);
		$this->load->view('templates/footer',$data);

	}

}

?>