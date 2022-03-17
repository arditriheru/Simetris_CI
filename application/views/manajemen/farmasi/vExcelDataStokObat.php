<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekap Data Stok Obat " . date('d/m/Y') . ".xls");
?>
<!DOCTYPE html>
<html>

<body>
    <table border="1" class="table table-bordered table-hover table-striped tablesorter">
        <h4 align="center">Rekap Data</h4>
        <h4 align="center"><?php echo $title; ?></h4>
        <h4 align="center">Periode <?php echo formatDateIndo($tgl_awal) . " - " . formatDateIndo($tgl_akhir); ?></h4><br>

        <thead>
            <th>
                <div align="center">No</div>
            </th>
            <th>
                <div align="center">Nama</div>
            </th>
            <th>
                <div align="center">Jenis</div>
            </th>
            <th>
                <div align="center">HPP</div>
            </th>
            <th>
                <div align="center">Hrg Beli</div>
            </th>
            <th>
                <div align="center">Hrg Jual</div>
            </th>
            <th>
                <div align="center">Stok Inap</div>
            </th>
            <th>
                <div align="center">Stok Poli</div>
            </th>
            <th>
                <div align="center">Update</div>
            </th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($datastokobat as $d) : ?>
                <tr>
                    <td>
                        <div align="center"><?php echo $no++; ?></div>
                    </td>
                    <td>
                        <div align="left"><?php echo $d->nama_obat; ?></div>
                    </td>
                    <td>
                        <div align="center"><?php echo $d->jenis; ?></div>
                    </td>
                    <td>
                        <div align="right"><?php echo number_format($d->harga_pokok); ?></div>
                    </td>
                    <td>
                        <div align="right"><?php echo number_format($d->harga_beli); ?></div>
                    </td>
                    <td>
                        <div align="right"><?php echo number_format($d->harga_jual); ?></div>
                    </td>
                    <td>
                        <div align="center"><?php echo $d->stok_inap; ?></div>
                    </td>
                    <td>
                        <div align="center"><?php echo $d->stok_poli; ?></div>
                    </td>
                    <td>
                        <div align="center"><?php echo date('d/m/Y', strtotime($d->tanggal)); ?></div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>

    </table>
</body>

</html>