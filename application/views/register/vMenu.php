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
    <a href="https://instagram.com/arditriheru" class="navbar-brand" target="_blank"><strong>SIMETRIS </strong><small>REGISTER</small></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
      <li><a href="<?php echo base_url('register/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url('register/dataHpl/registerDataHpl') ?>"><i class="fa fa-check-square-o"></i> Hari Ini</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-plus"></i> HPL <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url('register/dataHpl/tambahDataHpl/1') ?>">Lihat</a></li>
            <li><a href="<?php echo base_url('register/dataHpl/tambahDataHpl/2') ?>">Tambah</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-plus"></i> Vaksin <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo base_url('register/dataVaksin/tambahDataVaksin/1') ?>">Lihat</a></li>
              <li><a href="<?php echo base_url('register/dataVaksin/tambahDataVaksin/2') ?>">Tambah</a></li>
            </ul>
          </li>
        </ul>

        <ul class="nav navbar-nav navbar-right navbar-user">
          <li>
            <a href="https://instagram.com/arditriheru" target="_blank">
              <span class="label label-success">ONLINE</span>
            </a>
          </li>
          <li class="dropdown user-dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle"></i> <?php echo $this->session->userdata('register_akses').' / '.$this->session->userdata('register_nama_petugas'); ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo base_url('register/login/logout') ?>"><i class="fa fa-power-off"></i> Log Out</a></li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </nav>