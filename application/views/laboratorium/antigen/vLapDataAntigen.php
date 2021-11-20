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
          <?php echo $this->session->flashdata('alert') ?>
        </div>
        
        <?php if(!isset($antigen)){ ?>
          <div class="col-lg-6">
            <div class="table-responsive">
              <form method="post" action="<?php echo base_url('laboratorium/dataAntigen/lapCariDataAksi') ?>" role="form">
                <div class="form-group">
                  <label>Dari Tanggal</label>
                  <input class="form-control" type="date" name="awal" required="">
                </div>
                <div class="form-group">
                  <label>Sampai Tanggal</label>
                  <input class="form-control" type="date" name="akhir" required="">
                </div>
                <button type="submit" name="submit" class="btn btn-success">Tampilkan</button>
              </form>
            </div>
          </div>
        <?php }else{ ?>
          <div class="col-lg-12">
            <div class="col-lg-6">
              <form method="post" action="<?php echo base_url('laboratorium/dataAntigen/excelData') ?>" role="form">
                <input class="form-control" type="hidden" name="awal" value="<?php echo $awal ?>">
                <input class="form-control" type="hidden" name="akhir" value="<?php echo $akhir ?>">
                <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-download"></i> Export</button>
              </form><br>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                  <tr>
                    <th class="text-center">#</i></th>
                    <th class="text-center">Tgl. Pemeriksaan</i></th>
                    <th class="text-center">Nomor RM</i></th>
                    <th class="text-center">Nama Pasien</i></th>
                    <th class="text-center">Hasil</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; foreach ($antigen as $d) : ?>
                  <tr>
                    <td class="text-center"><?php echo $no++; ?></td>
                    <td class="text-center"><?php echo formatDateIndo($d->tgl_periksa)." / ".$d->jam;
                    ?></td>
                    <td class="text-center"><?php echo $d->id_catatan_medik;
                    ?></td>
                    <td class="text-center"><?php echo $d->nama_pasien2; ?>
                      <td class="text-center"><?php echo $d->nama_hasil;
                      ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        <?php } ?>
      </div><!-- /.row -->

    </div><!-- /#page-wrapper -->

    <!--</div> /#wrapper -->
