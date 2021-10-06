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
    <a href="https://arditriheru.github.io/" class="navbar-brand" target="_blank"><strong>SIMETRIS </strong><small>MANAJEMEN</small></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
      <li><a href="<?php echo base_url('manajemen/dataManajemen') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <?php if ($this->session->userdata('akses') == 'Admin') { ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-plus"></i> JM Dokter <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url('manajemen/dataJasaMedis/jmDokterRalan') ?>">Rawat Jalan</a></li>
            <li><a href="<?php echo base_url('manajemen/dataJasaMedis/jmDokterRanap') ?>">Rawat Inap</a></li>
          </ul>
        </li>
        <li><a href="<?php echo base_url('manajemen/dataJasaMedis/dataTampilJmParamedis') ?>"><i class="fa fa-plus"></i> JM Paramedis</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-plus"></i> Farmasi <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url('manajemen/dataFarmasi/dataEdObat/1') ?>">Expired Date Obat</a></li>
          </ul>
        </li>
        <li><a href="<?php echo base_url('manajemen/dataManajemen/exportCustom') ?>"><i class="fa fa-file-excel-o"></i> Export Custom</a></li>
      <?php } ?>
    </ul>

    <ul class="nav navbar-nav navbar-right navbar-user">
      <li>
        <a href="https://arditriheru.github.io/" target="_blank">
          <span class="label label-success">ONLINE</span>
        </a>
      </li>
      <li class="dropdown user-dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle"></i> <?php echo $this->session->userdata('akses') . ' / ' . $this->session->userdata('nama_petugas'); ?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url('manajemen/login/logout') ?>"><i class="fa fa-power-off"></i> Log Out</a></li>
        </ul>
      </li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>