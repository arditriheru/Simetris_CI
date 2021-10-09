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
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <?php $this->load->view('templates/welcome') ?>
                    <?php echo $this->session->flashdata('alert') ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <form method="post" action="<?php echo base_url('manajemen/dataFarmasi/dataPemakaianObat/2') ?>" role="form">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Dari tanggal</label>
                                <input class="form-control" type="date" name="tgl_awal" required="">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Sampai Tanggal</label>
                                <input class="form-control" type="date" name="tgl_akhir" required="">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>No.Rekam Medik</label>
                                <input class="form-control" type="text" name="id_catatan_medik">
                                <p class="text-red">Isi jika ingin menampilkan data per pasien</p>
                            </div>
                        </div>
                        <div class="col-lg-4"><br>
                            <button type="submit" class="btn btn-success">Tampilkan</button>
                        </div>
                    </form>
                </div>

            </div><!-- /.row -->

            <?php if (isset($dataPemakaianObat)) { ?>

                <div class="row">
                    <div class="col-lg-12"><br>
                        <a href="<?php echo base_url('manajemen/dataFarmasi/exportDataPemakaianObat/' . $tgl_awal . '/' . $tgl_akhir . '?rm=' . $id_catatan_medik) ?>" type="button" name="print" class="btn btn-primary"><i class="fa fa-excels"></i> Excel</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped tablesorter">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">No.Register</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Nomor RM</th>
                                        <th class="text-center">Nama Pasien</th>
                                        <th class="text-center">Obat</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Hrg Satuan</th>
                                        <th class="text-center">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($dataPemakaianObat as $d) : ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no++; ?></td>
                                            <td class="text-center"><?php echo $d->id_register; ?></td>
                                            <td class="text-center"><?php echo date('d-m-Y', strtotime($d->tanggal)); ?></td>
                                            <td class="text-left"><?php echo $d->id_catatan_medik; ?></td>
                                            <td class="text-center"><?php echo $d->nama; ?></td>
                                            <td class="text-center"><?php echo $d->nama_obat; ?></td>
                                            <td class="text-center"><?php echo $d->qty; ?></td>
                                            <td class="text-right"><?php echo $d->harga_satuan; ?></td>
                                            <td class="text-right"><?php echo $d->subtotal; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- /.row -->

            <?php } ?>

        </div><!-- /#page-wrapper -->

        <!--</div> /#wrapper -->