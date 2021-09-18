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
          <?php foreach($datapasien as $d): ?>
            <form method="post" action="<?php echo base_url('booking/dataBooking/tambahDataAncLamaAksi') ?>" role="form">
              <div class="form-group">
                <label>No.RM</label>
                <input class="form-control" type="text" name="id_catatan_medik" value="<?php echo $d->id_catatan_medik ?>" readonly="" required="">
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
                <input class="form-control" type="text" name="kontak" value="<?php echo $d->telp ?>" required="">
              </div>
              <div class="form-group">
                <label>Petugas</label>
                <select class="form-control" type="text" name="id_petugas" required="">
                  <option value="">Pilih</option>
                  <?php foreach($datapetugas as $d): ?>
                    <option value="<?php echo $d->id_petugas ?>"><?php echo $d->nama_petugas ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label>Jadwal</label>
                <input class="form-control" type="date" name="jadwal" required="">
              </div>
              <div class="form-group">
                <label>Sesi</label><br>
                <small><b>Pagi :</b> 07.00 - 10.59 | <b>Siang :</b> 11.00 - 14.59 | <b>Sore :</b> 15.00 - 17.59 | <b>Malam :</b> 18.00 - selesai</small>
                <select class="form-control" type="text" name="id_sesi" required="">
                  <option value="">Pilih</option>
                  <?php foreach($datasesi as $d): ?>
                    <option value="<?php echo $d->id_sesi ?>"><?php echo $d->nama_sesi ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <input class="form-control" type="text" name="keterangan" placeholder="Masukkan..">
              </div>
              <button type="submit" name="polisubmit" class="btn btn-success">Daftar</button>
            </form>
          <?php endforeach; ?>
        </div>
      </div>

    </div><!-- /.row -->

  </div><!-- /#page-wrapper -->

  <!--</div> /#wrapper -->
