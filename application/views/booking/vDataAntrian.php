<body>

  <!-- /#rekaman -->
  <audio id="suarabel" src="<?php echo base_url('assets/rekaman/bell-bandara.mp3') ?>"></audio>
  <audio id="suarabelnomorurut" src="<?php echo base_url('assets/rekaman/nomor-antrian.mp3') ?>"></audio>

  <?php if($this->session->userdata('id_unit') == 2){ ?>

    <audio id="suarabelabjad" src="<?php echo base_url('assets/rekaman/a.mp3') ?>"></audio>
    <audio id="suarabelsuarabelloket" src="<?php echo base_url('assets/rekaman/ke-poli-kandungan.mp3') ?>"></audio>

  <?php }else{ ?>

    <audio id="suarabelabjad" src="<?php echo base_url('assets/rekaman/b.mp3') ?>"></audio>
    <audio id="suarabelsuarabelloket" src="<?php echo base_url('assets/rekaman/ke-poli-anak.mp3') ?>"></audio>

  <?php } ?>

  <audio id="belas" src="<?php echo base_url('assets/rekaman/belas.mp3') ?>"></audio> 
  <audio id="sebelas" src="<?php echo base_url('assets/rekaman/sebelas.mp3') ?>"></audio> 
  <audio id="puluh" src="<?php echo base_url('assets/rekaman/puluh.mp3') ?>"></audio> 
  <audio id="sepuluh" src="<?php echo base_url('assets/rekaman/sepuluh.mp3') ?>"></audio> 
  <audio id="ratus" src="<?php echo base_url('assets/rekaman/ratus.mp3') ?>3"></audio> 
  <audio id="seratus" src="<?php echo base_url('assets/rekaman/seratus.mp3') ?>"></audio>

  <?php
  $loket    = 1;
  $tcounter = $this->session->userdata('tcounter');
  $panjang  = strlen($tcounter);
  $antrian  = $tcounter;

  for($i=0;$i<$panjang;$i++){ ?>

    <!--SUARA NOMOR URUT-->
    <audio id="suarabel<?php echo $i;?>"
      src="<?php echo base_url() ?>assets/rekaman/<?php echo substr($tcounter,$i,1); ?>.mp3" >
    </audio>

  <?php } ?>

  <div id="wrapper">

    <div id="page-wrapper">

      <div class="row">
        <div class="col-lg-12">

          <h1><?php echo $title ?> <small> <?php echo $subtitle ?></small></h1>

          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('booking/dataBooking') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-plus"></i> <?php echo $title ?></li>
          </ol>

          <?php $this->load->view('templates/welcome') ?>
          <?php echo $this->session->flashdata('alert') ?>

          <div class="col-lg-4"><br>
            <button name="next" type="submit"
            class="btn btn-primary" onClick="window.location.reload()"><i class="fa fa-refresh"></i> Refresh</button>
            <a href="<?php echo base_url('booking/DataAntrian/selesaiAntrian') ?>">
              <button name="next" type="submit"
              class="btn btn-danger"><i class="fa fa-close"></i> Selesai</button>
            </a>
            <a href="<?php echo base_url('booking/DataAntrian/excelData?dokter='.$this->session->userdata('id_dokter').'&sesi='.$this->session->userdata('id_sesi')) ?>">
              <button name="next" type="submit"
              class="btn btn-success"><i class="fa fa-download"></i> Excel</button>
            </a>
          </div>
          <div align="right" class="col-lg-8">
            <h1><small>Total <?php echo $total; ?> Pasien</small></h1>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped tablesorter">
              <thead>
                <tr>
                  <th class="text-center">Status</i></th>
                  <th class="text-center">#</i></th>
                  <th class="text-center">Bell</i></th>
                  <th class="text-center">Timer</i></th>
                  <th class="text-center">Nomor.RM</i></th>
                  <th class="text-center">Nama</i></th>
                  <th class="text-center">Alamat</i></th>
                  <th class="text-center">Sesi</i></th>
                  <th class="text-center">Action</i></th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($dataantrian as $d) : ?>
                <tr class="active">
                  <td><center><?php
                  if($d->status=='Datang'){
                    echo "<button type='button' class='btn btn-primary'><i class='fa fa-check'></i></button>";
                  }else{
                    echo "<button type='button' class='btn btn-danger'><i class='fa fa-times'></i></button>";
                  }
                  ?>
                </center></td>
                <td><center><?php echo $d->noant ?></center></td>
                <td>
                  <div align="center">
                    <?php
                    if($d->aktif=='1'){ ?>
                      <button type="button" id="<?php echo $d->noant ?>" onclick="play()" class="btn btn-success"><i class='fa fa-volume-up'></i></button>
                    <?php }else{ ?>
                      <a href="<?php echo base_url('booking/dataAntrian/aktifAksi/'.$d->id_booking) ?>"><button type="button" class="btn btn-link"><i class="fa fa-stop"></i></button></a>
                    <?php } ?>
                  </div>
                </td>
                <td><center>
                  <?php
                  if($d->mulai=="00:00:00"){ ?>

                    <a href="<?php echo base_url('booking/dataAntrian/dilayaniMulai/'.$d->id_booking) ?>"><button type='button' class='btn btn-primary'><i class='fa fa-hourglass-start'></i></button></a>

                  <?php }elseif($d->akhir=="00:00:00"){ ?>

                  <a href="<?php echo base_url('booking/dataAntrian/dilayaniAkhir/'.$d->id_booking) ?>"><button type='button' class='btn btn-warning'><i class='fa fa-hourglass-end'></i></button></a>

                <?php }else{

                    $mulai = strtotime($d->mulai); //waktu mulai
                    $akhir = strtotime($d->akhir); //waktu akhir
                    $diff  = $akhir - $mulai;
                    $jam   = floor($diff/(60*60));
                    $menit = $diff-$jam*(60*60);
                    echo $jam."' ".floor($menit/60)."''";

                  } ?>
                </center></td>
                <td><center><?php echo $d->id_catatan_medik ?></center></td>
                <td><center><?php echo $d->nama ?></center></td>
                <td><center><?php echo $d->alamat ?></center></td>
                <td><center><?php echo $d->nama_sesi ?></center></td>
                <td class="text-center">
                  <a href="<?php echo base_url('booking/dataBooking/detailDataPoli/'.$d->id_booking) ?>"><button type="button" class="btn btn-warning"><i class='fa fa-folder-open'></i></button></a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
    </div><!-- /.row -->

  </div><!-- /#page-wrapper -->

  <!--</div> /#wrapper -->

  <script type="text/javascript">
    function play()
    {
      //MAINKAN SUARA BEL PADA SAAT AWAL
      document.getElementById('suarabel').pause();
      document.getElementById('suarabel').currentTime=0;
      document.getElementById('suarabel').play();

      //SET DELAY UNTUK MEMAINKAN REKAMAN NOMOR URUT
      totalwaktu=document.getElementById('suarabel').duration*1030;

      //MAINKAN SUARA NOMOR URUT
      setTimeout(function() {
        document.getElementById('suarabelnomorurut').pause();
        document.getElementById('suarabelnomorurut').currentTime=0;
        document.getElementById('suarabelnomorurut').play();
      }, totalwaktu);
      totalwaktu=totalwaktu+1500;

      //MAINKAN SUARA ABJAD
      setTimeout(function() {
        document.getElementById('suarabelabjad').pause();
        document.getElementById('suarabelabjad').currentTime=0;
        document.getElementById('suarabelabjad').play();
      }, totalwaktu);
      totalwaktu=totalwaktu+500;

      <?php
        //JIKA KURANG DARI 10 MAKA MAIKAN SUARA ANGKA1
      if($antrian<10){
        ?>
        setTimeout(function() {
          document.getElementById('suarabel0').pause();
          document.getElementById('suarabel0').currentTime=0;
          document.getElementById('suarabel0').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+800;
        <?php   
      }elseif($antrian ==10){
          //JIKA 10 MAKA MAIKAN SUARA SEPULUH
        ?>  
        setTimeout(function() {
          document.getElementById('sepuluh').pause();
          document.getElementById('sepuluh').currentTime=0;
          document.getElementById('sepuluh').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+800;
        <?php   
      }elseif($antrian ==11){
          //JIKA 11 MAKA MAIKAN SUARA SEBELAS
        ?>  
        setTimeout(function() {
          document.getElementById('sebelas').pause();
          document.getElementById('sebelas').currentTime=0;
          document.getElementById('sebelas').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+800;
        <?php   
      }elseif($antrian < 20){
          //JIKA 12-20 MAKA MAIKAN SUARA ANGKA2+"BELAS"
        ?>          
        setTimeout(function() {
          document.getElementById('suarabel1').pause();
          document.getElementById('suarabel1').currentTime=0;
          document.getElementById('suarabel1').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+800;
        setTimeout(function() {
          document.getElementById('belas').pause();
          document.getElementById('belas').currentTime=0;
          document.getElementById('belas').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+800;
        <?php   
      }elseif($antrian < 100){        
          //JIKA PULUHAN MAKA MAINKAN SUARA ANGKA1+PULUH+AKNGKA2
        ?>  
        setTimeout(function() {
          document.getElementById('suarabel0').pause();
          document.getElementById('suarabel0').currentTime=0;
          document.getElementById('suarabel0').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+800;
        setTimeout(function() {
          document.getElementById('puluh').pause();
          document.getElementById('puluh').currentTime=0;
          document.getElementById('puluh').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+800;
        setTimeout(function() {
          document.getElementById('suarabel1').pause();
          document.getElementById('suarabel1').currentTime=0;
          document.getElementById('suarabel1').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+800;
        <?php
      }elseif($antrian == 100){
        //JIKA 100 MAKA MAIKAN SUARA SERATUS
        ?>
        setTimeout(function() {
          document.getElementById('seratus').pause();
          document.getElementById('seratus').currentTime=0;
          document.getElementById('seratus').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+800;
        <?php
      }else{
          //JIKA LEBIH DARI 100 
          //Karena aplikasi ini masih sederhana maka logina konversi hanya sampai 100
          //Selebihnya akan langsung disebutkan angkanya saja 
          //tanpa kata "RATUS", "PULUH", maupun "BELAS"
        ?>
        <?php 
        for($i=0;$i<$panjang;$i++){
          ?>
          totalwaktu=totalwaktu+800;
          setTimeout(function() {
            document.getElementById('suarabel<?php echo $i; ?>').pause();
            document.getElementById('suarabel<?php echo $i; ?>').currentTime=0;
            document.getElementById('suarabel<?php echo $i; ?>').play();
          }, totalwaktu);
          <?php
        }
      }
      ?>

      totalwaktu=totalwaktu+200;
      setTimeout(function() {
        document.getElementById('suarabelsuarabelloket').pause();
        document.getElementById('suarabelsuarabelloket').currentTime=0;
        document.getElementById('suarabelsuarabelloket').play();
      }, totalwaktu);
      totalwaktu=totalwaktu+200;
      setTimeout(function() {
        document.getElementById('suarabelloket<?php echo $loket; ?>').pause();
        document.getElementById('suarabelloket<?php echo $loket; ?>').currentTime=0;
        document.getElementById('suarabelloket<?php echo $loket; ?>').play();
      }, totalwaktu);

    }
  </script>