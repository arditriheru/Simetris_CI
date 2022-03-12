<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekap Data Penjualan Obat " . date('d/m/Y') . ".xls");
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
                <div align="center">Kode</div>
            </th>
            <th>
                <div align="center">Nama</div>
            </th>
            <th>
                <div align="center">Jenis</div>
            </th>
            <th>
                <div align="center">Kel</div>
            </th>
            <th>
                <div align="center">Qty</div>
            </th>
            <th>
                <div align="center">Subtotal</div>
            </th>
            <th>
                <div align="center">Tanggal</div>
            </th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($datapenjualan as $d) : ?>
                <tr>
                    <td>
                        <div align="center"><?php echo $no++; ?></div>
                    </td>
                    <td>
                        <div align="center"><?php echo $d->id_far_trn; ?></div>
                    </td>
                    <td>
                        <div align="center"><?php echo $d->nama_obat; ?></div>
                    </td>
                    <td>
                        <div align="left"><?php echo $d->jenis; ?></div>
                    </td>
                    <td>
                        <div align="left"><?php echo $d->kelompok_obat; ?></div>
                    </td>
                    <td>
                        <div align="left"><?php echo $d->qty; ?></div>
                    </td>
                    <td>
                        <div align="left"><?php echo number_format($d->subtotal); ?></div>
                    </td>
                    <td>
                        <div align="right"><?php echo date('d/m/Y', strtotime($d->tgl_penjualan)); ?></div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>

    </table>
</body>

</html>