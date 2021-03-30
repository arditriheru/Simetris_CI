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
        <div class="col-lg-7">
          <form method="post" action="laporan-booking-hari-ini-export.php" role="form">
           <div class="btn-group">
            <button type="button" class="btn btn-success">Pilih Dokter</button>
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
             <span class="caret"></span>
           </button>
           <ul class="dropdown-menu">
             <li disabled selected><a>All</a></li>
             <?php foreach($datadokter as $d): ?>
              <li><a href="<?php echo base_url('booking/dataJadwal/dataJadwalTab/'.$d->id_dokter) ?>"><?php echo $d->nama_dokter ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div><!-- /btn-group -->
      </form><br>
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped tablesorter">
          <thead>
            <tr>
              <th class="text-center">Hari</th>
              <th class="text-center">Poli</th>
              <th class="text-center">Nama Dokter</th>
              <th class="text-center">Sesi</th>
              <th class="text-center">Jam Praktek</th>
              <th class="text-center">Kuota</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($datajadwal as $d) : ?>
            <tr>
              <td class="text-center">
                <?php if($this->session->userdata('booking_akses')=="Admin"){ ?>
                  <a href="<?php echo base_url('booking/dataJadwal/updateDataJadwal/').$d->id_jadwal ?>">
                    <?php echo $d->nama_hari; ?>
                  </a>
                <?php }else{ ?>
                  <?php echo $d->nama_hari; ?>
                <?php } ?>
              </td>
              <td class="text-center"><?php echo $d->nama_unit; ?></td>
              <td class="text-center"><?php echo $d->nama_dokter; ?></td>
              <td class="text-center"><?php echo $d->nama_sesi; ?></td>
              <td class="text-center"><?php echo $d->jam.$d->plus_ims; ?></td>
              <td class="text-center"><?php echo $d->kuota; ?></td>
            </tr>

          <?php endforeach; ?>

        </tbody>
      </table>
    </div>
  </div>

  <div class="col-lg-5">
    <?php if($this->session->userdata('booking_akses')=="Admin"){ ?>
      <a href="<?php echo base_url('booking/dataJadwal/tambahDataJadwal/1') ?>">
        <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Libur / Cuti</button>
      </a><br><br>
    <?php } ?>
    <table class="table table-bordered table-hover table-striped tablesorter">
      <thead>
        <tr>
          <th class="text-center">#</th>
          <th class="text-center">Tanggal</th>
          <th class="text-center">Dokter</th>
          <th class="text-center">Sesi</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; foreach ($datajadwallibur as $d) : ?>
        <tr>
          <td class="text-center"><?php echo $no++; ?></td>
          <td class="text-center"><?php echo formatDateIndo($d->tanggal); ?></td>
          <td class="text-center"><?php echo $d->nama_dokter; ?></td>
          <td class="text-center"><?php echo $d->nama_sesi; ?></td>
          <td class="text-center">

            <?php if($this->session->userdata('booking_akses')=="Admin"){ ?>

              <a href="<?php echo base_url('booking/dataJadwal/deleteDataJadwalLibur/'.$d->id_jadwal_libur) ?>" onclick="javascript: return confirm('Anda yakin hapus?')"><button type="button" class="btn btn-danger"><i class='fa fa-trash'></i></button></a>

            <?php } ?>

          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

</div><!-- /.row -->

</div><!-- /#page-wrapper -->

<!--</div> /#wrapper -->
