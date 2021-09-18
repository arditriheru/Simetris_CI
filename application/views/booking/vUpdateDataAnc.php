<body>

  <div id="wrapper">

    <div id="page-wrapper">

      <div class="row">
        <div class="col-lg-12">
          <h1><?php echo $title ?> <small> <?php echo $subtitle ?></small></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('booking/dataBooking') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-plus"></i> <?php echo $title ?></li>
          </ol>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <?php $this->load->view('templates/welcome') ?>
          <?php echo $this->session->flashdata('alert') ?>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6">

          <?php foreach ($data as $d) : ?>

            <form method="post" action="<?php echo base_url('booking/dataBooking/updateDataAncAksi') ?>" role="form">
              <div class="form-group">
                <label>Nomor RM</label>
                <input class="form-control" type="hidden" name="id" value="<?php echo $d->id_anc ?>">
                <input class="form-control" type="text" name="id_catatan_medik" value="<?php echo $d->id_catatan_medik ?>" readonly="">
              </div>
              <div class="form-group">
                <label>Nama Pasien</label>
                <input class="form-control" type="text" name="nama" value="<?php echo $d->nama ?>" required="">
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <input class="form-control" type="text" name="alamat" value="<?php echo $d->alamat ?>" required="">
              </div>
              <div class="form-group">
                <label>Kontak</label>
                <input class="form-control" type="text" name="kontak" value="<?php echo $d->kontak ?>" required="">
              </div>
              <div class="form-group">
                <label>Petugas</label>
                <input class="form-control" type="text" name="id_petugas" value="<?php echo $d->nama_petugas ?>" readonly="">
              </div>
              <div class="form-group">
                <label>Jadwal</label>
                <input class="form-control" type="text" name="jadwal" value="<?php echo formatDateIndo($d->jadwal) ?>" readonly="">
              </div>
              <div class="form-group">
                <label>Sesi</label><br>
                <input class="form-control" type="text" name="id_sesi" value="<?php echo $d->nama_sesi ?>" readonly="">
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <input class="form-control" type="text" name="keterangan" value="<?php echo $d->keterangan ?>">
              </div>
              <button type="submit" name="polisubmit" class="btn btn-success">Perbarui</button>
            </form>

          <?php endforeach; ?>

        </div>

      </div><!-- /.row -->

    </div><!-- /#page-wrapper -->

    <!--</div> /#wrapper -->
