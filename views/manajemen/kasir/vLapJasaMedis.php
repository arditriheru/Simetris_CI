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
                    <form method="post" action="<?php echo base_url('manajemen/dataJasaMedis/dataTampil/') . $id ?>" role="form">
                        <div class="form-group">
                            <label>Nama Operator</label>
                            <select class="form-control" type="text" name="id_operator" required="">
                                <option value="">Pilih</option>
                                <?php foreach ($dataoperator as $d) : ?>
                                    <option value="<?php echo $d->id_dokter ?>"><?php echo $d->nama_dokter ?></option>
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

            <?php if (isset($post)) { ?>

                <div class="row">
                    <div class="col-lg-12">
                        <a href="<?php echo base_url('manajemen/dataJasaMedis/dataExport/') . $id . '/' . $data; ?>"><button type="button" class="btn btn-primary">Export</button></a><br><br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped tablesorter">
                                <thead>
                                    <tr>
                                        <th class="text-center" colspan="5">
                                            Operator <?php echo $nama_dokter; ?>
                                        </th>
                                        <th class="text-center" colspan="3">
                                            Total Jasa Medis Rp <?php echo number_format($total); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Asuransi</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">No.RM</th>
                                        <th class="text-center">Nama Pasien</th>
                                        <th class="text-center">Kls</th>
                                        <th class="text-center">Tindakan</th>
                                        <th class="text-center">Jasa Medis</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($jasamedis as $d) : ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no++; ?></td>
                                            <td class="text-center"><?php echo $d->nama_asuransi; ?></td>
                                            <td class="text-center"><?php echo formatDateIndo($d->tanggal); ?></td>
                                            <td class="text-center"><?php echo $d->id_catatan_medik; ?></td>
                                            <td class="text-center"><?php echo $d->nama_pasien; ?></td>
                                            <td class="text-center"><?php echo $d->kelas; ?></td>
                                            <td class="text-center"><?php echo $d->nama_tarif; ?></td>
                                            <td class="text-center"><?php echo number_format($d->jasa_operator); ?></td>
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