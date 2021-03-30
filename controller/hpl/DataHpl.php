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
			redirect('hpl/login');
		}

		$this->load->model("mSimetris");
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] 		= "Dashboard";
		$data['subtitle'] 	= getDateIndo();

		$getMonthNow = getMonthNow();
		$getYearNow  = getYearNow();

		$data['datadokter'] = $this->db->query("
			SELECT hpl_register.id_dokter, dokter.nama_dokter FROM hpl_register, dokter WHERE hpl_register.id_dokter=dokter.id_dokter AND MONTH(hpl_register.tgl_hpl)='$getMonthNow' AND YEAR(hpl_register.tgl_hpl)='$getYearNow' AND dokter.status=1 GROUP BY hpl_register.id_dokter
			")->result();
		$data['databulan'] = $this->db->query("
			SELECT MONTH(tgl_hpl) AS id_bulan,
			CASE
			WHEN MONTH(tgl_hpl)='1' THEN 'Januari'
			WHEN MONTH(tgl_hpl)='2' THEN 'Februari'
			WHEN MONTH(tgl_hpl)='3' THEN 'Maret'
			WHEN MONTH(tgl_hpl)='4' THEN 'April'
			WHEN MONTH(tgl_hpl)='5' THEN 'Mei'
			WHEN MONTH(tgl_hpl)='6' THEN 'Juni'
			WHEN MONTH(tgl_hpl)='7' THEN 'Juli'
			WHEN MONTH(tgl_hpl)='8' THEN 'Agustus'
			WHEN MONTH(tgl_hpl)='9' THEN 'September'
			WHEN MONTH(tgl_hpl)='10' THEN 'Oktober'
			WHEN MONTH(tgl_hpl)='11' THEN 'November'
			WHEN MONTH(tgl_hpl)='12' THEN 'Desember'
			END AS nama_bulan
			FROM hpl_register
			WHERE YEAR(tgl_hpl)='$getYearNow'
			GROUP BY id_bulan
			")->result();
		
		$totaldatahpl = $this->db->query("SELECT hpl_register.id_hpl_register, hpl_register.id_catatan_medik, hpl_register.tgl_hpl, mr_pasien.nama, mr_pasien.telp, mr_pasien.alamat, dokter.nama_dokter
			FROM hpl_register
			INNER JOIN mr_pasien ON hpl_register.id_catatan_medik=mr_pasien.id_catatan_medik
			INNER JOIN dokter ON hpl_register.id_dokter=dokter.id_dokter
			WHERE MONTH(hpl_register.tgl_hpl)='$getMonthNow'
			AND YEAR(hpl_register.tgl_hpl)='$getYearNow'
			ORDER BY hpl_register.tgl_hpl ASC");
		
		$data['totaldatahpl'] 		= $totaldatahpl->num_rows();

		$data['datahpl'] = $this->db->query("
			SELECT hpl_register.id_hpl_register, hpl_register.id_catatan_medik, hpl_register.tgl_hpl, mr_pasien.nama, mr_pasien.telp, mr_pasien.alamat, dokter.nama_dokter
			FROM hpl_register
			INNER JOIN mr_pasien ON hpl_register.id_catatan_medik=mr_pasien.id_catatan_medik
			INNER JOIN dokter ON hpl_register.id_dokter=dokter.id_dokter
			WHERE MONTH(hpl_register.tgl_hpl)='$getMonthNow'
			AND YEAR(hpl_register.tgl_hpl)='$getYearNow'
			ORDER BY hpl_register.tgl_hpl ASC")->result();


		$this->load->view('templates/header',$data);
		$this->load->view('hpl/vMenu',$data);
		$this->load->view('hpl/vDataHpl',$data);
		$this->load->view('templates/footer',$data);
	}

	public function tabDataHpl($value,$id)
	{
		$data['title'] 		= "Dashboard";
		$data['subtitle'] 	= "HPL Register";

		$getMonthNow = getMonthNow();
		$getYearNow  = getYearNow();

		$data['value'] = $value;

		$data['datadokter'] = $this->db->query("
			SELECT hpl_register.id_dokter, dokter.nama_dokter FROM hpl_register, dokter WHERE hpl_register.id_dokter=dokter.id_dokter AND MONTH(hpl_register.tgl_hpl)='$getMonthNow' AND YEAR(hpl_register.tgl_hpl)='$getYearNow' AND dokter.status=1 GROUP BY hpl_register.id_dokter
			")->result();
		$data['databulan'] = $this->db->query("
			SELECT MONTH(tgl_hpl) AS id_bulan,
			CASE
			WHEN MONTH(tgl_hpl)='1' THEN 'Januari'
			WHEN MONTH(tgl_hpl)='2' THEN 'Februari'
			WHEN MONTH(tgl_hpl)='3' THEN 'Maret'
			WHEN MONTH(tgl_hpl)='4' THEN 'April'
			WHEN MONTH(tgl_hpl)='5' THEN 'Mei'
			WHEN MONTH(tgl_hpl)='6' THEN 'Juni'
			WHEN MONTH(tgl_hpl)='7' THEN 'Juli'
			WHEN MONTH(tgl_hpl)='8' THEN 'Agustus'
			WHEN MONTH(tgl_hpl)='9' THEN 'September'
			WHEN MONTH(tgl_hpl)='10' THEN 'Oktober'
			WHEN MONTH(tgl_hpl)='11' THEN 'November'
			WHEN MONTH(tgl_hpl)='12' THEN 'Desember'
			END AS nama_bulan
			FROM hpl_register
			WHERE YEAR(tgl_hpl)='$getYearNow'
			GROUP BY id_bulan
			")->result();

		if($value==1)
		{

			$data['dataHplTab'] = $this->db->query("
				SELECT hpl_register.id_hpl_register, hpl_register.id_catatan_medik, hpl_register.tgl_hpl, mr_pasien.nama, mr_pasien.telp, dokter.nama_dokter, psdi_petugas.nama AS nama_petugas
				FROM hpl_register, mr_pasien, dokter, psdi_petugas
				WHERE hpl_register.id_catatan_medik=mr_pasien.id_catatan_medik
				AND hpl_register.id_dokter=dokter.id_dokter
				AND hpl_register.id_petugas=psdi_petugas.id_petugas
				AND hpl_register.id_dokter='$id'
				AND MONTH(hpl_register.tgl_hpl)='$getMonthNow'
				AND YEAR(hpl_register.tgl_hpl)='$getYearNow'
				ORDER BY hpl_register.tgl_hpl ASC")->result();

			$totalDataHplTab = $this->db->query("
				SELECT hpl_register.id_hpl_register, hpl_register.id_catatan_medik, hpl_register.tgl_hpl, mr_pasien.nama, mr_pasien.telp, dokter.nama_dokter, psdi_petugas.nama AS nama_petugas
				FROM hpl_register, mr_pasien, dokter, psdi_petugas
				WHERE hpl_register.id_catatan_medik=mr_pasien.id_catatan_medik
				AND hpl_register.id_dokter=dokter.id_dokter
				AND hpl_register.id_petugas=psdi_petugas.id_petugas
				AND hpl_register.id_dokter='$id'
				AND MONTH(hpl_register.tgl_hpl)='$getMonthNow'
				AND YEAR(hpl_register.tgl_hpl)='$getYearNow'
				ORDER BY hpl_register.tgl_hpl ASC");

		}else{

			$data['dataHplTab'] = $this->db->query("
				SELECT hpl_register.id_hpl_register, hpl_register.id_catatan_medik, hpl_register.tgl_hpl, mr_pasien.nama, mr_pasien.telp, dokter.nama_dokter, psdi_petugas.nama AS nama_petugas
				FROM hpl_register, mr_pasien, dokter, psdi_petugas
				WHERE hpl_register.id_catatan_medik=mr_pasien.id_catatan_medik
				AND hpl_register.id_dokter=dokter.id_dokter
				AND hpl_register.id_petugas=psdi_petugas.id_petugas
				AND MONTH(hpl_register.tgl_hpl)='$id'
				AND YEAR(hpl_register.tgl_hpl)='$getYearNow'
				ORDER BY hpl_register.tgl_hpl ASC")->result();

			$totalDataHplTab = $this->db->query("
				SELECT hpl_register.id_hpl_register, hpl_register.id_catatan_medik, hpl_register.tgl_hpl, mr_pasien.nama, mr_pasien.telp, dokter.nama_dokter, psdi_petugas.nama AS nama_petugas
				FROM hpl_register, mr_pasien, dokter, psdi_petugas
				WHERE hpl_register.id_catatan_medik=mr_pasien.id_catatan_medik
				AND hpl_register.id_dokter=dokter.id_dokter
				AND hpl_register.id_petugas=psdi_petugas.id_petugas
				AND MONTH(hpl_register.tgl_hpl)='$id'
				AND YEAR(hpl_register.tgl_hpl)='$getYearNow'
				ORDER BY hpl_register.tgl_hpl ASC");

		}

		$data['totalDataHplTab'] = $totalDataHplTab->num_rows();

		$this->load->view('templates/header',$data);
		$this->load->view('hpl/vMenu',$data);
		$this->load->view('hpl/vDataHplTab',$data);
		$this->load->view('templates/footer',$data);
	}

	public function registerDataHpl()
	{
		$data['title'] 		= "Registrasi";
		$data['subtitle'] 	= getDateIndo();

		$getDatenow = getDatenow();

		$data['datahplregister'] = $this->db->query("
			SELECT *, mr_pasien.nama, mr_pasien.telp, mr_pasien.alamat, dokter.nama_dokter
			FROM hpl_register
			INNER JOIN mr_pasien ON hpl_register.id_catatan_medik=mr_pasien.id_catatan_medik
			INNER JOIN dokter ON hpl_register.id_dokter=dokter.id_dokter
			WHERE hpl_register.tanggal='$getDatenow'
			ORDER BY hpl_register.id_hpl_register DESC")->result();


		$this->load->view('templates/header',$data);
		$this->load->view('hpl/vMenu',$data);
		$this->load->view('hpl/vDataHplRegister',$data);
		$this->load->view('templates/footer',$data);
	}

	public function tambahDataHpl($id)
	{
		if($id==1){

			$data['title'] 		= "Pencarian";

		}else{

			$data['title'] 		= "Tambah";
			
		}

		$data['subtitle'] 	= "Data HPL";

		$data['id'] = $id;

		$data['datadokter'] = $this->db->query("SELECT id_dokter, nama_dokter FROM dokter WHERE id_unit=2 AND status=1")->result();
		$data['dataunit'] 	= $this->db->query("SELECT id_unit, nama_unit FROM mr_unit")->result();

		$data['record']=  $this->mSimetris->getData('mr_pasien');

		$this->load->view('templates/header',$data);
		$this->load->view('hpl/vMenu',$data);
		$this->load->view('hpl/vTambahDataHpl',$data);
		$this->load->view('templates/footer',$data);
	}

	public function filterDataHplAksi($id)
	{
		if($id==1){

			$data['title'] 		= "Pencarian";

		}else{

			$data['title'] 		= "Tambah";
			
		}
		$data['subtitle'] 	= "Data HPL";

		$data['id'] = $id;

		$bln 	= $this->input->post('bln');
		$thn 	= $this->input->post('thn');

		$data['bln'] = $bln;

		$data['datahpl'] = $this->db->query("
			SELECT *, mr_pasien.nama, mr_pasien.telp, mr_pasien.alamat, dokter.nama_dokter
			FROM hpl_register
			INNER JOIN mr_pasien ON hpl_register.id_catatan_medik=mr_pasien.id_catatan_medik
			INNER JOIN dokter ON hpl_register.id_dokter=dokter.id_dokter
			WHERE MONTH(hpl_register.tgl_hpl)='$bln'
			AND YEAR(hpl_register.tgl_hpl)='$thn'
			ORDER BY hpl_register.tgl_hpl ASC")->result();


		$this->load->view('templates/header',$data);
		$this->load->view('hpl/vMenu',$data);
		$this->load->view('hpl/vTambahDataHpl',$data);
		$this->load->view('templates/footer',$data);
	}

	public function cari(){
		$id_catatan_medik=$_GET['id_catatan_medik'];
		$cari =$this->mSimetris->cari($id_catatan_medik)->result();
		echo json_encode($cari);
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
		redirect('hpl/dataHpl/tambahDataHpl/'.$id);

	}

}

?>