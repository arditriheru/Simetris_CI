<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan-pasien-rapidtest ".date('d/m/Y').".xls");
?>
<!DOCTYPE html>
<html>
<body>
  <table border="1" class="table table-bordered table-hover table-striped tablesorter">
    <thead>
      <h2 align="center">Rekap Data</h2>
      <h2 align="center">Pasien Test Antibody</h2>
      <h3 align="center">Periode <?php echo $awal." - ".$akhir ?>: </h3>
      <tr>
        <th><div align="center">No</div></th>
        <th><div align="center">Tanggal</div></th>
        <th><div align="center">No.RM</div></th>
        <th><div align="center">Nama Pasien</div></th>
        <th><div align="center">Unit</div></th>
        <th><div align="center">IgM</div></th>
        <th><div align="center">IgG</div></th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; foreach ($antibody as $d) : ?>
      <tr>
        <td><div align="center"><?php echo $no++; ?></div></td>
        <td><div align="center"><?php echo $d->tanggal; ?></div></td>
        <td><div align="center"><?php echo $d->id_catatan_medik; ?></div></td>
        <td><div align="center"><?php echo $d->nama; ?></div></td>
        <td><div align="center"><?php echo $d->nama_unit; ?></div></td>
        <td><div align="center"><?php echo $d->hasil_igg; ?></div></td>
        <td><div align="center"><?php echo $d->hasil_igm; ?></div></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>
</body>
</html>