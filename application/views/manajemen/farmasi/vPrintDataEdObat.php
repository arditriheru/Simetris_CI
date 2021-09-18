<body>

  <script>
    window.print();
  </script>

  <div id="wrapper">

    <div id="page-wrapper">

      <div class="row">
        <div class="col-lg-12">
          <table class="table table-bordered">
           <thead>
            <p align="center"><strong>Rekap Data</strong></p>
            <p align="center"><strong>Expired Date Obat</strong></p>
            <p align="center"><strong><?php echo $data ?></strong></p>
            <tr>
              <th class="text-center">No</th>
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
              <td class="text-center"><?php echo $d->no_urut ?></td>
              <td class="text-left"><?php echo $d->nama; ?></td>
              <td class="text-center"><?php echo $d->stok_poli; ?></td>
              <td class="text-center"><?php echo $d->stok_inap; ?></td>
              <td class="text-center"><?php echo $d->tgl_ed; ?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div><!-- /.row -->

</div><!-- /#page-wrapper -->

  <!-- </div> /#wrapper  -->