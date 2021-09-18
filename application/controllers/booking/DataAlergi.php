<?php 

class dataAlergi extends CI_Controller
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

	public function tambahHbsag($id,$rm)
	{
		$getDatenow = getDatenow();
		$data = array(

			'id_catatan_medik' 	=> $rm,
			'tanggal' 			=> $getDatenow,

		);

		$this->mSimetris->insertData('mr_hbsag',$data);
		redirect('booking/dataBooking/detailDataPoli/'.$id);
	}

	public function hapusHbsag($id,$rm)
	{	
		$where = array('id_catatan_medik' => $rm);

		$this->mSimetris->deleteData('mr_hbsag',$where);
		redirect('booking/dataBooking/detailDataPoli/'.$id);
	}

	public function dataAlergiMakanan($id,$rm)
	{
		$data['id'] = $id;
		$data['id_booking'] = $this->input->get('id_booking');

		if ($id==1) {

			$data['title'] 	= "Tambah";
			$data['rm']		= $rm;

		}else{

			$data['title'] 		= "Edit";

			$data['data'] = $this->db->query("
				SELECT id_catatan_medik, nama_makanan FROM mr_alergi_makanan WHERE id_catatan_medik = '$rm'")->result();

		}
		
		$data['subtitle'] 	= "Alergi Makanan";

		$this->load->view('templates/header',$data);
		$this->load->view('booking/vMenu',$data);
		$this->load->view('booking/vDataAlergiMakanan',$data);
		$this->load->view('templates/footer',$data);
	}

	public function updateDataAlergiMakananAksi($id)
	{
		$id_catatan_medik 	= $this->input->post('id_catatan_medik');
		$nama_makanan 		= $this->input->post('nama_makanan');

		$data = array('nama_makanan' => $nama_makanan);
		$where = array('id_catatan_medik' => $id_catatan_medik);

		$this->mSimetris->updateData('mr_alergi_makanan',$data,$where);
		redirect('booking/dataBooking/detailDataPoli/'.$id);
	}

	public function tambahDataAlergiMakananAksi($id)
	{
		$id_catatan_medik 	= $this->input->post('id_catatan_medik');
		$nama_makanan 		= $this->input->post('nama_makanan');
		$getDatenow			= getDatenow();

		$data = array(
			'id_catatan_medik'	=> $id_catatan_medik,
			'nama_makanan' 		=> $nama_makanan,
			'tanggal' 			=> $getDatenow,
		);

		$this->mSimetris->insertData('mr_alergi_makanan',$data);
		$this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			Berhasil menambahkan</div>');
		redirect('booking/dataBooking/detailDataPoli/'.$id);
	}

	public function hapusDataAlergiMakanan($id,$rm)
	{	
		$where = array('id_catatan_medik' => $rm);

		$this->mSimetris->deleteData('mr_alergi_makanan',$where);
		redirect('booking/dataBooking/detailDataPoli/'.$id);
	}

}

?>