<?php 

class mSimetris extends CI_Model
{

/*
|--------------------------------------------------------------------------
|
| Model public
|
|--------------------------------------------------------------------------
*/

public function getData($table)
{
	return $this->db->get($table);
}

function cari($id)
{
	$query= $this->db->get_where('mr_pasien',array('id_catatan_medik'=>$id));
	return $query;
}

public function insertData($table,$data)
{
	$this->db->insert($table,$data);
}

public function updateData($table,$data,$where)
{
	$this->db->update($table,$data,$where);
}

public function deleteData($table,$where)
{
	$this->db->where($where);
	$this->db->delete($table);
}

public function cekLogin()
{
	$username = set_value('username');
	$password = set_value('password');

	$query = $this->db->where('nama_user',$username)
	-> where('password',md5($password))
	-> limit('1')
	-> get('psdi_petugas');

	if($query->num_rows()>0)
	{
		return $query->row();
	}else{
		return FALSE;
	}
}

public function cekLogin2($username,$password,$id_unit)
{
	$query = $this->db->where('username',$username)
	-> where('password',md5($password))
	-> where('id_unit',$id_unit)
	-> limit('1')
	-> get('admin');

	if($query->num_rows()>0)
	{
		return $query->row();
	}else{
		return FALSE;
	}
}

public function hakAkses($username,$password,$id)
{
	$query = $this->db->where('psdi_petugas.nama_user',$username)
	-> where('psdi_petugas.password',md5($password))
	-> where('psdi_riw_aplikasi.id_aplikasi',$id)
	-> limit('1')
	-> join('psdi_riw_aplikasi','psdi_petugas.id_petugas=psdi_riw_aplikasi.id_petugas')
	-> get('psdi_petugas');

	if($query->num_rows()>0)
	{
		return $query->row();
	}else{
		return FALSE;
	}
}

function countData($table,$where)
{
	$this->db->where($where);
	$query = $this->db->get($table);
	return $query->num_rows();
}

function selectData($table,$column,$where)
{
	$this->db->select($column);
	$this->db->where($where);
	$query = $this->db->get($table);
	return $query;
}

function cariNamaPasienData($table,$keyword)
{
	$this->db->like($keyword);
	$this->db->order_by('nama', 'ASC');
	$query = $this->db->get($table);
	return $query;
}

function getMax($table,$column)
{
	$this->db->select_max($column);
	$query = $this->db->get($table);
	return $query; 
}

// function dataDokterAll()
// {
// 	$query = $this->db->query("
// 		SELECT id_dokter, nama_dokter FROM mr_dokter");
// 	return $query;
// }

// function dataDokterUnit($id)
// {
// 	$query = $this->db->query("
// 		SELECT id_dokter, nama_dokter FROM dokter WHERE id_unit='$id' AND status=1");
// 	return $query;
// }

function dataDokter($table,$where,$orderby)
{
	$this->db->select('id_dokter, nama_dokter');
	$this->db->from($table);
	$this->db->where($where);
	$this->db->order_by($orderby);
	return $this->db->get();
}

function dataPetugas($table,$where,$orderby)
{
	$this->db->select('id_petugas, nama_petugas');
	$this->db->from($table);
	$this->db->where($where);
	$this->db->order_by($orderby);
	return $this->db->get();
}

// function dataUnit()
// {
// 	$query = $this->db->query("
// 		SELECT id_unit, nama_unit FROM mr_unit");
// 	return $query;
// }

/*
|--------------------------------------------------------------------------
|
| Model booking
|
|--------------------------------------------------------------------------
*/

function dataAntrian($id_dokter,$id_sesi,$booking_tanggal)
{
	$query = $this->db->query("
		SELECT *, @no:=@no+1 AS noant, dokter.nama_dokter, dokter.id_unit, sesi.nama_sesi,
		IF (booking.status='1', 'Datang', 'Belum Datang') AS status
		FROM booking, dokter, sesi
		JOIN (SELECT @no:=0) r
		WHERE booking.id_dokter=dokter.id_dokter
		AND booking.id_sesi=sesi.id_sesi
		AND booking.booking_tanggal = '$booking_tanggal'
		AND booking.id_sesi = '$id_sesi'
		AND booking.id_dokter='$id_dokter' ORDER BY booking.id_booking ASC");
	return $query;
}

function dataPanggil($id_booking,$id_dokter,$id_sesi,$booking_tanggal)
{
	$query = $this->db->query("
		SELECT id_booking, nama, FIND_IN_SET( id_booking, (    
		SELECT GROUP_CONCAT( id_booking
		ORDER BY id_booking ASC ) 
		FROM booking 
		WHERE booking_tanggal = '$booking_tanggal'
		AND id_dokter = '$id_dokter'
		AND id_sesi = '$id_sesi')
		) AS noant
		FROM booking
		WHERE id_booking = '$id_booking'");
	return $query;
}

function dataWaktuTungguPoli($id_unit,$awal,$akhir)
{
	$this->db->select('*,dokter.id_unit, dokter.nama_dokter');
	$this->db->from('booking');
	$this->db->join('dokter','booking.id_dokter = dokter.id_dokter');
	$this->db->where('dokter.id_unit', $id_unit);
	$this->db->where("booking.booking_tanggal BETWEEN '$awal' AND '$akhir'");
	$this->db->where("booking.mulai != '00:00:00'");
	$this->db->where("booking.akhir != '00:00:00'");
	$this->db->order_by('booking.booking_tanggal, dokter.id_dokter, booking.id_booking ASC');
	return $this->db->get();
}

function dataDokterPoli($where)
{
	$this->db->select('*');
	$this->db->from('booking');
	$this->db->join('dokter','booking.id_dokter=dokter.id_dokter');
	$this->db->where($where);
	$this->db->group_by('booking.id_dokter');
	return $this->db->get();
}

function dataDokterTumbang($where)
{
	$this->db->select('*');
	$this->db->from('tumbang');
	$this->db->join('mr_petugas','tumbang.id_petugas=mr_petugas.id_petugas');
	$this->db->where($where);
	$this->db->group_by('tumbang.id_petugas');
	return $this->db->get();
}

function dataDokterAnc($where)
{
	$this->db->select('*');
	$this->db->from('anc');
	$this->db->join('mr_petugas','anc.id_petugas=mr_petugas.id_petugas');
	$this->db->where($where);
	$this->db->group_by('anc.id_petugas');
	return $this->db->get();
}

function dataPoli($where,$orderby)
{
	$this->db->select("booking.*, dokter.nama_dokter, sesi.nama_sesi, IF (booking.status='1', 'Datang', 'Belum Datang') AS status");
	$this->db->from('booking');
	$this->db->join('dokter','booking.id_dokter=dokter.id_dokter');
	$this->db->join('sesi','booking.id_sesi=sesi.id_sesi');
	$this->db->where($where);
	$this->db->order_by($orderby);
	return $this->db->get();
}

function dataTumbang($where)
{
	$this->db->select("tumbang.*, mr_petugas.nama_petugas, sesi.nama_sesi, IF (tumbang.status='1', 'Datang', 'Belum Datang') AS status");
	$this->db->from('tumbang');
	$this->db->join('mr_petugas','tumbang.id_petugas=mr_petugas.id_petugas');
	$this->db->join('sesi','tumbang.id_sesi=sesi.id_sesi');
	$this->db->where($where);
	$this->db->order_by('sesi.id_sesi, mr_petugas.id_petugas, tumbang.id_tumbang ASC');
	return $this->db->get();
}

function dataAnc($where)
{
	$this->db->select("anc.*, mr_petugas.nama_petugas, sesi.nama_sesi, IF (anc.status='1', 'Datang', 'Belum Datang') AS status");
	$this->db->from('anc');
	$this->db->join('mr_petugas','anc.id_petugas=mr_petugas.id_petugas');
	$this->db->join('sesi','anc.id_sesi=sesi.id_sesi');
	$this->db->where($where);
	$this->db->order_by('sesi.id_sesi, mr_petugas.id_petugas, anc.id_anc ASC');
	return $this->db->get();
}

function dataAlergi($where)
{
	$this->db->select("*");
	$this->db->from('mr_alergi');
	$this->db->where('id_catatan_medik',$where);
	$this->db->order_by('nama_obat, keterangan ASC');
	return $this->db->get();
}

// function detailDataPoli($id_booking)
// {
// 	$query = $this->db->query("
// 		SELECT booking.id_booking, booking.id_catatan_medik, booking.nama, booking.alamat, booking.booking_tanggal, booking.tanggal, booking.jam, booking.keterangan, booking.kontak, booking.status, dokter.nama_dokter, sesi.nama_sesi, mr_alergi.id_catatan_medik AS id_catatan_medik_alergi, mr_alergi.nama_obat, mr_alergi.keterangan AS alergi_keterangan,
// 		IF (booking.status='1', 'Datang', 'Belum Datang') AS nama_status
// 		FROM booking
// 		INNER JOIN dokter
// 		ON booking.id_dokter=dokter.id_dokter
// 		INNER JOIN sesi
// 		ON booking.id_sesi=sesi.id_sesi
// 		LEFT JOIN mr_alergi
// 		ON booking.id_catatan_medik = mr_alergi.id_catatan_medik
// 		WHERE booking.id_booking='$id_booking'
// 		ORDER BY booking.id_sesi, dokter.id_dokter, booking.nama ASC");
// 	return $query;
// }

function detailDataTumbang($table,$where)
{
	$this->db->select("tumbang.*,mr_petugas.nama_petugas, sesi.nama_sesi,IF (tumbang.status='1', 'Datang', 'Belum Datang') AS status");
	$this->db->from($table);
	$this->db->join("mr_petugas","tumbang.id_petugas = mr_petugas.id_petugas");
	$this->db->join("sesi","tumbang.id_sesi = sesi.id_sesi");
	$this->db->where($where);
	return $this->db->get();
}

function detailDataAnc($table,$where)
{
	$this->db->select("anc.*,mr_petugas.nama_petugas, sesi.nama_sesi,IF (anc.status='1', 'Datang', 'Belum Datang') AS status");
	$this->db->from($table);
	$this->db->join("mr_petugas","anc.id_petugas = mr_petugas.id_petugas");
	$this->db->join("sesi","anc.id_sesi = sesi.id_sesi");
	$this->db->where($where);
	return $this->db->get();
}

function tabDataPoli($where)
{
	$this->db->select("booking.*,dokter.nama_dokter, sesi.nama_sesi,IF (booking.status='1', 'Datang', 'Belum Datang') AS status");
	$this->db->from("booking");
	$this->db->join("dokter","booking.id_dokter = dokter.id_dokter");
	$this->db->join("sesi","booking.id_sesi = sesi.id_sesi");
	$this->db->where($where);
	$this->db->order_by("booking.id_sesi, booking.id_booking","ASC");
	return $this->db->get();
}

function dataRegisterPoli($where)
{
	$this->db->select('booking.*,dokter.nama_dokter, sesi.nama_sesi');
	$this->db->from('booking');
	$this->db->join('dokter','booking.id_dokter=dokter.id_dokter');
	$this->db->join('sesi','booking.id_sesi=sesi.id_sesi');
	$this->db->where($where);
	$this->db->order_by('booking.id_booking DESC');
	return $this->db->get();
}

function dataRegisterTumbang($where)
{
	$this->db->select('tumbang.*,mr_petugas.nama_petugas, sesi.nama_sesi');
	$this->db->from('tumbang');
	$this->db->join('mr_petugas','tumbang.id_petugas=mr_petugas.id_petugas');
	$this->db->join('sesi','tumbang.id_sesi=sesi.id_sesi');
	$this->db->where($where);
	$this->db->order_by('tumbang.id_tumbang DESC');
	return $this->db->get();
}

function dataRegisterAnc($where)
{
	$this->db->select('anc.*,mr_petugas.nama_petugas, sesi.nama_sesi');
	$this->db->from('anc');
	$this->db->join('mr_petugas','anc.id_petugas=mr_petugas.id_petugas');
	$this->db->join('sesi','anc.id_sesi=sesi.id_sesi');
	$this->db->where($where);
	$this->db->order_by('anc.id_anc DESC');
	return $this->db->get();
}

function dataJadwal($where)
{
	$this->db->select("dokter_jadwal.*,dokter.nama_dokter, sesi.nama_sesi,
		IF (dokter_jadwal.ims='1', ' + Imunisasi','') AS plus_ims, IF (dokter_jadwal.ims='1', 'Ya','Tidak') AS nama_ims,
		CASE
		WHEN dokter.id_unit='1' THEN 'Anak'
		WHEN dokter.id_unit='2' THEN 'Obsgyn'
		WHEN dokter.id_unit='3' THEN 'Bedah'
		END AS nama_unit,
		CASE
		WHEN dokter_jadwal.hari=1 THEN 'Senin'
		WHEN dokter_jadwal.hari=2 THEN 'Selasa'
		WHEN dokter_jadwal.hari=3 THEN 'Rabu'
		WHEN dokter_jadwal.hari=4 THEN 'Kamis'
		WHEN dokter_jadwal.hari=5 THEN 'Jumat'
		WHEN dokter_jadwal.hari=6 THEN 'Sabtu'
		WHEN dokter_jadwal.hari=0 THEN 'Minggu'
		END AS nama_hari");
	$this->db->from('dokter_jadwal');
	$this->db->join('dokter','dokter_jadwal.id_dokter=dokter.id_dokter');
	$this->db->join('sesi','dokter_jadwal.id_sesi=sesi.id_sesi');
	$this->db->where($where);
	$this->db->order_by('dokter_jadwal.hari ASC');
	return $this->db->get();

	// $query = $this->db->query("
	// 	SELECT *, dokter.nama_dokter, sesi.nama_sesi,
	// 	IF (dokter_jadwal.ims='1', ' + Imunisasi','') AS ims,
	// 	CASE
	// 	WHEN dokter.id_unit='1' THEN 'Anak'
	// 	WHEN dokter.id_unit='2' THEN 'Obsgyn'
	// 	WHEN dokter.id_unit='3' THEN 'Bedah'
	// 	END AS nama_unit,
	// 	CASE
	// 	WHEN dokter_jadwal.hari=1 THEN 'Senin'
	// 	WHEN dokter_jadwal.hari=2 THEN 'Selasa'
	// 	WHEN dokter_jadwal.hari=3 THEN 'Rabu'
	// 	WHEN dokter_jadwal.hari=4 THEN 'Kamis'
	// 	WHEN dokter_jadwal.hari=5 THEN 'Jumat'
	// 	WHEN dokter_jadwal.hari=6 THEN 'Sabtu'
	// 	WHEN dokter_jadwal.hari=0 THEN 'Minggu'
	// 	END AS nama_hari
	// 	FROM dokter_jadwal
	// 	JOIN dokter
	// 	ON dokter_jadwal.id_dokter=dokter.id_dokter
	// 	join sesi
	// 	ON dokter_jadwal.id_sesi=sesi.id_sesi
	// 	ORDER BY dokter_jadwal.hari ASC");
	// return $query;
}

function dataJadwalLibur()
{
	$query = $this->db->query("
		SELECT *, dokter.nama_dokter, sesi.nama_sesi
		FROM dokter_jadwal_libur
		JOIN dokter
		ON dokter_jadwal_libur.id_dokter=dokter.id_dokter
		JOIN sesi
		ON dokter_jadwal_libur.id_sesi=sesi.id_sesi
		ORDER BY dokter_jadwal_libur.tanggal ASC");
	return $query;
}

function dataKamar($where)
{
	$this->db->select("mr_tt.*, mr_unit.nama_unit, IF(mr_tt.no_bed='1', 'A', 'B') AS bed");
	$this->db->from('mr_tt');
	$this->db->join('mr_unit','mr_tt.id_unit = mr_unit.id_unit');
	$this->db->where_in('mr_unit.id_unit',$where);
	$this->db->order_by('mr_tt.kelas ASC');
	return $this->db->get();
}

// function cariDataPoli($where)
// {
// 	$this->db->select("booking.*, dokter.nama_dokter, sesi.nama_sesi,
// 		IF (booking.status='1', 'Datang', 'Belum Datang') AS status");
// 	$this->db->from('booking');
// 	$this->db->join('dokter','booking.id_dokter=dokter.id_dokter');
// 	$this->db->join('sesi','booking.id_sesi=sesi.id_sesi');
// 	$this->db->where($where);
// 	$this->db->order_by('booking.id_booking ASC');
// 	return $this->db->get();
// }

// function cariDataTumbang($where)
// {
// 	$this->db->select("tumbang.*, mr_petugas.nama_petugas, sesi.nama_sesi,
// 		IF (tumbang.status='1', 'Datang', 'Belum Datang') AS status");
// 	$this->db->from('tumbang');
// 	$this->db->join('mr_petugas','tumbang.id_petugas=mr_petugas.id_petugas');
// 	$this->db->join('sesi','tumbang.id_sesi=sesi.id_sesi');
// 	$this->db->where($where);
// 	$this->db->order_by('tumbang.id_tumbang ASC');
// 	return $this->db->get();
// }

// function cariDataAnc($where)
// {
// 	$this->db->select("anc.*, mr_petugas.nama_petugas, sesi.nama_sesi,
// 		IF (anc.status='1', 'Datang', 'Belum Datang') AS status");
// 	$this->db->from('anc');
// 	$this->db->join('mr_petugas','anc.id_petugas=mr_petugas.id_petugas');
// 	$this->db->join('sesi','anc.id_sesi=sesi.id_sesi');
// 	$this->db->where($where);
// 	$this->db->order_by('anc.id_anc ASC');
// 	return $this->db->get();
// }

// function dataSwab()
// {
// 	$this->db->select('booking_swab.*, mr_sex.nama_sex, jadwal_swab.hari, jadwal_swab.pukul');
// 	$this->db->from('booking_swab');
// 	$this->db->join('mr_sex','booking_swab.id_sex = mr_sex.id_sex');
// 	$this->db->join('jadwal_swab','booking_swab.id_jadwal_swab = jadwal_swab.id_jadwal_swab');
// 	return $this->db->get();
// }


/*
|--------------------------------------------------------------------------
|
| Model laboratorium
|
|--------------------------------------------------------------------------
*/

function dataAntibody()
{
	$query = $this->db->query("
		SELECT test_antibody.id_test_antibody, test_antibody.id_catatan_medik, test_antibody.tanggal, test_antibody.jam, test_antibody.igm, test_antibody.igg, mr_pasien.nama, mr_dokter.nama_dokter,
		CASE
		WHEN test_antibody.igm='0' THEN 'Non Reaktif'
		WHEN test_antibody.igm='1' THEN 'Reaktif'
		WHEN test_antibody.igm='3' THEN 'On Process'
		END AS nama_igm,
		CASE
		WHEN test_antibody.igg='0' THEN 'Non Reaktif'
		WHEN test_antibody.igg='1' THEN 'Reaktif'
		WHEN test_antibody.igg='3' THEN 'On Process'
		END AS nama_igg
		FROM test_antibody, mr_pasien, mr_dokter
		WHERE test_antibody.id_catatan_medik=mr_pasien.id_catatan_medik
		AND test_antibody.id_dokter=mr_dokter.id_dokter
		ORDER BY test_antibody.id_test_antibody DESC LIMIT 10");
	return $query;
}

function detailDataAntibody($where)
{
	$query = $this->db->query("
		SELECT *, test_antibody.tanggal AS tgl_periksa, mr_pasien.nama AS nama_pasien, mr_pasien.tgl_lahir AS tgl_lahir, mr_dokter.nama_dokter, psdi_petugas.nama AS nama_petugas,
		IF(mr_pasien.sex='1', 'Laki-laki', 'Perempuan') AS nama_sex,
		CASE
		WHEN test_antibody.igm='0' THEN 'Non Reaktif'
		WHEN test_antibody.igm='1' THEN 'Reaktif'
		WHEN test_antibody.igm='3' THEN 'On Process'
		END AS nama_igm,
		CASE
		WHEN test_antibody.igg='0' THEN 'Non Reaktif'
		WHEN test_antibody.igg='1' THEN 'Reaktif'
		WHEN test_antibody.igg='3' THEN 'On Process'
		END AS nama_igg
		FROM test_antibody
		JOIN mr_pasien
		ON test_antibody.id_catatan_medik = mr_pasien.id_catatan_medik
		jOIN mr_dokter
		ON test_antibody.id_dokter = mr_dokter.id_dokter
		JOIN psdi_petugas
		ON test_antibody.id_petugas = psdi_petugas.id_petugas
		where id_test_antibody ='$where'");
	return $query;
}

function ExcelDataAntibody($awal,$akhir)
{
	$query = $this->db->query("
		SELECT *, mr_pasien.nama AS nama_pasien, mr_dokter.nama_dokter, psdi_petugas.nama AS nama_petugas,
		IF(mr_pasien.sex='1', 'Laki-laki', 'Perempuan') AS nama_sex,
		CASE
		WHEN test_antibody.igm='0' THEN 'Non Reaktif'
		WHEN test_antibody.igm='1' THEN 'Reaktif'
		WHEN test_antibody.igm='3' THEN 'On Process'
		END AS nama_igm,
		CASE
		WHEN test_antibody.igg='0' THEN 'Non Reaktif'
		WHEN test_antibody.igg='1' THEN 'Reaktif'
		WHEN test_antibody.igg='3' THEN 'On Process'
		END AS nama_igg
		FROM test_antibody
		JOIN mr_pasien
		ON test_antibody.id_catatan_medik = mr_pasien.id_catatan_medik
		JOIN mr_dokter
		ON test_antibody.id_dokter = mr_dokter.id_dokter
		JOIN psdi_petugas
		ON test_antibody.id_petugas = psdi_petugas.id_petugas
		WHERE test_antibody.tanggal BETWEEN '$awal' AND '$akhir'");
	return $query;
}

function dataAntigen()
{
	$query = $this->db->query("
		SELECT *, mr_pasien.nama, mr_dokter.nama_dokter,
		CASE
		WHEN test_antigen.hasil=0 THEN 'Negatif'
		WHEN test_antigen.hasil=1 THEN 'Positif'
		WHEN test_antigen.hasil=3 THEN 'On Process'
		END AS nama_hasil
		FROM test_antigen
		JOIN mr_pasien
		ON test_antigen.id_catatan_medik = mr_pasien.id_catatan_medik
		JOIN mr_dokter
		ON test_antigen.id_dokter = mr_dokter.id_dokter
		ORDER BY test_antigen.id_test_antigen DESC LIMIT 10");
	return $query;
}

function detailDataAntigen($where)
{
	$query = $this->db->query("
		SELECT *, test_antigen.tanggal AS tgl_periksa, test_antigen.jam AS jam_periksa, mr_pasien.nama AS nama_pasien, mr_pasien.tgl_lahir AS tgl_lahir, mr_dokter.nama_dokter, psdi_petugas.nama AS nama_petugas,
		IF(mr_pasien.sex='1', 'Laki-laki', 'Perempuan') AS nama_sex,
		CASE
		WHEN test_antigen.hasil=0 THEN 'Negatif'
		WHEN test_antigen.hasil=1 THEN 'Positif'
		WHEN test_antigen.hasil=3 THEN 'On Process'
		END AS nama_hasil
		FROM test_antigen
		JOIN mr_pasien
		ON test_antigen.id_catatan_medik = mr_pasien.id_catatan_medik
		JOIN mr_dokter
		ON test_antigen.id_dokter = mr_dokter.id_dokter
		JOIN psdi_petugas
		ON test_antigen.id_petugas = psdi_petugas.id_petugas
		WHERE test_antigen.id_test_antigen = '$where'");
	return $query;
}

function ExcelDataAntigen($awal,$akhir)
{
	$query = $this->db->query("
		SELECT *, test_antigen.tanggal AS tgl_periksa, mr_pasien.nama AS nama_pasien, mr_dokter.nama_dokter, psdi_petugas.nama AS nama_petugas,
		IF(mr_pasien.sex='1', 'Laki-laki', 'Perempuan') AS nama_sex,
		CASE
		WHEN test_antigen.hasil=0 THEN 'Negatif'
		WHEN test_antigen.hasil=1 THEN 'Positif'
		WHEN test_antigen.hasil=3 THEN 'On Process'
		END AS nama_hasil
		FROM test_antigen
		JOIN mr_pasien
		ON test_antigen.id_catatan_medik = mr_pasien.id_catatan_medik
		JOIN mr_dokter
		ON test_antigen.id_dokter = mr_dokter.id_dokter
		JOIN psdi_petugas
		ON test_antigen.id_petugas = psdi_petugas.id_petugas
		WHERE test_antigen.tanggal BETWEEN '$awal' AND '$akhir'
		ORDER BY id_test_antigen ASC");
	return $query;
}

function dataSwab()
{
	$this->db->select('booking_swab.*, mr_sex.nama_sex, jadwal_swab.hari, jadwal_swab.pukul');
	$this->db->from('booking_swab');
	$this->db->join('mr_sex','booking_swab.id_sex = mr_sex.id_sex');
	$this->db->join('jadwal_swab','booking_swab.id_jadwal_swab = jadwal_swab.id_jadwal_swab');
	$this->db->order_by('booking_swab.id_booking_swab DESC');
	return $this->db->get();
}

function dataSwabDetail($where)
{
	$this->db->select('booking_swab.*, mr_sex.nama_sex, jadwal_swab.hari, jadwal_swab.pukul');
	$this->db->from('booking_swab');
	$this->db->join('mr_sex','booking_swab.id_sex = mr_sex.id_sex');
	$this->db->join('jadwal_swab','booking_swab.id_jadwal_swab = jadwal_swab.id_jadwal_swab');
	$this->db->where($where);
	return $this->db->get();
}

function cariDataAsuransi($where)
{
	$this->db->select('*, lab_trn.id_register AS no_reg, lab_trn.tanggal AS tgl_kunj, lab_trn.jam AS jam_kunj, mr_pasien.nama AS nama_pasien, mr_unit.nama_unit');
	$this->db->from('lab_trn');
	$this->db->join('mr_pasien','lab_trn.id_catatan_medik = mr_pasien.id_catatan_medik');
	$this->db->join('mr_unit','lab_trn.id_unit = mr_unit.id_unit');
	$this->db->where('lab_trn.id_register',$where);
	return $this->db->get();
}

function dataKlaimAsuransi($no,$where)
{
	$this->db->select('*,mr_pasien.nama AS nama_pasien, lab_tarif.nama AS pemeriksaan, mr_dokter.nama_dokter, lab_trn.tanggal AS tgl_kunj, lab_trn.jam AS jam_kunj,
		IF (mr_pasien.sex="1", "Laki-laki", "Perempuan") AS nama_sex');
	$this->db->from('lab_det_trn');
	$this->db->join('lab_trn','lab_det_trn.id_lab_trn = lab_trn.id_lab_trn');
	$this->db->join('mr_pasien','lab_det_trn.id_catatan_medik = mr_pasien.id_catatan_medik');
	$this->db->join('lab_tarif','lab_det_trn.id_lab_tarif = lab_tarif.id_lab_tarif');
	$this->db->join('mr_dokter','lab_trn.id_dokter = mr_dokter.id_dokter');

	if($no==1)
	{
		$this->db->where('lab_det_trn.id_register',$where);
	}else{

		$this->db->where('lab_det_trn.id_lab_trn',$where);
	}

	$this->db->where('lab_det_trn.harga !=',0);
	return $this->db->get();
}

	/*
	|--------------------------------------------------------------------------
	|
	| Model inventaris
	|
	|--------------------------------------------------------------------------
*/

	function dataInventaris()
	{
		$query = $this->db->query("
			SELECT *, inventaris_ruangan.nama_ruangan, inventaris_jenis.nama_jenis
			FROM inventaris
			INNER JOIN inventaris_ruangan
			ON inventaris.kode_ruangan = inventaris_ruangan.kode_ruangan
			INNER JOIN inventaris_jenis
			ON inventaris.kode_jenis = inventaris_jenis.kode_jenis
			ORDER BY inventaris.kode_registrasi DESC
			LIMIT 50");
		return $query;
	}

	function cariDataNomor($where)
	{
		$query = $this->db->query("
			SELECT *, inventaris_ruangan.nama_ruangan, inventaris_jenis.nama_jenis,
			IF (inventaris.kondisi='1', 'Baik', 'Rusak') AS nama_kondisi,
			IF (inventaris.status='1', 'Baru', 'Bekas') AS nama_status
			FROM inventaris
			INNER JOIN inventaris_ruangan
			ON inventaris.kode_ruangan = inventaris_ruangan.kode_ruangan
			INNER JOIN inventaris_jenis
			ON inventaris.kode_jenis = inventaris_jenis.kode_jenis
			WHERE inventaris.nomor_inventaris = '$where'
			ORDER BY inventaris.kode_registrasi ASC");
		return $query;
	}

	function cariDataKondisi($where)
	{
		$query = $this->db->query("
			SELECT *, inventaris_ruangan.nama_ruangan, inventaris_jenis.nama_jenis,
			IF (inventaris.kondisi='1', 'Baik', 'Rusak') AS nama_kondisi,
			IF (inventaris.status='1', 'Baru', 'Bekas') AS nama_status
			FROM inventaris
			INNER JOIN inventaris_ruangan
			ON inventaris.kode_ruangan = inventaris_ruangan.kode_ruangan
			INNER JOIN inventaris_jenis
			ON inventaris.kode_jenis = inventaris_jenis.kode_jenis
			WHERE inventaris.kondisi = '$where'
			ORDER BY inventaris.kode_registrasi ASC");
		return $query;
	}

	function cariDataStatus($where)
	{
		$query = $this->db->query("
			SELECT *, inventaris_ruangan.nama_ruangan, inventaris_jenis.nama_jenis,
			IF (inventaris.kondisi='1', 'Baik', 'Rusak') AS nama_kondisi,
			IF (inventaris.status='1', 'Baru', 'Bekas') AS nama_status
			FROM inventaris
			INNER JOIN inventaris_ruangan
			ON inventaris.kode_ruangan = inventaris_ruangan.kode_ruangan
			INNER JOIN inventaris_jenis
			ON inventaris.kode_jenis = inventaris_jenis.kode_jenis
			WHERE inventaris.status = '$where'
			ORDER BY inventaris.kode_registrasi ASC");
		return $query;
	}

	function cariDataRuanganAll()
	{
		$query = $this->db->query("
			SELECT *, inventaris_ruangan.nama_ruangan, inventaris_jenis.nama_jenis,
			IF (inventaris.kondisi='1', 'Baik', 'Rusak') AS nama_kondisi,
			IF (inventaris.status='1', 'Baru', 'Bekas') AS nama_status
			FROM inventaris
			INNER JOIN inventaris_ruangan
			ON inventaris.kode_ruangan = inventaris_ruangan.kode_ruangan
			INNER JOIN inventaris_jenis
			ON inventaris.kode_jenis = inventaris_jenis.kode_jenis
			ORDER BY inventaris.kode_registrasi ASC");
		return $query;
	}

	function cariDataRuangan($where)
	{
		$query = $this->db->query("
			SELECT *, inventaris_ruangan.nama_ruangan, inventaris_jenis.nama_jenis,
			IF (inventaris.kondisi='1', 'Baik', 'Rusak') AS nama_kondisi,
			IF (inventaris.status='1', 'Baru', 'Bekas') AS nama_status
			FROM inventaris
			INNER JOIN inventaris_ruangan
			ON inventaris.kode_ruangan = inventaris_ruangan.kode_ruangan
			INNER JOIN inventaris_jenis
			ON inventaris.kode_jenis = inventaris_jenis.kode_jenis
			WHERE inventaris.kode_ruangan = '$where'
			ORDER BY inventaris.kode_registrasi ASC");
		return $query;
	}


	function dataJenisInventaris()
	{
		$query = $this->db->query("
			SELECT * FROM inventaris_jenis ORDER BY nama_jenis ASC");
		return $query;
	}

	function dataRuanganInventaris()
	{
		$query = $this->db->query("
			SELECT * FROM inventaris_ruangan ORDER BY nama_ruangan ASC");
		return $query;
	}

	function detailDataInventaris($where)
	{
		$query = $this->db->query("
			SELECT *, inventaris_jenis.nama_jenis, inventaris_ruangan.nama_ruangan,
			IF (inventaris.kondisi='1', 'Baik', 'Rusak') AS nama_kondisi,
			IF (inventaris.status='1', 'Baru', 'Bekas') AS nama_status
			FROM inventaris, inventaris_jenis, inventaris_ruangan
			WHERE inventaris.kode_jenis=inventaris_jenis.kode_jenis
			AND inventaris.kode_ruangan=inventaris_ruangan.kode_ruangan
			AND inventaris.kode_registrasi = '$where'");
		return $query;
	}

	/*
	|--------------------------------------------------------------------------
	|
	| Model register
	|
	|--------------------------------------------------------------------------
*/

	function dataDokterTab($bln,$thn)
	{
		$query = $this->db->query("
			SELECT hpl_register.id_dokter, dokter.nama_dokter FROM hpl_register, dokter WHERE hpl_register.id_dokter=dokter.id_dokter AND MONTH(hpl_register.tgl_hpl)='$getMonthNow' AND YEAR(hpl_register.tgl_hpl)='$getYearNow' AND dokter.status=1 GROUP BY hpl_register.id_dokter");
		return $query;
	}

	function dataBulanTab($thn)
	{
		$query = $this->db->query("
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
			WHERE YEAR(tgl_hpl)='$thn'
			GROUP BY id_bulan");
		return $query;
	}

	function dataHplTab($bln,$thn)
	{
		$query = $this->db->query("
			SELECT hpl_register.id_hpl_register, hpl_register.id_catatan_medik, hpl_register.tgl_hpl, mr_pasien.nama, mr_pasien.telp, dokter.nama_dokter, psdi_petugas.nama AS nama_petugas
			FROM hpl_register, mr_pasien, dokter, psdi_petugas
			WHERE hpl_register.id_catatan_medik=mr_pasien.id_catatan_medik
			AND hpl_register.id_dokter=dokter.id_dokter
			AND hpl_register.id_petugas=psdi_petugas.id_petugas
			AND hpl_register.id_dokter='$id'
			AND MONTH(hpl_register.tgl_hpl)='$bln'
			AND YEAR(hpl_register.tgl_hpl)='$thn'
			ORDER BY hpl_register.tgl_hpl ASC");
		return $query;
	}

	function dataHplRegister($id)
	{
		$query = $this->db->query("
			SELECT *, mr_pasien.nama, mr_pasien.telp, mr_pasien.alamat, dokter.nama_dokter
			FROM hpl_register
			INNER JOIN mr_pasien ON hpl_register.id_catatan_medik=mr_pasien.id_catatan_medik
			INNER JOIN dokter ON hpl_register.id_dokter=dokter.id_dokter
			WHERE hpl_register.tanggal='$id'
			ORDER BY hpl_register.id_hpl_register DESC");
		return $query;
	}

	function dataHpl($bln,$thn)
	{
		$query = $this->db->query("
			SELECT *, mr_pasien.nama, mr_pasien.telp, mr_pasien.alamat, dokter.nama_dokter
			FROM hpl_register
			INNER JOIN mr_pasien ON hpl_register.id_catatan_medik=mr_pasien.id_catatan_medik
			INNER JOIN dokter ON hpl_register.id_dokter=dokter.id_dokter
			WHERE MONTH(hpl_register.tgl_hpl)='$bln'
			AND YEAR(hpl_register.tgl_hpl)='$thn'
			ORDER BY hpl_register.tgl_hpl ASC");
		return $query;
	}

	function dataVaksinRm($id)
	{
		$query = $this->db->query("
			SELECT *, mr_pasien.nama AS nama_pasien, far_stok.nama AS nama_vaksin, dokter.nama_dokter
			FROM vaksin_register
			JOIN mr_pasien
			ON vaksin_register.id_catatan_medik = mr_pasien.id_catatan_medik
			JOIN far_stok
			ON vaksin_register.kode_vaksin = far_stok.no_urut
			JOIN dokter
			ON vaksin_register.id_dokter = dokter.id_dokter
			WHERE vaksin_register.id_catatan_medik = '$id'
			ORDER BY id_vaksin_register DESC");
		return $query;
	}

	function dataVaksinPeriode($bln,$thn)
	{
		$query = $this->db->query("
			SELECT *, mr_pasien.nama AS nama_pasien, far_stok.nama AS nama_vaksin, dokter.nama_dokter
			FROM vaksin_register
			JOIN mr_pasien
			ON vaksin_register.id_catatan_medik = mr_pasien.id_catatan_medik
			JOIN far_stok
			ON vaksin_register.kode_vaksin = far_stok.no_urut
			JOIN dokter
			ON vaksin_register.id_dokter = dokter.id_dokter
			WHERE MONTH(vaksin_register.tanggal)= '$bln'
			AND  YEAR(vaksin_register.tanggal)= '$thn'
			ORDER BY id_vaksin_register ASC");
		return $query;
	}

	function dataNamaVaksin()
	{
		$query = $this->db->query("
			SELECT no_urut, nama FROM far_stok WHERE kode_lain=13 ORDER BY nama ASC");
		return $query;
	}

}

?>