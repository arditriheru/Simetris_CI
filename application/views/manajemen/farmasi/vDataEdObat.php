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
          <p class="text-success"><strong>Note : </strong>Pencarian dapat dilakukan berdasarkan bulan, tahun atau bulan dan tahun.</p>
          <form method="post" action="<?php echo base_url('manajemen/dataFarmasi/dataEdObat/2') ?>" role="form">
            <div class="col-lg-4">
             <div class="form-group">
              <label>Bulan</label>
              <select class="form-control" type="text" name="bln">
                <option value="">Pilih</option>
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
              </select>
            </div>
          </div>
          <div class="col-lg-4">
           <div class="form-group">
            <label>Tahun</label>
            <input class="form-control" type="text" name="thn" placeholder="Contoh : <?php echo getYearNow(); ?>">
          </div>
        </div>
        <div class="col-lg-4"><br>
          <button type="submit" class="btn btn-success">Tampilkan</button>
        </div>
      </form>
    </div>

  </div><!-- /.row -->

  <?php if(isset($data)){ ?>

    <div class="row">
     <div class="col-lg-12">
      <a href="<?php echo base_url('manajemen/dataFarmasi/printDataEdObat?'.$data) ?>" type="button" name="print" class="btn btn-primary"><i class="fa fa-print"></i> Print</a><br><br>
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped tablesorter">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th class="text-center">Kode Obat</th>
              <th class="text-center">Nama Obat</th>
              <th class="text-center">Stok Ralan</th>
              <th class="text-center">Stok Ranap</th>
              <th class="text-center">Expired Date</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($dataedobat as $d) : ?>
            <tr>
              <td class="text-center"><?php echo $no++; ?></td>
              <td class="text-center"><?php echo $d->no_urut; ?></td>
              <td class="text-left"><?php echo $d->nama; ?></td>
              <td class="text-center"><?php echo $d->stok_poli; ?></td>
              <td class="text-center"><?php echo $d->stok_inap; ?></td>
              <td class="text-center"><?php echo $d->tgl_ed; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div><!-- /.row -->

<?php } ?>

</div><!-- /#page-wrapper -->

<!--</div> /#wrapper -->
