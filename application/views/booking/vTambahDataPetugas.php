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
          <?php if($id == 1) { ?>
            <form method="post" action="<?php echo base_url('booking/dataPetugas/tambahDataDokterAksi') ?>" role="form">
              <div class="form-group">
                <label>Nama Dokter</label>
                <input class="form-control" type="text" name="nama_dokter" placeholder="Contoh : Sulchan Sofoewan, Ph.D, Sp.OG (K). Prof. dr.">
              </div>
              <div class="form-group">
                <label>Spesialis</label>
                <select class="form-control" type="text" name="id_unit" required="">
                  <option value="">Pilih</option>
                  <option value="1">Poli Anak</option>
                  <option value="2">Poli Obsgyn</option>
                  <option value="3">Poli Bedah</option>
                </select>
              </div>
              <button type="submit" class="btn btn-success">Submit</button>
            </form>

          <?php }else{ ?>

            <form method="post" action="<?php echo base_url('booking/dataPetugas/tambahDataPetugasAksi') ?>" role="form">
              <div class="form-group">
                <label>Nama Petugas</label>
                <input class="form-control" type="text" name="nama_petugas" placeholder="Contoh : Heru Sarmuji, S.Psi">
              </div>
              <div class="form-group">
                <label>Layanan</label>
                <select class="form-control" type="text" name="pelayanan" required="">
                  <option value="">Pilih</option>
                  <option value="1">Tumbuh Kembang</option>
                  <option value="2">ANC Terpadu</option>
                </select>
              </div>
              <button type="submit" class="btn btn-success">Submit</button>
            </form>
          <?php } ?>
        </div>

      </div><!-- /.row -->

    </div><!-- /#page-wrapper -->

    <!--</div> /#wrapper -->
