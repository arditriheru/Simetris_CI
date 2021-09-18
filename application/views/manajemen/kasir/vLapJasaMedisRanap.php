<body>

    <div id="wrapper">

        <div id="page-wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <h1><?php echo $title ?> <small><?php echo $subtitle ?></small></h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url('booking/dataBooking') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li class="active"><i class="fa fa-plus"></i> <?php echo $title ?></li>
                    </ol>
                </div>
            </div><!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <?php $this->load->view('templates/welcome') ?>
                    <?php echo $this->session->flashdata('alert') ?>
                </div>
            </div><!-- /.row -->

            <div class="row">
                <div class="col-lg-3">
                    <form method="post" action="<?php echo base_url('manajemen/dataJasaMedis/dataTampilJmDokterRanap') ?>" role="form">
                        <div class="form-group">
                            <label>Nama Operator</label>
                            <select class="form-control" type="text" name="id_operator" required="">
                                <option value="">Pilih</option>
                                <?php foreach ($dataoperator as $d) : ?>
                                    <option value="<?php echo $d->id_operator ?>"><?php echo $d->nama_operator; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Dari Tanggal</label>
                        <input class="form-control" type="date" name="awal">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Sampai Tanggal</label>
                        <input class="form-control" type="date" name="akhir">
                    </div>
                </div>
                <div class="col-lg-3"><br>
                    <button type="submit" class="btn btn-success">Tampilkan</button>
                    </form>
                </div>
            </div>

            <?php if (isset($data)) { ?>

                <div class="row">
                    <div class="col-lg-12">
                        <a href="<?php echo base_url('manajemen/dataJasaMedis/dataExportJmDokterRanap/') . $data; ?>"><button type="button" class="btn btn-primary"><i class="fa fa-download"></i> Export</button></a><br><br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped tablesorter">
                                <thead>
                                    <tr>
                                        <th class="text-center" colspan="10">
                                            <?php echo $nama_dokter; ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Tgl Pulang</th>
                                        <th class="text-center">No. RM</th>
                                        <th class="text-center">Nama Pasien</th>
                                        <th class="text-center">Kelas</th>
                                        <th class="text-center">Tindakan</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Diskon</th>
                                        <th class="text-center">Jasa Medis</th>
                                        <th class="text-center">Keterangan</th>
                                    </tr>
                                </thead>

                                <?php if ($data1 > 0) { ?>

                                    <tbody>
                                        <tr>
                                            <td colspan="10">Jasa Operator</td>
                                        </tr>
                                        <?php $no = 1;
                                        $subtotal = 0;
                                        $grandtotal = 0;
                                        foreach ($operator as $d) :
                                            $subtotal = $d->operator - $d->diskon;
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
                                                <td class="text-right"><?php echo number_format($subtotal); ?></td>
                                                <td class="text-center"><?php echo $d->nama_asuransi; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td class="text-center" colspan="8"><b>TOTAL</b></td>
                                            <td class="text-right"><b>Rp <?php echo number_format($grandtotal); ?></b></td>
                                        </tr>
                                    </tbody>

                                <?php }
                                if ($data2 > 0) { ?>

                                    <tbody>
                                        <tr>
                                            <td colspan="10">Jasa Anestesi</td>
                                        </tr>
                                        <?php $no = 1;
                                        $subtotal = 0;
                                        $grandtotal = 0;
                                        foreach ($anestesi as $d) :
                                            $subtotal = $d->anestesi - $d->diskon;
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
                                                <td class="text-right"><?php echo number_format($subtotal); ?></td>
                                                <td class="text-center"><?php echo $d->nama_asuransi; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td class="text-center" colspan="8"><b>TOTAL</b></td>
                                            <td class="text-right"><b>Rp <?php echo number_format($grandtotal); ?></b></td>
                                        </tr>
                                    </tbody>

                                <?php }
                                if ($data3 > 0) { ?>

                                    <tbody>
                                        <tr>
                                            <td colspan="10">Jasa Spesialis Anak</td>
                                        </tr>
                                        <?php $no = 1;
                                        $subtotal = 0;
                                        $grandtotal = 0;
                                        foreach ($sp_anak as $d) :
                                            $subtotal = $d->sp_anak - $d->diskon;
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
                                                <td class="text-right"><?php echo number_format($subtotal); ?></td>
                                                <td class="text-center"><?php echo $d->nama_asuransi; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td class="text-center" colspan="8"><b>TOTAL</b></td>
                                            <td class="text-right"><b>Rp <?php echo number_format($grandtotal); ?></b></td>
                                        </tr>
                                    </tbody>

                                <?php } ?>

                            </table>

                        </div>
                    </div>
                </div><!-- /.row -->

            <?php } ?>

        </div><!-- /#page-wrapper -->

        <!--</div> /#wrapper -->