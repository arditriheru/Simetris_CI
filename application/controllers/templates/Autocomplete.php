<?php 

class autocomplete extends CI_Controller { 
	function __construct() { 
		parent::__construct(); 
		$this->load->model('mCovid');
	}

	public function index()
	{
		$data['record']=  $this->mCovid->getData();
		$this->load->view('view_data',$data);
	}

	public function cari(){
		$id_catatan_medik=$_GET['id_catatan_medik'];
		$cari =$this->mCovid->cari($id_catatan_medik)->result();
		echo json_encode($cari);
	} 

}

?>