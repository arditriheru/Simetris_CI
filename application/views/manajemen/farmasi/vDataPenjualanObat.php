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
                    <form method="get" action="<?php echo base_url('manajemen/dataFarmasi/dataPenjualanObat') ?>" role="form">
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
                            <label>Kelompok Obat</label>
                            <select class="form-control" type="text" name="id_far_kel" required="">
                            <option value="">Pilih</option>
                            <?php foreach ($kelobat as $d) : ?>
                                <option value="<?php echo $d->id_far_kel; ?>"><?php echo $d->nama ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        </div>
                        <div class="col-lg-4"><br>
                            <button type="submit" class="btn btn-success">Tampilkan</button>
                        </div>
                    </form>
                </div>

            </div><!-- /.row -->

            <?php if (isset($datapenjualan)) { ?>

                <div class="row">
                    <div class="col-lg-12"><br>
                        <a href="<?php echo base_url('manajemen/dataFarmasi/exportDataPenjualanObat/' . $this->input->get('tgl_awal') . '/' . $this->input->get('tgl_akhir') . '?id_far_kel=' . $this->input->get('id_far_kel')) ?>" type="button" name="print" class="btn btn-primary"><i class="fa fa-excels"></i> Excel</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped tablesorter">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Kode</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Jenis</th>
                                        <th class="text-center">Kel</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Subtotal</th>
                                        <th class="text-center">Tgl</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($datapenjualan as $d) : ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no++; ?></td>
                                            <td class="text-center"><?php echo $d->id_far_trn; ?></td>
                                            <td class="text-left"><?php echo $d->nama_obat; ?></td>
                                            <td class="text-center"><?php echo $d->jenis; ?></td>
                                            <td class="text-center"><?php echo $d->kelompok_obat; ?></td>
                                            <td class="text-center"><?php echo $d->qty; ?></td>
                                            <td class="text-right"><?php echo number_format($d->subtotal); ?></td>
                                            <td class="text-center"><?php echo date('d/m/Y', strtotime($d->tgl_penjualan)); ?></td>
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