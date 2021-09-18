<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo getTopTitle()." - ".$title ?></title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet">

  <!-- Add custom CSS here -->
  <link href="<?php echo base_url() ?>assets/css/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.min.css">

  <style>
    html {
      position: fixed;
      overflow: auto;
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
      background: silver;
    }
    body {
      height: 100%;
      margin: 0;
      overflow: auto;
      background: #153e90;
    }
    .antrian {
      font-size: 80px;
      color: #000000;
    }
    .black-text {
      color: #000000;
    }
  </style>
</head>

<body>
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-4">

        <div class="panel panel-primary">
          <div class="panel-heading">
            <h2 align="center">Poli Obsgyn Selatan</h2>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-6">
                <center><font class="antrian" id="poli1"></font></center>
              </div>
              <div class="col-lg-6">
                <center><font class="black-text" size="5px">Total</font></center>
                <center><font class="black-text" size="10px" id="total1"></font></center>
              </div>
            </div>
            <div class="row">
              <center><font class="black-text" size="4px" id="dokter1"></font></center>
            </div>
          </div>
        </div>

        <div class="panel panel-primary">
          <div class="panel-heading">
            <h2 align="center">Poli Anak</h2>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-6">
                <center><font class="antrian" id="poli2"></font></center>
              </div>
              <div class="col-lg-6">
                <center><font class="black-text" size="5px">Total</font></center>
                <center><font class="black-text" size="10px" id="total2"></font></center>
              </div>
            </div>
            <div class="row">
              <center><font class="black-text" size="4px" id="dokter2"></font></center>
            </div>
          </div>
        </div>

        <div class="panel panel-primary">
          <div class="panel-heading">
            <h2 align="center">Poli Obsgyn Utara</h2>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-6">
                <center><font class="antrian" id="poli3"></font></center>
              </div>
              <div class="col-lg-6">
                <center><font class="black-text" size="5px">Total</font></center>
                <center><font class="black-text" size="10px" id="total3"></font></center>
              </div>
            </div>
            <div class="row">
              <center><font class="black-text" size="4px" id="dokter3"></font></center>
            </div>
          </div>
        </div>

      </div>

      <div class="col-lg-8">
        <br>
        <div style="font-size: 30px; width: 100%; color: #ffffff;">
          <!-- <?php $date = date('d F Y'); echo dateIndo($date) ;?> -->
          <div align="right" id="time"><?php echo date('H:m:i');?></div>
        </div>
        <div class="img-thumbnail" style="font-size: 30px;width: 100%;">
          <video src="<?php echo base_url();?>assets/video/profil.mp4" width="100%" muted loop controls autoplay class="img-thumbnail" style="width: 100%"></video>
        </div>
        <br><br>
        <div align="right">
          <font color="white" size="5px">Copyright &#169; <script type='text/javascript'>var creditsyear = new Date();document.write(creditsyear.getFullYear());</script></b> Tim Teknologi Informasi</font>
        </div>

        <marquee direction="left" bgcolor="transparent" width="auto"><font size="7px" color="yellow">Selamat Datang di RSKIA Rachmi Yogyakarta - Melayani Dengan Kasih dan Sayang</marquee>

        </div>
      </div>

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

      <script>  
        // setInterval(function(){
        //   count_akhir();
        //   data_panggil();
        //   cektotal();
        // }, 1000);

        setInterval(function(){
         var myVar = setInterval(myTimer, 1000);
         function myTimer() {
          var d = new Date();
          document.getElementById("time").innerHTML = d.toLocaleTimeString();
        }  
        $("#poli1").load('<?php echo base_url()?>monitor/dataMonitor/poli1?>');
        $("#poli2").load('<?php echo base_url()?>monitor/dataMonitor/poli2?>');
        $("#poli3").load('<?php echo base_url()?>monitor/dataMonitor/poli3?>');

        $("#dokter1").load('<?php echo base_url()?>monitor/dataMonitor/dokter1?>');
        $("#dokter2").load('<?php echo base_url()?>monitor/dataMonitor/dokter2?>');
        $("#dokter3").load('<?php echo base_url()?>monitor/dataMonitor/dokter3?>');

        $("#total1").load('<?php echo base_url()?>monitor/dataMonitor/total1?>');
        $("#total2").load('<?php echo base_url()?>monitor/dataMonitor/total2?>');
        $("#total3").load('<?php echo base_url()?>monitor/dataMonitor/total3?>');
      }, 1000);
    </script>

  </body>
  </html>