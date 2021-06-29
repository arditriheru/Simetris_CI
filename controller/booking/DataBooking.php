<?php

class dataBooking extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('login') != '1') {
			$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
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
		$data['title'] 		= "Dashboard";
		$data['subtitle'] 	= "Poliklinik";

		$getDateNow = getDateNow();

		$where1 = array('booking_tanggal' => $getDateNow);
		$where2 = array('jadwal' => $getDateNow);
		$data['totaldatapoli'] 		= $this->mSimetris->countData("booking", $where1);
		$data['totaldatatumbang'] 	= $this->mSimetris->countData("tumbang", $where2);
		$data['totaldataanc'] 		= $this->mSimetris->countData("anc", $where2);
		$data['dokterpoli'] 		= $this->mSimetris->dataDokterPoli($where1)->result();
		$data['doktertumbang'] 		= $this->mSimetris->dataDokterTumbang($where2)->result();
		$data['dokteranc'] 			= $this->mSimetris->dataDokterAnc($where2)->result();
		$data['poli'] 				= $this->mSimetris->dataPoli($where1, "booking.id_sesi, dokter.nama_dokter, booking.id_booking ASC")->result();
		$data['tumbang'] 			= $this->mSimetris->dataTumbang($where2)->result();
		$data['anc'] 				= $this->mSimetris->dataAnc($where2)->result();

		// autodelete
		$this->db->query("DELETE FROM booking WHERE DATEDIFF(CURDATE(), booking_tanggal) > 62");
		$this->db->query("DELETE FROM anc WHERE DATEDIFF(CURDATE(), jadwal) > 62");
		$this->db->query("DELETE FROM tumbang WHERE DATEDIFF(CURDATE(), jadwal) > 62");
		$this->db->query("DELETE FROM dokter_jadwal_libur WHERE DATEDIFF(CURDATE(), tanggal) > 1");

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vDataBooking', $data);
		$this->load->view('templates/footer', $data);
	}

	public function ubahDatangPoli($id)
	{
		$data = array('status' => '1');
		$where = array('id_booking' => $id);

		$this->mSimetris->updateData('booking', $data, $where);
		redirect('booking/dataBooking/');
	}

	public function ubahBelumDatangPoli($id)
	{
		$data = array('status' => '2');
		$where = array('id_booking' => $id);

		$this->mSimetris->updateData('booking', $data, $where);
		redirect('booking/dataBooking/');
	}

	public function ubahDatangTumbang($id)
	{
		$data = array('status' => '1');
		$where = array('id_tumbang' => $id);

		$this->mSimetris->updateData('tumbang', $data, $where);
		redirect('booking/dataBooking/');
	}

	public function ubahBelumDatangTumbang($id)
	{
		$data = array('status' => '0');
		$where = array('id_tumbang' => $id);

		$this->mSimetris->updateData('tumbang', $data, $where);
		redirect('booking/dataBooking/');
	}

	public function ubahDatangAnc($id)
	{
		$data = array('status' => '1');
		$where = array('id_anc' => $id);

		$this->mSimetris->updateData('anc', $data, $where);
		redirect('booking/dataBooking/');
	}

	public function ubahBelumDatangAnc($id)
	{
		$data = array('status' => '0');
		$where = array('id_anc' => $id);

		$this->mSimetris->updateData('anc', $data, $where);
		redirect('booking/dataBooking/');
	}

	public function detailDataPoli($id)
	{
		$data['title'] 		= "Detail";
		$data['subtitle'] 	= "Poliklinik";

		$where = array(
			'id_booking' => $id
		);

		$data['poli'] 		= $this->mSimetris->dataPoli($where, "booking.id_booking ASC")->result();
		$poli 				= $this->mSimetris->dataPoli($where, "booking.id_booking ASC")->result();

		foreach ($poli as $d) {
			$id_catatan_medik	= $d->id_catatan_medik;
			$booking_tanggal 	= $d->booking_tanggal;
			$id_dokter 			= $d->id_dokter;
			$id_sesi 			= $d->id_sesi;
		}

		$data['dataalergi']		= $this->mSimetris->dataAlergi($id_catatan_medik)->result();
		$result					= $this->mSimetris->dataPanggil($id, $id_dokter, $id_sesi, $booking_tanggal)->result();

		foreach ($result as $d) {
			$data['noant'] = $d->noant;
		}


		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vDataDetailPoli', $data, $id);
		$this->load->view('templates/footer', $data);
	}

	public function detailDataTumbang($id)
	{
		$data['title'] 		= "Detail";
		$data['subtitle'] 	= "Tumbuh Kembang";

		$where = array("id_tumbang" => $id);
		$data['tumbang'] = $this->mSimetris->detailDataTumbang("tumbang", $where)->result();

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vDataDetailTumbang', $data, $id);
		$this->load->view('templates/footer', $data);
	}

	public function detailDataAnc($id)
	{
		$data['title'] 		= "Detail";
		$data['subtitle'] 	= "ANC";

		$where = array("id_anc" => $id);
		$data['anc'] = $this->mSimetris->detailDataAnc("anc", $where)->result();

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vDataDetailAnc', $data, $id);
		$this->load->view('templates/footer', $data);
	}

	public function updateDataPoli($id)
	{
		$data['title'] 		= "Update";
		$data['subtitle'] 	= "Poliklinik";

		$where = array(
			'id_booking' => $id
		);

		$data['datapoli'] = $this->mSimetris->dataPoli($where, "booking.id_booking ASC")->result();

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vUpdateDataPoli', $data);
		$this->load->view('templates/footer', $data);
	}

	public function updateDataPoliAksi()
	{
		$id 		= $this->input->post('id');
		$nama 		= $this->input->post('nama');
		$alamat 	= $this->input->post('alamat');
		$kontak 	= $this->input->post('kontak');
		$keterangan = $this->input->post('keterangan');

		$data = array(

			'nama' 		 => $nama,
			'alamat' 	 => $alamat,
			'kontak' 	 => $kontak,
			'keterangan' => $keterangan,

		);

		$where = array(
			'id_booking' 		=> $id
		);

		$this->mSimetris->updateData('booking', $data, $where);
		$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4">Data berhasil diupdate</font>
			</div>');
		redirect('booking/dataBooking/detailDataPoli/' . $id);
	}

	public function deleteDataPoli($id)
	{
		$where = array('id_booking' => $id);
		$this->mSimetris->deleteData('booking', $where);
		$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4">Data berhasil dihapus</font>
			</div>');
		redirect('booking/dataBooking');
	}

	public function deleteDataTumbang($id)
	{
		$where = array('id_tumbang' => $id);
		$this->mSimetris->deleteData('tumbang', $where);
		$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4">Data berhasil dihapus</font>
			</div>');
		redirect('booking/dataBooking');
	}

	public function deleteDataAnc($id)
	{
		$where = array('id_anc' => $id);
		$this->mSimetris->deleteData('anc', $where);
		$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4">Data berhasil dihapus</font>
			</div>');
		redirect('booking/dataBooking');
	}

	public function tabDataPoli($id)
	{
		$data['title'] 		= "Tab";
		$data['subtitle'] 	= "Poliklinik";

		$getDateNow = getDateNow();

		$where = array('booking_tanggal' => $getDateNow);

		$where1 = array(
			'id_dokter' 				=> $id,
			'booking_tanggal' 			=> $getDateNow
		);

		$where2 = array(
			'id_dokter' 				=> $id,
			'id_sesi' 					=> 1,
			'booking_tanggal' 			=> $getDateNow
		);

		$where3 = array(
			'id_dokter' 				=> $id,
			'id_sesi' 					=> 2,
			'booking_tanggal' 			=> $getDateNow
		);

		$where4 = array(
			'id_dokter' 				=> $id,
			'id_sesi'					=> 3,
			'booking_tanggal' 			=> $getDateNow
		);

		$where5 = array(
			'id_dokter' 				=> $id,
			'id_sesi' 					=> 4,
			'booking_tanggal' 			=> $getDateNow
		);


		$where6 = array(
			'booking.id_dokter' 		=> $id,
			'booking.booking_tanggal' 	=> $getDateNow,
		);

		$where7 = array(
			'booking.id_dokter' 		=> $id,
			'booking.id_sesi' 			=> 1,
			'booking.booking_tanggal' 	=> $getDateNow,
		);

		$where8 = array(
			'booking.id_dokter' 		=> $id,
			'booking.id_sesi' 			=> 2,
			'booking.booking_tanggal' 	=> $getDateNow,
		);

		$where9 = array(
			'booking.id_dokter' 		=> $id,
			'booking.id_sesi' 			=> 3,
			'booking.booking_tanggal' 	=> $getDateNow,
		);

		$where10 = array(
			'booking.id_dokter' 		=> $id,
			'booking.id_sesi' 			=> 4,
			'booking.booking_tanggal' 	=> $getDateNow,
		);

		$data['dokterpoli'] 	= $this->mSimetris->dataDokterPoli($where)->result();
		$data['totaldatapoli'] 	= $this->mSimetris->countData("booking", $where1);
		$data['totaldatapoli1'] = $this->mSimetris->countData("booking", $where2);
		$data['totaldatapoli2'] = $this->mSimetris->countData("booking", $where3);
		$data['totaldatapoli3'] = $this->mSimetris->countData("booking", $where4);
		$data['totaldatapoli4'] = $this->mSimetris->countData("booking", $where5);
		$data['poli'] 			= $this->mSimetris->tabDataPoli($where6)->result();
		$data['poli1'] 			= $this->mSimetris->tabDataPoli($where7)->result();
		$data['poli2'] 			= $this->mSimetris->tabDataPoli($where8)->result();
		$data['poli3'] 			= $this->mSimetris->tabDataPoli($where9)->result();
		$data['poli4'] 			= $this->mSimetris->tabDataPoli($where10)->result();

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vDataTabPoli', $data, $id);
		$this->load->view('templates/footer', $data);
	}

	public function dataRegister()
	{
		$data['title'] 		= "Registrasi";
		$data['subtitle'] 	= "Poliklinik";

		$getDateNow 		= getDateNow();
		$where1 			= array('booking.tanggal' 	=> $getDateNow);
		$where2 			= array('tumbang.tanggal' 	=> $getDateNow);
		$where3 			= array('anc.tanggal' 		=> $getDateNow);
		$where4 			= array('booking.tanggal' 	=> $getDateNow, 'booking.mandiri' => 1);
		$data['poli'] 		= $this->mSimetris->dataRegisterPoli($where1)->result();
		$data['tumbang'] 	= $this->mSimetris->dataRegisterTumbang($where2)->result();
		$data['anc'] 		= $this->mSimetris->dataRegisterAnc($where3)->result();
		$data['mandiri'] 	= $this->mSimetris->dataRegisterPoli($where4)->result();
		$data['jmlpoli'] 	= $this->mSimetris->dataRegisterPoli($where1)->num_rows();
		$data['jmltumbang'] = $this->mSimetris->dataRegisterTumbang($where2)->num_rows();
		$data['jmlanc'] 	= $this->mSimetris->dataRegisterAnc($where3)->num_rows();
		$data['jmlmandiri'] = $this->mSimetris->dataRegisterPoli($where4)->num_rows();

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vDataRegister', $data);
		$this->load->view('templates/footer', $data);
	}

	// proses tambah data booking poliklinik

	public function tambahDataPoli($id)
	{
		$data['id'] 		= $id;

		if ($id == 1) {
			$data['title'] 	= "Lihat";
		} else {
			$data['title'] 	= "Tambah";
		}

		$data['subtitle'] 	= "Poliklinik";
		$where 				= array('status' => 1);
		$data['datadokter'] = $this->mSimetris->dataDokter("dokter.id_dokter AS id_dokter, dokter.nama_dokter AS nama_dokter", "dokter", $where, "nama_dokter ASC")->result();
		$data['datasesi'] 	= $this->mSimetris->getData("sesi")->result();
		$data['record'] 	= $this->mSimetris->getData('mr_pasien');

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vTambahDataPoli', $data);
		$this->load->view('templates/footer', $data);
	}

	public function tambahDataPoliRm()
	{
		$data['title'] 		= "Tambah";
		$data['subtitle'] 	= "Poliklinik";

		$id 				= $this->input->get('rm');
		$where 				= array('id_catatan_medik' => $id);
		$data['datapasien'] = $this->mSimetris->selectData('mr_pasien', '*', $where)->result();
		$where 				= array('status' => 1);
		$data['datadokter'] = $this->mSimetris->datadokter("dokter.id_dokter AS id_dokter, dokter.nama_dokter AS nama_dokter", "dokter", $where, "nama_dokter ASC")->result();
		$data['datasesi'] 	= $this->mSimetris->getdata("sesi")->result();
		$data['record'] 	= $this->mSimetris->getData('mr_pasien');

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vTambahDataPoliRm', $data);
		$this->load->view('templates/footer', $data);
	}

	public function tambahDataPoliCariNm()
	{
		$data['title'] 		= "Tambah";
		$data['subtitle'] 	= "Poliklinik";

		$id 				= $this->input->get('nm');
		$keyword 			= array('nama' => $id);
		$data['caripasien'] = $this->mSimetris->cariNamaPasienData('mr_pasien', $keyword)->result();

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vTambahDataPoliCariNm', $data);
		$this->load->view('templates/footer', $data);
	}

	public function tambahDataPoliNm($id)
	{
		$data['title'] 		= "Tambah";
		$data['subtitle'] 	= "Poliklinik";

		$where 				= array('id_catatan_medik' => $id);
		$data['datapasien'] = $this->mSimetris->selectData('mr_pasien', '*', $where)->result();
		$where 				= array('status' => 1);
		$data['datadokter'] = $this->mSimetris->datadokter("dokter.id_dokter AS id_dokter, dokter.nama_dokter AS nama_dokter", "dokter", $where, "nama_dokter ASC")->result();
		$data['datasesi'] 	= $this->mSimetris->getdata("sesi")->result();
		$data['record'] 	= $this->mSimetris->getData('mr_pasien');

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vTambahDataPoliNm', $data);
		$this->load->view('templates/footer', $data);
	}

	public function tambahDataPoliBaruAksi()
	{

		$id 			  = $this->input->post('id');
		$nama             = $this->input->post('nama');
		$alamat           = $this->input->post('alamat');
		$kontak           = $this->input->post('kontak');
		$id_catatan_medik = '0';
		$booking_tanggal  = $this->input->post('booking_tanggal');
		$tanggal          = getDatenow();
		$jam              = getTimenow();
		$status           = '2';
		$keterangan       = $this->input->post('keterangan');
		$id_dokter        = $this->input->post('id_dokter');
		$id_sesi          = $this->input->post('id_sesi');
		$mandiri          = '0';
		$antrian          = '0';
		$aktif 			  = '0';
		$tgl1      		  = new DateTime();
		$tgl2             = new DateTime("$booking_tanggal");
		$selisih          = $tgl1->diff($tgl2)->format("%a");

		if ($selisih > 30) {

			$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<font size="4">Lebih dari 30 hari</font></div>');
			redirect('booking/dataBooking/tambahDataPoli/' . $id);
		} else {

			$hari = date('w', strtotime($booking_tanggal));

			$where2 = array(
				'id_dokter' => $id_dokter,
				'id_sesi' 	=> $id_sesi,
				'hari' 		=> $hari,
			);

			$cekjadwal = $this->mSimetris->countData('dokter_jadwal', $where2);

			if ($cekjadwal > 0) {

				$where3 = array(
					'id_dokter' => $id_dokter,
					'id_sesi' 	=> $id_sesi,
					'tanggal' 	=> $booking_tanggal,
				);

				$ceklibur = $this->mSimetris->countData('dokter_jadwal_libur', $where3);

				if ($ceklibur > 0) {

					$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<font size="4">Jadwal Dokter Cuti</font></div>');
					redirect('booking/dataBooking/tambahDataPoli/' . $id);
				} else {

					$hari = date('w', strtotime($booking_tanggal));

					$where4 = array(
						'booking_tanggal' 	=> $booking_tanggal,
						'id_dokter' 		=> $id_dokter,
						'id_sesi' 			=> $id_sesi,
					);

					$count = $this->mSimetris->countData('booking', $where4);
					$noant = $count + 1;

					$where5 = array(
						'id_dokter' => $id_dokter,
						'id_sesi' 	=> $id_sesi,
						'hari' 		=> $hari,
					);

					$kuota = $this->mSimetris->selectData('dokter_jadwal', 'kuota', $where5);
					foreach ($kuota->result() as $d) {
						$cekkuota = $d->kuota;
					}

					if ($noant > $cekkuota) {

						$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<font size="4">Kuota Penuh</font></div>');
						redirect('booking/dataBooking/tambahDataPoli/' . $id);
					} else {

						$data = array(

							'nama' 				=> $nama,
							'alamat' 			=> $alamat,
							'kontak' 			=> $kontak,
							'id_catatan_medik' 	=> $id_catatan_medik,
							'booking_tanggal' 	=> $booking_tanggal,
							'tanggal' 			=> $tanggal,
							'jam' 				=> $jam,
							'status' 			=> $status,
							'keterangan' 		=> $keterangan,
							'id_dokter' 		=> $id_dokter,
							'id_sesi' 			=> $id_sesi,
							'mandiri' 			=> $mandiri,
							'antrian' 			=> $antrian,
							'aktif' 			=> $aktif,
						);

						$this->mSimetris->insertData('booking', $data);
						$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>Berhasil mendaftar </strong><font size="4"><b>Nomor Antrian : 
							' . $noant . '</b></font></div>');
						redirect('booking/dataBooking/tambahDataPoli/' . $id);
					}
				}
			} else {

				$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<font size="4">Jadwal Dokter Kosong</font></div>');
				redirect('booking/dataBooking/tambahDataPoli/' . $id);
			}
		}
	}

	public function tambahDataPoliLamaAksi()
	{

		$id 			  = '2';
		$nama             = $this->input->post('nama');
		$alamat           = $this->input->post('alamat');
		$kontak           = $this->input->post('kontak');
		$id_catatan_medik = $this->input->post('id_catatan_medik');
		$booking_tanggal  = $this->input->post('booking_tanggal');
		$tanggal          = getDatenow();
		$jam              = getTimenow();
		$status           = '2';
		$keterangan       = $this->input->post('keterangan');
		$id_dokter        = $this->input->post('id_dokter');
		$id_sesi          = $this->input->post('id_sesi');
		$mandiri          = '0';
		$antrian          = '0';
		$aktif 			  = '0';
		$tgl1      		  = new DateTime();
		$tgl2             = new DateTime("$booking_tanggal");
		$selisih          = $tgl1->diff($tgl2)->format("%a");

		if ($selisih > 30) {

			$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<font size="4">Lebih dari 30 hari</font></div>');
			redirect('booking/dataBooking/tambahDataPoli/' . $id);
		} else {

			$where1 = array(
				'id_catatan_medik' 	=> $id_catatan_medik,
				'booking_tanggal' 	=> $booking_tanggal,
			);

			$cekdaftar = $this->mSimetris->countData('booking', $where1);

			if ($cekdaftar > 0) {

				$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<font size="4">Sudah Mendaftar Sebelumnya</font></div>');
				redirect('booking/dataBooking/tambahDataPoli/' . $id);
			} else {

				$hari = date('w', strtotime($booking_tanggal));

				$where2 = array(
					'id_dokter' => $id_dokter,
					'id_sesi' 	=> $id_sesi,
					'hari' 		=> $hari,
				);

				$cekjadwal = $this->mSimetris->countData('dokter_jadwal', $where2);

				if ($cekjadwal > 0) {

					$where3 = array(
						'id_dokter' => $id_dokter,
						'id_sesi' 	=> $id_sesi,
						'tanggal' 	=> $booking_tanggal,
					);

					$ceklibur = $this->mSimetris->countData('dokter_jadwal_libur', $where3);

					if ($ceklibur > 0) {

						$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<font size="4">Jadwal Dokter Cuti</font></div>');
						redirect('booking/dataBooking/tambahDataPoli/' . $id);
					} else {

						$hari = date('w', strtotime($booking_tanggal));

						$where4 = array(
							'booking_tanggal' 	=> $booking_tanggal,
							'id_dokter' 		=> $id_dokter,
							'id_sesi' 			=> $id_sesi,
						);

						$count = $this->mSimetris->countData('booking', $where4);
						$noant = $count + 1;

						$where5 = array(
							'id_dokter' => $id_dokter,
							'id_sesi' 	=> $id_sesi,
							'hari' 		=> $hari,
						);

						$kuota = $this->mSimetris->selectData('dokter_jadwal', 'kuota', $where5);
						foreach ($kuota->result() as $d) {
							$cekkuota = $d->kuota;
						}

						if ($noant > $cekkuota) {

							$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<font size="4">Kuota Penuh</font></div>');
							redirect('booking/dataBooking/tambahDataPoli/' . $id);
						} else {

							$data = array(

								'nama' 				=> $nama,
								'alamat' 			=> $alamat,
								'kontak' 			=> $kontak,
								'id_catatan_medik' 	=> $id_catatan_medik,
								'booking_tanggal' 	=> $booking_tanggal,
								'tanggal' 			=> $tanggal,
								'jam' 				=> $jam,
								'status' 			=> $status,
								'keterangan' 		=> $keterangan,
								'id_dokter' 		=> $id_dokter,
								'id_sesi' 			=> $id_sesi,
								'mandiri' 			=> $mandiri,
								'antrian' 			=> $antrian,
								'aktif' 			=> $aktif,
							);

							$this->mSimetris->insertData('booking', $data);
							$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Berhasil mendaftar </strong><font size="4"><b>Nomor Antrian : 
								' . $noant . '</b></font></div>');
							redirect('booking/dataBooking/tambahDataPoli/' . $id);
						}
					}
				} else {

					$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<font size="4">Jadwal Dokter Kosong</font></div>');
					redirect('booking/dataBooking/tambahDataPoli/' . $id);
				}
			}
		}
	}

	public function cariDataPoliAksi()
	{
		$id_dokter 			= $this->input->post('id_dokter');
		$id_sesi 			= $this->input->post('id_sesi');
		$booking_tanggal 	= $this->input->post('booking_tanggal');

		$where = array(
			'booking.id_dokter' 		=> $id_dokter,
			'booking.id_sesi' 			=> $id_sesi,
			'booking.booking_tanggal' 	=> $booking_tanggal,
		);

		$data['booking'] 		= $this->mSimetris->dataPoli($where, "booking.id_booking ASC")->result();

		if (isset($id_dokter)) {
			$data['title'] 		= $this->mSimetris->dataPoli($where, "booking.id_booking ASC")->num_rows() . " Pasien";
			$data['subtitle'] 	= formatDateIndo($booking_tanggal);
		}

		$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4">Data berhasil ditampilkan</font>
			</div>');

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vTambahDataPoli', $data);
		$this->load->view('templates/footer', $data);
	}

	// proses tambah data booking tumbuh kembang

	public function tambahDataTumbang($id)
	{
		$data['id'] = $id;

		if ($id == 1) {
			$data['title'] 		= "Lihat";
		} else {
			$data['title'] 		= "Tambah";
		}

		$data['subtitle'] 		= "Tumbuh Kembang";
		$where 					= array('status' => 1);
		$data['datapetugas'] 	= $this->mSimetris->datapetugas("mr_petugas.id_petugas AS id_petugas, mr_petugas.nama_petugas AS nama_petugas", "mr_petugas", $where, "nama_petugas ASC")->result();
		$data['datasesi'] 		= $this->mSimetris->getData("sesi")->result();
		$data['record'] 		= $this->mSimetris->getData('mr_pasien');

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vTambahDataTumbang', $data);
		$this->load->view('templates/footer', $data);
	}

	public function tambahDataTumbangRm()
	{
		$data['title'] 		= "Tambah";
		$data['subtitle'] 	= "Tumbuh Kembang";

		$id = $this->input->get('rm');

		$where = array('id_catatan_medik' => $id);

		$data['datapasien'] 	= $this->mSimetris->selectData('mr_pasien', '*', $where)->result();
		$where 					= array('status' => 1);
		$data['datapetugas'] 	= $this->mSimetris->datapetugas("mr_petugas.id_petugas AS id_petugas, mr_petugas.nama_petugas AS nama_petugas", "mr_petugas", $where, "nama_petugas ASC")->result();
		$data['datasesi'] 		= $this->mSimetris->getData("sesi")->result();
		$data['record'] 		= $this->mSimetris->getData('mr_pasien');

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vTambahDataTumbangRm', $data);
		$this->load->view('templates/footer', $data);
	}

	public function tambahDataTumbangCariNm()
	{
		$data['title'] 		= "Tambah";
		$data['subtitle'] 	= "Tumbuh Kembang";

		$id = $this->input->get('nm');

		$keyword = array('nama' => $id);

		$data['caripasien'] = $this->mSimetris->cariNamaPasienData('mr_pasien', $keyword)->result();

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vTambahDataTumbangCariNm', $data);
		$this->load->view('templates/footer', $data);
	}

	public function tambahDataTumbangNm($id)
	{
		$data['title'] 		= "Tambah";
		$data['subtitle'] 	= "Tumbuh Kembang";

		$where = array('id_catatan_medik' => $id);

		$data['datapasien'] 	= $this->mSimetris->selectData('mr_pasien', '*', $where)->result();
		$where 					= array('status' => 1);
		$data['datapetugas'] 	= $this->mSimetris->datapetugas("mr_petugas.id_petugas AS id_petugas, mr_petugas.nama_petugas AS nama_petugas", "mr_petugas", $where, "nama_petugas ASC")->result();
		$data['datasesi'] 		= $this->mSimetris->getData("sesi")->result();
		$data['record'] 		= $this->mSimetris->getData('mr_pasien');

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vTambahDataTumbangNm', $data);
		$this->load->view('templates/footer', $data);
	}

	public function cariDataTumbangAksi()
	{
		$id_petugas 		= $this->input->post('id_petugas');
		$id_sesi 			= $this->input->post('id_sesi');
		$jadwal 			= $this->input->post('jadwal');

		$where = array(
			'tumbang.id_petugas' => $id_petugas,
			'tumbang.id_sesi' 	 => $id_sesi,
			'tumbang.jadwal' 	 => $jadwal,
		);

		$data['tumbang'] 		= $this->mSimetris->dataTumbang($where)->result();

		if (isset($id_petugas)) {
			$data['title'] 		= $this->mSimetris->dataTumbang($where)->num_rows() . " Pasien";
			$data['subtitle'] 	= formatDateIndo($jadwal);
		}

		$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4">Data berhasil ditampilkan</font>
			</div>');

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vTambahDataTumbang', $data);
		$this->load->view('templates/footer', $data);
	}

	public function tambahDataTumbangBaruAksi()
	{

		$id 			  = '2';
		$nama             = $this->input->post('nama');
		$alamat           = $this->input->post('alamat');
		$kontak           = $this->input->post('kontak');
		$id_catatan_medik = '0';
		$jadwal 		  = $this->input->post('jadwal');
		$tanggal          = getDatenow();
		$jam              = getTimenow();
		$status           = '2';
		$keterangan       = $this->input->post('keterangan');
		$id_petugas       = $this->input->post('id_petugas');
		$id_sesi          = $this->input->post('id_sesi');
		$tgl1      		  = new DateTime();
		$tgl2             = new DateTime("$jadwal");
		$selisih          = $tgl1->diff($tgl2)->format("%a");

		if ($selisih > 30) {

			$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<font size="4">Lebih dari 30 hari</font></div>');
			redirect('booking/dataBooking/tambahDataTumbang/' . $id);
		} else {

			$where2 = array(
				'jadwal' 			=> $jadwal,
				'id_petugas' 		=> $id_petugas,
				'id_sesi' 			=> $id_sesi,
			);

			$count = $this->mSimetris->countData('tumbang', $where2);
			$noant = $count + 1;

			$data = array(

				'nama' 				=> $nama,
				'alamat' 			=> $alamat,
				'kontak' 			=> $kontak,
				'id_catatan_medik' 	=> $id_catatan_medik,
				'jadwal' 			=> $jadwal,
				'tanggal' 			=> $tanggal,
				'jam' 				=> $jam,
				'status' 			=> $status,
				'keterangan' 		=> $keterangan,
				'id_petugas' 		=> $id_petugas,
				'id_sesi' 			=> $id_sesi,

			);

			$this->mSimetris->insertData('tumbang', $data);
			$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Berhasil mendaftar </strong><font size="4"><b>Nomor Antrian : 
				' . $noant . '</b></font></div>');
			redirect('booking/dataBooking/tambahDataTumbang/' . $id);
		}
	}

	public function tambahDataTumbangLamaAksi()
	{

		$id 			  = '2';
		$nama             = $this->input->post('nama');
		$alamat           = $this->input->post('alamat');
		$kontak           = $this->input->post('kontak');
		$id_catatan_medik = $this->input->post('id_catatan_medik');
		$jadwal 		  = $this->input->post('jadwal');
		$tanggal          = getDatenow();
		$jam              = getTimenow();
		$status           = '2';
		$keterangan       = $this->input->post('keterangan');
		$id_petugas       = $this->input->post('id_petugas');
		$id_sesi          = $this->input->post('id_sesi');
		$tgl1      		  = new DateTime();
		$tgl2             = new DateTime("$jadwal");
		$selisih          = $tgl1->diff($tgl2)->format("%a");

		if ($selisih > 30) {

			$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<font size="4">Lebih dari 30 hari</font></div>');
			redirect('booking/dataBooking/tambahDataTumbang/' . $id);
		} else {

			$where1 = array(
				'id_catatan_medik' 	=> $id_catatan_medik,
				'id_petugas' 		=> $id_petugas,
				'jadwal' 			=> $jadwal,
				'id_sesi' 			=> $id_sesi,
			);

			$cekdaftar = $this->mSimetris->countData('tumbang', $where1);

			if ($cekdaftar > 0) {

				$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<font size="4">Sudah Mendaftar Sebelumnya</font></div>');
				redirect('booking/dataBooking/tambahDataTumbang/' . $id);
			} else {

				$where2 = array(
					'jadwal' 			=> $jadwal,
					'id_petugas' 		=> $id_petugas,
					'id_sesi' 			=> $id_sesi,
				);

				$count = $this->mSimetris->countData('tumbang', $where2);
				$noant = $count + 1;

				$data = array(

					'nama' 				=> $nama,
					'alamat' 			=> $alamat,
					'kontak' 			=> $kontak,
					'id_catatan_medik' 	=> $id_catatan_medik,
					'jadwal' 			=> $jadwal,
					'tanggal' 			=> $tanggal,
					'jam' 				=> $jam,
					'status' 			=> $status,
					'keterangan' 		=> $keterangan,
					'id_petugas' 		=> $id_petugas,
					'id_sesi' 			=> $id_sesi,

				);

				$this->mSimetris->insertData('tumbang', $data);
				$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Berhasil mendaftar </strong><font size="4"><b>Nomor Antrian : 
					' . $noant . '</b></font></div>');
				redirect('booking/dataBooking/tambahDataTumbang/' . $id);
			}
		}
	}

	public function updateDataTumbang($id)
	{
		$data['title'] 		= "Update";
		$data['subtitle'] 	= "Tumbuh Kembang";

		$where = array(
			'id_tumbang' => $id
		);

		$data['data'] = $this->mSimetris->dataTumbang($where, "tumbang.id_tumbang ASC")->result();

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vUpdateDataTumbang', $data);
		$this->load->view('templates/footer', $data);
	}

	public function updateDataTumbangAksi()
	{
		$id 		= $this->input->post('id');
		$nama 		= $this->input->post('nama');
		$alamat 	= $this->input->post('alamat');
		$kontak 	= $this->input->post('kontak');
		$keterangan = $this->input->post('keterangan');

		$data = array(

			'nama' 		 => $nama,
			'alamat' 	 => $alamat,
			'kontak' 	 => $kontak,
			'keterangan' => $keterangan,

		);

		$where = array(
			'id_tumbang' 		=> $id
		);

		$this->mSimetris->updateData('tumbang', $data, $where);
		$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4">Data berhasil diupdate</font>
			</div>');
		redirect('booking/dataBooking/detailDataTumbang/' . $id);
	}

	// proses tambah data booking ANC terpadu

	public function tambahDataAnc($id)
	{
		$data['id'] = $id;

		if ($id == 1) {
			$data['title'] 		= "Lihat";
		} else {
			$data['title'] 		= "Tambah";
		}

		$data['subtitle'] 		= "ANC Terpadu";
		$where 					= array('status' => 1);
		$data['datapetugas'] 	= $this->mSimetris->datapetugas("mr_petugas.id_petugas AS id_petugas, mr_petugas.nama_petugas AS nama_petugas", "mr_petugas", $where, "nama_petugas ASC")->result();
		$data['datasesi'] 		= $this->mSimetris->getData("sesi")->result();
		$data['record'] 		= $this->mSimetris->getData('mr_pasien');

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vTambahDataAnc', $data);
		$this->load->view('templates/footer', $data);
	}

	public function tambahDataAncRm()
	{
		$data['title'] 		= "Tambah";
		$data['subtitle'] 	= "ANC Terpadu";

		$id 					= $this->input->get('rm');
		$where 					= array('id_catatan_medik' => $id);
		$data['datapasien'] 	= $this->mSimetris->selectData('mr_pasien', '*', $where)->result();
		$where 					= array('status' => 1);
		$data['datapetugas'] 	= $this->mSimetris->datapetugas("mr_petugas.id_petugas AS id_petugas, mr_petugas.nama_petugas AS nama_petugas", "mr_petugas", $where, "nama_petugas ASC")->result();
		$data['datasesi'] 		= $this->mSimetris->getData("sesi")->result();
		$data['record'] 		= $this->mSimetris->getData('mr_pasien');

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vTambahDataAncRm', $data);
		$this->load->view('templates/footer', $data);
	}

	public function tambahDataAncCariNm()
	{
		$data['title'] 		= "Tambah";
		$data['subtitle'] 	= "ANC Terpadu";

		$id 				= $this->input->get('nm');

		$keyword 			= array('nama' => $id);

		$data['caripasien'] = $this->mSimetris->cariNamaPasienData('mr_pasien', $keyword)->result();

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vTambahDataAncCariNm', $data);
		$this->load->view('templates/footer', $data);
	}

	public function tambahDataAncNm($id)
	{
		$data['title'] 		= "Tambah";
		$data['subtitle'] 	= "ANC Terpadu";

		$where 					= array('id_catatan_medik' => $id);
		$data['datapasien'] 	= $this->mSimetris->selectData('mr_pasien', '*', $where)->result();
		$where 					= array('status' => 1);
		$data['datapetugas'] 	= $this->mSimetris->datapetugas("mr_petugas.id_petugas AS id_petugas, mr_petugas.nama_petugas AS nama_petugas", "mr_petugas", $where, "nama_petugas ASC")->result();
		$data['datasesi'] 		= $this->mSimetris->getData("sesi")->result();
		$data['record'] 		= $this->mSimetris->getData('mr_pasien');

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vTambahDataAncNm', $data);
		$this->load->view('templates/footer', $data);
	}

	public function cariDataAncAksi()
	{
		$id_petugas 		= $this->input->post('id_petugas');
		$id_sesi 			= $this->input->post('id_sesi');
		$jadwal 			= $this->input->post('jadwal');

		$where = array(
			'anc.id_petugas' 	=> $id_petugas,
			'anc.id_sesi' 		=> $id_sesi,
			'anc.jadwal' 		=> $jadwal,
		);

		$data['anc'] = $this->mSimetris->dataAnc($where)->result();

		if (isset($id_petugas)) {
			$data['title'] 		= $this->mSimetris->dataAnc($where)->num_rows() . " Pasien";
			$data['subtitle'] 	= formatDateIndo($jadwal);
		}

		$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4">Data berhasil ditampilkan</font>
			</div>');

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vTambahDataAnc', $data);
		$this->load->view('templates/footer', $data);
	}

	public function tambahDataAncBaruAksi()
	{

		$id 			  = '2';
		$nama             = $this->input->post('nama');
		$alamat           = $this->input->post('alamat');
		$kontak           = $this->input->post('kontak');
		$id_catatan_medik = '0';
		$jadwal 		  = $this->input->post('jadwal');
		$tanggal          = getDatenow();
		$jam              = getTimenow();
		$status           = '2';
		$keterangan       = $this->input->post('keterangan');
		$id_petugas       = $this->input->post('id_petugas');
		$id_sesi          = $this->input->post('id_sesi');
		$tgl1      		  = new DateTime();
		$tgl2             = new DateTime("$jadwal");
		$selisih          = $tgl1->diff($tgl2)->format("%a");

		if ($selisih > 30) {

			$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<font size="4">Lebih dari 30 hari</font></div>');
			redirect('booking/dataBooking/tambahDataAnc/' . $id);
		} else {

			$where2 = array(
				'jadwal' 			=> $jadwal,
				'id_petugas' 		=> $id_petugas,
				'id_sesi' 			=> $id_sesi,
			);

			$count = $this->mSimetris->countData('anc', $where2);
			$noant = $count + 1;

			$data = array(

				'nama' 				=> $nama,
				'alamat' 			=> $alamat,
				'kontak' 			=> $kontak,
				'id_catatan_medik' 	=> $id_catatan_medik,
				'jadwal' 			=> $jadwal,
				'tanggal' 			=> $tanggal,
				'jam' 				=> $jam,
				'status' 			=> $status,
				'keterangan' 		=> $keterangan,
				'id_petugas' 		=> $id_petugas,
				'id_sesi' 			=> $id_sesi,

			);

			$this->mSimetris->insertData('anc', $data);
			$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Berhasil mendaftar </strong><font size="4"><b>Nomor Antrian : 
				' . $noant . '</b></font></div>');
			redirect('booking/dataBooking/tambahDataAnc/' . $id);
		}
	}

	public function tambahDataAncLamaAksi()
	{

		$id 			  = '2';
		$nama             = $this->input->post('nama');
		$alamat           = $this->input->post('alamat');
		$kontak           = $this->input->post('kontak');
		$id_catatan_medik = $this->input->post('id_catatan_medik');
		$jadwal 		  = $this->input->post('jadwal');
		$tanggal          = getDatenow();
		$jam              = getTimenow();
		$status           = '2';
		$keterangan       = $this->input->post('keterangan');
		$id_petugas       = $this->input->post('id_petugas');
		$id_sesi          = $this->input->post('id_sesi');
		$tgl1      		  = new DateTime();
		$tgl2             = new DateTime("$jadwal");
		$selisih          = $tgl1->diff($tgl2)->format("%a");

		if ($selisih > 30) {

			$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<font size="4">Lebih dari 30 hari</font></div>');
			redirect('booking/dataBooking/tambahDataAnc/' . $id);
		} else {

			$where1 = array(
				'id_catatan_medik' 	=> $id_catatan_medik,
				'id_petugas' 		=> $id_petugas,
				'jadwal' 			=> $jadwal,
				'id_sesi' 			=> $id_sesi,
			);

			$cekdaftar = $this->mSimetris->countData('anc', $where1);

			if ($cekdaftar > 0) {

				$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<font size="4">Sudah Mendaftar Sebelumnya</font></div>');
				redirect('booking/dataBooking/tambahDataAnc/' . $id);
			} else {

				$where2 = array(
					'jadwal' 			=> $jadwal,
					'id_petugas' 		=> $id_petugas,
					'id_sesi' 			=> $id_sesi,
				);

				$count = $this->mSimetris->countData('anc', $where2);
				$noant = $count + 1;

				$data = array(

					'nama' 				=> $nama,
					'alamat' 			=> $alamat,
					'kontak' 			=> $kontak,
					'id_catatan_medik' 	=> $id_catatan_medik,
					'jadwal' 			=> $jadwal,
					'tanggal' 			=> $tanggal,
					'jam' 				=> $jam,
					'status' 			=> $status,
					'keterangan' 		=> $keterangan,
					'id_petugas' 		=> $id_petugas,
					'id_sesi' 			=> $id_sesi,

				);

				$this->mSimetris->insertData('anc', $data);
				$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Berhasil mendaftar </strong><font size="4"><b>Nomor Antrian : 
					' . $noant . '</b></font></div>');
				redirect('booking/dataBooking/tambahDataAnc/' . $id);
			}
		}
	}

	public function updateDataAnc($id)
	{
		$data['title'] 		= "Update";
		$data['subtitle'] 	= "ANC Terpadu";

		$where = array(
			'id_anc' => $id
		);

		$data['data'] = $this->mSimetris->dataAnc($where, "anc.id_anc ASC")->result();

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vUpdateDataAnc', $data);
		$this->load->view('templates/footer', $data);
	}

	public function updateDataAncAksi()
	{
		$id 		= $this->input->post('id');
		$nama 		= $this->input->post('nama');
		$alamat 	= $this->input->post('alamat');
		$kontak 	= $this->input->post('kontak');
		$keterangan = $this->input->post('keterangan');

		$data = array(

			'nama' 		 => $nama,
			'alamat' 	 => $alamat,
			'kontak' 	 => $kontak,
			'keterangan' => $keterangan,

		);

		$where = array(
			'id_anc' 		=> $id
		);

		$this->mSimetris->updateData('anc', $data, $where);
		$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4">Data berhasil diupdate</font>
			</div>');
		redirect('booking/dataBooking/detailDataAnc/' . $id);
	}

	public function dataRedZone()
	{
		$data['title'] 		= "Redzone";
		$data['subtitle'] 	= "COVID-19";

		$this->load->view('templates/header', $data);
		$this->load->view('booking/vMenu', $data);
		$this->load->view('booking/vRedZone', $data);
		$this->load->view('templates/footer', $data);
	}

	public function _rules()
	{
		$this->form_validation->set_rules('id_catatan_medik', 'nomor rekam medik', 'required');
		$this->form_validation->set_rules('id_dokter', 'nama dokter', 'required');
		$this->form_validation->set_rules('id_sesi', 'nama sesi', 'required');
	}
}
