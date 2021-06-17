<?php

class dataAntibody extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('login') != '1') {
			$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
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
		$data['title'] 		= "Antibody";
		$data['subtitle'] 	= "Test";

		$where1 = array('igg' 	=> 0, 'igm' 	=> 0);
		$where2 = array('igg' 	=> 1);
		$where3 = array('igm' 	=> 1);

		$data['nonreaktif'] = $this->mSimetris->countData("test_antibody", $where1);
		$data['iggreaktif'] = $this->mSimetris->countData("test_antibody", $where2);
		$data['igmreaktif'] = $this->mSimetris->countData("test_antibody", $where3);
		$data['datadokter'] = $this->mSimetris->getData("mr_dokter")->result();
		$data['dataunit'] 	= $this->mSimetris->getData("mr_unit")->result();
		$data['record']		= $this->mSimetris->getData('mr_pasien');
		$data['totaldata'] 	= $this->mSimetris->getData("test_antibody")->num_rows();
		$data['antibody'] 	= $this->mSimetris->dataAntibody()->result();

		$this->load->view('templates/header', $data);
		$this->load->view('laboratorium/vMenu', $data);
		$this->load->view('laboratorium/antibody/vTambahDataAntibody', $data);
		$this->load->view('templates/footer', $data);
	}

	public function cari()
	{
		$id_catatan_medik = $_GET['id_catatan_medik'];
		$cari = $this->mSimetris->cari($id_catatan_medik)->result();
		echo json_encode($cari);
	}

	public function tambahDataAksi()
	{
		$id_catatan_medik 	= $this->input->post('id_catatan_medik');
		$id_dokter 			= $this->input->post('id_dokter');
		$id_petugas 		= $this->session->userdata('laboratorium_id_petugas');
		$igm 				= '3';
		$igg 				= '3';
		$tanggal 			= getDatenow();
		$jam 				= getTimenow();

		$data = array(

			'id_catatan_medik' 	=> $id_catatan_medik,
			'id_dokter' 		=> $id_dokter,
			'id_petugas' 		=> $id_petugas,
			'igm' 				=> $igm,
			'igg' 				=> $igg,
			'tanggal' 			=> $tanggal,
			'jam' 				=> $jam,
		);

		$this->mSimetris->insertData('test_antibody', $data);
		$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4"><b>Data berhasil ditambahkan!</b></font>
			</div>');
		redirect('laboratorium/dataAntibody');
	}

	public function updateData($id)
	{
		$data['title'] 		= "Antibody";
		$data['subtitle'] 	= "Edit";

		$data['datadokter'] = $this->mSimetris->getData("mr_dokter")->result();
		$data['dataunit'] 	= $this->mSimetris->getData("mr_unit")->result();
		$data['antibody'] 	= $this->mSimetris->detailDataAntibody($id)->result();

		$this->load->view('templates/header', $data);
		$this->load->view('laboratorium/vMenu', $data);
		$this->load->view('laboratorium/antibody/vUpdateDataAntibody', $data);
		$this->load->view('templates/footer', $data);
	}

	public function updateDataAksi()
	{
		$id 				= $this->input->post('id_test_antibody');
		$id_dokter 			= $this->input->post('id_dokter');
		$igm 				= $this->input->post('igm');
		$igg 				= $this->input->post('igg');

		$data = array(

			'id_dokter' 		=> $id_dokter,
			'igm' 				=> $igm,
			'igg' 				=> $igg,
		);

		$where = array(
			'id_test_antibody' 		=> $id
		);

		$this->mSimetris->updateData('test_antibody', $data, $where);
		$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4"><b>Data berhasil diupdate!</b></font>
			</div>');
		redirect('laboratorium/dataAntibody/');
	}

	public function printData($id)
	{
		$data['title'] 		= "Antibody";
		$data['subtitle'] 	= "Print";

		$data['antibody'] = $this->mSimetris->detailDataAntibody($id)->result();

		$this->load->view('templates/print', $data);
		$this->load->view('laboratorium/antibody/vPrintDataAntibody', $data);
	}

	public function deleteData($id)
	{
		$where = array('id_test_antibody' => $id);
		$this->mSimetris->deleteData('test_antibody', $where);
		$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4"><b>Data berhasil dihapus!</b></font>
			</div>');
		redirect('laboratorium/dataAntibody/');
	}

	public function lapCariData()
	{
		$data['title'] 		= "Antibody";
		$data['subtitle'] 	= "Search";

		$this->load->view('templates/header', $data);
		$this->load->view('laboratorium/vMenu', $data);
		$this->load->view('laboratorium/antibody/vLapDataAntibody', $data);
		$this->load->view('templates/footer', $data);
	}

	public function lapCariDataAksi()
	{
		$data['title'] 		= "Antibody";
		$data['subtitle'] 	= "Search";

		$awal 				= $this->input->post('awal');
		$akhir 				= $this->input->post('akhir');
		$data['awal'] 		= $awal;
		$data['akhir'] 		= $akhir;
		$data['antibody'] 	= $this->mSimetris->ExcelDataAntibody($awal, $akhir)->result();

		$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4"><b>Data berhasil ditampilkan!</b></font>
			</div>');

		$this->load->view('templates/header', $data);
		$this->load->view('laboratorium/vMenu', $data);
		$this->load->view('laboratorium/antibody/vLapDataAntibody', $data);
		$this->load->view('templates/footer', $data);
	}

	public function excelData()
	{
		$data['title'] 		= "Antibody";
		$data['subtitle'] 	= "Excel";

		$awal 				= $this->input->post('awal');
		$akhir 				= $this->input->post('akhir');
		$data['awal'] 		= $awal;
		$data['akhir'] 		= $akhir;
		$data['antibody'] 	= $this->mSimetris->ExcelDataAntibody($awal, $akhir)->result();

		$this->load->view('templates/header', $data);
		$this->load->view('laboratorium/vMenu', $data);
		$this->load->view('laboratorium/antibody/vExcelDataAntibody', $data);
		$this->load->view('templates/footer', $data);
	}

	public function _rules()
	{
		$this->form_validation->set_rules('id_catatan_medik', 'nomor rekam medik', 'required');
		$this->form_validation->set_rules('id_dokter', 'nama dokter', 'required');
		$this->form_validation->set_rules('id_unit', 'nama unit', 'required');
		$this->form_validation->set_rules('tgl_periksa', 'tanggal periksa', 'required');
		$this->form_validation->set_rules('jam_periksa', 'jam periksa', 'required');
	}
}
