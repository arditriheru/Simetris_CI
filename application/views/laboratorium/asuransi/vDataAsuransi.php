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
      </div><!-- /.row -->

      <div class="row">
        <div class="col-lg-12">
          <?php $this->load->view('templates/welcome') ?>
          <?php echo $this->session->flashdata('alert') ?>
        </div>
      </div><!-- /.row -->

      <?php $no=1; if(isset($data)) { ?>

        <div class="row">
          <div class="col-lg-6">
            <a href="<?php echo base_url('laboratorium/dataAsuransi/printData/1/'.$id) ?>" target="_blank"><button type="button" class="btn btn-primary"><i class='fa fa-print'></i> Print Semua</button></a><br><br>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">No.Register</th>
                    <th class="text-center">Nomor RM</th>
                    <th class="text-center">Nama Pasien</th>
                    <th class="text-center">Tanggal / Jam</th>
                    <th class="text-center">Tarif</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; foreach ($data as $d) : ?>
                  <tr>
                    <td class="text-center"><?php echo $no++; ?></td>
                    <td class="text-center"><?php echo $d->no_reg; ?></td>
                    <td class="text-center"><?php echo $d->id_catatan_medik; ?></td>
                    <td class="text-center"><?php echo $d->nama_pasien; ?></td>
                    <td class="text-center"><?php echo formatDateIndo($d->tgl_kunj)." / ".$d->jam_kunj; ?></td>
                    <td class="text-center"><?php echo number_format($d->biaya,0,",","."); ?></td>
                    <td class="text-center">
                      <a href="<?php echo base_url('laboratorium/dataAsuransi/printData/2/'.$d->id_lab_trn) ?>" target="_blank"><button type="button" class="btn btn-success"><i class='fa fa-print'></i></button></a>
                    </td>
                  </tr>

                <?php endforeach; ?>

              </tbody>
            </table>
          </div>
        </div>
      </div><!-- /.row -->

    <?php }else{ ?>

      <div class="row">
        <div class="col-lg-6">
          <form method="post" action="<?php echo base_url('laboratorium/dataAsuransi/cariData') ?>" role="form">
            <div class="form-group">
              <label>Masukkan Nomor Registrasi</label>
              <input class="form-control" type="text" name="id" placeholder="Nomor Registrasi Pendaftaran">
            </div><button type="submit" class="btn btn-success">Tampilkan</button>
          </form>
        </div>
      </div><!-- /.row -->

    <?php } ?>

  </div><!-- /#page-wrapper -->

  <!--</div> /#wrapper -->
