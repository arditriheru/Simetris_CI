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

		$data['data'] = $this->db->query("
			SELECT *, lab_trn.id_register AS no_reg, lab_trn.tanggal AS tgl_kunj, lab_trn.jam AS jam_kunj, mr_pasien.nama AS nama_pasien, mr_unit.nama_unit
			FROM lab_trn
			JOIN mr_pasien
			ON lab_trn.id_catatan_medik = mr_pasien.id_catatan_medik
			JOIN mr_unit
			ON lab_trn.id_unit = mr_unit.id_unit
			WHERE lab_trn.id_register= '$id'
			")->result();

		$this->load->view('templates/header',$data);
		$this->load->view('laboratorium/vMenu',$data);
		$this->load->view('laboratorium/asuransi/vDataAsuransi',$data);
		$this->load->view('templates/footer',$data);
	}

	// public function cariDetailData()
	// {
	// 	$data['title'] 		= "Invoice";
	// 	$data['subtitle'] 	= "Pemeriksaan";

	// 	$id 				= $this->input->post('id');

	// 	$biodata = $this->db->query("
	// 		SELECT lab_det_trn.id_catatan_medik, lab_det_trn.id_lab_tarif, lab_det_trn.qty, mr_pasien.nama AS nama_pasien, lab_tarif.nama AS pemeriksaan, lab_tarif.tarif, lab_trn.id_dokter, mr_dokter.nama_dokter, mr_pasien.tgl_lahir, mr_pasien.alamat, lab_trn.tanggal,lab_trn.jam,
	// 		IF (mr_pasien.sex='1', 'Laki-laki', 'Perempuan') AS nama_sex
	// 		FROM lab_det_trn
	// 		JOIN lab_tarif
	// 		ON lab_det_trn.id_lab_tarif = lab_tarif.id_lab_tarif
	// 		JOIN mr_pasien
	// 		ON lab_det_trn.id_catatan_medik = mr_pasien.id_catatan_medik
	// 		JOIN lab_trn
	// 		ON lab_det_trn.id_lab_trn = lab_trn.id_lab_trn
	// 		JOIN mr_dokter
	// 		ON lab_trn.id_dokter = mr_dokter.id_dokter
	// 		WHERE lab_det_trn.id_register = '$id'
	// 		")->result();

	// 	$data['data'] = $this->db->query("
	// 		SELECT lab_det_trn.id_catatan_medik, lab_det_trn.id_lab_tarif, lab_det_trn.qty, mr_pasien.nama AS nama_pasien, lab_tarif.nama AS pemeriksaan, lab_tarif.tarif, lab_trn.id_dokter, mr_dokter.nama_dokter, mr_pasien.tgl_lahir, mr_pasien.alamat, lab_trn.tanggal,lab_trn.jam,
	// 		IF (mr_pasien.sex='1', 'Laki-laki', 'Perempuan') AS nama_sex
	// 		FROM lab_det_trn
	// 		JOIN lab_tarif
	// 		ON lab_det_trn.id_lab_tarif = lab_tarif.id_lab_tarif
	// 		JOIN mr_pasien
	// 		ON lab_det_trn.id_catatan_medik = mr_pasien.id_catatan_medik
	// 		JOIN lab_trn
	// 		ON lab_det_trn.id_lab_trn = lab_trn.id_lab_trn
	// 		JOIN mr_dokter
	// 		ON lab_trn.id_dokter = mr_dokter.id_dokter
	// 		WHERE lab_det_trn.id_register = '$id'
	// 		")->result();

	// 	foreach ($biodata as $d) {
	// 		$data['id_catatan_medik'] 	= $d->id_catatan_medik;
	// 		$data['nama_sex'] 			= $d->nama_sex;
	// 		$data['nama_pasien'] 		= $d->nama_pasien;
	// 		$data['alamat'] 			= $d->alamat;
	// 		$data['tgl_lahir'] 			= $d->tgl_lahir;
	// 		$data['nama_dokter'] 		= $d->nama_dokter;
	// 		$data['tanggal'] 			= $d->tanggal;
	// 		$data['jam'] 				= $d->jam;
	// 	}

	// 	$this->load->view('templates/print',$data);
	// 	$this->load->view('laboratorium/asuransi/vPrintDataAsuransi',$data);
	// 	$this->load->view('templates/footer',$data);
	// }

	public function printData($id)
	{
		$data['title'] 		= "Detail";
		$data['subtitle'] 	= "Pemeriksaan";

		$biodata = $this->db->query("
			SELECT *, mr_pasien.nama AS nama_pasien, lab_tarif.nama AS pemeriksaan, mr_dokter.nama_dokter,
			IF (mr_pasien.sex='1', 'Laki-laki', 'Perempuan') AS nama_sex
			FROM lab_det_trn
			JOIN lab_trn
			ON lab_det_trn.id_lab_trn = lab_trn.id_lab_trn
			JOIN mr_pasien
			ON lab_det_trn.id_catatan_medik = mr_pasien.id_catatan_medik
			JOIN lab_tarif
			ON lab_det_trn.id_lab_tarif = lab_tarif.id_lab_tarif
			JOIN mr_dokter
			ON lab_trn.id_dokter = mr_dokter.id_dokter
			WHERE lab_det_trn.id_lab_trn = '$id'
			AND !lab_det_trn.harga=0
			")->result();

		$data['data'] = $this->db->query("
			SELECT *, mr_pasien.nama AS nama_pasien, lab_tarif.nama AS pemeriksaan, mr_dokter.nama_dokter,
			IF (mr_pasien.sex='1', 'Laki-laki', 'Perempuan') AS nama_sex
			FROM lab_det_trn
			JOIN lab_trn
			ON lab_det_trn.id_lab_trn = lab_trn.id_lab_trn
			JOIN mr_pasien
			ON lab_det_trn.id_catatan_medik = mr_pasien.id_catatan_medik
			JOIN lab_tarif
			ON lab_det_trn.id_lab_tarif = lab_tarif.id_lab_tarif
			JOIN mr_dokter
			ON lab_trn.id_dokter = mr_dokter.id_dokter
			WHERE lab_det_trn.id_lab_trn = '$id'
			AND !lab_det_trn.harga=0
			")->result();

		foreach ($biodata as $d) {
			$data['id_catatan_medik'] 	= $d->id_catatan_medik;
			$data['nama_sex'] 			= $d->nama_sex;
			$data['nama_pasien'] 		= $d->nama_pasien;
			$data['alamat'] 			= $d->alamat;
			$data['tgl_lahir'] 			= $d->tgl_lahir;
			$data['nama_dokter'] 		= $d->nama_dokter;
			$data['tanggal'] 			= $d->tanggal;
			$data['jam'] 				= $d->jam;
		}
		$this->load->view('templates/print',$data);
		$this->load->view('laboratorium/asuransi/vPrintDataAsuransi',$data);
		$this->load->view('templates/footer',$data);

	}

}

?>