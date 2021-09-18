<body>

  <div id="wrapper">

    <div id="page-wrapper">

      <div class="row">
        <div class="col-lg-12">
          <h1><?php echo $title ?> <small> <?php echo $subtitle ?></small></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('laboratorium/dataAntibody') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-plus"></i> <?php echo $title ?></li>
          </ol>
          <?php $this->load->view('templates/welcome') ?>
          <?php echo $this->session->flashdata('update_success') ?>
        </div>
        <div class="col-lg-6">

          <?php foreach ($antibody as $d) : ?>

            <div align="right">
              <a href="<?php echo base_url('laboratorium/dataAntibody/deleteData/' . $d->id_test_antibody) ?>" onclick="javascript: return confirm('Anda yakin hapus?')">
                <button type="button" class="btn btn-danger"><i class='fa fa-trash'></i></button></a>
            </div>

            <div class="table-responsive">
              <form method="post" action="<?php echo base_url('laboratorium/dataAntibody/updateDataAksi') ?>" role="form">
                <div class="form-group">
                  <label>Nomor Rekam Medik</label>
                  <input class="form-control" type="hidden" value="<?php echo $d->id_test_antibody ?>" name="id_test_antibody">
                  <input class="form-control" type="text" value="<?php echo $d->id_catatan_medik ?>" name="id_catatan_medik" readonly="">
                </div>
                <div class="form-group">
                  <label>Nama Pasien</label>
                  <input class="form-control" type="text" id="nama" name="nama_pasien" value="<?php echo $d->nama_pasien ?>" readonly>
                </div>
                <div class="form-group">
                  <label>Dokter Pengirim</label>
                  <select class="form-control" type="text" name="id_dokter" required="">
                    <option value="<?php echo $d->id_dokter ?>"><?php echo $d->nama_dokter ?></option>
                    <?php foreach ($datadokter as $a) : ?>
                      <option value="<?php echo $a->id_dokter ?>"><?php echo $a->nama_dokter ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Tanggal Periksa</label>
                  <input class="form-control" type="text" name="tanggal" value="<?php echo formatDateIndo($d->tgl_periksa) . ' / ' . $d->jam; ?>" readonly="">
                </div>
                <div class="form-group">
                  <label>IgM</label>
                  <select class="form-control" type="text" name="igm" required="">
                    <option value="<?php echo $d->igm ?>"><?php echo $d->nama_igm ?></option>
                    <option value="3">On Process</option>
                    <option value="1">Reaktif</option>
                    <option value="0">Non Reaktif</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>IgG</label>
                  <select class="form-control" type="text" name="igg" required="">
                    <option value="<?php echo $d->igg ?>"><?php echo $d->nama_igg ?></option>
                    <option value="3">On Process</option>
                    <option value="1">Reaktif</option>
                    <option value="0">Non Reaktif</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Petugas Pemeriksa</label>
                  <input class="form-control" type="text" value="<?php echo $d->nama_petugas ?>" name="pemeriksa" readonly="">
                </div>
                <button type="submit" name="submit" class="btn btn-success">Update</button>
              </form>
            <?php endforeach ?>
            </div>
        </div>
      </div><!-- /.row -->

    </div><!-- /#page-wrapper -->

    <!--</div> /#wrapper -->