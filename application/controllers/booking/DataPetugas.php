<?php 

class dataPetugas extends CI_Controller
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
		$data['title'] 		= "Petugas";
		$data['subtitle'] 	= "Medis";

		$data['datadokter'] 	= $this->db->query("
			SELECT *,  IF (status='1', 'Aktif', 'Nonaktif') AS status,
			CASE
			WHEN id_unit='1' THEN 'Anak'
			WHEN id_unit='2' THEN 'Obsgyn'
			WHEN id_unit='3' THEN 'Bedah'
			END AS nama_unit
			FROM dokter
			WHERE !id_dokter = '0'
			ORDER BY nama_dokter ASC")->result();

		$data['datapetugas'] = $this->db->query("
			SELECT *,  IF (status='1', 'Aktif', 'Nonaktif') AS status,
			CASE
			WHEN pelayanan='1' THEN 'Tumbang'
			WHEN pelayanan='2' THEN 'ANC'
			END AS pelayanan
			FROM mr_petugas
			WHERE !id_petugas = '0'
			ORDER BY nama_petugas ASC")->result();

		$this->load->view('templates/header',$data);
		$this->load->view('booking/vMenu',$data);
		$this->load->view('booking/vDataPetugas',$data);
		$this->load->view('templates/footer',$data);
	}

	public function tambahDataPetugas($id)
	{
		$data['id'] 		= $id;
		$data['title'] 		= "Petugas";
		$data['subtitle'] 	= "Medis";

		$this->load->view('templates/header',$data);
		$this->load->view('booking/vMenu',$data);
		$this->load->view('booking/vTambahDataPetugas',$data);
		$this->load->view('templates/footer',$data);
	}

	public function tambahDataDokterAksi()
	{
		$nama_dokter = $this->input->post('nama_dokter');
		$id_unit     = $this->input->post('id_unit');
		$status    	  = '1';

		$data = array(

			'nama_dokter' 	=> $nama_dokter,
			'id_unit' 		=> $id_unit,
			'status' 		=> $status,

		);

		$this->mSimetris->insertData('dokter',$data);
		$this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4">Berhasil menambahkan</font></div>');
		redirect('booking/dataPetugas');
	}

	public function tambahDataPetugasAksi()
	{
		$nama_petugas = $this->input->post('nama_petugas');
		$pelayanan    = $this->input->post('pelayanan');
		$status    	  = '1';

		$data = array(

			'nama_petugas' 	=> $nama_petugas,
			'pelayanan' 	=> $pelayanan,
			'status' 		=> $status,
			
		);

		$this->mSimetris->insertData('mr_petugas',$data);
		$this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4">Berhasil menambahkan</font></div>');
		redirect('booking/dataPetugas');
	}

	public function deleteDataDokter($id)
	{
		$where = array('id_dokter' => $id);
		$this->mSimetris->deleteData('dokter',$where);
		$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4">Data berhasil dihapus</font>
			</div>');
		redirect('booking/dataPetugas');

	}

	public function deleteDataPetugas($id)
	{
		$where = array('id_petugas' => $id);
		$this->mSimetris->deleteData('mr_petugas',$where);
		$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4">Data berhasil dihapus</font>
			</div>');
		redirect('booking/dataPetugas');

	}

	public function updateDataDokter($id)
	{
		$data['title'] 		= "Update";
		$data['subtitle'] 	= "Dokter";

		$data['datadokter'] = $this->db->query("
			SELECT *, IF (status='1', 'Aktif', 'Nonaktif') AS status,
			CASE
			WHEN id_unit='1' THEN 'Poli Anak'
			WHEN id_unit='2' THEN 'Poli Obsgyn'
			WHEN id_unit='3' THEN 'Poli Bedah'
			END AS nama_unit
			FROM dokter
			WHERE id_dokter = '$id'")->result();

		$this->load->view('templates/header',$data);
		$this->load->view('booking/vMenu',$data);
		$this->load->view('booking/vUpdateDataDokter',$data);
		$this->load->view('templates/footer',$data);
	}

	public function updateDataPetugas($id)
	{
		$data['title'] 		= "Update";
		$data['subtitle'] 	= "Petugas";

		$data['datapetugas'] = $this->db->query("
			SELECT *, IF (status='1', 'Aktif', 'Nonaktif') AS status,
			CASE
			WHEN pelayanan='1' THEN 'Tumbuh Kembang'
			WHEN pelayanan='2' THEN 'ANC Terpadu'
			END AS nama_pelayanan
			FROM mr_petugas
			WHERE id_petugas = '$id'")->result();

		$this->load->view('templates/header',$data);
		$this->load->view('booking/vMenu',$data);
		$this->load->view('booking/vUpdateDataPetugas',$data);
		$this->load->view('templates/footer',$data);
	}

	public function updateDataDokterAksi()
	{
		$id 		 = $this->input->post('id_dokter');
		$nama_dokter = $this->input->post('nama_dokter');
		$id_unit 	 = $this->input->post('id_unit');
		$status 	 = $this->input->post('status');

		$data = array(

			'nama_dokter' 		=> $nama_dokter,
			'id_unit' 			=> $id_unit,
			'status' 			=> $status,

		);

		$where = array(
			'id_dokter' 		=> $id
		);

		$this->mSimetris->updateData('dokter',$data,$where);
		$this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4">Data berhasil diupdate</font>
			</div>');
		redirect('booking/dataPetugas/');

	}

	public function updateDataPetugasAksi()
	{
		$id 		  = $this->input->post('id_petugas');
		$nama_petugas = $this->input->post('nama_petugas');
		$pelayanan 	  = $this->input->post('pelayanan');
		$status 	  = $this->input->post('status');

		$data = array(

			'nama_petugas' 		=> $nama_petugas,
			'pelayanan' 		=> $pelayanan,
			'status' 			=> $status,

		);

		$where = array(
			'id_petugas' 		=> $id
		);

		$this->mSimetris->updateData('mr_petugas',$data,$where);
		$this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4">Data berhasil diupdate</font>
			</div>');
		redirect('booking/dataPetugas/');

	}

}

?>