<?php 

class dataTarif extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model("mSimetris");
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] 		= "Tarif";
		$data['subtitle'] 	= "Tabel";

		$data['id'] = FALSE;

		$this->load->view('templates/header',$data);
		$this->load->view('booking/vMenu',$data);
		$this->load->view('booking/vDataTarif',$data);
		$this->load->view('templates/footer',$data);
	}

	public function cariDataTarif($id)
	{
		$data['title'] 		= "Tarif";
		$data['subtitle'] 	= "Tabel";

		$data['id'] = $id;
		$keyword = $this->input->post('keyword');

		if($id==1)
		{
			$data['datatarif'] = $this->db->query("
				SELECT kode, nama, tarif FROM ksr_tarif WHERE nama LIKE '%' '$keyword' '%' AND publish=1 ORDER BY nama ASC")->result();
		}elseif($id==2)
		{
			$data['datatarif'] = $this->db->query("
				SELECT no_urut, nama, harga_jual FROM far_stok WHERE nama LIKE '%' '$keyword' '%' ORDER BY nama ASC")->result();
		}elseif($id==3)
		{
			$data['datatarif'] = $this->db->query("
				SELECT id_lab_tarif, nama, tarif FROM lab_tarif WHERE nama LIKE '%' '$keyword' '%' ORDER BY nama ASC")->result();
		}

		
		$this->load->view('templates/header',$data);
		$this->load->view('booking/vDataTarif',$data,$id);
		$this->load->view('templates/footer',$data);
	}

}

?>