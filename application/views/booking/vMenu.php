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
    <a href="https://instagram.com/arditriheru" class="navbar-brand" target="_blank"><strong>SIMETRIS </strong><small>BOOKING</small></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
      <li><a href="<?php echo base_url('booking/dataBooking') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url('booking/dataBooking/dataRegister') ?>"><i class="fa fa-check-square-o"></i> Hari Ini</a></li>
      <li><a href="<?php echo base_url('covid/dataSwab') ?>"><i class="fa fa-check-square-o"></i> Antigen</a></li>

      <?php if($this->session->userdata('booking_akses')=='Admin'){ ?>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-plus"></i> Poliklinik <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo base_url('booking/dataBooking/tambahDataPoli/1') ?>">Lihat</a></li>
              <li><a href="<?php echo base_url('booking/dataBooking/tambahDataPoli/2') ?>">Tambah</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-plus"></i> Tumbuh Kembang <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url('booking/dataBooking/tambahDataTumbang/1') ?>">Lihat</a></li>
                <li><a href="<?php echo base_url('booking/dataBooking/tambahDataTumbang/2') ?>">Tambah</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-plus"></i> Antenatal Care <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url('booking/dataBooking/tambahDataAnc/1') ?>">Lihat</a></li>
                  <li><a href="<?php echo base_url('booking/dataBooking/tambahDataAnc/2') ?>">Tambah</a></li>
                </ul>
              </li>

            <?php } ?>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-calendar-check-o"></i> Jadwal Dokter <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url('booking/dataJadwal') ?>">Lihat</a></li>

                  <?php if($this->session->userdata('booking_akses')=="Admin"){ ?>

                    <li><a href="<?php echo base_url('booking/dataJadwal/tambahDataJadwal/2') ?>">Tambah</a></li>

                  <?php } ?>

                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i> Bell Antrian <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url('booking/dataAntrian/filterDataAntrian/1') ?>">Mulai</a></li>
                    <li><a href="<?php echo base_url('booking/dataAntrian/filterDataAntrian/2') ?>">Rekap Data</a></li>
                  </ul>
                </li>
                <li>
                  <a href="<?php echo base_url('booking/dataWhatsapp') ?>">
                    <i class="fa fa-whatsapp"></i> WhatsApp
                  </a>
                </li>
                <li>
                  <a href="<?php echo base_url('booking/dataSkrining') ?>">
                    <i class="fa fa-pencil-square-o"></i> Skrining
                  </a>
                </li>

                <?php if($this->session->userdata('booking_akses')=="Admin"){ ?>

                  <li>
                    <a href="<?php echo base_url('booking/dataPetugas') ?>">
                      <i class="fa fa-user-md"></i> Petugas Medis
                    </a>
                  </li>

                <?php } ?>

                <li>
                  <a href="<?php echo base_url('booking/dataKamar') ?>">
                    <i class="fa fa-bed"></i> Info Kamar
                  </a>
                </li>
                <li>
                  <a href="<?php echo base_url('booking/dataBooking/dataRedZone') ?>">
                    <i class="fa fa-warning"></i> Zona Merah
                  </a>
                </li>
                <li>
                  <a href="<?php echo base_url('booking/dataBooking/dataRedZone') ?>">
                    <i class="fa fa-file-text-o"></i> Laporan
                  </a>
                </li>
                <li>-<br><br></li>
              </ul>
              <ul class="nav navbar-nav navbar-right navbar-user">
                <li>
                  <a href="https://instagram.com/arditriheru" target="_blank">
                    <span class="label label-success">ONLINE</span>
                  </a>
                </li>
                <li class="dropdown user-dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle"></i> <?php echo $this->session->userdata('booking_akses').' / '.$this->session->userdata('booking_nama_petugas'); ?> <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url('booking/login/logout') ?>"><i class="fa fa-power-off"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </nav>