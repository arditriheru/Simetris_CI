<?php

class dataJasaMedis extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // if ($this->session->userdata('login') != '1') {
        //     $this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
        // 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        // 		<font size="4"><b>Anda belum login!</b></font>
        // 		</div>');
        //     redirect('manajemen/login');
        // }

        $this->load->model("mSimetris");
        $this->load->library('form_validation');
    }

    function index($id)
    {
        $data['dataoperator']   = $this->mSimetris->dataDokter('mr_dokter', 'mr_dokter.id_dokter IS NOT NULL', 'mr_dokter.nama_dokter ASC')->result();
        $data['subtitle']     = "Jasa Medis";

        $data['id'] = $id;

        if ($id == 2) {

            $data['title']        = "Ranap";
        } else {

            $data['title']        = "Ralan";
        }

        $this->load->view('templates/header', $data);
        $this->load->view('manajemen/vMenu', $data);
        $this->load->view('manajemen/kasir/vLapJasaMedis', $data);
        $this->load->view('templates/footer', $data);
    }

    function dataTampil($id)
    {
        $data['dataoperator']   = $this->mSimetris->dataDokter('mr_dokter', 'mr_dokter.id_dokter IS NOT NULL', 'mr_dokter.nama_dokter ASC')->result();
        $data['subtitle']     = "Jasa Medis";

        if ($id == 2) {

            $data['title']        = "Ranap";
        } else {

            $data['title']        = "Ralan";
        }

        $id_operator          = $this->input->post('id_operator');
        $awal                 = $this->input->post('awal');
        $akhir                = $this->input->post('akhir');

        if (isset($id_operator)) {
            $data['id']             = $id;
            $data['post']           = $id_operator;

            $data['data']           = $id_operator . '/' . $awal . '/' . $akhir;

            $jasamedis              = $this->mSimetris->dataJasaMedis($id, $id_operator, $awal, $akhir)->result();
            $data['jasamedis']      = $this->mSimetris->dataJasaMedis($id, $id_operator, $awal, $akhir)->result();

            foreach ($jasamedis as $d) {
                $nama_dokter = $d->nama_dokter;
            }

            $data['nama_dokter'] = $nama_dokter;

            $this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<font size="4"><b>Data berhasil ditampilkan!</b></font>
			</div>');
        }

        $this->load->view('templates/header', $data);
        $this->load->view('manajemen/vMenu', $data);
        $this->load->view('manajemen/kasir/vLapJasaMedis', $data);
        $this->load->view('templates/footer', $data);
    }

    function dataExport($id, $id_operator, $awal, $akhir)
    {
        $data['id'] = $id;

        if ($id == 2) {

            $data['title']        = "Ranap";
            $data['awal']         = formatDateIndo($awal);
            $data['akhir']        = formatDateIndo($akhir);

            $jasamedis            = $this->mSimetris->dataJasaMedis($id, $id_operator, $awal, $akhir)->result();
            $data['jasamedis']    = $this->mSimetris->dataJasaMedis($id, $id_operator, $awal, $akhir)->result();

            foreach ($jasamedis as $d) {
                $nama_dokter = $d->nama_dokter;
            }

            $data['nama_dokter'] = $nama_dokter;
        } else {

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
        }

        $this->load->view('templates/header', $data);
        $this->load->view('manajemen/vMenu', $data);
        $this->load->view('manajemen/kasir/vExcelJasaMedis', $data);
        $this->load->view('templates/footer', $data);
    }
}
