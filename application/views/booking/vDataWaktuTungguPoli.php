<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekap Data Waktu Pelayanan Poliklinik ".date('d/m/Y').".xls");
?>
<!DOCTYPE html>
<html>
<body>
  <table border="1" class="table table-bordered table-hover table-striped tablesorter">
    <thead>
      <h2 align="center">Rekap Data</h2>
      <h2 align="center">Waktu Pelayanan Poliklinik</h2>
      <h3 align="center">Periode <?php echo date("d-m-Y", strtotime($awal))." - ".date("d-m-Y", strtotime($akhir)); ?>: </h3>
      <tr>
        <th class="text-center">#</th>
        <th class="text-center">Tanggal</th>
        <th class="text-center">Nomor RM</th>
        <th class="text-center">Nama Pasien</th>
        <th class="text-center">Waktu <small>(Menit)</small></th>
      </tr>
    </thead>
    <tbody>
     <?php $no = 1; foreach ($data as $d) : ?>
     <tr>
      <td class="text-center"><?php echo $no++; ?></td>
      <td class="text-center"><?php echo date("d-m-Y", strtotime($d->booking_tanggal)); ?></td>
      <td class="text-center"><?php echo $d->id_catatan_medik; ?></td>
      <td class="text-center"><?php echo $d->nama; ?></td>
      <td><div align="center">
       <?php

       if($d->mulai!='00:00:00' && $d->akhir=='00:00:00')
       {
        echo "Error";

      }else{

        $mulai = strtotime($d->mulai); //waktu mulai
        $akhir = strtotime($d->akhir); //waktu akhir
        $diff  = $akhir - $mulai;
        $jam   = floor($diff/(60*60));
        $menit = $diff-$jam*(60*60);
        echo $jam.":".floor($menit/60);

      }
      ?>
    </div></td>
  </tr>

<?php endforeach; ?>

</tbody>
</table>
</body>
</html>