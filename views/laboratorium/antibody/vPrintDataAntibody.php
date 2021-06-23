<body>

  <div class="container">
    <a class="noprint"><button class="btn btn-danger" type="button" onclick="windowClose();">Tutup</button></a>
    <div class="row">
      <div class="col-xs-12">
        <div align="center" class="invoice-title">
          <img class="img-responsive" src="<?php echo base_url('assets/images/Kop Surat Laboratorium.jpg') ?>" width="90%" alt="Kop Surat Laboratorium"><br>
          <u>HASIL PEMERIKSAAN LABORATORIUM</u>
        </div><br>

        <?php foreach ($antibody as $d) : ?>

          <div class="row">
            <div class="col-xs-6">
              <address>
                <p><strong>Nomor RM: </strong><?php echo $d->id_catatan_medik; ?><br>
                  <strong>Nama Pasien: </strong><?php echo $d->nama_pasien; ?><br>
                  <strong>Gender: </strong><?php echo $d->nama_sex; ?><br>
                  <strong>Tgl Lahir: </strong><?php echo formatDateIndo($d->tgl_lahir) . " (" . getAge($d->tgl_lahir) . ")"; ?>
                </p>
              </address>
            </div>
            <div class="col-xs-6 text-right">
              <address>
                <p><strong>Pengirim:</strong><br>
                  <?php echo $d->nama_dokter; ?><br><br>
                  <strong>Pemeriksaan:</strong><br>
                  <small><?php echo formatDateIndo($d->tgl_periksa) . ' / ' . $d->jam; ?></small>
                </p>
              </address>
            </div>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-condensed">
              <thead>
                <tr>
                  <td class="text-center">
                    <p><strong>Pemeriksaan</strong></p>
                  </td>
                  <td class="text-center">
                    <p><strong>Hasil</strong></p>
                  </td>
                  <td class="text-center">
                    <p><strong>Nilai Rujukan</strong></p>
                  </td>
                  <td class="text-center">
                    <p><strong>Metode</strong></p>
                  </td>
                  <td class="text-center">
                    <p><strong>Sampel</strong></p>
                  </td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="5">
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SARS CoV-2 Antibody</p>
                  </td>
                </tr>
                <tr>
                  <td class="text-center">
                    <p>(IgM)</p>
                  </td>
                  <td class="text-center">
                    <?php if ($d->igm == 0) {
                      echo "<p>" . ucwords($d->nama_igm) . "</p>";
                    } else {
                      echo "<p class='red-text'>" . ucwords($d->nama_igm) . "</p>";
                    } ?>
                  </td>
                  <td class="text-center">
                    <p>Non Reaktif</p>
                  </td>
                  <td class="text-center">
                    <p>ICT</p>
                  </td>
                  <td class="text-center">
                    <p>Darah</p>
                  </td>
                </tr>
                <tr>
                  <td class="text-center">
                    <p>(IgG)</p>
                  </td>
                  <td class="text-center">
                    <?php if ($d->igg == 0) {
                      echo "<p>" . ucwords($d->nama_igg) . "</p>";
                    } else {
                      echo "<p class='red-text'>" . ucwords($d->nama_igg) . "</p>";
                    } ?>
                  </td>
                  <td class="text-center">
                    <p>Non Reaktif</p>
                  </td>
                  <td class="text-center">
                    <p>ICT</p>
                  </td>
                  <td class="text-center">
                    <p>Darah</p>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="text-right">
          <p><small>Printed : <?php echo getdateindo() . " / " . gettimenow() ?></small></p>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <table class="table table-condensed">
          <tbody>
            <tr>
              <?php
              if ($d->igm == 1 || $d->igg == 1) { ?>
                <td>
                  <left>
                    <p>
                      <strong>Catatan :</strong><br>
                      1. Pemeriksaan Rapid ke 1<br>
                      2. Hasil Rapid Test Antibody Reaktif belum dapat memastikan adanya Infeksi SARS Cov-2<br>
                      3. Pemeriksaan Konfirmasi dengan pemeriksaan <b>RT PCR</b><br>
                      4. Lakukan karantina mandiri dengan menerapkan PHBS (Perilaku Hidup Bersih dan Sehat : Mencuci tangan, menerapkan etika batuk, menggunakan masker), dan menjaga Physical Distancing<br>
                      5. Bila muncul gejala atau gejala memberat selama isolasi segera menuju ke RS Rujukan Covid-19
                    </p>
                  </left>
                </td>
              <?php } else { ?>
                <td>
                  <left>
                    <p>
                      <strong>Catatan :</strong><br>
                      1. Pemeriksaan Rapid ke 1<br>
                      2. Hasil Non reaktif tidak menyingkirkan kemungkinan infeksi SARS CoV-2<br>
                      3. Hasil Non Reaktif dapat terjadi pada kondisi :<br>
                      &nbsp; &nbsp; - Seseorang belum / tidak terinfeksi<br>
                      &nbsp; &nbsp; - Window Period (Terinfeksi namun antibody belum terbentuk)<br>
                      &nbsp; &nbsp; - Immunocompromised<br>
                      4. Saran :<br>
                      &nbsp; &nbsp; - Ulangi pemeriksaan rapid test antibody 7-10 hari kemudian<br>
                      &nbsp; &nbsp; - Pertahankan perilaku hidup bersih dan physical distancing
                    </p>
                  </left>
                </td>
              <?php } ?>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <table class="table table-condensed">
          <tbody>
            <tr>
              <td class="text-right">
                <p><strong>Petugas,</strong></p><br><br><br>
                <p><?php echo ucfirst($this->session->userdata('laboratorium_nama_petugas')); ?></p>
              </td>
              <td class="text-right">
                <p>Yogyakarta, <?php echo getDateIndo(); ?><br><strong>Penanggung jawab,</strong></p><br><br>
                <p>dr. Indah Ajeng Ebtasari, M.Sc.,Sp.PK.</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  <?php endforeach; ?>

  </div>