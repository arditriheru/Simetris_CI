<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekap Jasa Medis Rawat Jalan " . date('d/m/Y') . ".xls");
?>
<!DOCTYPE html>
<html>

<body>
    <table border="1" class="table table-bordered table-hover table-striped tablesorter">
        <h4 align="center"><?php echo $title; ?></h4>
        <h4 align="center"><?php echo $nama_dokter; ?></h4>
        <h4 align="center">Periode <?php echo formatDateIndo($awal) . " - " . formatDateIndo($akhir); ?></h4><br>

            <thead>
                <th>
                    <div align="center">No</div>
                </th>
                <th>
                    <div align="center">Tgl Pulang</div>
                </th>
                <th>
                    <div align="center">Tindakan</div>
                </th>
                <th>
                    <div align="center">Jml Pasien</div>
                </th>
                <th>
                    <div align="center">Diskon</div>
                </th>
                <th>
                    <div align="center">Jasa Medis</div>
                </th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1;
                $grandtotal = 0;
                foreach ($jasamedis as $d) :
                    $subtotal =  ($d->operator * $d->jml_pasien) - $d->jml_diskon;
                    $grandtotal += $subtotal;
            ?>
                    <tr>
                        <td>
                            <div align="center"><?php echo $no++; ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo formatDateIndo($d->tgl_pulang); ?></div>
                        </td>
                        <td>
                            <div align="left"><?php echo $d->nama_tarif; ?></div>
                        </td>
                        <td>
                            <div align="left"><?php echo $d->jml_pasien; ?></div>
                        </td>
                        <td>
                            <div align="right"><?php echo $d->jml_diskon; ?></div>
                        </td>
                        <td>
                            <div align="right"><?php echo $subtotal; ?></div>
                        </td>
                    </tr>
                <?php endforeach ?>
                <tr>
                    <td class="text-center" colspan="5"><b>TOTAL</b></td>
                    <td class="text-right"><?php echo $grandtotal; ?></td>
                </tr>
            </tbody>
    </table>
</body>

</html>