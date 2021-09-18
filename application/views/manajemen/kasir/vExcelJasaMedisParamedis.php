<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekap Jasa Medis Rawat Inap " . date('d/m/Y') . ".xls");
?>
<!DOCTYPE html>
<html>

<body>
    <table border="1" class="table table-bordered table-hover table-striped tablesorter">
        <h4 align="center"><?php echo $title; ?></h4>
        <h4 align="center"><?php echo $nama_operator; ?></h4>
        <h4 align="center">Periode <?php echo $awal . " - " . $akhir ?></h4><br>

            <thead>
                <th>
                    <div align="center">No</div>
                </th>
                <th>
                    <div align="center">Tgl Pulang</div>
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
            <?php if ($data1 > 0) { ?>

<tbody>
    <tr>
        <td colspan="10">Jasa Asisten 1</td>
    </tr>
    <?php $no = 1;
    $subtotal = 0;
    $grandtotal = 0;
    foreach ($ass1 as $d) :
        $subtotal = $d->ass_1 - $d->diskon;
        $grandtotal += $subtotal;
    ?>
        <tr>
            <td class="text-center"><?php echo $no++; ?></td>
            <td class="text-center"><?php echo formatDateIndo($d->tgl_pulang); ?></td>
            <td class="text-center"><?php echo $d->id_catatan_medik; ?></td>
            <td class="text-left"><?php echo ucwords(strtolower($d->nama_pasien)); ?></td>
            <td class="text-center"><?php echo $d->kelas; ?></td>
            <td class="text-left"><?php echo $d->nama_tarif; ?></td>
            <td class="text-center"><?php echo $d->jumlah; ?></td>
            <td class="text-center"><?php echo $d->diskon; ?></td>
            <td class="text-right"><?php echo $subtotal; ?></td>
            <td class="text-center"><?php echo $d->nama_asuransi; ?></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td class="text-center" colspan="8"><b>TOTAL</b></td>
        <td class="text-right"><b>Rp <?php echo $grandtotal; ?></b></td>
    </tr>
</tbody>

<?php }
if ($data2 > 0) { ?>

<tbody>
    <tr>
        <td colspan="10">Jasa Asisten 2</td>
    </tr>
    <?php $no = 1;
    $subtotal = 0;
    $grandtotal = 0;
    foreach ($ass2 as $d) :
        $subtotal = $d->ass_2 - $d->diskon;
        $grandtotal += $subtotal;
    ?>
        <tr>
            <td class="text-center"><?php echo $no++; ?></td>
            <td class="text-center"><?php echo formatDateIndo($d->tgl_pulang); ?></td>
            <td class="text-center"><?php echo $d->id_catatan_medik; ?></td>
            <td class="text-left"><?php echo ucwords(strtolower($d->nama_pasien)); ?></td>
            <td class="text-center"><?php echo $d->kelas; ?></td>
            <td class="text-left"><?php echo $d->nama_tarif; ?></td>
            <td class="text-center"><?php echo $d->jumlah; ?></td>
            <td class="text-center"><?php echo $d->diskon; ?></td>
            <td class="text-right"><?php echo $subtotal; ?></td>
            <td class="text-center"><?php echo $d->nama_asuransi; ?></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td class="text-center" colspan="8"><b>TOTAL</b></td>
        <td class="text-right"><b>Rp <?php echo $grandtotal; ?></b></td>
    </tr>
</tbody>

<?php }
if ($data3 > 0) { ?>

<tbody>
    <tr>
        <td colspan="10">Jasa Penata</td>
    </tr>
    <?php $no = 1;
    $subtotal = 0;
    $grandtotal = 0;
    foreach ($penata as $d) :
        $subtotal = $d->penata - $d->diskon;
        $grandtotal += $subtotal;
    ?>
        <tr>
            <td class="text-center"><?php echo $no++; ?></td>
            <td class="text-center"><?php echo formatDateIndo($d->tgl_pulang); ?></td>
            <td class="text-center"><?php echo $d->id_catatan_medik; ?></td>
            <td class="text-left"><?php echo ucwords(strtolower($d->nama_pasien)); ?></td>
            <td class="text-center"><?php echo $d->kelas; ?></td>
            <td class="text-left"><?php echo $d->nama_tarif; ?></td>
            <td class="text-center"><?php echo $d->jumlah; ?></td>
            <td class="text-center"><?php echo $d->diskon; ?></td>
            <td class="text-right"><?php echo $subtotal; ?></td>
            <td class="text-center"><?php echo $d->nama_asuransi; ?></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td class="text-center" colspan="8"><b>TOTAL</b></td>
        <td class="text-right"><b>Rp <?php echo $grandtotal; ?></b></td>
    </tr>
</tbody>

<?php }
if ($data4 > 0) { ?>

<tbody>
    <tr>
        <td colspan="10">Jasa On Loop</td>
    </tr>
    <?php $no = 1;
    $subtotal = 0;
    $grandtotal = 0;
    foreach ($onloop as $d) :
        $subtotal = $d->on_loop - $d->diskon;
        $grandtotal += $subtotal;
    ?>
        <tr>
            <td class="text-center"><?php echo $no++; ?></td>
            <td class="text-center"><?php echo formatDateIndo($d->tgl_pulang); ?></td>
            <td class="text-center"><?php echo $d->id_catatan_medik; ?></td>
            <td class="text-left"><?php echo ucwords(strtolower($d->nama_pasien)); ?></td>
            <td class="text-center"><?php echo $d->kelas; ?></td>
            <td class="text-left"><?php echo $d->nama_tarif; ?></td>
            <td class="text-center"><?php echo $d->jumlah; ?></td>
            <td class="text-center"><?php echo $d->diskon; ?></td>
            <td class="text-right"><?php echo $subtotal; ?></td>
            <td class="text-center"><?php echo $d->nama_asuransi; ?></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td class="text-center" colspan="8"><b>TOTAL</b></td>
        <td class="text-right"><b>Rp <?php echo $grandtotal; ?></b></td>
    </tr>
</tbody>

<?php } ?>

    </table>
</body>

</html>