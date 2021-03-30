<?php 

class dataInventaris extends CI_Controller
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
			redirect('inventaris/login');
		}

		$this->load->model("mSimetris");
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] 		= "Dashboard";
		$data['subtitle'] 	= "Inventaris";

		$data['data'] 		= $this->mSimetris->dataInventaris()->result();
		$data['total'] 		= $this->mSimetris->getData("inventaris")->num_rows();

		$this->load->view('templates/header',$data);
		$this->load->view('inventaris/vMenu',$data);
		$this->load->view('inventaris/vDataInventaris',$data);
		$this->load->view('templates/footer',$data);
	}

	public function cariDataInventaris()
	{
		$data['title'] 		= "Pencarian";

		$nomor_inventaris 	= $this->input->get('nomor_inventaris');
		$kondisi 			= $this->input->get('kondisi');
		$status 			= $this->input->get('status');
		$kode_ruangan 		= $this->input->get('kode_ruangan');

		if(isset($nomor_inventaris))
		{
			$data['subtitle'] 	= "Nomor Inventaris";
			$data['id'] 		= "nomor_inventaris=".$nomor_inventaris;

			$data['data'] = $this->mSimetris->cariDataNomor($nomor_inventaris)->result();

		}elseif(isset($kondisi)){

			$data['subtitle'] 	= "Kondisi";
			$data['id'] 		= "kondisi=".$kondisi;

			$data['data'] = $this->mSimetris->cariDataKondisi($kondisi)->result();

		}elseif(isset($status)){

			$data['subtitle'] 	= "Status";
			$data['id'] 		= "status=".$status;

			$data['data'] = $this->mSimetris->cariDataStatus($status)->result();

		}elseif(isset($kode_ruangan)){
			$data['id'] 		= "kode_ruangan=".$kode_ruangan;

			if ($kode_ruangan=='0')
			{
				$data['subtitle'] 	= "Semua Ruangan";
				$data['data'] 		= $this->mSimetris->cariDataRuanganAll()->result();

			}else{

				$data['subtitle'] 	= "Ruangan";
				$data['data'] 		= $this->mSimetris->cariDataRuangan($kode_ruangan)->result();

			}
		}

		$this->load->view('templates/header',$data);
		$this->load->view('inventaris/vMenu',$data);
		$this->load->view('inventaris/vCariDataInventaris',$data);
		$this->load->view('templates/footer',$data);
	}

	public function tambahDataInventaris($id)
	{
		if($id==1)
		{
			$data['title'] 		= "Pencarian";
		}else{
			$data['title'] 		= "Tambah";
		}

		$data['id'] 			= $id;
		$data['subtitle'] 		= "Inventaris";

		$data['datajenis'] 		= $this->mSimetris->dataJenisInventaris()->result();
		$data['dataruangan'] 	= $this->mSimetris->dataRuanganInventaris()->result();

		$this->load->view('templates/header',$data);
		$this->load->view('inventaris/vMenu',$data);
		$this->load->view('inventaris/vTambahDataInventaris',$data);
		$this->load->view('templates/footer',$data);

	}

	public function tambahDataInventarisAksi()
	{
		$result = $this->mSimetris->getMax('inventaris','kode_registrasi')->result();
		foreach ($result as $d) {
			$kode_registrasi = $d->kode_registrasi+1;
		}
		
		$getDateNow 		= getDateNow();
		$kode_jenis 		= $this->input->post('kode_jenis');
		$kode_ruangan 		= $this->input->post('kode_ruangan');
		$nomor_inventaris 	= $kode_jenis.'/'.$getDateNow.'/'.$kode_registrasi;
		$nama_barang 		= $this->input->post('nama_barang');
		$tanggal_pengadaan 	= $this->input->post('tanggal_pengadaan');
		$kondisi 			= 1;
		$status 			= $this->input->post('status');
		$tanggal_kalibrasi 	= '0000-00-00';
		$kalibrasi_ulang 	= '0000-00-00';
		$keterangan 		= $this->input->post('keterangan');

		$data = array(

			'kode_registrasi' 	=> $kode_registrasi,
			'kode_jenis' 		=> $kode_jenis,
			'kode_ruangan' 		=> $kode_ruangan,
			'nomor_inventaris' 	=> $nomor_inventaris,
			'nama_barang' 		=> $nama_barang,
			'tanggal_pengadaan' => $tanggal_pengadaan,
			'kondisi' 			=> $kondisi,
			'status' 			=> $status,
			'tanggal_kalibrasi' => $tanggal_kalibrasi,
			'kalibrasi_ulang' 	=> $kalibrasi_ulang,
			'keterangan' 		=> $keterangan,

		);

		$this->mSimetris->insertData('inventaris',$data);
		$this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="5">Data berhasil ditambahkan</font></div>');
		redirect('inventaris/dataInventaris');

	}

	public function detailDataInventaris($id)
	{
		$data['title'] 		= "Detail";
		$data['subtitle'] 	= "Inventaris";

		$data['data'] = $this->mSimetris->detailDataInventaris($id)->result();

		$this->load->view('templates/header',$data);
		$this->load->view('inventaris/vMenu',$data);
		$this->load->view('inventaris/vDataDetailInventaris',$data,$id);
		$this->load->view('templates/footer',$data);
	}

	public function updateDataInventaris($id)
	{
		$data['title'] 			= "Update";
		$data['subtitle'] 		= "Inventaris";

		$data['data'] 			= $this->mSimetris->detailDataInventaris($id)->result();
		$data['datajenis'] 		= $this->mSimetris->dataJenisInventaris()->result();
		$data['dataruangan'] 	= $this->mSimetris->dataRuanganInventaris()->result();

		$this->load->view('templates/header',$data);
		$this->load->view('inventaris/vMenu',$data);
		$this->load->view('inventaris/vUpdateDataInventaris',$data,$id);
		$this->load->view('templates/footer',$data);
	}

	public function updateDataInventarisAksi($id)
	{
		$kode_jenis 		= $this->input->post('kode_jenis');
		$kode_ruangan 		= $this->input->post('kode_ruangan');
		$nomor_inventaris 	= $this->input->post('nomor_inventaris');
		$nama_barang 		= $this->input->post('nama_barang');
		$tanggal_pengadaan 	= $this->input->post('tanggal_pengadaan');
		$kondisi 			= $this->input->post('kode_ruangan');
		$status 			= $this->input->post('status');
		$tanggal_kalibrasi 	= $this->input->post('tanggal_kalibrasi');
		$kalibrasi_ulang 	= $this->input->post('kalibrasi_ulang');
		$keterangan 		= $this->input->post('keterangan');

		$data = array(

			'kode_registrasi' 	=> $id,
			'kode_jenis' 		=> $kode_jenis,
			'kode_ruangan' 		=> $kode_ruangan,
			'nomor_inventaris' 	=> $nomor_inventaris,
			'nama_barang' 		=> $nama_barang,
			'tanggal_pengadaan' => $tanggal_pengadaan,
			'kondisi' 			=> $kondisi,
			'status' 			=> $status,
			'tanggal_kalibrasi' => $tanggal_kalibrasi,
			'kalibrasi_ulang' 	=> $kalibrasi_ulang,
			'keterangan' 		=> $keterangan,

		);

		$where = array('kode_registrasi' => $id);

		$this->mSimetris->updateData('inventaris',$data,$where);
		$this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="5">Data berhasil diupdate</font>
			</div>');
		redirect('inventaris/dataInventaris/detailDataInventaris/'.$id);
	}

	public function deleteDataInventaris($id)
	{
		$where = array('kode_registrasi' => $id);
		$this->mSimetris->deleteData('inventaris',$where);
		$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="5">Data berhasil dihapus</font>
			</div>');
		redirect('inventaris/dataInventaris');

	}

	public function tambahDataJenis()
	{
		$data['title'] 		= "Tambah";
		$data['subtitle'] 	= "Jenis";

		$data['data'] 		= $this->mSimetris->dataJenisInventaris()->result();
		
		$this->load->view('templates/header',$data);
		$this->load->view('inventaris/vMenu',$data);
		$this->load->view('inventaris/vTambahDataJenis',$data);
		$this->load->view('templates/footer',$data);
	}

	public function tambahDataJenisAksi()
	{
		$max = $this->mSimetris->getData('inventaris_jenis')->num_rows()+1;

		$digit 		= strlen($max);

		if($digit==1){
			$kode_jenis = "K0".$max;
		}else{
			$kode_jenis = "K".$max;
		}

		$nama_jenis = $this->input->post('nama_jenis');

		$data = array(

			'kode_jenis' => $kode_jenis,
			'nama_jenis' => $nama_jenis,

		);

		$this->mSimetris->insertData('inventaris_jenis',$data);
		$this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="5">Data berhasil ditambahkan</font></div>');
		redirect('inventaris/dataInventaris/tambahDataJenis');
		
	}

	public function deleteDataJenis($id)
	{
		$where = array('kode_jenis' => $id);
		$this->mSimetris->deleteData('inventaris_jenis',$where);
		$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="5">Data berhasil dihapus</font>
			</div>');
		redirect('inventaris/dataInventaris/tambahDataJenis');

	}

	public function tambahDataRuangan()
	{
		$data['title'] 		= "Tambah";
		$data['subtitle'] 	= "Ruangan";

		$data['data'] 		= $this->mSimetris->dataRuanganInventaris()->result();
		
		$this->load->view('templates/header',$data);
		$this->load->view('inventaris/vMenu',$data);
		$this->load->view('inventaris/vTambahDataRuangan',$data);
		$this->load->view('templates/footer',$data);
	}

	public function tambahDataRuanganAksi()
	{
		$kode_ruangan 	= $this->input->post('kode_ruangan');
		$nama_ruangan 	= $this->input->post('nama_ruangan');

		$where = array('kode_ruangan' => $kode_ruangan);
		$cek = $this->mSimetris->countData("inventaris_ruangan",$where);

		if($cek>0)
		{
			$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<font size="5">Kode sudah ada</font></div>');
			redirect('inventaris/dataInventaris/tambahDataRuangan');

		}else{

			$data = array(

				'kode_ruangan' => $kode_ruangan,
				'nama_ruangan' => $nama_ruangan,

			);

			$this->mSimetris->insertData('inventaris_ruangan',$data);
			$this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<font size="5">Data berhasil ditambahkan</font></div>');
			redirect('inventaris/dataInventaris/tambahDataRuangan');

		}
	}

	public function deleteDataRuangan($id)
	{
		$where = array('kode_ruangan' => $id);
		$this->mSimetris->deleteData('inventaris_ruangan',$where);
		$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="5">Data berhasil dihapus</font>
			</div>');
		redirect('inventaris/dataInventaris/tambahDataRuangan');

	}

	public function excelDataInventaris()
	{
		$nomor_inventaris 	= $this->input->get('nomor_inventaris');
		$kondisi 			= $this->input->get('kondisi');
		$status 			= $this->input->get('status');
		$kode_ruangan 		= $this->input->get('kode_ruangan');

		if(isset($nomor_inventaris))
		{
			$data['subtitle'] 	= "Nomor Inventaris";
			$data['id'] 		= "nomor_inventaris=".$nomor_inventaris;

			$data['data'] 		= $this->mSimetris->cariDataNomor($nomor_inventaris)->result();

		}elseif(isset($kondisi)){

			$data['subtitle'] 	= "Kondisi";
			$data['id'] 		= "kondisi=".$kondisi;

			$data['data'] = $this->mSimetris->cariDataKondisi($kondisi)->result();

		}elseif(isset($status)){

			$data['subtitle'] 	= "Status";
			$data['id'] 		= "status=".$status;

			$data['data'] = $this->mSimetris->cariDataStatus($status)->result();

		}elseif(isset($kode_ruangan)){
			$data['id'] 		= "kode_ruangan=".$kode_ruangan;

			if ($kode_ruangan=='0')
			{
				$data['subtitle'] 	= "Semua Ruangan";
				$data['data'] 		= $this->mSimetris->cariDataRuanganAll()->result();

			}else{

				$data['subtitle'] 	= "Ruangan";
				$data['data'] 		= $this->mSimetris->cariDataRuangan($kode_ruangan)->result();

			}
		}

		$this->load->view('templates/header',$data);
		$this->load->view('inventaris/vExcelDataInventaris',$data);
	}


}

?>
