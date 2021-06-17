<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan-pasien-rapidtest " . date('d/m/Y') . ".xls");
?>
<!DOCTYPE html>
<html>

<body>
    <table border="1" class="table table-bordered table-hover table-striped tablesorter">
        <h4 align="center">Rekap Jasa Medis</h4>
        <h4 align="center"><?php echo $nama_dokter; ?></h4>
        <h4 align="center">Periode <?php echo $awal . " - " . $akhir ?>: </h4><br>
        <thead>
            <th>
                <div align="center">No</div>
            </th>
            <th>
                <div align="center">Asuransi</div>
            </th>
            <th>
                <div align="center">Tanggal</div>
            </th>
            <th>
                <div align="center">No.RM</div>
            </th>
            <th>
                <div align="center">Nama Pasien</div>
            </th>
            <th>
                <div align="center">Kls</div>
            </th>
            <th>
                <div align="center">Tindakan</div>
            </th>
            <th>
                <div align="center">Jasa Medis</div>
            </th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($jasamedis as $d) : ?>
                <tr>
                    <td>
                        <div align="center"><?php echo $no++; ?></div>
                    </td>
                    <td>
                        <div align="center"><?php echo $d->nama_asuransi; ?></div>
                    </td>
                    <td>
                        <div align="center"><?php echo formatDateIndo($d->tanggal); ?></div>
                    </td>
                    <td>
                        <div align="center"><?php echo $d->id_catatan_medik; ?></div>
                    </td>
                    <td>
                        <div align="left"><?php echo $d->nama_pasien; ?></div>
                    </td>
                    <td>
                        <div align="center"><?php echo $d->kelas; ?></div>
                    </td>
                    <td>
                        <div align="center"><?php echo $d->nama_tarif; ?></div>
                    </td>
                    <td>
                        <div align="right"><?php echo number_format($d->jasa_operator); ?></div>
                    </td>
                </tr>
            <?php endforeach ?>
            <tr>
                <td class="text-center" colspan="7"><b>TOTAL</b></td>
                <td class="text-right" colspan="1"><?php echo number_format($total); ?></td>
            </tr>
        </tbody>
    </table>
</body>

</html>