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

          <?php if($id == 1){ ?>

          <form method="post" action="<?php echo base_url('booking/dataAlergi/tambahDataAlergiMakananAksi/'.$id_booking) ?>" role="form">
            <div class="form-group">
              <label>Alergi Makanan</label>
              <input class="form-control" type="hidden" name="id_catatan_medik" value="<?php echo $rm ?>">
              <input class="form-control" type="text" name="nama_makanan" placeholder="Masukkan..">
            </div>
            <button type="submit" name="submit" class="btn btn-success">Simpan</button>
          </form>

        <?php }else{ ?>

          <?php foreach ($data as $d) : ?>

            <div align="right">
              <a href="<?php echo base_url('booking/dataAlergi/hapusDataAlergiMakanan/'.$id_booking.'/'.$d->id_catatan_medik) ?>"
                onclick="javascript: return confirm('Anda yakin hapus?')">
                <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> Hapus</button>
              </a>
            </div>

            <form method="post" action="<?php echo base_url('booking/dataAlergi/updateDataAlergiMakananAksi/'.$id_booking) ?>" role="form">
              <div class="form-group">
                <label>Alergi Makanan</label>
                <input class="form-control" type="hidden" name="id_catatan_medik" value="<?php echo $d->id_catatan_medik ?>">
                <input class="form-control" type="text" name="nama_makanan" value="<?php echo $d->nama_makanan ?>">
              </div>
              <button type="submit" name="submit" class="btn btn-success">Simpan</button>
            </form>

          <?php endforeach; ?>

        <?php } ?>

      </div>

    </div><!-- /.row -->

  </div><!-- /#page-wrapper -->

  <!--</div> /#wrapper -->
