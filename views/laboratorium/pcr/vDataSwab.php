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

      <div class="row">
        <div class="col-lg-12">
          <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped tablesorter">
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Registrasi</th>
                  <th class="text-center">Nomor Identitas</th>
                  <th class="text-center">Nama Pasien</th>
                  <th class="text-center">Jadwal</th>
                  <th class="text-center" colspan="2">File Upload</th>
                  <th class="text-center">Invoice</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = $total; foreach ($antigen as $d) : ?>
                <tr>
                  <td class="text-center"><?php echo $no--; ?></td>
                  <td class="text-center">
                    <?php if($d->validasi==0){ ?>
                      <a type="button" class="btn btn-danger" href="<?php echo base_url('laboratorium/dataSwab/ubahOk/').$d->id_booking_swab; ?>" onclick="javascript: return confirm('Anda yakin di validasi?')"><i class='fa fa-remove'></i></a>
                    <?php }else{ ?>
                      <a type="button" class="btn btn-success" href="<?php echo base_url('laboratorium/dataSwab/ubahNo/').$d->id_booking_swab; ?>" onclick="javascript: return confirm('Anda yakin tidak di validasi?')"><i class='fa fa-check'></i></a>
                    <?php } ?>
                  </td>
                  <td class="text-center"><?php echo formatDateIndo($d->tanggal).' / '.$d->jam; ?></td>
                  <td class="text-center"><?php echo $d->no_identitas; ?></td>
                  <td class="text-center"><?php echo strtoupper($d->nama); ?></td>
                  <td class="text-center"><?php echo $d->hari.', '.$d->pukul; ?></td>
                  <?php if(isset($d->file_identitas)){ ?>
                    <td class="text-center"><a type="button" class="btn btn-success" href="<?php echo base_url('laboratorium/dataSwab/berkas/').$d->file_identitas; ?>"><i class='fa fa-id-card-o'></i></a></td>
                  <?php }else{ ?>
                    <td class="text-center"><a type="button" class="btn btn-success"><i class='fa fa-remove'></i></a></td>
                  <?php } if(isset($d->file_pembayaran)){ ?>
                    <td class="text-center"><a type="button" class="btn btn-primary" href="<?php echo base_url('laboratorium/dataSwab/berkas/').$d->file_pembayaran; ?>"><i class='fa fa-file-text-o'></i></a></td>
                  <?php }else{ ?>
                    <td class="text-center"><a type="button" class="btn btn-primary"><i class='fa fa-remove'></i></a></td>
                  <?php } ?>
                  
                  <td class="text-center"><a type="button" class="btn btn-warning" href="<?php echo base_url('laboratorium/dataSwab/pdf/').$d->id_booking_swab; ?>" target="_blank"><i class='fa fa-print'></i></a></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </div>
        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->

      <!--</div> /#wrapper -->
