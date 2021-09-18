<body>

  <script>
    window.print();
  </script>

  <div id="wrapper">

    <div id="page-wrapper">

      <div class="row">
        <div class="col-lg-12">
          <center>
            <div class="row">
              <img class="img-responsive" src="<?php echo base_url('assets/images/Kop Surat Laboratorium.jpg') ?>" width="90%" alt="Kop Surat Laboratorium">
            </div>
          </center><br>
          <?php foreach ($rapidtest as $d): ?>
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td><b>No. RM</b></td>
                  <td><?php echo $d->id_catatan_medik; ?></td>
                  <td><b>Dokter</b></td>
                  <td><?php echo "dr. ".$d->nama_dokter; ?></td>
                </tr>
                <tr>
                  <td><b>Nama</b></td>
                  <td><?php echo $d->nama_pasien; ?></td>
                  <td><b>Asal</b></td>
                  <td><?php echo $d->nama_unit; ?></td>
                </tr>
                <tr>
                  <td><b>Umur</b></td>
                  <td><?php echo getAge($d->tgl_lahir); ?></td>
                  <td><b>Tgl Periksa</b></td>
                  <td><?php echo formatDateIndo($d->tgl_periksa); ?></td>
                </tr>
                <tr>
                  <td><b>Gender</b></td>
                  <td><?php echo $d->nama_sex; ?></td>
                  <td><b>Jam Periksa</b></td>
                  <td><?php echo $d->jam_periksa; ?></td>
                </tr>
                <tr>
                  <td><b>Alamat</b></td>
                  <td><?php echo $d->alamat; ?></td>
                  <td><b>Sampel</b></td>
                  <td><?php echo $d->sampel; ?></td>
                </tr>
              </tbody>
            </table>
            <table class="table table-bordered table-hover table-striped tablesorter">
              <thead>
                <tr>
                  <th><center>Pemeriksaan</center></th>
                  <th><center>Hasil</center></th>
                  <th><center>Nilai Rujukan</center></th>
                  <th><center>Metode</center></th>
                </tr>
                <tr><td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $d->pemeriksaan; ?></td></tr>
              </thead>
              <tbody>
                <tr>
                  <td><center>(IgM)</center></td>
                  <td><center><?php echo $d->nama_igm; ?></center></td>
                  <td><center><?php echo $d->nama_nilai_rujukan; ?></center></td>
                  <td><center><?php echo $d->metode; ?></center></td>
                </tr>
                <tr>
                  <td><center>(IgG)</center></td>
                  <td><center><?php echo $d->nama_igg; ?></center></td>
                  <td><center><?php echo $d->nama_nilai_rujukan; ?></center></td>
                  <td><center><?php echo $d->metode; ?></center></td>
                </tr>
              </tbody>
            </table>
            <div align="right">
              <small>Printed : <?php echo getdateindo()." / ".gettimenow() ?></small>
            </div>
            <table>
              <tbody>
                <tr>
                  <?php
                  if( $d->igm == 1 || $d->igg == 1){ ?>
                    <td><left><p>
                      <strong>Catatan :</strong><br>
                      1. Pemeriksaan Rapid ke 1<br>
                      2. Hasil Rapid Test Antibody Reaktif belum dapat memastikan adanya Infeksi SARS Cov-2<br>
                      3. Pemeriksaan Konfirmasi dengan pemeriksaan <b>RT PCR</b><br>
                      4. Lakukan karantina mandiri  dengan menerapkan PHBS (Perilaku Hidup Bersih dan Sehat : Mencuci tangan, menerapkan etika batuk, menggunakan masker), dan menjaga Physical Distancing<br>
                      5. Bila muncul gejala atau gejala memberat selama isolasi segera menuju ke RS Rujukan Covid-19<br>
                    </p></letf></td>
                  <?php }else{ ?>
                    <td><left><p>
                      <strong>Catatan :</strong><br>
                      1. Pemeriksaan Rapid ke 1<br>
                      2. Hasil Non reaktif tidak menyingkirkan kemungkinan infeksi SARS CoV-2<br>
                      3. Hasil Non Reaktif dapat terjadi pada kondisi :<br>
                      &nbsp; &nbsp; - Sesorang belum / tidak terinfeksi<br>
                      &nbsp; &nbsp; - Window Period (Terinfeksi namun antibody belum terbentuk)<br>
                      &nbsp; &nbsp; - Immunocompromised<br>
                      4. Saran :<br>
                      &nbsp; &nbsp; - Ulangi pemeriksaan rapid test antibody 7-10 hari kemudian<br>
                      &nbsp; &nbsp; - Pertahankan perilaku hidup bersih dan physical distancing<br><br><br>
                    </p></letf></td>
                  <?php } ?>
                </tr>
              </table>
            </tbody><br>
            <div align="right">
              <table>
                <tbody>
                  <tr>
                    <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
                    <td><center><strong>Petugas,</strong><br><br><br><br><br><br>
                      <?php echo $this->session->userdata('covid_nama_petugas'); ?></center></td>
                      <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
                      <td><center>Yogyakarta, <?php echo formatDateIndo($d->tanggal); ?><br><strong>Penanggung jawab,</strong><br><br><br><br><br>
                      dr. Indah Ajeng Ebtasari, M.Sc.,Sp.PK.</center></td>
                    </tr>
                  </tbody>
                  </table><?php endforeach ?>
                </div>
              </div><!-- /.row -->

            </div><!-- /#page-wrapper -->

            <!-- </div> /#wrapper  -->
