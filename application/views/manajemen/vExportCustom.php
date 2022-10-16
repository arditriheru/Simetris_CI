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
      <h4 align="center">Tarif Laborat</h4>
      <tr>
        <th><div align="center">#</div></th>
        <th><div align="center">id_catatan_medik</div></th>
        <th><div align="center">nama</div></th>
        <th><div align="center">kelamin</div></th>
        <th><div align="center">tempat</div></th>
        <th><div align="center">tgl_lahir</div></th>
        <th><div align="center">alamat</div></th>
        <th><div align="center">telp</div></th>
        <th><div align="center">nama_ortu</div></th>
        <th><div align="center">alamat_ortu</div></th>
        <th><div align="center">nama_desa</div></th>
        <th><div align="center">nama_kecamatan</div></th>
        <th><div align="center">nama_kabupaten</div></th>
        <th><div align="center">nam_propinsi</div></th>
        <th><div align="center">pendidikan</div></th>
        <th><div align="center">pekerjaan</div></th>
        <th><div align="center">nama_keluarga</div></th>
        <th><div align="center">nama_menikah</div></th>
        <th><div align="center">nama_agama</div></th>
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
            <div align="center"><?php echo $d->nama; ?></div>
          </td>
          <td>
            <div align="center"><?php echo $d->kelamin; ?></div>
          </td>
          <td>
            <div align="center"><?php echo $d->tempat; ?></div>
          </td>
          <td>
            <div align="center"><?php echo $d->tgl_lahir; ?></div>
          </td>
          <td>
            <div align="center"><?php echo $d->alamat; ?></div>
          </td>
          <td>
            <div align="center"><?php echo $d->telp; ?></div>
          </td>
          <td>
            <div align="center"><?php echo $d->nama_ortu; ?></div>
          </td>
          <td>
            <div align="center"><?php echo $d->alamat_ortu; ?></div>
          </td>
          <td>
            <div align="center"><?php echo $d->nama_desa; ?></div>
          </td>
          <td>
            <div align="center"><?php echo $d->nama_kecamatan; ?></div>
          </td>
          <td>
            <div align="center"><?php echo $d->nama_kabupaten; ?></div>
          </td>
          <td>
            <div align="center"><?php echo $d->nama_propinsi; ?></div>
          </td>
          <td>
            <div align="center"><?php echo $d->pendidikan; ?></div>
          </td>
          <td>
            <div align="center"><?php echo $d->pekerjaan; ?></div>
          </td>
          <td>
            <div align="center"><?php echo $d->nama_keluarga; ?></div>
          </td>
          <td>
            <div align="center"><?php echo $d->nama_menikah; ?></div>
          </td>
          <td>
            <div align="center"><?php echo $d->nama_keluarga; ?></div>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</body>

</html>