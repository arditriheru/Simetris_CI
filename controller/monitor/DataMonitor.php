<?php 

class dataMonitor extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model("mSimetris");
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] 		= "Monitor";
		$data['subtitle'] 	= "Antrian";

		$this->load->view('monitor/vMonitor',$data);
	}

	// antrian poli obsgyn selatan
	function poli1()
	{
		$aa = $this->db->query("
			SELECT *, dokter.nama_dokter
			FROM antrian
			INNER JOIN dokter
			ON antrian.id_dokter = dokter.id_dokter
			WHERE antrian.id_unit = 2
			AND antrian.konter = 1")->result();

		foreach ($aa as $d) {
			$id_dokter 			= $d->id_dokter;
			$id_sesi 			= $d->id_sesi;
			$nama_dokter 		= $d->nama_dokter;
			$booking_tanggal 	= getDatenow();
		}

		if(!isset($id_dokter))
		{
			$tcounter     = 'X';

			echo $tcounter;

		}else{

			$bb = $this->db->query("
				SELECT id_booking AS id_booking
				FROM booking 
				WHERE booking_tanggal = '$booking_tanggal'
				AND id_dokter = '$id_dokter'
				AND id_sesi = '$id_sesi'
				AND aktif = 1")->result();

			foreach ($bb as $d) {
				$id_booking = $d->id_booking;
			}

			if(!isset($id_booking))
			{
				$tcounter     = '0';

				echo "A".$tcounter;

			}else{

				$dd = $this->db->query("
					SELECT FIND_IN_SET( id_booking, (    
					SELECT GROUP_CONCAT( id_booking
					ORDER BY id_booking ASC ) 
					FROM booking 
					WHERE booking_tanggal = '$booking_tanggal'
					AND id_dokter = '$id_dokter'
					AND id_sesi = '$id_sesi')
					) AS noant
					FROM booking
					WHERE id_booking = '$id_booking'")->result();

				foreach ($dd as $d) {
					$tcounter = $d->noant;
					$ncounter = $d->noant+1;
				}
				echo "A".$tcounter;
			}
		}
	}

	// antrian poli anak
	function poli2()
	{
		$aa = $this->db->query("
			SELECT *, dokter.nama_dokter
			FROM antrian
			INNER JOIN dokter
			ON antrian.id_dokter = dokter.id_dokter
			WHERE antrian.id_unit = 1
			AND antrian.konter = 2")->result();

		foreach ($aa as $d) {
			$id_dokter 			= $d->id_dokter;
			$id_sesi 			= $d->id_sesi;
			$nama_dokter 		= $d->nama_dokter;
			$booking_tanggal 	= getDatenow();
		}

		if(!isset($id_dokter))
		{
			$tcounter     = 'X';

			echo $tcounter;

		}else{

			$bb = $this->db->query("
				SELECT id_booking AS id_booking
				FROM booking 
				WHERE booking_tanggal = '$booking_tanggal'
				AND id_dokter = '$id_dokter'
				AND id_sesi = '$id_sesi'
				AND aktif = 1")->result();

			foreach ($bb as $d) {
				$id_booking = $d->id_booking;
			}

			if(!isset($id_booking))
			{
				$tcounter     = '0';

				echo "B".$tcounter;

			}else{

				$dd = $this->db->query("
					SELECT FIND_IN_SET( id_booking, (    
					SELECT GROUP_CONCAT( id_booking
					ORDER BY id_booking ASC ) 
					FROM booking 
					WHERE booking_tanggal = '$booking_tanggal'
					AND id_dokter = '$id_dokter'
					AND id_sesi = '$id_sesi')
					) AS noant
					FROM booking
					WHERE id_booking = '$id_booking'")->result();

				foreach ($dd as $d) {
					$tcounter = $d->noant;
					$ncounter = $d->noant+1;
				}
				echo "B".$tcounter;
			}
		}
	}

	// antrian poli obsgyn utara
	function poli3()
	{
		$aa = $this->db->query("
			SELECT *, dokter.nama_dokter
			FROM antrian
			INNER JOIN dokter
			ON antrian.id_dokter = dokter.id_dokter
			WHERE antrian.id_unit = 2
			AND antrian.konter = 3")->result();

		foreach ($aa as $d) {
			$id_dokter 		= $d->id_dokter;
			$id_sesi 			= $d->id_sesi;
			$nama_dokter 		= $d->nama_dokter;
			$booking_tanggal 	= getDatenow();
		}

		if(!isset($id_dokter))
		{
			$tcounter     = 'X';

			echo $tcounter;

		}else{

			$bb = $this->db->query("
				SELECT id_booking AS id_booking
				FROM booking 
				WHERE booking_tanggal = '$booking_tanggal'
				AND id_dokter = '$id_dokter'
				AND id_sesi = '$id_sesi'
				AND aktif = 1")->result();

			foreach ($bb as $d) {
				$id_booking = $d->id_booking;
			}

			if(!isset($id_booking))
			{
				$tcounter     = '0';

				echo "C".$tcounter;

			}else{

				$dd = $this->db->query("
					SELECT FIND_IN_SET( id_booking, (    
					SELECT GROUP_CONCAT( id_booking
					ORDER BY id_booking ASC ) 
					FROM booking 
					WHERE booking_tanggal = '$booking_tanggal'
					AND id_dokter = '$id_dokter'
					AND id_sesi = '$id_sesi')
					) AS noant
					FROM booking
					WHERE id_booking = '$id_booking'")->result();

				foreach ($dd as $d) {
					$tcounter = $d->noant;
					$ncounter = $d->noant+1;
				}
				echo "C".$tcounter;
			}
		}
	}

	function dokter1()
	{
		$aa = $this->db->query("
			SELECT *, dokter.nama_dokter
			FROM antrian
			INNER JOIN dokter
			ON antrian.id_dokter = dokter.id_dokter
			WHERE antrian.id_unit = 2
			AND antrian.konter = 1")->result();

		foreach ($aa as $d) {
			$nama_dokter 		= $d->nama_dokter;
		}

		if (!isset($nama_dokter)) {
			echo $nama_dokter = "Tutup";
		}else{
			echo $nama_dokter;
		}
	}

	function dokter2()
	{
		$aa = $this->db->query("
			SELECT *, dokter.nama_dokter
			FROM antrian
			INNER JOIN dokter
			ON antrian.id_dokter = dokter.id_dokter
			WHERE antrian.id_unit = 1
			AND antrian.konter = 2")->result();

		foreach ($aa as $d) {
			$nama_dokter 		= $d->nama_dokter;
		}

		if (!isset($nama_dokter)) {
			echo $nama_dokter = "Tutup";
		}else{
			echo $nama_dokter;
		}
	}

	function dokter3()
	{
		$aa = $this->db->query("
			SELECT *, dokter.nama_dokter
			FROM antrian
			INNER JOIN dokter
			ON antrian.id_dokter = dokter.id_dokter
			WHERE antrian.id_unit = 2
			AND antrian.konter = 3")->result();

		foreach ($aa as $d) {
			$nama_dokter 		= $d->nama_dokter;
		}

		if (!isset($nama_dokter)) {
			echo $nama_dokter = "Tutup";
		}else{
			echo $nama_dokter;
		}
	}

	function total1()
	{
		$aa = $this->db->query("
			SELECT *, dokter.nama_dokter
			FROM antrian
			INNER JOIN dokter
			ON antrian.id_dokter = dokter.id_dokter
			WHERE antrian.id_unit = 2
			AND antrian.konter = 1")->result();

		foreach ($aa as $d) {
			$id_dokter 			= $d->id_dokter;
			$id_sesi 			= $d->id_sesi;
			$booking_tanggal 	= getDatenow();
		}

		if (!isset($id_dokter))
		{
			$total = "0";

		}else{

			$bb = $this->db->query("
				SELECT COUNT(id_booking) AS total
				FROM booking 
				WHERE booking_tanggal = '$booking_tanggal'
				AND id_dokter = '$id_dokter'
				AND id_sesi = '$id_sesi'")->result();

			foreach ($bb as $d) {
				$total = $d->total;
			}
			
		}

		echo $total;
	}

	function total2()
	{
		$aa = $this->db->query("
			SELECT *, dokter.nama_dokter
			FROM antrian
			INNER JOIN dokter
			ON antrian.id_dokter = dokter.id_dokter
			WHERE antrian.id_unit = 1
			AND antrian.konter = 2")->result();

		foreach ($aa as $d) {
			$id_dokter 			= $d->id_dokter;
			$id_sesi 			= $d->id_sesi;
			$booking_tanggal 	= getDatenow();
		}

		if (!isset($id_dokter))
		{
			$total = "0";

		}else{

			$bb = $this->db->query("
				SELECT COUNT(id_booking) AS total
				FROM booking 
				WHERE booking_tanggal = '$booking_tanggal'
				AND id_dokter = '$id_dokter'
				AND id_sesi = '$id_sesi'")->result();

			foreach ($bb as $d) {
				$total = $d->total;
			}
			
		}

		echo $total;
	}

	function total3()
	{
		$aa = $this->db->query("
			SELECT *, dokter.nama_dokter
			FROM antrian
			INNER JOIN dokter
			ON antrian.id_dokter = dokter.id_dokter
			WHERE antrian.id_unit = 2
			AND antrian.konter = 3")->result();

		foreach ($aa as $d) {
			$id_dokter 			= $d->id_dokter;
			$id_sesi 			= $d->id_sesi;
			$booking_tanggal 	= getDatenow();
		}

		if (!isset($id_dokter))
		{
			$total = "0";

		}else{

			$bb = $this->db->query("
				SELECT COUNT(id_booking) AS total
				FROM booking 
				WHERE booking_tanggal = '$booking_tanggal'
				AND id_dokter = '$id_dokter'
				AND id_sesi = '$id_sesi'")->result();

			foreach ($bb as $d) {
				$total = $d->total;
			}

		}

		echo $total;
	}

} 

?>