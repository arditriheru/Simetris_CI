<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekap Jasa Medis " . date('d/m/Y') . ".xls");
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
                <div align="center">No.Register</div>
            </th>
            <th>
                <div align="center">Tanggal</div>
            </th>
            <th>
                <div align="center">No.Rekam Medik</div>
            </th>
            <th>
                <div align="center">Nama Pasien</div>
            </th>
            <th>
                <div align="center">Obat</div>
            </th>
            <th>
                <div align="center">Qty</div>
            </th>
            <th>
                <div align="center">Harga Satuan</div>
            </th>
            <th>
                <div align="center">Subtotal</div>
            </th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($dataPemakaianObat as $d) : ?>
                <tr>
                    <td>
                        <div align="center"><?php echo $no++; ?></div>
                    </td>
                    <td>
                        <div align="center"><?php echo $d->id_register; ?></div>
                    </td>
                    <td>
                        <div align="center"><?php echo $d->tanggal; ?></div>
                    </td>
                    <td>
                        <div align="left"><?php echo $d->id_catatan_medik; ?></div>
                    </td>
                    <td>
                        <div align="left"><?php echo $d->nama; ?></div>
                    </td>
                    <td>
                        <div align="left"><?php echo $d->nama_obat; ?></div>
                    </td>
                    <td>
                        <div align="left"><?php echo $d->qty; ?></div>
                    </td>
                    <td>
                        <div align="right"><?php echo $d->harga_satuan; ?></div>
                    </td>
                    <td>
                        <div align="right"><?php echo $d->subtotal; ?></div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>

    </table>
</body>

</html>