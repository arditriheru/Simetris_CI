<?php

class dataManajemen extends CI_Controller
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

	public function index()
	{
		$data['title'] 		= "Dashboard";
		$data['subtitle'] 	= getDateIndo();

		$this->load->view('templates/header', $data);
		$this->load->view('manajemen/vMenu', $data);
		$this->load->view('manajemen/vDashboard', $data);
		$this->load->view('templates/footer', $data);
	}

	public function exportCustom()
	{
		$data['data'] = $this->db->query("
		SELECT mr_rla.id_catatan_medik, mr_rla.tanggal, mr_pasien.nama, mr_pasien.telp, mr_rla.id_unit
		FROM mr_rla
		JOIN mr_pasien
		ON mr_rla.id_catatan_medik = mr_pasien.id_catatan_medik
		WHERE mr_rla.tanggal BETWEEN '2021-01-01' AND '2021-12-31'
		AND mr_rla.id_unit=2
		GROUP BY mr_rla.id_catatan_medik
		ORDER BY mr_rla.tanggal, mr_rla.id_unit ASC")->result();

		$this->load->view('templates/header', $data);
		$this->load->view('manajemen/vMenu', $data);
		$this->load->view('manajemen/vExportCustom', $data);
		$this->load->view('templates/footer', $data);
	}
}
