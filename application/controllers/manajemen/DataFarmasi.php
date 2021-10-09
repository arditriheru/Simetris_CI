<?php

class dataFarmasi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('manajemen_login') != '1') {
			$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<font size="4"><b>Anda belum login!</b></font>
				</div>');
			redirect('manajemen/login');
		}

		$this->load->model("mSimetris");
		$this->load->library('form_validation');
	}

	function dataEdObat($id)
	{
		$data['title'] 		= "Data";
		$data['subtitle'] 	= "Expired Date Obat";

		if ($id == 2) {

			$bln 	= $this->input->post('bln');
			$thn 	= $this->input->post('thn');

			if (isset($bln) && empty($thn)) {
				$data['data'] 	= 'bln=' . $bln;

				$data['dataedobat'] = $this->db->query("
					SELECT * FROM far_stok WHERE MONTH(tgl_ed) = '$bln' ORDER BY nama ASC")->result();
			} elseif (isset($thn) && empty($bln)) {

				$data['data'] 	= 'thn=' . $thn;

				$data['dataedobat'] = $this->db->query("
					SELECT * FROM far_stok WHERE YEAR(tgl_ed) = '$thn' ORDER BY nama ASC")->result();
			} elseif (isset($bln) && isset($thn)) {

				$data['data'] 	= 'bln=' . $bln . '&' . 'thn=' . $thn;

				$data['dataedobat'] = $this->db->query("
					SELECT * FROM far_stok WHERE MONTH(tgl_ed) = '$bln' AND YEAR(tgl_ed) = '$thn' ORDER BY nama ASC")->result();
			}
		}

		$this->load->view('templates/header', $data);
		$this->load->view('manajemen/vMenu', $data);
		$this->load->view('manajemen/farmasi/vDataEdObat', $data);
		$this->load->view('templates/footer', $data);
	}

	function printDataEdObat()
	{
		$data['title'] 		= "Data";
		$data['subtitle'] 	= "Expired Date Obat";

		$bln 	= $this->input->get('bln');
		$thn 	= $this->input->get('thn');

		if (isset($bln) && empty($thn)) {
			$data['data'] 	= 'Bulan : ' . $bln;

			$data['dataedobat'] = $this->db->query("
				SELECT * FROM far_stok WHERE MONTH(tgl_ed) = '$bln' ORDER BY nama ASC")->result();
		} elseif (isset($thn) && empty($bln)) {

			$data['data'] 	= 'Tahun : ' . $thn;

			$data['dataedobat'] = $this->db->query("
				SELECT * FROM far_stok WHERE YEAR(tgl_ed) = '$thn' ORDER BY nama ASC")->result();
		} elseif (isset($bln) && isset($thn)) {

			$data['data'] 	= 'Periode Bulan : ' . $bln . '/' . $thn;

			$data['dataedobat'] = $this->db->query("
				SELECT * FROM far_stok WHERE MONTH(tgl_ed) = '$bln' AND YEAR(tgl_ed) = '$thn' ORDER BY nama ASC")->result();
		}

		$this->load->view('templates/header', $data);
		$this->load->view('manajemen/vMenu', $data);
		$this->load->view('manajemen/farmasi/vPrintDataEdObat', $data);
	}

	function dataPemakaianObat($id)
	{
		$data['title'] 		= "Data";
		$data['subtitle'] 	= "Expired Date Obat";

		if ($id == 2) {

			$tgl_awal 			= $this->input->post('tgl_awal');
			$tgl_akhir 			= $this->input->post('tgl_akhir');
			$id_catatan_medik 	= $this->input->post('id_catatan_medik');
			$data['tgl_awal'] 	= $tgl_awal;
			$data['tgl_akhir'] 	= $tgl_akhir;
			$data['id_catatan_medik'] 	= $id_catatan_medik;

			if (isset($id_catatan_medik)) {
				$where = array(
					'far_trn.tanggal >=' => $tgl_awal,
					'far_trn.tanggal <=' => $tgl_akhir,
					'far_trn.id_catatan_medik' => $id_catatan_medik,
				);
			} else {
				$where = array(
					'far_trn.tanggal >=' => $tgl_awal,
					'far_trn.tanggal <=' => $tgl_akhir,
				);
			}

			$data['dataPemakaianObat'] = $this->mSimetris->dataPemakaianObat($where)->result();
		}

		$this->load->view('templates/header', $data);
		$this->load->view('manajemen/vMenu', $data);
		$this->load->view('manajemen/farmasi/vDataPemakaianObat', $data);
		$this->load->view('templates/footer', $data);
	}

	function exportDataPemakaianObat($tgl_awal, $tgl_akhir)
	{
		$data['title']        = "Pemakaian Obat";

		$id_catatan_medik 	= $this->input->get('rm');
		$data['tgl_awal'] 	= $tgl_awal;
		$data['tgl_akhir'] 	= $tgl_akhir;

		if (isset($id_catatan_medik)) {
			$where = array(
				'far_trn.tanggal >=' => $tgl_awal,
				'far_trn.tanggal <=' => $tgl_akhir,
				'far_trn.id_catatan_medik' => $id_catatan_medik,
			);
		} else {
			$where = array(
				'far_trn.tanggal >=' => $tgl_awal,
				'far_trn.tanggal <=' => $tgl_akhir,
			);
		}

		$data['dataPemakaianObat'] = $this->mSimetris->dataPemakaianObat($where)->result();

		$this->load->view('templates/header', $data);
		$this->load->view('manajemen/vMenu', $data);
		$this->load->view('manajemen/farmasi/vExcelDataPemakaianObat', $data);
		$this->load->view('templates/footer', $data);
	}
}
