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

        <?php if($id==1){ ?>

         <div class="col-lg-6">
          <form method="get" action="<?php echo base_url('inventaris/dataInventaris/cariDataInventaris') ?>" role="form">
            <div class="form-group">
              <label>Nomor Inventaris</label>
              <input class="form-control" type="text" name="nomor_inventaris" placeholder="Masukkan.." required="">
            </div><button type="submit" class="btn btn-success">Tampilkan</button>
          </form>
          <br>
          <form method="get" action="<?php echo base_url('inventaris/dataInventaris/cariDataInventaris') ?>" role="form">
            <div class="form-group">
              <label>Kondisi Barang</label>
              <select class="form-control" type="text" name="kondisi" required="">
                <option value="">Pilih</option>
                <option value="1">Baik</option>
                <option value="0">Rusak</option>
              </select>
            </div>
            <button type="submit" class="btn btn-success">Tampilkan</button>
          </form>
        </div>

        <div class="col-lg-6">
         <form method="get" action="<?php echo base_url('inventaris/dataInventaris/cariDataInventaris') ?>" role="form">
          <div class="form-group">
            <label>Status Barang</label>
            <select class="form-control" type="text" name="status" required="">
              <option value="">Pilih</option>
              <option value="1">Baru</option>
              <option value="0">Bekas</option>
            </select>
          </div>
          <button type="submit" class="btn btn-success">Tampilkan</button>
        </form>
        <br>
        <form method="get" action="<?php echo base_url('inventaris/dataInventaris/cariDataInventaris') ?>" role="form">
         <div class="form-group">
          <label>Nama Ruangan</label>
          <select class="form-control" type="text" name="kode_ruangan" required="">
            <option value="">Pilih</option>
            <option value="0">Semua</option>
            <?php foreach ($dataruangan as $d) : ?>
              <option value="<?php echo $d->kode_ruangan ?>"><?php echo $d->nama_ruangan ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <button type="submit" class="btn btn-success">Tampilkan</button>
      </form>
    </div>

  <?php }else { ?>

   <div class="col-lg-6">
    <form method="post" action="<?php echo base_url('inventaris/dataInventaris/tambahDataInventarisAksi') ?>" role="form">
      <div class="form-group">
        <label>Nama Barang</label>
        <input class="form-control" type="text" name="nama_barang" placeholder="Masukkan..">
      </div>
      <div class="form-group">
        <label>Jenis</label>
        <select class="form-control" type="text" name="kode_jenis" required="">
          <option value="">Pilih</option>
          <?php foreach ($datajenis as $d) : ?>
            <option value="<?php echo $d->kode_jenis ?>"><?php echo $d->nama_jenis ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="form-group">
        <label>Ruangan</label>
        <select class="form-control" type="text" name="kode_ruangan" required="">
          <option value="">Pilih</option>
          <?php foreach ($dataruangan as $d) : ?>
            <option value="<?php echo $d->kode_ruangan ?>"><?php echo $d->nama_ruangan ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="form-group">
        <label>Pengadaan</label>
        <input class="form-control" type="date" name="tanggal_pengadaan">
      </div>
      <div class="form-group">
        <label>Status</label>
        <select class="form-control" type="text" name="status" required="">
          <option value="">Pilih</option>
          <option value='1'>Baru</option>
          <option value='0'>Bekas</option>
        </select>
      </div>
      <div class="form-group">
        <label>Keterangan</label>
        <input class="form-control" type="text" name="keterangan" placeholder="Masukkan..">
      </div>
      <button type="submit" name="submit" class="btn btn-success">Tambah</button>
    </form>
  </div>

<?php } ?>

</div>
</div>
</div><!-- /.row -->

</div><!-- /#page-wrapper -->

<!--</div> /#wrapper -->
