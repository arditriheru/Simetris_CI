<body>

  <div class="container">
    <a class="noprint"><button class="btn btn-danger" type="button" onclick="windowClose();">Tutup</button></a>
    <div class="row">
      <div class="col-xs-12">
        <div align="center" class="invoice-title">
          <img class="img-responsive" src="<?php echo base_url('assets/images/Kop Surat Laboratorium.jpg') ?>" width="90%" alt="Kop Surat Laboratorium"><br>
          <u>HASIL PEMERIKSAAN LABORATORIUM</u>
        </div><br>

        <?php foreach ($antigen as $d) : ?>

          <div class="row">
            <div class="col-xs-6">
              <address>
                <p>
                  <?php if ($d->id_catatan_medik == 10000000) { ?>

                    <strong>Nomor RM: </strong>
                    <td class="text-center"><?php echo $d->id_catatan_medik . ' (UMUM)'; ?></td><br>
                    <strong>Nama Pasien: </strong>
                    <td class="text-center"><?php echo $d->test_antigen_nama; ?></td><br>
                    <strong>Gender: </strong>
                    <td class="text-center"><?php echo $d->test_antigen_nama_sex; ?></td><br>
                    <strong>Tgl Lahir: </strong>
                    <?php echo formatDateIndo($d->test_antigen_tgl_lahir) . " (" . getAge($d->test_antigen_tgl_lahir) . ")"; ?>

                  <?php } else { ?>

                    <strong>Nomor RM: </strong>
                    <td class="text-center"><?php echo $d->id_catatan_medik; ?></td><br>
                    <strong>Nama Pasien: </strong>
                    <td class="text-center"><?php echo $d->mr_pasien_nama; ?></td><br>
                    <strong>Gender: </strong>
                    <td class="text-center"><?php echo $d->mr_pasien_nama_sex; ?></td><br>
                    <strong>Tgl Lahir: </strong>
                    <?php echo formatDateIndo($d->mr_pasien_tgl_lahir) . " (" . getAge($d->mr_pasien_tgl_lahir) . ")"; ?>

                  <?php } ?>

                </p>
              </address>
            </div>
            <div class="col-xs-6 text-right">
              <address>
                <p><strong>Pengirim:</strong><br>
                  <?php echo $d->nama_dokter; ?><br><br>
                  <strong>Pemeriksaan:</strong><br>
                  <small><?php echo formatDateIndo($d->tgl_periksa) . ' / ' . $d->jam_periksa; ?></small>
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
                  <td class="text-center"><strong>
                      <p>Pemeriksaan</p>
                    </strong></td>
                  <td class="text-center"><strong>
                      <p>Hasil</p>
                    </strong></td>
                  <td class="text-center"><strong>
                      <p>Nilai Rujukan</p>
                    </strong></td>
                  <td class="text-center"><strong>
                      <p>Metode</p>
                    </strong></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-center">
                    <p>SARS CoV-2 Antigen</p>
                  </td>
                  <td class="text-center">
                    <?php if ($d->hasil == 0) {
                      echo "<p>" . ucwords($d->nama_hasil) . "</p>";
                    } else {
                      echo "<p class='red-text'>" . ucwords($d->nama_hasil) . "</p>";
                    } ?>
                  </td>
                  <td class="text-center">
                    <p>Negatif</p>
                  </td>
                  <td class="text-center">
                    <p>ICT</p>
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
              if ($d->hasil == 1) { ?>
                <td>
                  <left>
                    <p>
                      <strong>Interpretasi :</strong><br>
                      - Hasil pemeriksaan POSITIF kemungkinan besar terinfeksi SARS CoV-2<br>
                      - Hasil positif palsu masih mungkin terjadi pada keadaan bahan pemeriksaan tercampur darah<br><br>

                      <strong>Saran :</strong><br>
                      - Hasil pemeriksaan POSITIF perlu dikonfirmasi dengan pemeriksaan RT-PCR SARS CoV-2<br>
                      - Isolasi sesuai dengan ketentuan sampai dengan diperoleh hasil RT-PCR konklusif<br><br>

                      <strong>Catatan :</strong><br>
                      - Interpretrasi hasil harus dilakukan oleh dokter dengan mempertimbangkan data klinis dan epidemiologis<br>
                    </p>
                  </left>
                </td>
              <?php } else { ?>
                <td>
                  <left>
                    <p>
                      <strong>Interpretasi :</strong><br>
                      - Hasil pemeriksaan hanya menggambarkan kondisi saat pengambilan spesimen<br>
                      - Hasil pemeriksaan NEGATIF tidak menyingkirkan kemungkinan infeksi SARS CoV-2 khususnya bila ada kemungkinan kontak erat dengan kasus positif<br>
                      - Hasil NEGATIF dapat terjadi pada kondisi jumlah antigen pada bahan pemeriksaan rendah, dibawah level deteksi alat atau dalam masa inkubasi<br><br>

                      <strong>Saran :</strong><br>
                      - Jika kecurigaan infeksi SARS CoV-2 besar, lanjutkan dengan pemeriksaan molekuler (RT-PCR), lakukan karantina mandiri sampai dengan hasil hasil test RT-PCR konklusif<br><br>

                      <strong>Catatan :</strong><br>
                      - Interpretrasi hasil harus dilakukan oleh dokter dengan mempertimbangkan data klinis dan epidemiologis<br>
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