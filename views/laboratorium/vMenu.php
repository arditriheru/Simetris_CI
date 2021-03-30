<!-- Sidebar -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a href="https://instagram.com/arditriheru" class="navbar-brand" target="_blank"><strong>SIMETRIS </strong><small>LABORATORIUM</small></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
      <li><a href="<?php echo base_url('laboratorium/index') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <?php if($this->session->userdata('laboratorium_akses') =='Admin') { ?>
        <li><a href="http://192.168.1.250:8080/laboratorium/" target="_blank"><i class="fa fa-flask"></i> Laboratorium</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-plus"></i> Test Antibody <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo base_url('laboratorium/dataAntibody/') ?>">Lihat & Tambah</a></li>
              <li><a href="<?php echo base_url('laboratorium/dataAntibody/lapCariData') ?>">Laporan</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-plus"></i> Test Antigen <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url('laboratorium/dataAntigen/') ?>">Lihat & Tambah</a></li>
                <li><a href="<?php echo base_url('laboratorium/dataAntigen/lapCariData') ?>">Laporan</a></li>
              </ul>
            </li>
            <li><a href="<?php echo base_url('laboratorium/dataAsuransi/') ?>"><i class="fa fa-file"></i> Klaim Asuransi</a></li>
            <li><a href="<?php echo base_url('laboratorium/dataAsuransi/index/1') ?>"><i class="fa fa-print"></i> Invoice Pemeriksaan</a></li>
          <?php } ?>
        </ul>

        <ul class="nav navbar-nav navbar-right navbar-user">
          <li>
            <a href="https://instagram.com/arditriheru" target="_blank">
              <span class="label label-success">ONLINE</span>
            </a>
          </li>
          <li class="dropdown user-dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle"></i> <?php echo $this->session->userdata('laboratorium_akses').' / '.$this->session->userdata('laboratorium_nama_petugas'); ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo base_url('laboratorium/login/logout') ?>"><i class="fa fa-power-off"></i> Log Out</a></li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </nav>