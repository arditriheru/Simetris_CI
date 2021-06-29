<?php

class dataJasaMedis extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('login') != '1') {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
        		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        		<font size="4"><b>Anda belum login!</b></font>
        		</div>');
            redirect('manajemen/login');
        }

        $this->load->model("mSimetris");
        $this->load->library('form_validation');
    }

    function index($id)
    {
        $data['subtitle']     = "Jasa Medis";

        $data['id'] = $id;

        if ($id == 1) {

            $data['title']        = "Ralan";

            $data['dataoperator']   = $this->mSimetris->dataDokter('mr_dokter.id_dokter AS id_operator, mr_dokter.nama_dokter AS nama_operator', 'mr_dokter', 'mr_dokter.id_dokter IS NOT NULL', 'mr_dokter.nama_dokter ASC')->result();
        } elseif ($id == 2) {

            $data['title']        = "Ranap";

            $data['dataoperator']   = $this->mSimetris->dataDokter('mr_dokter.id_dokter AS id_operator, mr_dokter.nama_dokter AS nama_operator', 'mr_dokter', 'mr_dokter.id_dokter IS NOT NULL', 'mr_dokter.nama_dokter ASC')->result();
        } elseif ($id == 3) {

            $data['title']        = "Paramedis";

            $data['dataoperator']   = $this->mSimetris->dataPetugas('psdi_petugas.id_petugas AS id_operator, psdi_petugas.nama AS nama_operator', 'psdi_petugas', 'psdi_petugas.id_petugas IS NOT NULL', 'psdi_petugas.nama ASC')->result();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('manajemen/vMenu', $data);
        $this->load->view('manajemen/kasir/vLapJasaMedis', $data);
        $this->load->view('templates/footer', $data);
    }

    function dataTampil($id)
    {
        $data['subtitle']     = "Jasa Medis";

        $data['id'] = $id;

        if ($id == 1) {

            $data['title']        = "Ralan";

            $data['dataoperator']   = $this->mSimetris->dataDokter('mr_dokter.id_dokter AS id_operator, mr_dokter.nama_dokter AS nama_operator', 'mr_dokter', 'mr_dokter.id_dokter IS NOT NULL', 'mr_dokter.nama_dokter ASC')->result();
        } elseif ($id == 2) {

            $data['title']        = "Ranap";

            $data['dataoperator']   = $this->mSimetris->dataDokter('mr_dokter.id_dokter AS id_operator, mr_dokter.nama_dokter AS nama_operator', 'mr_dokter', 'mr_dokter.id_dokter IS NOT NULL', 'mr_dokter.nama_dokter ASC')->result();
        } elseif ($id == 3) {

            $data['title']        = "Paramedis";

            $data['dataoperator']   = $this->mSimetris->dataPetugas('psdi_petugas.id_petugas AS id_operator, psdi_petugas.nama AS nama_operator', 'psdi_petugas', 'psdi_petugas.id_petugas IS NOT NULL', 'psdi_petugas.nama ASC')->result();
        }

        $id_operator          = $this->input->post('id_operator');
        $awal                 = $this->input->post('awal');
        $akhir                = $this->input->post('akhir');

        if (isset($id_operator)) {
            $data['id']             = $id;
            $data['post']           = $id_operator;

            $data['data']           = $id_operator . '/' . $awal . '/' . $akhir;

            $jasamedis              = $this->mSimetris->dataJasaMedis($id, $id_operator, $awal, $akhir)->result();

            if ($this->mSimetris->dataJasaMedis($id, $id_operator, $awal, $akhir)->num_rows() > 0) {
                $data['jasamedis']      = $this->mSimetris->dataJasaMedis($id, $id_operator, $awal, $akhir)->result();

                foreach ($jasamedis as $d) {
                    $nama_dokter = $d->nama_dokter;
                }

                $data['nama_dokter'] = $nama_dokter;

                $this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4"><b>Data berhasil ditampilkan!</b></font>
			</div>');
            } else {

                $this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4"><b>Data tidak ditemukan!</b></font>
			</div>');
                redirect('manajemen/dataJasaMedis/index/' . $id);
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('manajemen/vMenu', $data);
        $this->load->view('manajemen/kasir/vLapJasaMedis', $data);
        $this->load->view('templates/footer', $data);
    }

    function dataExport($id, $id_operator, $awal, $akhir)
    {
        $data['id'] = $id;

        if ($id == 1) {

            $data['title']        = "Ralan";
            $data['title']        = "Ranap";
            $data['awal']         = formatDateIndo($awal);
            $data['akhir']        = formatDateIndo($akhir);

            $jasamedis            = $this->mSimetris->dataJasaMedis($id, $id_operator, $awal, $akhir)->result();
            $data['jasamedis']    = $this->mSimetris->dataJasaMedis($id, $id_operator, $awal, $akhir)->result();

            foreach ($jasamedis as $d) {
                $nama_dokter = $d->nama_dokter;
            }

            $data['nama_dokter'] = $nama_dokter;
        } elseif ($id == 2) {

            $data['title']        = "Ranap";
            $data['awal']         = formatDateIndo($awal);
            $data['akhir']        = formatDateIndo($akhir);

            $jasamedis            = $this->mSimetris->dataJasaMedis($id, $id_operator, $awal, $akhir)->result();
            $data['jasamedis']    = $this->mSimetris->dataJasaMedis($id, $id_operator, $awal, $akhir)->result();

            foreach ($jasamedis as $d) {
                $nama_dokter = $d->nama_dokter;
            }

            $data['nama_dokter'] = $nama_dokter;
        } elseif ($id == 3) {
        }

        $this->load->view('templates/header', $data);
        $this->load->view('manajemen/vMenu', $data);
        $this->load->view('manajemen/kasir/vExcelJasaMedis', $data);
        $this->load->view('templates/footer', $data);
    }
}
