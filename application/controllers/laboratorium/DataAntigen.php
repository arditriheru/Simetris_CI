<?php

class dataAntigen extends CI_Controller
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
		$data['title'] 		= "Antigen";
		$data['subtitle'] 	= "Test";

		$where1 = array('hasil' 	=> 1);
		$where2 = array('hasil' 	=> 0);

		$data['total'] 		= $this->mSimetris->getData("test_antigen")->num_rows();
		$data['positif'] 	= $this->mSimetris->countData("test_antigen", $where1);
		$data['negatif'] 	= $this->mSimetris->countData("test_antigen", $where2);
		$data['datadokter'] = $this->mSimetris->dataDokter("mr_dokter.id_dokter, mr_dokter.nama_dokter", "mr_dokter", "id_dokter IS NOT NULL", "nama_dokter ASC")->result();
		$data['datasex'] 	= $this->mSimetris->getData("mr_sex")->result();
		$data['dataunit'] 	= $this->mSimetris->getData("mr_unit")->result();
		$data['record']		= $this->mSimetris->getData('mr_pasien');
		$data['totaldata'] 	= $this->mSimetris->getData("test_antigen")->num_rows();
		$data['antigen'] 	= $this->mSimetris->dataAntigen()->result();
		$data['datapasien'] = $this->db->query("SELECT *, mr_sex.nama_sex FROM mr_pasien JOIN mr_sex ON mr_pasien.sex=mr_sex.id_sex WHERE id_catatan_medik=10000000")->result();

		$this->load->view('templates/header', $data);
		$this->load->view('laboratorium/vMenu', $data);
		$this->load->view('laboratorium/antigen/vTambahDataAntigen', $data);
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
		$id_sex 			= $this->input->post('id_sex');
		$nama 				= $this->input->post('nama');
		$tgl_lahir 			= $this->input->post('tgl_lahir');
		$id_petugas 		= $this->session->userdata('laboratorium_id_petugas');
		$hasil 				= '3';
		$tanggal 			= getDatenow();
		$jam 				= getTimenow();

		$data = array(

			'id_catatan_medik' 	=> $id_catatan_medik,
			'id_dokter' 		=> $id_dokter,
			'id_sex' 			=> $id_sex,
			'nama' 				=> $nama,
			'tgl_lahir' 		=> $tgl_lahir,
			'id_petugas' 		=> $id_petugas,
			'hasil' 			=> $hasil,
			'tanggal' 			=> $tanggal,
			'jam' 				=> $jam,
		);

		$this->mSimetris->insertData('test_antigen', $data);
		$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4"><b>Data berhasil ditambahkan!</b></font>
			</div>');
		redirect('laboratorium/dataAntigen/');
	}

	public function updateData($id)
	{
		$data['title'] 		= "Antigen";
		$data['subtitle'] 	= "Edit";

		$data['datadokter'] = $this->mSimetris->dataDokter("mr_dokter.id_dokter, mr_dokter.nama_dokter", "mr_dokter", "id_dokter IS NOT NULL", "nama_dokter ASC")->result();
		$data['dataunit'] 	= $this->mSimetris->getData("mr_unit")->result();
		$data['antigen'] 	= $this->mSimetris->detailDataAntigen($id)->result();

		$this->load->view('templates/header', $data);
		$this->load->view('laboratorium/vMenu', $data);
		$this->load->view('laboratorium/antigen/vUpdateDataAntigen', $data);
		$this->load->view('templates/footer', $data);
	}

	public function updateDataAksi()
	{
		$id 				= $this->input->post('id_test_antigen');
		$id_dokter 			= $this->input->post('id_dokter');
		$hasil 				= $this->input->post('hasil');

		$data = array(

			'id_dokter' 	=> $id_dokter,
			'hasil' 		=> $hasil,
		);

		$where = array(
			'id_test_antigen' => $id
		);

		$this->mSimetris->updateData('test_antigen', $data, $where);
		$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4"><b>Data berhasil diupdate!</b></font>
			</div>');
		redirect('laboratorium/dataAntigen/');
	}

	public function printData($id)
	{
		$data['title'] 		= "Antigen";
		$data['subtitle'] 	= "Print";

		$data['antigen'] = $this->mSimetris->detailDataAntigen($id)->result();

		$this->load->view('templates/print', $data);
		$this->load->view('laboratorium/antigen/vPrintDataAntigen', $data);
	}

	public function deleteData($id)
	{
		$where = array('id_test_antigen' => $id);
		$this->mSimetris->deleteData('test_antigen', $where);
		$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4"><b>Data berhasil dihapus!</b></font>
			</div>');
		redirect('laboratorium/dataAntigen');
	}

	public function lapCariData()
	{
		$data['title'] 		= "Antigen";
		$data['subtitle'] 	= "Search";

		$this->load->view('templates/header', $data);
		$this->load->view('laboratorium/vMenu', $data);
		$this->load->view('laboratorium/antigen/vLapDataAntigen', $data);
		$this->load->view('templates/footer', $data);
	}

	public function lapCariDataAksi()
	{
		$data['title'] 		= "Antigen";
		$data['subtitle'] 	= "Search";

		$awal 				= $this->input->post('awal');
		$akhir 				= $this->input->post('akhir');
		$data['awal'] 		= $awal;
		$data['akhir'] 		= $akhir;
		$data['antigen'] 	= $this->mSimetris->ExcelDataAntigen($awal, $akhir)->result();

		$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4"><b>Data berhasil ditampilkan!</b></font>
			</div>');

		$this->load->view('templates/header', $data);
		$this->load->view('laboratorium/vMenu', $data);
		$this->load->view('laboratorium/antigen/vLapDataAntigen', $data);
		$this->load->view('templates/footer', $data);
	}

	public function excelData()
	{
		$data['title'] 		= "Antigen";
		$data['subtitle'] 	= "Excel";

		$awal 				= $this->input->post('awal');
		$akhir 				= $this->input->post('akhir');
		$data['awal'] 		= $awal;
		$data['akhir'] 		= $akhir;
		$data['antigen'] 	= $this->mSimetris->ExcelDataAntigen($awal, $akhir)->result();

		$this->load->view('templates/header', $data);
		$this->load->view('laboratorium/vMenu', $data);
		$this->load->view('laboratorium/antigen/vExcelDataAntigen', $data);
		$this->load->view('templates/footer', $data);
	}
}
