<?php 
//$data = file_get_contents('https://data.covid19.go.id/public/api/prov.json');
//$value = json_decode($data, true); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $toptitle ?></title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet">

  <!-- Add custom CSS here -->
  <link href="<?php echo base_url() ?>assets/css/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.min.css">
  <!-- Page Specific CSS -->
  <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
</head>

<div id="page-wrapper">

  <div class="row">

    <div class="col-lg-12">
      <a href="https://instagram.com/arditriheru">
        <img class="img-responsive" src="<?php echo base_url('assets/images/header.jpg') ?>" width="100%" height="auto" alt="Author Ardi Tri Heru Hatmoko / arditriheruh@gmail.com"></a><br>
        <div class="alert alert-info alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h3>Selamat Datang di Sistem Informasi Rumah Sakit dikembangkan oleh IT RSKIA Rachmi Yogyakarta</h3>
        </div>
      </div>

    </div>

<!--     <div class="row">
      <div class="col-lg-6">
        <h2 class="text-center">Update Kasus Penularan COVID-19<br>Provinsi D.I.Yogyakarta<br>Per tanggal 
          <?php
          $n = 1;
          $prevN = mktime(0, 0, 0, date("m"), date("d") - $n, date("Y"));
          $min   = date("Y-m-d", $prevN);
          echo formatDateIndo($min); 
          ?>
        </h2>
        <p class="text-center">Sumber : https://covid19.go.id</p>
      </div>
      <div class="col-lg-2">
       <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title text-center"><strong>Positif</strong></h3>
        </div>
        <div class="panel-body">
          <h1 class="text-center"><?php echo $value["list_data"][12]["penambahan"]["positif"] ?></h1>
        </div>
      </div>
    </div>
    <div class="col-lg-2">
     <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title text-center"><strong>Sembuh</strong></h3>
      </div>
      <div class="panel-body">
        <h1 class="text-center"><?php echo $value["list_data"][12]["penambahan"]["sembuh"] ?></h1>
      </div>
    </div>
  </div>
  <div class="col-lg-2">
   <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title text-center"><strong>Meninggal</strong></h3>
    </div>
    <div class="panel-body">
      <h1 class="text-center"><?php echo $value["list_data"][12]["penambahan"]["meninggal"] ?></h1>
    </div>
  </div>
</div>

</div> -->

<div class="row">

  <div class="col-lg-3">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <a href="http://192.168.1.250:8080/bangsal/">
            <div class="col-xs-2">
              <i class="fa fa-heartbeat fa-4x"></i>
            </div>
            <div class="col-xs-10 text-right">
              <h2>Bangsal</h2>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div><!-- menu -->

  <div class="col-lg-3">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <a href="<?php echo base_url('booking/login') ?>">
            <div class="col-xs-2">
              <i class="fa fa-calendar-check-o fa-4x"></i>
            </div>
            <div class="col-xs-10 text-right">
              <h2>Booking</h2>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div><!-- menu -->

  <div class="col-lg-3">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <a href="<?php echo base_url('booking/dataTarif') ?>">
            <div class="col-xs-2">
              <i class="fa fa-dollar fa-4x"></i>
            </div>
            <div class="col-xs-10 text-right">
              <h2>Daftar Tarif</h2>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div><!-- menu -->

  <div class="col-lg-3">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <a href="http://192.168.1.250:8080/farmasi/">
            <div class="col-xs-2">
              <i class="fa fa-medkit fa-4x"></i>
            </div>
            <div class="col-xs-10 text-right">
              <h2>Farmasi</h2>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div><!-- menu -->

  <div class="col-lg-3">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <a href="http://192.168.1.250:8080/sdi/">
            <div class="col-xs-2">
              <i class="fa fa-user-plus fa-4x"></i>
            </div>
            <div class="col-xs-10 text-right">
              <h2>Hak Akses</h2>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div><!-- menu -->

  <div class="col-lg-3">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <a href="https://pcare.bpjs-kesehatan.go.id/vaksin">
            <div class="col-xs-2">
              <i class="fa fa-universal-access fa-4x"></i>
            </div>
            <div class="col-xs-10 text-right">
              <h2>Pcare Vaksin</h2>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div><!-- menu -->

  <div class="col-lg-3">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <a href="<?php echo base_url('register/login') ?>">
            <div class="col-xs-2">
              <i class="fa fa-file-text-o fa-4x"></i>
            </div>
            <div class="col-xs-10 text-right">
              <h2>Register</h2>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div><!-- menu -->

  <div class="col-lg-3">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <a href="<?php echo base_url('inventaris/login') ?>">
            <div class="col-xs-2">
              <i class="fa fa-paperclip fa-4x"></i>
            </div>
            <div class="col-xs-10 text-right">
              <h2>Inventaris</h2>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div><!-- menu -->

  <div class="col-lg-3">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <a href="http://192.168.1.250:8080/kasir/">
            <div class="col-xs-2">
              <i class="fa fa-calculator fa-4x"></i>
            </div>
            <div class="col-xs-10 text-right">
              <h2>Kasir</h2>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div><!-- menu -->

  <div class="col-lg-3">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <a href="<?php echo base_url('laboratorium/login') ?>">
            <div class="col-xs-2">
              <i class="fa fa-flask fa-4x"></i>
            </div>
            <div class="col-xs-10 text-right">
              <h2>Laboratorium</h2>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div><!-- menu -->

  <div class="col-lg-3">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <a href="<?php echo base_url('manajemen/login') ?>">
            <div class="col-xs-2">
              <i class="fa fa-bar-chart fa-4x"></i>
            </div>
            <div class="col-xs-10 text-right">
              <h2>Manajemen</h2>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div><!-- menu -->

  <div class="col-lg-3">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <a href="<?php echo base_url('monitor/dataMonitor') ?>">
            <div class="col-xs-2">
              <i class="fa fa-desktop fa-4x"></i>
            </div>
            <div class="col-xs-10 text-right">
              <h2>Monitor</h2>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div><!-- menu -->

  <div class="col-lg-3">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <a href="http://192.168.1.250:8080/poliklinik/">
            <div class="col-xs-2">
              <i class="fa fa-stethoscope fa-4x"></i>
            </div>
            <div class="col-xs-10 text-right">
              <h2>Poliklinik</h2>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div><!-- menu -->

  <div class="col-lg-3">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <a href="http://192.168.1.250:8080/mr/">
            <div class="col-xs-2">
              <i class="fa fa-id-card-o fa-4x"></i>
            </div>
            <div class="col-xs-10 text-right">
              <h2>Rekam Medik</h2>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div><!-- menu -->

  <div class="col-lg-3">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <a href="http://36.94.165.191:8080/lite/">
            <div class="col-xs-2">
              <i class="fa fa-mobile fa-4x"></i>
            </div>
            <div class="col-xs-10 text-right">
              <h2>RS Online</h2>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div><!-- menu -->

  <div class="col-lg-3">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <a href="http://192.168.1.100:8080">
            <div class="col-xs-2">
              <i class="fa fa-database fa-4x"></i>
            </div>
            <div class="col-xs-10 text-right">
              <h2>Sismadak</h2>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div><!-- menu -->

  <div class="col-lg-3">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <a href="https://sisrute.kemkes.go.id/baru/index.php">
            <div class="col-xs-2">
              <i class="fa fa-ambulance fa-4x"></i>
            </div>
            <div class="col-xs-10 text-right">
              <h2>SISRUTE</h2>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div><!-- menu -->

</div>

</div><!-- row -->

</div><!-- page-wrapper -->

<footer class="fixed-footer">
  <marquee direction="left" bgcolor="transparent" width="auto"><font color="black"><?php echo getCopyright() ?><font face="consolas" > <?php echo getVersion() ?> | <?php echo getDateIndo() ?></font></marquee>
</footer><br>
</div><!-- /#wrapper -->

<!-- JavaScript -->
<script src="<?php echo base_url() ?>assets/js/font-awesome.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery-1.10.2.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>

<!-- Page Specific Plugins -->
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/morris/chart-data-morris.js"></script>
<script src="<?php echo base_url() ?>assets/js/tablesorter/jquery.tablesorter.js"></script>
<script src="<?php echo base_url() ?>assets/js/tablesorter/tables.js"></script>

</body>
</html>