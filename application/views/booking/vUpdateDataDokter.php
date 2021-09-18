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
          <?php foreach ($datadokter as $d) : ?>
            <form method="post" action="<?php echo base_url('booking/dataPetugas/updateDataDokterAksi') ?>" role="form">
              <div class="form-group">
                <label>Nama Dokter</label>
                <input class="form-control" type="hidden" name="id_dokter" value="<?php echo $d->id_dokter ?>">
                <input class="form-control" type="text" name="nama_dokter" value="<?php echo $d->nama_dokter ?>">
              </div>
              <div class="form-group">
                <label>Spesialis</label>
                <select class="form-control" type="text" name="id_unit" required="">
                  <option value="<?php echo $d->id_unit ?>"><?php echo $d->nama_unit ?></option>
                  <option value="1">Poli Anak</option>
                  <option value="2">Poli Obsgyn</option>
                  <option value="3">Poli Bedah</option>
                </select>
              </div>
              <div class="form-group">
                <label>Aktif</label>
                <select class="form-control" type="text" name="status" required="">
                  <option value="<?php echo $d->status ?>"><?php echo $d->status ?></option>
                  <option value="1">Aktif</option>
                  <option value="0">Nonaktif</option>
                </select>
              </div>
              <button type="submit" class="btn btn-success">Submit</button>
            </form>
          <?php endforeach; ?>
        </div>
      </div><!-- /.row -->

    </div><!-- /#page-wrapper -->

    <!--</div> /#wrapper -->
