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
          
          <?php $this->load->view('templates/welcome') ?>
          <?php echo $this->session->flashdata('alert') ?>

        </div>
        <div class="col-lg-6">
          <form method="post" action="<?php echo base_url('inventaris/dataInventaris/tambahDataRuanganAksi') ?>" role="form">
            <div class="form-group">
              <label>Kode Ruangan</label>
              <input class="form-control" type="text" name="kode_ruangan" placeholder="Masukkan..">
            </div>
            <div class="form-group">
              <label>Nama Ruangan</label>
              <input class="form-control" type="text" name="nama_ruangan" placeholder="Masukkan..">
            </div>
            <button type="submit" name="submit" class="btn btn-success">Tambah</button>
          </form>
        </div>
        <div class="col-lg-6">
          <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped tablesorter">
              <thead>
                <tr>
                  <th class="text-center">#</i></th>
                  <th class="text-center">Kode</i></th>
                  <th class="text-center">Nama Ruangan</i></th>
                  <th class="text-center" colspan="3">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($data as $d) : ?>
                <tr class="active">
                  <td class="text-center"><?php echo $no++; ?></td>
                  <td class="text-center"><?php echo $d->kode_ruangan; ?></td>
                  <td class="text-center"><?php echo $d->nama_ruangan; ?></td>
                  <td class="text-center">              
                    <a href="<?php echo base_url('inventaris/dataInventaris/deleteDataRuangan/'.$d->kode_ruangan) ?>"
                      onclick="javascript: return confirm('Anda yakin hapus?')">
                      <button type="button" class="btn btn-danger"><i class='fa fa-trash'></i></button></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div><!-- /.row -->

    </div><!-- /#page-wrapper -->

    <!--</div> /#wrapper -->
