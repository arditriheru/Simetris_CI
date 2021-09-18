<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekap Data Waktu Pelayanan ".date('d/m/Y').".xls");
?>
<!DOCTYPE html>
<html>
<body>
  <table border="0" class="table table-bordered table-hover table-striped tablesorter">
    <thead>
      <h4 align="center">Rekap Data</h4>
      <h4 align="center">Waktu Pelayanan</h4>
      <h4 align="center">Dokter <?php echo $nama_dokter ?>: </h4>
      <tr>
        <th><div align="center">No</div></th>
        <th><div align="center">Nomor RM</div></th>
        <th><div align="center">Nama Pasien</div></th>
        <th><div align="center">Waktu Mulai</div></th>
        <th><div align="center">Waktu Akhir</div></th>
        <th><div align="center">Total</div></th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; foreach ($data as $d) : ?>
      <tr>
        <td><div align="center"><?php echo $no++; ?></div></td>
        <td><div align="center"><?php echo $d->id_catatan_medik; ?></div></td>
        <td><div align="center"><?php echo $d->nama; ?></div></td>
        <td><div align="center"><?php echo $d->mulai; ?></div></td>
        <td><div align="center"><?php echo $d->akhir; ?></div></td>
        <td><div align="center">
         <?php
            $mulai = strtotime($d->mulai); //waktu mulai
            $akhir = strtotime($d->akhir); //waktu akhir
            $diff  = $akhir - $mulai;
            $jam   = floor($diff/(60*60));
            $menit = $diff-$jam*(60*60);
            echo $jam.":".floor($menit/60);
            ?>
          </div></td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</body>
</html>