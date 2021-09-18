<body>

  <div id="wrapper">

    <div id="page-wrapper">

      <div class="row">
        <div class="col-lg-12">
          <h1><?php echo $title ?> <small><?php echo $subtitle ?></small></h1>
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

          <?php if($id==1){ ?>

            <form method="post" action="<?php echo base_url('booking/dataJadwal/tambahDataJadwalLiburAksi') ?>" role="form">
              <div class="form-group">
                <label>Nama Dokter</label>
                <select class="form-control" type="text" name="id_dokter" required="">
                  <option value="">Pilih</option>
                  <?php foreach($datadokter as $d): ?>
                    <option value="<?php echo $d->id_dokter ?>"><?php echo $d->nama_dokter ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label>Tanggal</label>
                <input class="form-control" type="date" name="tanggal">
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
              <button type="submit" class="btn btn-success">Submit</button>
            </form>

          <?php }else{ ?>

            <form method="post" action="<?php echo base_url('booking/dataJadwal/tambahDataJadwalAksi') ?>" role="form">
              <div class="form-group">
                <label>Nama Dokter</label>
                <select class="form-control" type="text" name="id_dokter" required="">
                  <option value="">Pilih</option>
                  <?php foreach($datadokter as $d): ?>
                    <option value="<?php echo $d->id_dokter ?>"><?php echo $d->nama_dokter ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label>Hari</label>
                <select class="form-control" type="text" name="hari" required="">
                  <option value=''>Pilih</option>
                  <option value='1'>Senin</option>
                  <option value='2'>Selasa</option>
                  <option value='3'>Rabu</option>
                  <option value='4'>Kamis</option>
                  <option value='5'>Jumat</option>
                  <option value='6'>Sabtu</option>
                  <option value='0'>Minggu</option>
                </select>
              </div>
              <div class="form-group">
                <label>Jam</label>
                <input class="form-control" type="text" name="jam" placeholder="Masukkan.." required="">
              </div>
              <div class="form-group">
                <label>Kuota</label>
                <input class="form-control" type="text" name="kuota" placeholder="Masukkan.." required="">
              </div>
              <div class="form-group">
                <label>Imunisasi</label>
                <small>(Untuk dokter spesialis anak)</small>
                <select class="form-control" type="text" name="ims" required="">
                  <option value='0' selected>Tidak</option>
                  <option value='1'>Ya</option>
                </select>
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
              <button type="submit" class="btn btn-success">Submit</button>
            </form>
          <?php } ?>
        </div>

      </div><!-- /.row -->

    </div><!-- /#page-wrapper -->

    <!--</div> /#wrapper -->
