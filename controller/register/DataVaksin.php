<?php 

class dataVaksin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if($this->session->userdata('login') !='1')
		{
			$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<font size="4"><b>Anda belum login!</b></font>
				</div>');
			redirect('register/login');
		}

		$this->load->model("mSimetris");
		$this->load->library('form_validation');
	}

	public function tambahDataVaksin($id)
	{
		if($id==1){

			$data['title'] 		= "Pencarian";

		}else{

			$data['title'] 		= "Tambah";
			$where 				= array(
				'status' 	=> 1
			);
			
			$data['datadokter'] = $this->mSimetris->dataDokter("dokter.id_dokter AS id_dokter, dokter.nama_dokter AS nama_dokter", "dokter",$where,"nama_dokter ASC")->result();
			$data['datavaksin'] = $this->mSimetris->dataNamaVaksin()->result();
			$data['record']		= $this->mSimetris->getData('mr_pasien');
			
		}

		$data['subtitle']	= "Data Vaksin";
		$data['id'] 		= $id;

		$this->load->view('templates/header',$data);
		$this->load->view('register/vMenu',$data);
		$this->load->view('register/vTambahDataVaksin',$data);
		$this->load->view('templates/footer',$data);
	}

	public function tambahDatavaksinAksi($id)
	{
		$id_catatan_medik 	= $this->input->post('id_catatan_medik');
		$id_dokter 			= $this->input->post('id_dokter');
		$kode_vaksin 		= $this->input->post('kode_vaksin');
		$tanggal 			= getDatenow();
		$jam 				= getTimenow();
		$keterangan 		= $this->input->post('keterangan');

		$data = array(

			'id_catatan_medik' 	=> $id_catatan_medik,
			'id_dokter' 		=> $id_dokter,
			'kode_vaksin' 		=> $kode_vaksin,
			'tanggal' 			=> $tanggal,
			'jam' 				=> $jam,
			'keterangan' 		=> $keterangan,
		);

		$this->mSimetris->insertData('vaksin_register',$data);
		$this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4"><b>Data berhasil ditambahkan!</b></font>
			</div>');
		redirect('register/dataVaksin/tambahDataVaksin/'.$id);

	}

	public function filterDataVaksinAksi($id)
	{
		if($id==1){

			$data['title'] 		= "Pencarian";

		}else{

			$data['title'] 		= "Tambah";
			
		}

		$data['subtitle'] 	= "Data Vaksin";
		$data['id'] 		= $id;
		$id_catatan_medik 	= $this->input->post('id_catatan_medik');
		$bln 				= $this->input->post('bln');
		$thn 				= $this->input->post('thn');

		if(isset($id_catatan_medik)){

			$data['value'] 			= $id_catatan_medik;
			$data['data'] 			= $this->mSimetris->dataVaksinRm($id_catatan_medik)->result();

		}elseif(isset($bln) AND isset($thn)){

			$data['value'] = $bln.$thn;
			$data['data'] 			= $this->mSimetris->dataVaksinPeriode($bln,$thn)->result();

		}

		$this->load->view('templates/header',$data);
		$this->load->view('register/vMenu',$data);
		$this->load->view('register/vTambahDataVaksin',$data);
		$this->load->view('templates/footer',$data);
	}

	public function deleteDataVaksin($id)
	{
		$where = array('id_vaksin_register' => $id);
		$this->mSimetris->deleteData('vaksin_register',$where);
		$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="5">Data berhasil dihapus</font>
			</div>');
		redirect('register/dataVaksin/filterDatavaksinAksi/1');

	}

	public function cari()
	{
		$id_catatan_medik=$_GET['id_catatan_medik'];
		$cari =$this->mSimetris->cari($id_catatan_medik)->result();
		echo json_encode($cari);
	} 

}
