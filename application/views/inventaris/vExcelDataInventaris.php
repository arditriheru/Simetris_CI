<?php
$filename   = "inventaris-per-".$subtitle."-".getDatenow();
header("Content-type: application/ms-excel");
header("Content-Disposition: attachment; filename=".$filename.".xls");
?>
<body>
  <div class="table-responsive">
    <table border="0">
      <tr>
        <th class="text-center" colspan="8"><p><strong>Daftar Barang Inventaris<br>Per <?php echo $subtitle ?><br><?php echo getDateIndo() ?></strong></p></th>
      </tr>
      <tr>
        <th class="text-center">#</i></th>
        <th class="text-center">Nomor Inventaris</i></th>
        <th class="text-center">Nama Barang</i></th>
        <th class="text-center">Ruangan</i></th>
        <th class="text-center">Kondisi</i></th>
        <th class="text-center">Status</i></th>
        <th class="text-center">Kalibrasi</i></th>
        <th class="text-center">Re-kalibrasi</i></th>
      </tr>
      <?php $no = 1; foreach ($data as $d) : ?>
      <tr class="active">
        <td class="text-center"><?php echo $no++; ?></td>
        <td class="text-center"><?php echo $d->nomor_inventaris; ?></td>
        <td class="text-center"><?php echo $d->nama_barang; ?></td>
        <td class="text-center"><?php echo $d->nama_ruangan; ?></td>
        <td class="text-center"><?php echo $d->nama_kondisi; ?></td>
        <td class="text-center"><?php echo $d->nama_status; ?></td>
        <td class="text-center">
          <?php
          if($d->tanggal_kalibrasi=="0000-00-00")
          {
            echo "-";
          }else{
            echo date('d/m/Y', strtotime($d->tanggal_kalibrasi));
          }
          ?>
        </td>
        <td class="text-center">
          <?php
          if($d->kalibrasi_ulang=="0000-00-00")
          {
            echo "-";
          }else{
            echo date('d/m/Y', strtotime($d->kalibrasi_ulang));
          }
          ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>

  </div><!-- /.row -->