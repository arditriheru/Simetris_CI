<?php 

class dataHpl extends CI_Controller
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

	public function tabDataHpl($value,$id)
	{
		$data['title'] 		= "Dashboard";
		$data['subtitle'] 	= "HPL Register";

		$bln 	= getMonthNow();
		$thn  	= getYearNow();

		$data['value'] = $value;

		$data['datadokter'] = $this->mSimetris->dataDokterTab($bln,$thn)->result();
		$data['databulan'] 	= $this->mSimetris->dataBulanTab($bln,$thn)->result();

		if($value==1)
		{

			$data['dataHplTab'] = $this->mSimetris->dataDokterTab($bln,$thn)->result();
			$data['dataHplTab'] = $this->mSimetris->dataDokterTab($bln,$thn)->num_rows();

		}else{

			$data['dataHplTab'] = $this->mSimetris->dataDokterTab($id,$thn)->result();
			$data['dataHplTab'] = $this->mSimetris->dataDokterTab($id,$thn)->num_rows();

		}

		$data['totalDataHplTab'] = $totalDataHplTab->num_rows();

		$this->load->view('templates/header',$data);
		$this->load->view('register/vMenu',$data);
		$this->load->view('register/vDataHplTab',$data);
		$this->load->view('templates/footer',$data);
	}

	public function registerDataHpl()
	{
		$data['title'] 		= "Registrasi";
		$data['subtitle'] 	= getDateIndo();

		$id = getDatenow();
		$data['datahplregister'] = $this->mSimetris->dataHplRegister($id)->result();

		$this->load->view('templates/header',$data);
		$this->load->view('register/vMenu',$data);
		$this->load->view('register/vDataHplRegister',$data);
		$this->load->view('templates/footer',$data);
	}

	public function tambahDataHpl($id)
	{
		if($id==1){

			$data['title'] 		= "Pencarian";

		}else{

			$data['title'] 		= "Tambah";
			$where 				= array(
				'id_unit' 		=> 2,
				'status' 		=> 1
			);
			
			$data['datadokter'] = $this->mSimetris->dataDokter("dokter",$where,"nama_dokter ASC")->result();
			$data['record']		=  $this->mSimetris->getData('mr_pasien');
			
		}

		$data['subtitle'] 	= "Data HPL";
		$data['id'] = $id;

		$this->load->view('templates/header',$data);
		$this->load->view('register/vMenu',$data);
		$this->load->view('register/vTambahDataHpl',$data);
		$this->load->view('templates/footer',$data);
	}

	public function filterDataHplAksi($id)
	{
		if($id==1){

			$data['title']	= "Pencarian";

		}else{

			$data['title']	= "Tambah";
			
		}

		$data['subtitle'] 	= "Data HPL";
		$data['id'] 		= $id;
		$bln 				= $this->input->post('bln');
		$thn 				= $this->input->post('thn');
		$data['bln'] 		= $bln;
		$data['datahpl'] 	= $this->mSimetris->dataHpl($bln,$thn)->result();

		$this->load->view('templates/header',$data);
		$this->load->view('register/vMenu',$data);
		$this->load->view('register/vTambahDataHpl',$data);
		$this->load->view('templates/footer',$data);
	}

	public function tambahDataHplAksi($id)
	{
		$id_catatan_medik 	= $this->input->post('id_catatan_medik');
		$id_dokter 			= $this->input->post('id_dokter');
		$id_petugas			= $this->session->userdata('hpl_id_petugas');
		$tgl_hpl 			= $this->input->post('tgl_hpl');
		$tanggal 			= getDatenow();
		$jam 				= getTimenow();

		$data = array(

			'id_catatan_medik' 	=> $id_catatan_medik,
			'id_dokter' 		=> $id_dokter,
			'id_petugas' 		=> $id_petugas,
			'tgl_hpl' 			=> $tgl_hpl,
			'tanggal' 			=> $tanggal,
			'jam' 				=> $jam,
		);

		$this->mSimetris->insertData('hpl_register',$data);
		$this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4"><b>Data berhasil ditambahkan!</b></font>
			</div>');
		redirect('register/dataHpl/tambahDataHpl/'.$id);

	}

	public function deleteDataHpl($id)
	{
		$where = array('id_hpl_register' => $id);
		$this->mSimetris->deleteData('hpl_register',$where);
		$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="5">Data berhasil dihapus</font>
			</div>');
		redirect('register/dataHpl/filterDataHplAksi/1');

	}

	public function cari()
	{
		$id_catatan_medik = $_GET['id_catatan_medik'];
		$cari =$this->mSimetris->cari($id_catatan_medik)->result();
		echo json_encode($cari);
	} 

}

?>