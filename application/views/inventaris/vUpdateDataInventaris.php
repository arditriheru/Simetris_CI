<body>

  <div id="wrapper">

    <div id="page-wrapper">

      <div class="row">
        <div class="col-lg-12">

          <h1><?php echo $title ?> <small> <?php echo $subtitle ?></small></h1>

          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('inventaris/dataInventaris') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-plus"></i> <?php echo $subtitle ?></li>
          </ol>

          <?php $this->load->view('templates/welcome') ?>
          <?php echo $this->session->flashdata('alert') ?>

        </div>

        <div class="col-lg-6">

          <?php foreach ($data as $d) : ?>

            <form method="post" action="<?php echo base_url('inventaris/dataInventaris/updateDataInventarisAksi/'.$d->kode_registrasi) ?>" role="form">
             <div class="form-group">
              <label>Nomor Inventaris</label>
              <input class="form-control" type="text" name="nomor_inventaris" value="<?php echo $d->nomor_inventaris ?>" readonly="">
            </div>
            <div class="form-group">
              <label>Nama Barang</label>
              <input class="form-control" type="text" name="nama_barang" value="<?php echo $d->nama_barang ?>">
            </div>
            <div class="form-group">
              <label>Jenis</label>
              <select class="form-control" type="text" name="kode_jenis" required="">
                <option value="<?php echo $d->kode_jenis ?>"><?php echo $d->nama_jenis ?></option>
                <?php foreach ($datajenis as $a) : ?>
                  <option value="<?php echo $a->kode_jenis ?>"><?php echo $a->nama_jenis ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Ruangan</label>
              <select class="form-control" type="text" name="kode_ruangan" required="">
                <option value="<?php echo $d->kode_ruangan ?>"><?php echo $d->nama_ruangan ?></option>
                <?php foreach ($dataruangan as $a) : ?>
                  <option value="<?php echo $a->kode_ruangan ?>"><?php echo $a->nama_ruangan ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Pengadaan</label>
              <input class="form-control" type="date" name="tanggal_pengadaan" value="<?php echo $d->tanggal_pengadaan ?>">
            </div>
            <div class="form-group">
              <label>Kondisi</label>
              <select class="form-control" type="text" name="kondisi" required="">
                <option value="<?php echo $d->kondisi ?>"><?php echo $d->nama_kondisi ?></option>
                <option value='1'>Baik</option>
                <option value='0'>Rusak</option>
              </select>
            </div>
            <div class="form-group">
              <label>Kalibrasi</label>
              <input class="form-control" type="date" name="tanggal_kalibrasi" value="<?php echo $d->tanggal_kalibrasi ?>">
            </div>
            <div class="form-group">
              <label>Kalibrasi Ulang</label>
              <input class="form-control" type="date" name="kalibrasi_ulang" value="<?php echo $d->kalibrasi_ulang ?>">
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <input class="form-control" type="text" name="keterangan" value="<?php echo $d->keterangan ?>">
            </div>
            <button type="submit" name="submit" class="btn btn-success">Perbarui</button>
          </form>

        <?php endforeach ?>

      </div>

    </div>
  </div>
</div><!-- /.row -->

</div><!-- /#page-wrapper -->

<!--</div> /#wrapper -->
