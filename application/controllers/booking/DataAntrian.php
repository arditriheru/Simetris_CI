<?php

class dataAntrian extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('login') != '1') {
			$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<font size="4">Anda belum login!</font>
				</div>');
			redirect('booking/login');
		}

		$this->load->model("mSimetris");
		$this->load->library('form_validation');
	}

	public function filterDataAntrian($id)
	{
		if ($id == 1) {
			$data['title'] 		= "Antrian";
			$data['subtitle'] 	= "Pasien";
		} else {

			$data['title'] 		= "Rekap";
			$data['subtitle'] 	= "Data";
		}

		$data['id']			= $id;
		$where 				= array('status' => 1);
		$data['datadokter'] = $this->mSimetris->dataDokter("dokter.id_dokter AS id_dokter, dokter.nama_dokter AS nama_dokter", "dokter", $where, "nama_dokter ASC")->result();
		$data['datasesi'] 	= $this->mSimetris->getData("sesi")->result();

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vFilterAntrian', $data);
		$this->load->view('templates/footer', $data);
	}

	public function filterDataAntrianAksi($id)
	{
		if ($id == 1) {

			$unset_session = array(

				'id_dokter',
				'id_sesi',
				'jadwal',
				'konter',
			);

			$this->session->unset_userdata($unset_session);

			$id_dokter 			= $this->input->post('id_dokter');
			$id_sesi 			= $this->input->post('id_sesi');
			$konter 			= $this->input->post('konter');
			$tanggal 			= getDateNow();
			$jam 				= getTimenow();
			$booking_tanggal 	= getDateNow();

			$where = array(
				'id_dokter' 		=> $id_dokter,
				'id_sesi' 			=> $id_sesi,
				'booking_tanggal' 	=> $booking_tanggal,
			);
			$cek = $this->mSimetris->countData("booking", $where);

			if ($cek > 0) {
				$where1 = array('id_dokter' => $id_dokter);
				$select = $this->mSimetris->selectData('dokter', 'id_unit', $where1)->result();
				foreach ($select as $d) {
					$id_unit = $d->id_unit;
				}

				$where2 = array(
					'id_unit' 	=> $id_unit,
					'konter' 	=> $konter,
				);
				$this->mSimetris->deleteData('antrian', $where2);

				$data = array(

					'id_dokter' => $id_dokter,
					'id_unit' 	=> $id_unit,
					'id_sesi' 	=> $id_sesi,
					'tanggal' 	=> $tanggal,
					'jam' 		=> $jam,
					'konter' 	=> $konter,

				);

				$this->mSimetris->insertData('antrian', $data);

				$antdata = array(
					'id_dokter'  		=> $id_dokter,
					'id_sesi'     		=> $id_sesi,
					'id_unit'     		=> $id_unit,
					'booking_tanggal'  	=> $booking_tanggal,
					'konter'     		=> $konter,
				);

				$this->session->set_userdata($antdata);

				$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<font size="4">Data berhasil ditampilkan</font>
					</div>');

				redirect('booking/dataAntrian/dataAntrian');
			} else {

				$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<font size="4">Jadwal kosong, data tidak ditemukan</font>
					</div>');

				redirect('booking/dataAntrian/filterDataAntrian/1');
			}
		} else {

			$data['title'] 		= "Rekap";
			$data['subtitle'] 	= "Data";

			$id_unit 		= $this->input->post('id_unit');
			$awal 			= $this->input->post('awal');
			$akhir 			= $this->input->post('akhir');

			$data['awal']	= $awal;
			$data['akhir']	= $akhir;

			$data['data'] 	= $this->mSimetris->dataWaktuTungguPoli($id_unit, $awal, $akhir)->result();

			$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<font size="4">Data berhasil ditampilkan</font>
				</div>');

			$this->load->view('templates/header', $data);
			$this->load->view('booking/vMenu', $data);
			$this->load->view('booking/vDataWaktuTungguPoli', $data);
			$this->load->view('templates/footer', $data);
		}
	}

	public function dataAntrian()
	{
		$data['title'] 			= "Antrian";

		$booking_tanggal 		= $this->session->userdata('booking_tanggal');
		$id_sesi 				= $this->session->userdata('id_sesi');
		$id_dokter 				= $this->session->userdata('id_dokter');

		$data['dataantrian'] 	= $this->mSimetris->dataAntrian($id_dokter, $id_sesi, $booking_tanggal)->result();
		$data['total'] 			= $this->mSimetris->dataAntrian($id_dokter, $id_sesi, $booking_tanggal)->num_rows();
		$title 					= $this->mSimetris->dataAntrian($id_dokter, $id_sesi, $booking_tanggal)->result();

		foreach ($title as $d) {
			$data['subtitle'] = $d->nama_dokter;
			$id_unit = $d->id_unit;
		}

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vDataAntrian', $data);
		$this->load->view('templates/footer', $data);
	}

	public function aktifAksi($id)
	{
		$booking_tanggal 	= $this->session->userdata('booking_tanggal');
		$id_sesi 			= $this->session->userdata('id_sesi');
		$id_dokter 			= $this->session->userdata('id_dokter');

		$data1 = array('aktif' => '0');
		$where1 = array(
			'aktif' 			=> '1',
			'booking_tanggal' 	=> $booking_tanggal,
			'id_sesi' 			=> $id_sesi,
			'id_dokter' 		=> $id_dokter,
		);

		$data2 	= array('aktif' => '1');
		$where2 = array('id_booking' => $id);

		$this->mSimetris->updateData('booking', $data1, $where1);
		$this->mSimetris->updateData('booking', $data2, $where2);

		$datapanggil = $this->mSimetris->dataPanggil($id, $id_dokter, $id_sesi, $booking_tanggal)->result();

		foreach ($datapanggil as $d) {
			$noant = $d->noant;
		}

		$tcounter = array(
			'tcounter'  => $noant,
		);

		$this->session->set_userdata($tcounter);

		redirect('booking/dataAntrian/dataAntrian');
	}

	public function selesaiAntrian()
	{
		$id_dokter 			= $this->session->userdata('id_dokter');
		$id_sesi 			= $this->session->userdata('id_sesi');

		$where = array(

			'id_dokter' => $id_dokter,
			'id_sesi' 	=> $id_sesi,

		);

		$this->mSimetris->deleteData('antrian', $where);

		$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4">Antrian diakhiri</font>
			</div>');
		redirect('booking/dataAntrian/filterDataAntrian/1');
	}

	public function dilayaniMulai($id)
	{
		$getTimenow = getTimenow();
		$data 		= array('mulai' => $getTimenow);
		$where 		= array('id_booking' => $id);

		$this->mSimetris->updateData('booking', $data, $where);
		redirect('booking/dataAntrian/dataAntrian/' . $id);
	}

	public function dilayaniAkhir($id)
	{
		$getTimenow = getTimenow();
		$data 		= array('akhir' => $getTimenow);
		$where 		= array('id_booking' => $id);

		$this->mSimetris->updateData('booking', $data, $where);
		redirect('booking/dataAntrian/dataAntrian/' . $id);
	}

	public function excelData()
	{
		$id_dokter 			= $this->input->get('dokter');
		$id_sesi 			= $this->input->get('sesi');
		$booking_tanggal	= getDateNow();

		$where1 			= array('id_dokter' => $id_dokter);
		$nama_dokter 		= $this->mSimetris->selectData("dokter", "nama_dokter", $where1)->result();

		foreach ($nama_dokter as $d) {
			$data['nama_dokter'] = $d->nama_dokter;
		}

		$where2 			= array(
			'id_dokter' 		=> $id_dokter,
			'id_sesi' 			=> $id_sesi,
			'booking_tanggal' 	=> $booking_tanggal,
		);
		$data['data'] 		= $this->mSimetris->selectData("booking", "id_catatan_medik,nama,mulai,akhir", $where2)->result();

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vExcelDataJamLayanan', $data);
		$this->load->view('templates/footer', $data);
	}
}
