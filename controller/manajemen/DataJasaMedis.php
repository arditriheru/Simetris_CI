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

    function jmDokterRalan()
    {
        $data['subtitle']     = "Jasa Medis";
        $data['title']        = "Ralan";

        $data['dataoperator']   = $this->mSimetris->dataDokter('mr_dokter.id_dokter AS id_operator, mr_dokter.nama_dokter AS nama_operator', 'mr_dokter', 'mr_dokter.id_dokter IS NOT NULL', 'mr_dokter.nama_dokter ASC')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('manajemen/vMenu', $data);
        $this->load->view('manajemen/kasir/vLapJasaMedisRalan', $data);
        $this->load->view('templates/footer', $data);
    }

    function dataTampilJmDokterRalan()
    {
        $data['title']        = "Ralan";
        $data['subtitle']     = "Jasa Medis";

        $id_operator          = $this->input->post('id_operator');
        $awal                 = $this->input->post('awal');
        $akhir                = $this->input->post('akhir');

        $data['dataoperator'] = $this->mSimetris->dataDokter('mr_dokter.id_dokter AS id_operator, mr_dokter.nama_dokter AS nama_operator', 'mr_dokter', 'mr_dokter.id_dokter IS NOT NULL', 'mr_dokter.nama_dokter ASC')->result();

        if (isset($id_operator)) {
            $data['data']           = $id_operator . '/' . $awal . '/' . $akhir;

            $data['jasamedis']      = $this->mSimetris->dataJasaMedisRalan($id_operator, $awal, $akhir)->result();
            $jasamedis              = $this->mSimetris->dataJasaMedisRalan($id_operator, $awal, $akhir)->result();

            foreach ($jasamedis as $d) {
                $nama_dokter = $d->nama_dokter;
            }

            $data['nama_dokter'] = $nama_dokter;
        }

        $this->load->view('templates/header', $data);
        $this->load->view('manajemen/vMenu', $data);
        $this->load->view('manajemen/kasir/vLapJasaMedisRalan', $data);
        $this->load->view('templates/footer', $data);
    }

    function jmDokterRanap()
    {
        $data['subtitle']     = "Jasa Medis";
        $data['title']        = "Ranap";

        $data['dataoperator']   = $this->mSimetris->dataDokter('mr_dokter.id_dokter AS id_operator, mr_dokter.nama_dokter AS nama_operator', 'mr_dokter', 'mr_dokter.id_dokter IS NOT NULL', 'mr_dokter.nama_dokter ASC')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('manajemen/vMenu', $data);
        $this->load->view('manajemen/kasir/vLapJasaMedisRanap', $data);
        $this->load->view('templates/footer', $data);
    }

    function dataTampilJmDokterRanap()
    {
        $data['title']        = "Ranap";
        $data['subtitle']     = "Jasa Medis";

        $id_operator          = $this->input->post('id_operator');
        $awal                 = $this->input->post('awal');
        $akhir                = $this->input->post('akhir');

        $data['dataoperator'] = $this->mSimetris->dataDokter('mr_dokter.id_dokter AS id_operator, mr_dokter.nama_dokter AS nama_operator', 'mr_dokter', 'mr_dokter.id_dokter IS NOT NULL', 'mr_dokter.nama_dokter ASC')->result();

        if (isset($id_operator)) {
            $data['data']           = $id_operator . '/' . $awal . '/' . $akhir;

            $where = array(
                'id_dokter'   => $id_operator,
            );
            $where1 = array(
                'id_operator'   => $id_operator,
            );
            $where2 = array(
                'id_anestesi'   => $id_operator,
            );
            $where3 = array(
                'id_dokter_sp_anak'   => $id_operator,
            );

            $data['operator']   = $this->mSimetris->dataJasaMedisRanap($awal, $akhir, $where1)->result();
            $data['anestesi']   = $this->mSimetris->dataJasaMedisRanap($awal, $akhir, $where2)->result();
            $data['sp_anak']    = $this->mSimetris->dataJasaMedisRanap($awal, $akhir, $where3)->result();
            $data['data1']      = $this->mSimetris->dataJasaMedisRanap($awal, $akhir, $where1)->num_rows();
            $data['data2']      = $this->mSimetris->dataJasaMedisRanap($awal, $akhir, $where2)->num_rows();
            $data['data3']      = $this->mSimetris->dataJasaMedisRanap($awal, $akhir, $where3)->num_rows();
            $nama_dokter        = $this->mSimetris->selectData('mr_dokter', 'nama_dokter', $where)->result();

            foreach ($nama_dokter as $d) {
                $data['nama_dokter'] = $d->nama_dokter;
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('manajemen/vMenu', $data);
        $this->load->view('manajemen/kasir/vLapJasaMedisRanap', $data);
        $this->load->view('templates/footer', $data);
    }

    function dataTampilJmParamedis()
    {
        $data['title']        = "Paramedis";
        $data['subtitle']     = "Jasa Medis";

        $id_operator          = $this->input->post('id_operator');
        $iol                  = $this->input->post('iol');
        $awal                 = $this->input->post('awal');
        $akhir                = $this->input->post('akhir');

        $data['dataoperator'] = $this->mSimetris->dataPetugas('psdi_petugas.id_petugas AS id_operator, psdi_petugas.nama AS nama_operator', 'psdi_petugas', 'psdi_petugas.id_petugas IS NOT NULL', 'psdi_petugas.nama ASC')->result();

        if (isset($id_operator)) {
            $data['data']           = $id_operator . '/'. $iol . '/' . $awal . '/' . $akhir;

            $where = array(
                'id_petugas'    => $id_operator,
            );
            $where1 = array(
                'ksr_det_trn.id_ass_1'      => $id_operator,
                'ksr_det_trn.iol'           => $iol,
            );
            $where2 = array(
                'ksr_det_trn.id_ass_2'      => $id_operator,
                'ksr_det_trn.iol'           => $iol,
            );
            $where3 = array(
                'ksr_det_trn.id_penata'     => $id_operator,
                'ksr_det_trn.iol'           => $iol,
            );
            $where4 = array(
                'ksr_det_trn.id_on_loop'    => $id_operator,
                'ksr_det_trn.iol'           => $iol,
            );

            $data['ass1']   = $this->mSimetris->dataJasaMedisParamedis($awal, $akhir, $where1)->result();
            $data['ass2']   = $this->mSimetris->dataJasaMedisParamedis($awal, $akhir, $where2)->result();
            $data['penata'] = $this->mSimetris->dataJasaMedisParamedis($awal, $akhir, $where3)->result();
            $data['onloop'] = $this->mSimetris->dataJasaMedisParamedis($awal, $akhir, $where4)->result();

            $data['data1']  = $this->mSimetris->dataJasaMedisParamedis($awal, $akhir, $where1)->num_rows();
            $data['data2']  = $this->mSimetris->dataJasaMedisParamedis($awal, $akhir, $where2)->num_rows();
            $data['data3']  = $this->mSimetris->dataJasaMedisParamedis($awal, $akhir, $where3)->num_rows();
            $data['data4']  = $this->mSimetris->dataJasaMedisParamedis($awal, $akhir, $where4)->num_rows();

            $nama_operator    = $this->mSimetris->selectData('psdi_petugas', 'nama', $where)->result();

            foreach ($nama_operator as $d) {
                $data['nama_operator'] = $d->nama;
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('manajemen/vMenu', $data);
        $this->load->view('manajemen/kasir/vLapJasaMedisParamedis', $data);
        $this->load->view('templates/footer', $data);
    }


    // function dataTampilJmDokter($id)
    // {
    //     $data['subtitle']     = "Jasa Medis";

    //     $data['id'] = $id;

    //     if ($id == 1) {

    //         $data['title']        = "Ralan";

    //         $data['dataoperator']   = $this->mSimetris->dataDokter('mr_dokter.id_dokter AS id_operator, mr_dokter.nama_dokter AS nama_operator', 'mr_dokter', 'mr_dokter.id_dokter IS NOT NULL', 'mr_dokter.nama_dokter ASC')->result();
    //     } elseif ($id == 2) {

    //         $data['title']        = "Ranap";

    //         $data['dataoperator']   = $this->mSimetris->dataDokter('mr_dokter.id_dokter AS id_operator, mr_dokter.nama_dokter AS nama_operator', 'mr_dokter', 'mr_dokter.id_dokter IS NOT NULL', 'mr_dokter.nama_dokter ASC')->result();
    //     } elseif ($id == 3) {

    //         $data['title']        = "Paramedis";

    //         $data['dataoperator']   = $this->mSimetris->dataPetugas('psdi_petugas.id_petugas AS id_operator, psdi_petugas.nama AS nama_operator', 'psdi_petugas', 'psdi_petugas.id_petugas IS NOT NULL', 'psdi_petugas.nama ASC')->result();
    //     }

    //     $id_operator          = $this->input->post('id_operator');
    //     $awal                 = $this->input->post('awal');
    //     $akhir                = $this->input->post('akhir');

    //     if (isset($id_operator)) {
    //         $data['id']             = $id;
    //         $data['post']           = $id_operator;

    //         $data['data']           = $id_operator . '/' . $awal . '/' . $akhir;

    //         $jasamedis              = $this->mSimetris->dataJasaMedis($id_operator, $awal, $akhir)->result();

    //         if ($this->mSimetris->dataJasaMedis($id, $id_operator, $awal, $akhir)->num_rows() > 0) {
    //             $data['jasamedis']      = $this->mSimetris->dataJasaMedis($id, $id_operator, $awal, $akhir)->result();

    //             foreach ($jasamedis as $d) {
    //                 $nama_dokter = $d->nama_dokter;
    //                 $data['data1'] = ($d->operator * $d->jumlah) - $d->diskon;
    //                 $data['data2'] = ($d->anestesi * $d->jumlah) - $d->diskon;
    //                 $data['data3'] = ($d->sp_anak * $d->jumlah) - $d->diskon;
    //             }

    //             $data['nama_dokter'] = $nama_dokter;

    //             $this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissable">
	// 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	// 		<font size="4"><b>Data berhasil ditampilkan!</b></font>
	// 		</div>');
    //         } else {

    //             $this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissable">
	// 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	// 		<font size="4"><b>Data tidak ditemukan!</b></font>
	// 		</div>');
    //             redirect('manajemen/dataJasaMedis/index/' . $id);
    //         }
    //     }

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('manajemen/vMenu', $data);
    //     $this->load->view('manajemen/kasir/vLapJasaMedis', $data);
    //     $this->load->view('templates/footer', $data);
    // }

    function dataExportJmDokterRalan($id_operator, $awal, $akhir)
    {
        $data['title']        = "Jasa Medis Ranap";

        $data['jasamedis']  = $this->mSimetris->dataJasaMedisRalan($id_operator, $awal, $akhir)->result();
        $jasamedis          = $this->mSimetris->dataJasaMedisRalan($id_operator, $awal, $akhir)->result();

            foreach ($jasamedis as $d) {
                $nama_dokter = $d->nama_dokter;
            }

        $data['nama_dokter']    = $nama_dokter;
        $data['awal']           = $awal;
        $data['akhir']          = $akhir;

        $this->load->view('templates/header', $data);
        $this->load->view('manajemen/vMenu', $data);
        $this->load->view('manajemen/kasir/vExcelJasaMedisRalan', $data);
        $this->load->view('templates/footer', $data);
    }

    function dataExportJmDokterRanap($id_operator, $awal, $akhir)
    {
        $data['title']        = "Jasa Medis Ranap";

        $where = array(
            'id_dokter'   => $id_operator,
        );
        $where1 = array(
            'id_operator'   => $id_operator,
        );
        $where2 = array(
            'id_anestesi'   => $id_operator,
        );
        $where3 = array(
            'id_dokter_sp_anak'   => $id_operator,
        );

        $data['operator']   = $this->mSimetris->dataJasaMedisRanap($awal, $akhir, $where1)->result();
        $data['anestesi']   = $this->mSimetris->dataJasaMedisRanap($awal, $akhir, $where2)->result();
        $data['sp_anak']    = $this->mSimetris->dataJasaMedisRanap($awal, $akhir, $where3)->result();
        $data['data1']      = $this->mSimetris->dataJasaMedisRanap($awal, $akhir, $where1)->num_rows();
        $data['data2']      = $this->mSimetris->dataJasaMedisRanap($awal, $akhir, $where2)->num_rows();
        $data['data3']      = $this->mSimetris->dataJasaMedisRanap($awal, $akhir, $where3)->num_rows();
        $result             = $this->mSimetris->selectData('mr_dokter', 'nama_dokter', $where)->result();

        foreach ($result as $d) {
            $data['nama_dokter'] = $d->nama_dokter;
        }

        $data['awal']           = $awal;
        $data['akhir']          = $akhir;

        $this->load->view('templates/header', $data);
        $this->load->view('manajemen/vMenu', $data);
        $this->load->view('manajemen/kasir/vExcelJasaMedisRanap', $data);
        $this->load->view('templates/footer', $data);
    }

    function dataExportJmDokterParamedis($id_operator, $iol, $awal, $akhir)
    {
        $data['title']        = "Jasa Medis Paramedis";

        $where = array(
            'id_petugas'    => $id_operator,
        );
        $where1 = array(
            'ksr_det_trn.id_ass_1'      => $id_operator,
            'ksr_det_trn.iol'           => $iol,
        );
        $where2 = array(
            'ksr_det_trn.id_ass_2'      => $id_operator,
            'ksr_det_trn.iol'           => $iol,
        );
        $where3 = array(
            'ksr_det_trn.id_penata'     => $id_operator,
            'ksr_det_trn.iol'           => $iol,
        );
        $where4 = array(
            'ksr_det_trn.id_on_loop'    => $id_operator,
            'ksr_det_trn.iol'           => $iol,
        );

        $data['ass1']   = $this->mSimetris->dataJasaMedisParamedis($awal, $akhir, $where1)->result();
        $data['ass2']   = $this->mSimetris->dataJasaMedisParamedis($awal, $akhir, $where2)->result();
        $data['penata'] = $this->mSimetris->dataJasaMedisParamedis($awal, $akhir, $where3)->result();
        $data['onloop'] = $this->mSimetris->dataJasaMedisParamedis($awal, $akhir, $where4)->result();

        $data['data1']  = $this->mSimetris->dataJasaMedisParamedis($awal, $akhir, $where1)->num_rows();
        $data['data2']  = $this->mSimetris->dataJasaMedisParamedis($awal, $akhir, $where2)->num_rows();
        $data['data3']  = $this->mSimetris->dataJasaMedisParamedis($awal, $akhir, $where3)->num_rows();
        $data['data4']  = $this->mSimetris->dataJasaMedisParamedis($awal, $akhir, $where4)->num_rows();

        $nama_operator    = $this->mSimetris->selectData('psdi_petugas', 'nama', $where)->result();

        foreach ($nama_operator as $d) {
            $data['nama_operator'] = $d->nama;
        }

        $data['awal']           = $awal;
        $data['akhir']          = $akhir;

        $this->load->view('templates/header', $data);
        $this->load->view('manajemen/vMenu', $data);
        $this->load->view('manajemen/kasir/vExcelJasaMedisParamedis', $data);
        $this->load->view('templates/footer', $data);
    }
}
