<?php

class dataManajemen extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		// if ($this->session->userdata('manajemen_login') != '1') {
		// 	$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
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
		$data['title'] 		= "Dashboard";
		$data['subtitle'] 	= getDateIndo();

		$this->load->view('templates/header', $data);
		$this->load->view('manajemen/vMenu', $data);
		$this->load->view('manajemen/vDashboard', $data);
		$this->load->view('templates/footer', $data);
	}

	public function exportDataPasien()
	{
		// QUERY DATA PASIEN
		// 		SELECT
		// IF (mr_pasien.sex='1', 'M', 'F') AS kelamin,
		// mr_pasien.id_catatan_medik,
		// mr_pasien.nama,
		// mr_pasien.tempat,
		// mr_pasien.tgl_lahir,
		// mr_pasien.alamat,
		// mr_pasien.telp,
		// mr_pasien.nama_ortu,
		// mr_pasien.alamat_ortu,
		// mr_desa_bps.nama_desa,
		// mr_kecamatan_bps.nama_kecamatan,
		// mr_kabupaten_bps.nama_kabupaten,
		// mr_propinsi_bps.nama_propinsi,
		// mr_pendidikan.nama AS pendidikan,
		// mr_pekerjaan.id_pekerjaan AS kode_pekerjaan,
		// mr_pekerjaan.nama AS pekerjaan,
		// mr_keluarga.nama_keluarga,
		// mr_menikah.nama_menikah,
		// mr_agama.nama_agama
		// FROM mr_pasien
		// JOIN mr_desa_bps
		// ON mr_pasien.id_desa=mr_desa_bps.kode_desa
		// JOIN mr_kecamatan_bps
		// ON mr_pasien.id_kecamatan=mr_kecamatan_bps.kode_kecamatan
		// JOIN mr_kabupaten_bps
		// ON mr_pasien.id_kabupaten=mr_kabupaten_bps.kode_kabupaten
		// JOIN mr_propinsi_bps
		// ON mr_pasien.id_propinsi=mr_propinsi_bps.kode_propinsi
		// JOIN mr_pendidikan
		// ON mr_pasien.id_pendidikan=mr_pendidikan.id_pendidikan
		// JOIN mr_pekerjaan
		// ON mr_pasien.id_pekerjaan=mr_pekerjaan.id_pekerjaan
		// JOIN mr_keluarga
		// ON mr_pasien.id_keluarga=mr_keluarga.id_keluarga
		// JOIN mr_menikah
		// ON mr_pasien.menikah=mr_menikah.id_menikah
		// JOIN mr_agama
		// ON mr_pasien.id_agama=mr_agama.id_agama
		// WHERE mr_pasien.id_catatan_medik BETWEEN 10020001 AND 10030000
		// ORDER BY mr_pasien.id_catatan_medik ASC

		// QUERY STOK OBAT FARMASI
		// SELECT far_stok.nama, far_stok.harga_pokok, far_stok.ppn, far_suplier.nama AS suplier
		// FROM far_stok
		// JOIN far_suplier
		// ON far_stok.suplier = far_suplier.id_far_suplier

		$data['data'] = $this->db->query("
		SELECT
		IF (mr_pasien.sex='1', 'M', 'F') AS kelamin,
		mr_pasien.id_catatan_medik,
		mr_pasien.nama,
		mr_pasien.tempat,
		mr_pasien.tgl_lahir,
		mr_pasien.alamat,
		mr_pasien.telp,
		mr_pasien.nama_ortu,
		mr_pasien.alamat_ortu,
		mr_desa_bps.nama_desa,
		mr_kecamatan_bps.nama_kecamatan,
		mr_kabupaten_bps.nama_kabupaten,
		mr_propinsi_bps.nama_propinsi,
		mr_pendidikan.nama AS pendidikan,
		mr_pekerjaan.id_pekerjaan AS kode_pekerjaan,
		mr_pekerjaan.nama AS pekerjaan,
		mr_keluarga.nama_keluarga,
		mr_menikah.nama_menikah,
		mr_agama.nama_agama
		FROM mr_pasien
		JOIN mr_desa_bps
		ON mr_pasien.id_desa=mr_desa_bps.kode_desa
		JOIN mr_kecamatan_bps
		ON mr_pasien.id_kecamatan=mr_kecamatan_bps.kode_kecamatan
		JOIN mr_kabupaten_bps
		ON mr_pasien.id_kabupaten=mr_kabupaten_bps.kode_kabupaten
		JOIN mr_propinsi_bps
		ON mr_pasien.id_propinsi=mr_propinsi_bps.kode_propinsi
		JOIN mr_pendidikan
		ON mr_pasien.id_pendidikan=mr_pendidikan.id_pendidikan
		JOIN mr_pekerjaan
		ON mr_pasien.id_pekerjaan=mr_pekerjaan.id_pekerjaan
		JOIN mr_keluarga
		ON mr_pasien.id_keluarga=mr_keluarga.id_keluarga
		JOIN mr_menikah
		ON mr_pasien.menikah=mr_menikah.id_menikah
		JOIN mr_agama
		ON mr_pasien.id_agama=mr_agama.id_agama
		WHERE mr_pasien.id_catatan_medik BETWEEN 10028640 AND 10040000
		ORDER BY mr_pasien.id_catatan_medik ASC
		")->result();

		$this->load->view('templates/header', $data);
		$this->load->view('manajemen/vMenu', $data);
		$this->load->view('manajemen/vExportCustom', $data);
		$this->load->view('templates/footer', $data);
	}
}
