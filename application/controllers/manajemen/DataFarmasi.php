<?php 

class dataFarmasi extends CI_Controller
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
			redirect('manajemen/login');
		}

		$this->load->model("mSimetris");
		$this->load->library('form_validation');
	}

	function dataEdObat($id)
	{
		$data['title'] 		= "Data";
		$data['subtitle'] 	= "Expired Date Obat";

		if($id==2)
		{

			$bln 	= $this->input->post('bln');
			$thn 	= $this->input->post('thn');

			if(isset($bln) && empty($thn))
			{
				$data['data'] 	= 'bln='.$bln;

				$data['dataedobat'] = $this->db->query("
					SELECT * FROM far_stok WHERE MONTH(tgl_ed) = '$bln' ORDER BY nama ASC")->result();

			}elseif(isset($thn) && empty($bln)){

				$data['data'] 	= 'thn='.$thn;

				$data['dataedobat'] = $this->db->query("
					SELECT * FROM far_stok WHERE YEAR(tgl_ed) = '$thn' ORDER BY nama ASC")->result();

			}elseif(isset($bln) && isset($thn)){

				$data['data'] 	= 'bln='.$bln.'&'.'thn='.$thn;

				$data['dataedobat'] = $this->db->query("
					SELECT * FROM far_stok WHERE MONTH(tgl_ed) = '$bln' AND YEAR(tgl_ed) = '$thn' ORDER BY nama ASC")->result();

			}

		}

		$this->load->view('templates/header',$data);
		$this->load->view('manajemen/vMenu',$data);
		$this->load->view('manajemen/farmasi/vDataEdObat',$data);
		$this->load->view('templates/footer',$data);
	}

	function printDataEdObat()
	{
		$data['title'] 		= "Data";
		$data['subtitle'] 	= "Expired Date Obat";

		$bln 	= $this->input->get('bln');
		$thn 	= $this->input->get('thn');

		if(isset($bln) && empty($thn))
		{
			$data['data'] 	= 'Bulan : '.$bln;

			$data['dataedobat'] = $this->db->query("
				SELECT * FROM far_stok WHERE MONTH(tgl_ed) = '$bln' ORDER BY nama ASC")->result();

		}elseif(isset($thn) && empty($bln)){

			$data['data'] 	= 'Tahun : '.$thn;

			$data['dataedobat'] = $this->db->query("
				SELECT * FROM far_stok WHERE YEAR(tgl_ed) = '$thn' ORDER BY nama ASC")->result();

		}elseif(isset($bln) && isset($thn)){

			$data['data'] 	= 'Periode Bulan : '.$bln.'/'.$thn;

			$data['dataedobat'] = $this->db->query("
				SELECT * FROM far_stok WHERE MONTH(tgl_ed) = '$bln' AND YEAR(tgl_ed) = '$thn' ORDER BY nama ASC")->result();

		}

		$this->load->view('templates/header',$data);
		$this->load->view('manajemen/vMenu',$data);
		$this->load->view('manajemen/farmasi/vPrintDataEdObat',$data);
	}


}

?>