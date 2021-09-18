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
    <a href="https://instagram.com/arditriheru" class="navbar-brand" target="_blank"><strong>SIMETRIS </strong><small>INVENTARIS</small></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
      <li><a href="<?php echo base_url('inventaris/dataInventaris') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-plus"></i> Inventaris<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url('inventaris/dataInventaris/tambahDataInventaris/1') ?>">Lihat</a></li>
            <li><a href="<?php echo base_url('inventaris/dataInventaris/tambahDataInventaris/2') ?>">Tambah</a></li>
          </ul>
        </li>
        <li><a href="<?php echo base_url('inventaris/dataInventaris/tambahDataJenis') ?>"><i class="fa fa-tag"></i> Jenis</a></li>
        <li><a href="<?php echo base_url('inventaris/dataInventaris/tambahDataRuangan') ?>"><i class="fa fa-home"></i> Ruangan</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right navbar-user">
        <li>
          <a href="https://instagram.com/arditriheru" target="_blank">
            <span class="label label-success">ONLINE</span>
          </a>
        </li>
        <li class="dropdown user-dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle"></i> <?php echo $this->session->userdata('inventaris_akses').' / '.$this->session->userdata('inventaris_nama_petugas'); ?> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url('inventaris/login/logout') ?>"><i class="fa fa-power-off"></i> Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </nav>