<body>

  <div id="wrapper">

    <div id="page-wrapper">

      <div class="row">
        <div class="col-lg-12">
          <h1><?php echo $title ?> <small> <?php echo $subtitle ?></small></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('laboratorium/dataRapidTest') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-plus"></i> <?php echo $title ?></li>
          </ol>
          <?php $this->load->view('templates/welcome') ?>
          <?php echo $this->session->flashdata('update_success') ?>
        </div>
        <div class="col-lg-6">

          <?php foreach ($antigen as $d): ?>

           <div align="right">
            <a href="<?php echo base_url('laboratorium/dataAntigen/deleteData/'.$d->id_test_antigen) ?>"
              onclick="javascript: return confirm('Anda yakin hapus?')">
              <button type="button" class="btn btn-danger"><i class='fa fa-trash'></i> Hapus</button></a>
            </div>

            <div class="table-responsive">
              <form method="post" action="<?php echo base_url('laboratorium/dataAntigen/updateDataAksi') ?>" role="form">
                <div class="form-group">
                  <label>Nomor Rekam Medik</label>
                  <input class="form-control" type="hidden" value="<?php echo $d->id_test_antigen ?>" name="id_test_antigen">
                  <input class="form-control" type="text" value="<?php echo $d->id_catatan_medik ?>" name="id_catatan_medik" readonly="">
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input class="form-control" type="text" id="nama" name="nama" 
                  value="<?php echo $d->nama_pasien ?>" readonly>
                </div>
                <div class="form-group">
                  <label>Dokter</label>
                  <select class="form-control" type="text" name="id_dokter" required="">
                    <option value="<?php echo $d->id_dokter ?>"><?php echo $d->nama_dokter ?></option>
                    <?php foreach($datadokter as $a): ?>
                      <option value="<?php echo $a->id_dokter ?>"><?php echo $a->nama_dokter ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Tanggal / Jam</label>
                  <input class="form-control" type="text" name="tanggal" value="<?php echo formatDateIndo($d->tanggal).' / '.$d->jam; ?>" readonly="">
                </div>
                <div class="form-group">
                  <label>Hasil</label>
                  <select class="form-control" type="text" name="hasil" required="">
                    <option value="<?php echo $d->hasil ?>"><?php echo $d->nama_hasil ?></option>
                    <option value="3">On Process</option>
                    <option value="1">Positif</option>
                    <option value="0">Negatif</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label>Pemeriksa</label>
                <input class="form-control" type="text" value="<?php echo $d->nama_petugas ?>" name="nama_petugas" readonly="">
              </div>
              <button type="submit" name="submit" class="btn btn-success">Update</button>
            </form>
          <?php endforeach ?>
        </div>
      </div>
    </div><!-- /.row -->

  </div><!-- /#page-wrapper -->

  <!--</div> /#wrapper -->
