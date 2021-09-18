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
    <a href="https://instagram.com/arditriheru" class="navbar-brand" target="_blank"><strong>SIMETRIS </strong><small>RAPIDTEST</small></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
      <li><a href="<?php echo base_url('covid/dataRapidtest') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <?php if($this->session->userdata('covid_akses') =='Admin') { ?>
        <li><a href="<?php echo base_url('covid/dataRapidtest/tambahData') ?>"><i class="fa fa-plus"></i> Rapid Test</a></li>
        <li><a href="<?php echo base_url('covid/dataRapidtest/lapCariData') ?>"><i class="fa fa-file"></i> Laporan</a></li>
      <?php } ?>
    </ul>

    <ul class="nav navbar-nav navbar-right navbar-user">
      <li>
        <a href="https://instagram.com/arditriheru" target="_blank">
          <span class="label label-success">ONLINE</span>
        </a>
      </li>
      <li class="dropdown user-dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle"></i> <?php echo $this->session->userdata('covid_akses').' / '.$this->session->userdata('covid_nama_petugas'); ?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url('covid/login/logout') ?>"><i class="fa fa-power-off"></i> Log Out</a></li>
        </ul>
      </li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>