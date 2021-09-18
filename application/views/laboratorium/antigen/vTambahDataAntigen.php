<body>

  <div id="wrapper">

    <div id="page-wrapper">

      <div class="row">
        <div class="col-lg-12">
          <h1><?php echo $title ?> <small> <?php echo $subtitle ?></small></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('laboratorium/dataRapidTest') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
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
        <div class="col-lg-4">
          <div class="panel panel-info">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-6">
                  <i class="fa fa-user fa-5x"></i>
                </div>
                <div class="col-xs-6 text-right">
                  <p class="announcement-heading"><?php echo $total ?></p>
                  <p class="announcement-text">Total Pasien</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="panel panel-success">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-6">
                  <i class="fa fa-check fa-5x"></i>
                </div>
                <div class="col-xs-6 text-right">
                  <p class="announcement-heading"><?php echo $negatif ?></p>
                  <p class="announcement-text">Negatif</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="panel panel-danger">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-6">
                  <i class="fa fa-warning fa-5x"></i>
                </div>
                <div class="col-xs-6 text-right">
                  <p class="announcement-heading"><?php echo $positif ?></p>
                  <p class="announcement-text">Positif</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.row -->

      <div class="row">
        <div class="col-lg-4">
          <ul class="nav nav-pills" style="margin-bottom: 15px;">
            <li class="active"><a href="#1" data-toggle="tab">Pasien Lama</a></li>
            <li><a href="#2" data-toggle="tab">Pasien Baru</a></li>
          </ul>

          <div id="myTabContent" class="tab-content">

            <div class="tab-pane fade active in" id="1">
              <div class="table-responsive">
                <form method="post" action="<?php echo base_url('laboratorium/dataAntigen/tambahDataAksi') ?>" role="form">
                  <div class="form-group">
                    <label>Nomor Rekam Medik</label>
                    <input class="form-control" type="text" name="id_catatan_medik" onkeyup="autofill()" id="id_catatan_medik" placeholder="Masukkan Nomor Rekam Medik" required="">
                  </div>
                  <div class="form-group">
                    <label>Nama Pasien</label>
                    <input class="form-control" type="text" name="nama" id="nama" placeholder="Nama Pasien (otomatis)" readonly="">
                  </div>
                  <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input class="form-control" type="text" name="tgl_lahir" id="tgl_lahir" placeholder="Tanggal Lahir (otomatis)" readonly="">
                  </div>
                  <div class="form-group">
                    <label>Gender</label>
                    <input class="form-control" type="hidden" name="id_sex" id="sex">
                    <input class="form-control" type="text" id="nama_sex" placeholder="Gender (otomatis)" readonly="">
                  </div>
                  <div class="form-group">
                    <label>Dokter Pengirim</label>
                    <select class="form-control" type="text" name="id_dokter" required="">
                      <option value="">Pilih</option>
                      <?php foreach ($datadokter as $d) : ?>
                        <option value="<?php echo $d->id_dokter ?>"><?php echo $d->nama_dokter ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <button type="submit" name="submit" class="btn btn-success">Tambah</button>
                </form>
              </div>
            </div>

            <div class="tab-pane fade in" id="2">
              <div class="table-responsive">

                <?php foreach ($datapasien as $d) : ?>

                  <form method="post" action="<?php echo base_url('laboratorium/dataAntigen/tambahDataAksi') ?>" role="form">
                    <div class="form-group">
                      <label>Nomor Rekam Medik</label>
                      <input class="form-control" type="text" name="id_catatan_medik" value="<?php echo $d->id_catatan_medik; ?>" readonly="">
                    </div>
                    <div class="form-group">
                      <label>Nama Pasien</label>
                      <input class="form-control" type="text" name="nama" value="<?php echo $d->nama; ?>" required="">
                    </div>
                    <div class="form-group">
                      <label>Tanggal Lahir</label>
                      <input class="form-control" type="date" name="tgl_lahir" value="<?php echo $d->tgl_lahir; ?>" required="">
                    </div>
                    <div class="form-group">
                      <label>Gender</label>
                      <select class="form-control" type="text" name="id_sex" required="">
                        <option value="<?php echo $d->sex; ?>"><?php echo $d->nama_sex; ?></option>
                        <?php foreach ($datasex as $d) : ?>
                          <option value="<?php echo $d->id_sex ?>"><?php echo $d->nama_sex ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Dokter Pengirim</label>
                      <select class="form-control" type="text" name="id_dokter" required="">
                        <option value="">Pilih</option>
                        <?php foreach ($datadokter as $d) : ?>
                          <option value="<?php echo $d->id_dokter ?>"><?php echo $d->nama_dokter ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success">Tambah</button>
                  </form>

                <?php endforeach; ?>

              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-8">
          <?php if ($this->session->userdata('laboratorium_akses') == 'Operator') { ?>

            <button name="next" type="submit" class="btn btn-primary" onClick="window.location.reload()"><i class="fa fa-refresh"></i> Refresh</button><br><br>

          <?php } ?>
          <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped tablesorter">
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">No.RM</th>
                  <th class="text-center">Nama Pasien</th>
                  <th class="text-center">Dokter</th>
                  <th class="text-center">Hasil</th>
                  <?php if ($this->session->userdata('laboratorium_akses') == 'Admin') { ?>
                    <th class="text-center" colspan="3">Action</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php $no = $totaldata;
                foreach ($antigen as $d) : ?>
                  <tr>
                    <td class="text-center"><?php echo $no--; ?></td>
                    <td class="text-center"><?php echo $d->id_catatan_medik; ?></td>

                    <?php if ($d->id_catatan_medik == 10000000) { ?>
                      <td class="text-center"><?php echo $d->test_antigen_nama; ?></td>
                    <?php } else { ?>
                      <td class="text-center"><?php echo $d->mr_pasien_nama; ?></td>
                    <?php } ?>

                    <td class="text-center"><?php echo $d->nama_dokter; ?></td>
                    <?php
                    if ($d->hasil == 1) {
                      echo '<td class="text-center link-danger"><p class="text-danger">' . $d->nama_hasil . '</p></td>';
                    } else {
                      echo '<td class="text-center">' . $d->nama_hasil . '</td>';
                    }
                    ?>
                    <?php if ($this->session->userdata('laboratorium_akses') == 'Admin') { ?>
                      <td class="text-center">
                        <a href="<?php echo base_url('laboratorium/dataAntigen/printData/' . $d->id_test_antigen) ?>" target="_blank"><button type="button" class="btn btn-primary"><i class='fa fa-print'></i></button></a>
                      </td>
                      <td class="text-center">
                        <a href="<?php echo base_url('laboratorium/dataAntigen/updateData/' . $d->id_test_antigen) ?>"><button type="button" class="btn btn-warning"><i class='fa fa-edit'></i></button></a>
                      </td>
                    <?php } ?>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div><!-- /.row -->

    </div><!-- /#page-wrapper -->

    <!--</div> /#wrapper -->

    <script>
      function autofill() {
        var id_catatan_medik = document.getElementById('id_catatan_medik').value;
        $.ajax({
          url: "<?php echo base_url('laboratorium/dataAntigen/cari'); ?>",
          data: '&id_catatan_medik=' + id_catatan_medik,
          success: function(data) {
            var hasil = JSON.parse(data);

            $.each(hasil, function(key, val) {

              document.getElementById('id_catatan_medik').value = val.id_catatan_medik;
              document.getElementById('nama').value = val.nama;
              document.getElementById('tgl_lahir').value = val.tgl_lahir;
              document.getElementById('nama_sex').value = val.nama_sex;
              document.getElementById('sex').value = val.sex;

            });
          }
        });
      }
    </script>