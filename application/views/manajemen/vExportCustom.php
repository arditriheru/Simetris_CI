<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Export Custom " . date('d/m/Y') . ".xls");
?>
<!DOCTYPE html>
<html>

<body>
  <table border="1" class="table table-bordered table-hover table-striped tablesorter">
    <thead>
      <h2 align="center">Rekap Data</h2>
      <h4 align="center">Pasien Rawat Jalan Tahun 2021</h4>
      <tr>
        <th>
          <div align="center">#</div>
        </th>
        <th>
          <div align="center">RM</div>
        </th>
        <th>
          <div align="center">Nama</div>
        </th>
        <th>
          <div align="center">Kontak</div>
        </th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1;
      foreach ($data as $d) : ?>
        <tr>
          <td>
            <div align="center"><?php echo $no++; ?></div>
          </td>
          <td>
            <div align="center"><?php echo $d->id_catatan_medik; ?></div>
          </td>
          <td>
            <div align="center"><?php echo ucwords(strtolower($d->nama)); ?></div>
          </td>
          <td>
            <div align="center"><?php echo $d->telp; ?></div>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</body>

</html>