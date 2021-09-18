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
          <a href="<?php echo base_url('booking/dataPetugas/tambahDataPetugas/1') ?>">
            <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button>
          </a><br><br>
          <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped tablesorter">
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Nama</th>
                  <th class="text-center">Spesialis</th>
                  <th class="text-center">Status</th>
                  <th class="text-center" colspan="3">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($datadokter as $d) : ?>
                <tr>
                  <td class="text-center"><?php echo $no++; ?></td>
                  <td class="text-left"><?php echo $d->nama_dokter; ?></td>
                  <td class="text-center"><?php echo $d->nama_unit; ?></td>
                  <td class="text-center"><?php echo $d->status; ?></td>
                  <td class="text-center">              
                    <a href="<?php echo base_url('booking/dataPetugas/updateDataDokter/'.$d->id_dokter) ?>"><button type="button" class="btn btn-warning"><i class='fa fa-edit'></i></button></a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="col-lg-6">
        <a href="<?php echo base_url('booking/dataPetugas/tambahDataPetugas/2') ?>">
          <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button>
        </a><br><br>
        <table class="table table-bordered table-hover table-striped tablesorter">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th class="text-center">Nama</th>
              <th class="text-center">Layanan</th>
              <th class="text-center">Status</th>
              <th class="text-center" colspan="3">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($datapetugas as $d) : ?>
            <tr>
              <td class="text-center"><?php echo $no++; ?></td>
              <td class="text-left"><?php echo $d->nama_petugas; ?></td>
              <td class="text-center"><?php echo $d->pelayanan; ?></td>
              <td class="text-center"><?php echo $d->status; ?></td>
              <td class="text-center">              
                <a href="<?php echo base_url('booking/dataPetugas/updateDataPetugas/'.$d->id_petugas) ?>"><button type="button" class="btn btn-warning"><i class='fa fa-edit'></i></button></a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

  </div><!-- /.row -->

</div><!-- /#page-wrapper -->

<!--</div> /#wrapper -->
