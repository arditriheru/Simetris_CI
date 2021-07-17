<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekap Jasa Medis " . date('d/m/Y') . ".xls");
?>
<!DOCTYPE html>
<html>

<body>
    <table border="1" class="table table-bordered table-hover table-striped tablesorter">
        <h4 align="center">Rekap Jasa Medis</h4>
        <h4 align="center"><?php echo $nama_dokter; ?></h4>
        <h4 align="center">Periode <?php echo $awal . " - " . $akhir ?></h4><br>

        <?php if ($id == 1) { ?>
            <thead>
                <th>
                    <div align="center">No</div>
                </th>
                <th>
                    <div align="center">Tanggal</div>
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
                <?php
                $no = 1;
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
                            <div align="center"><?php echo formatDateIndo($d->tanggal); ?></div>
                        </td>
                        <td>
                            <div align="left"><?php echo $d->nama_tarif; ?></div>
                        </td>
                        <td>
                            <div align="left"><?php echo $d->jml_pasien; ?></div>
                        </td>
                        <td>
                            <div align="right"><?php echo number_format($d->jml_diskon); ?></div>
                        </td>
                        <td>
                            <div align="right"><?php echo number_format($subtotal); ?></div>
                        </td>
                    </tr>
                <?php endforeach ?>
                <tr>
                    <td class="text-center" colspan="5"><b>TOTAL</b></td>
                    <td class="text-right"><?php echo number_format($grandtotal); ?></td>
                </tr>
            </tbody>
        <?php } else { ?>

            <thead>
                <th>
                    <div align="center">No</div>
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
                    <div align="center">Kelas</div>
                </th>
                <th>
                    <div align="center">Tindakan</div>
                </th>
                <th>
                    <div align="center">Qty</div>
                </th>
                <th>
                    <div align="center">Diskon</div>
                </th>
                <th>
                    <div align="center">Jasa Medis</div>
                </th>
                <th>
                    <div align="center">Keterangan</div>
                </th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                $subtotal = 0;
                $grandtotal = 0;
                foreach ($jasamedis as $d) :
                    $subtotal = ($d->operator * $d->jumlah) - $d->diskon;
                    $grandtotal += $subtotal;
                ?>
                    <tr>
                        <td>
                            <div align="center"><?php echo $no++; ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo formatDateIndo($d->tanggal); ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo $d->id_catatan_medik; ?></div>
                        </td>
                        <td>
                            <div align="left"><?php echo ucwords(strtolower($d->nama_pasien)); ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo $d->kelas; ?></div>
                        </td>
                        <td>
                            <div align="left"><?php echo $d->nama_tarif; ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo $d->jumlah; ?></div>
                        </td>
                        <td>
                            <div align="right"><?php echo number_format($d->diskon); ?></div>
                        </td>
                        <td>
                            <div align="right"><?php echo number_format($subtotal); ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo $d->nama_asuransi; ?></div>
                        </td>
                    </tr>
                <?php endforeach ?>
                <tr>
                    <td class="text-center" colspan="8"><b>TOTAL</b></td>
                    <td class="text-right" colspan="1"><?php echo number_format($grandtotal); ?></td>
                </tr>
            </tbody>
        <?php } ?>


    </table>
</body>

</html>