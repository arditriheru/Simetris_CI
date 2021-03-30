<?php

class dataJadwal extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if($this->session->userdata('login') !='1')
		{
			$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissable">
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
		$data['title'] 		= "Jadwal";
		$data['subtitle'] 	= "Dokter";

		$where1 = array(
			'dokter.status' => 1
		);

		$where2 = array(
			'dokter.status' => 1
		);

		$data['datajadwal'] 		= $this->mSimetris->dataJadwal($where2)->result();
		$data['datadokter'] 		= $this->mSimetris->dataDokter("dokter",$where1,"nama_dokter ASC")->result();
		$data['datajadwallibur'] 	= $this->mSimetris->dataJadwalLibur()->result();

		$this->load->view('templates/header',$data);
		$this->load->view('booking/vMenu',$data);
		$this->load->view('booking/vDataJadwal',$data);
		$this->load->view('templates/footer',$data);
	}

	public function dataJadwalTab($id)
	{
		$data['title'] 		= "Jadwal";
		$data['subtitle'] 	= "Dokter";

		$data['id'] = $id;

		$where1 = array(
			'status' => 1
		);
		$where2 = array(
			'dokter.id_dokter' => $id
		);

		$data['datadokter']			= $this->mSimetris->dataDokter("dokter",$where1,"nama_dokter ASC")->result();
		$data['datajadwal'] 		= $this->mSimetris->dataJadwal($where2)->result();
		$data['datajadwallibur']	= $this->mSimetris->dataJadwalLibur()->result();

		$this->load->view('templates/header',$data);
		$this->load->view('booking/vMenu',$data);
		$this->load->view('booking/vDataJadwal',$data);
		$this->load->view('templates/footer',$data);
	}

	public function tambahDataJadwal($id)
	{
		$data['id'] = $id;

		$data['title'] 			= "Tambah";

		if($id==1){
			$data['subtitle'] 	= "Libur";
		}else{
			$data['subtitle'] 	= "Jadwal";
		}

		$where 				= array('status' => 1);
		$data['datadokter'] = $this->mSimetris->dataDokter("dokter",$where,"nama_dokter ASC")->result();
		$data['datasesi'] 	= $this->mSimetris->getData("sesi")->result();

		$this->load->view('templates/header',$data);
		$this->load->view('booking/vMenu',$data);
		$this->load->view('booking/vTambahDataJadwal',$data);
		$this->load->view('templates/footer',$data);
	}

	public function tambahDataJadwalLiburAksi()
	{
		$id_dokter 	= $this->input->post('id_dokter');
		$id_sesi    = $this->input->post('id_sesi');
		$tanggal    = $this->input->post('tanggal');

		$data = array(

			'id_dokter' 	=> $id_dokter,
			'id_sesi' 		=> $id_sesi,
			'tanggal' 		=> $tanggal,

		);

		$this->mSimetris->insertData('dokter_jadwal_libur',$data);
		$this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4">Berhasil menambahkan</font></div>');
		redirect('booking/dataJadwal');

	}

	public function tambahDataJadwalAksi()
	{
		$id_dokter 	= $this->input->post('id_dokter');
		$id_sesi    = $this->input->post('id_sesi');
		$hari    	= $this->input->post('hari');
		$jam    	= $this->input->post('jam');
		$kuota    	= $this->input->post('kuota');
		$ims    	= $this->input->post('ims');

		$data = array(

			'id_dokter' 	=> $id_dokter,
			'id_sesi' 		=> $id_sesi,
			'hari' 			=> $hari,
			'jam' 			=> $jam,
			'kuota' 		=> $kuota,
			'ims' 			=> $ims,

		);

		$this->mSimetris->insertData('dokter_jadwal',$data);
		$this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4">Berhasil menambahkan</font></div>');
		redirect('booking/dataJadwal');

	}

	public function deleteDataJadwalLibur($id)
	{
		$where = array('id_jadwal_libur' => $id);
		$this->mSimetris->deleteData('dokter_jadwal_libur',$where);
		$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4">Data berhasil dihapus</font>
			</div>');
		redirect('booking/dataJadwal');

	}

	public function deleteDataJadwal($id)
	{
		$where = array('id_jadwal' => $id);
		$this->mSimetris->deleteData('dokter_jadwal',$where);
		$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4">Data berhasil dihapus</font>
			</div>');
		redirect('booking/dataJadwal');

	}

	public function updateDataJadwal($id)
	{
		$data['title'] 		= "Update";
		$data['subtitle'] 	= "Jadwal";

		$where = array(
			'id_jadwal' => $id
		);
		$data['datasesi'] 	= $this->mSimetris->getData("sesi")->result();
		$data['datajadwal'] = $this->mSimetris->dataJadwal($where)->result();

		$this->load->view('templates/header',$data);
		$this->load->view('booking/vMenu',$data);
		$this->load->view('booking/vUpdateDataJadwal',$data);
		$this->load->view('templates/footer',$data);
	}

	public function updateDataJadwalAksi()
	{
		$id 		= $this->input->post('id_jadwal');
		$id_dokter 	= $this->input->post('id_dokter');
		$id_sesi 	= $this->input->post('id_sesi');
		$hari 	 	= $this->input->post('hari');
		$jam 		= $this->input->post('jam');
		$kuota 	 	= $this->input->post('kuota');
		$ims 	 	= $this->input->post('ims');

		$data = array(

			'id_dokter' 		=> $id_dokter,
			'id_sesi' 			=> $id_sesi,
			'hari' 				=> $hari,
			'jam' 				=> $jam,
			'kuota' 			=> $kuota,
			'ims' 				=> $ims,

		);

		$where = array(
			'id_jadwal' 		=> $id
		);

		$this->mSimetris->updateData('dokter_jadwal',$data,$where);
		$this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4">Data berhasil diupdate!</font>
			</div>');
		redirect('booking/dataJadwal/');

	}



}

?>