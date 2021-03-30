
<body>

  <div class="container">
    <a class="noprint"><button class="btn btn-danger" type="button" onclick="windowClose();">Tutup</button></a>
    <div class="row">
      <div class="col-xs-12">
        <div align="center" class="invoice-title">
          <img class="img-responsive" src="<?php echo base_url('assets/images/Kop Surat Laboratorium.jpg') ?>" width="90%" alt="Kop Surat Laboratorium"><br>
          <u>HASIL PEMERIKSAAN LABORATORIUM</u>
        </div><br>

        <?php foreach ($antigen as $d): ?>

          <div class="row">
            <div class="col-xs-6">
              <address>
                <p><strong>Identitas Pasien:</strong><br>
                  <?php echo $d->id_catatan_medik; ?><br>
                  <?php echo $d->nama_pasien; ?><br>
                  <?php echo $d->nama_sex; ?><br>
                  <?php echo getAge($d->tgl_lahir); ?></p>
                </address>
              </div>
              <div class="col-xs-6 text-right">
                <address>
                  <p><strong>Pengirim:</strong><br>
                    <?php echo $d->nama_dokter; ?><br><br>
                    <strong>Pemeriksaan:</strong><br>
                    <small><?php echo formatDateIndo($d->tanggal).' / '.$d->jam; ?></small></p>
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
                        <td class="text-center"><strong><p>Pemeriksaan</p></strong></td>
                        <td class="text-center"><strong><p>Hasil</p></strong></td>
                        <td class="text-center"><strong><p>Nilai Rujukan</p></strong></td>
                        <td class="text-center"><strong><p>Metode</p></strong></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center"><p>SARS CoV-2 Antigen</p></td>
                        <td class="text-center">
                          <?php 
                          if($d->hasil==1){
                            echo "<p><strong>".strtoupper($d->nama_hasil)."</strong></p>";
                          }else{
                            echo strtoupper($d->nama_hasil);
                          }

                          ?>
                        </td>
                        <td class="text-center"><p>NEGATIF</p></td>
                        <td class="text-center"><p>ICT</p></td>
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
                <p><small>Printed : <?php echo getdateindo()." / ".gettimenow() ?></small></p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <table class="table table-condensed">
                <tbody>
                  <tr>
                    <?php
                    if( $d->hasil == 1){ ?>
                      <td><left><p>
                        <strong>Interpretasi :</strong><br>
                        - Hasil pemeriksaan POSITIF kemungkinan besar terinfeksi SARS CoV-2 (Covid-19)<br>
                        - Hasil positif palsu masih mungkin terjadi pada keadaan bahan pemeriksaan tercampur darah<br><br>

                        <strong>Saran :</strong><br>
                        - Hasil pemeriksaan POSITIF perlu dikonfirmasi dengan pemeriksaan SWAB-PCR SARS CoV-2 (Covid-19)<br>
                        - Isolasi sesuai dengan ketentuan sampai diperoleh hasil SWAB-PCR konklusif<br><br>

                        <strong>Catatan :</strong><br>
                        - Interpretrasi hasil harus dilakukan oleh dokter dengan mempertimbangkan data klinis dan epidemiologis<br>
                      </p></left></td>
                    <?php }else{ ?>
                      <td><left><p>
                        <strong>Interpretasi :</strong><br>
                        - Hasil pemeriksaan hanya menggambarkan kondisi saat pengambilan spesimen<br>
                        - Hasil pemeriksaan NEGATIF tidak menyingkirkan kemungkinan infeksi SARS CoV-2 (Covid-19) khusus bila ada kemungkinan kontak erat dengan kasus POSITIF<br>
                        - Hasil NEGATIF dapat terjadi pada kondisi jumlah antigen pada bahan pemeriksaan rendah, dibawah level deteksi alat atau dalam masa inkubasi<br><br>

                        <strong>Saran :</strong><br>
                        - Jika kecurigaan infeksi SARS CoV-2 (Covid-19), lanjutkan dengan pemeriksaan molekuler (SWAB-PCR), lakukan karantina mandiri sampai dengan hasil hasil test SWAB-PCR konklusif<br><br>

                        <strong>Catatan :</strong><br>
                        - Interpretrasi hasil harus dilakukan oleh dokter dengan mempertimbangkan data klinis dan epidemiologis<br>
                      </p></left></td>
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