<body>

  <div id="wrapper">

    <div id="page-wrapper">

      <div class="row">
        <div class="col-lg-12">
          <h1><?php echo $title ?> <small><?php echo getDateIndo() ?></small></h1>
          <ol class="breadcrumb">
            <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
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
        <div class="col-lg-12">
          <ul class="nav nav-pills" style="margin-bottom: 15px;">
            <li class="active"><a href="#1" data-toggle="tab">Poliklinik</a></li>
            <li><a href="#2" data-toggle="tab">Tumbuh Kembang</a></li>
            <li><a href="#3" data-toggle="tab">Antenatal Care</a></li>
            <li><a href="#4" data-toggle="tab">Daftar Mandiri</a></li>
          </ul>
          <div id="myTabContent" class="tab-content">

            <div class="tab-pane fade active in" id="1">
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped tablesorter">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">No.RM</th>
                      <th class="text-center">Nama Pasien</th>
                      <th class="text-center">Dokter</th>
                      <th class="text-center">Jadwal</th>
                      <th class="text-center">Sesi</th>
                      <th class="text-center">Keterangan</th>
                      <th class="text-center" colspan="3">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = $jmlpoli; foreach ($poli as $d) : ?>
                    <tr>
                      <td class="text-center"><?php echo $no--; ?></td>
                      <td class="text-center"><?php echo $d->id_catatan_medik; ?></td>
                      <td class="text-center"><?php echo $d->nama; ?></td>
                      <td class="text-center"><?php echo $d->nama_dokter; ?></td>
                      <td class="text-center"><?php echo date("d/m/Y", strtotime($d->booking_tanggal)); ?></td>
                      <td class="text-center"><?php echo $d->nama_sesi; ?></td>
                      <td class="text-center"><?php echo $d->keterangan; ?></td>
                      <td class="text-center">              
                        <a href="<?php echo base_url('booking/dataBooking/detailDataPoli/'.$d->id_booking) ?>"><button type="button" class="btn btn-warning"><i class='fa fa-folder-open'></i></button></a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>

          <div class="tab-pane fade in" id="2">
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">No.RM</th>
                    <th class="text-center">Nama Pasien</th>
                    <th class="text-center">Dokter</th>
                    <th class="text-center">Jadwal</th>
                    <th class="text-center">Sesi</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center" colspan="3">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = $jmltumbang; foreach ($tumbang as $d) : ?>
                  <tr>
                    <td class="text-center"><?php echo $no--;?></td>
                    <td class="text-center"><?php echo $d->id_catatan_medik;?></td>
                    <td class="text-center"><?php echo $d->nama;?></td>
                    <td class="text-center"><?php echo $d->nama_petugas;?></td>
                    <td class="text-center"><?php echo date("d/m/Y", strtotime($d->jadwal)); ?></td>
                    <td class="text-center"><?php echo $d->nama_sesi;?></td>
                    <td class="text-center"><?php echo $d->keterangan;?></td>
                    <td class="text-center">              
                      <a href="<?php echo base_url('booking/dataBooking/detailDataTumbang/'.$d->id_tumbang) ?>"><button type="button" class="btn btn-warning"><i class='fa fa-folder-open'></i></button></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="tab-pane fade in" id="3">
          <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped tablesorter">
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">No.RM</th>
                  <th class="text-center">Nama Pasien</th>
                  <th class="text-center">Dokter</th>
                  <th class="text-center">Jadwal</th>
                  <th class="text-center">Sesi</th>
                  <th class="text-center">Keterangan</th>
                  <th class="text-center" colspan="3">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = $jmlanc; foreach ($anc as $d) : ?>
                <tr>
                  <td class="text-center"><?php echo $no--;?></td>
                  <td class="text-center"><?php echo $d->id_catatan_medik;?></td>
                  <td class="text-center"><?php echo $d->nama;?></td>
                  <td class="text-center"><?php echo $d->nama_petugas;?></td>
                  <td class="text-center"><?php echo date("d/m/Y", strtotime($d->jadwal)); ?></td>
                  <td class="text-center"><?php echo $d->nama_sesi;?></td>
                  <td class="text-center"><?php echo $d->keterangan;?></td>
                  <td class="text-center">              
                    <a href="<?php echo base_url('booking/dataBooking/detailDataAnc/'.$d->id_anc) ?>"><button type="button" class="btn btn-warning"><i class='fa fa-folder-open'></i></button></a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="tab-pane fade in" id="4">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped tablesorter">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th class="text-center">No.RM</th>
                <th class="text-center">Nama Pasien</th>
                <th class="text-center">Dokter</th>
                <th class="text-center">Jadwal</th>
                <th class="text-center">Sesi</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center" colspan="3">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = $jmlmandiri; foreach ($mandiri as $d) : ?>
              <tr>
               <td class="text-center"><?php echo $no--;?></td>
               <td class="text-center"><?php echo $d->id_catatan_medik;?></td>
               <td class="text-center"><?php echo $d->nama;?></td>
               <td class="text-center"><?php echo $d->nama_dokter;?></td>
               <td class="text-center"><?php echo date("d/m/Y", strtotime($d->booking_tanggal)); ?></td>
               <td class="text-center"><?php echo $d->nama_sesi;?></td>
               <td class="text-center"><?php echo $d->keterangan;?></td>
               <td class="text-center">              
                <a href="<?php echo base_url('booking/dataBooking/detailDataPoli/'.$d->id_booking) ?>"><button type="button" class="btn btn-warning"><i class='fa fa-folder-open'></i></button></a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</div><!-- content -->
</div>
</div><!-- /.row -->

</div><!-- /#page-wrapper -->

<!--</div> /#wrapper -->
