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
      <h2 align="center">Pasien Test Antigen</h2>
      <h3 align="center">Periode <?php echo $awal." - ".$akhir ?>: </h3>
      <tr>
        <th><div align="center">#</div></th>
        <th><div align="center">Tgl. Pemeriksaan</div></th>
        <th><div align="center">Nomor RM</div></th>
        <th><div align="center">Nama Pasien</div></th>
        <th><div align="center">Hasil</div></th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; foreach ($antigen as $d) : ?>
      <tr>
        <td><div align="center"><?php echo $no++; ?></div></td>
        <td><div align="center"><?php echo formatDateIndo($d->tgl_periksa)." / ".$d->jam;
        ?></div></td>
        <td><div align="center"><?php echo $d->id_catatan_medik; ?></div></td>
        <td><div align="center"><?php echo $d->nama_pasien2; ?></div></td>
        <td><div align="center"><?php echo $d->nama_hasil; ?></div></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>
</body>
</html>