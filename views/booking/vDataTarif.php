<body>

  <div id="wrapper">

    <div id="page-wrapper">

      <div class="row">
        <div class="col-lg-12">
          <h1><?php echo $title ?> <small><?php echo $subtitle ?></small></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('booking/dataBooking') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-plus"></i> <?php echo $title ?></li>
          </ol>
        </div>
      </div>

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
          <a href="https://instagram.com/arditriheru" class="navbar-brand" target="_blank">S I M E T R I S</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li><a href="<?php echo base_url('booking/dataTarif') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url('booking/dataTarif') ?>"><i class="fa fa-check-square-o"></i> Daftar Tarif</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right navbar-user">
            <li>
              <a href="https://instagram.com/arditriheru" target="_blank">
                <span class="label label-success">ONLINE</span>
              </a>
            </li>
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle"></i><b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url('') ?>"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div class="row">
        <div class="col-lg-12">
          <?php $this->load->view('templates/welcome') ?>
          <?php echo $this->session->flashdata('alert') ?>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4">
          <form method="post" action="<?php echo base_url('booking/dataTarif/cariDataTarif/1') ?>" role="form">
            <div class="form-group">
              <label>Tarif Tindakan</label>
              <input class="form-control" type="text" name="keyword" placeholder="Pencarian..">
            </div><button type="submit" class="btn btn-success">Tampilkan</button>
          </form>
        </div>
        <div class="col-lg-4">
          <form method="post" action="<?php echo base_url('booking/dataTarif/cariDataTarif/2') ?>" role="form">
            <div class="form-group">
              <label>Tarif Farmasi</label>
              <input class="form-control" type="text" name="keyword" placeholder="Pencarian..">
            </div><button type="submit" class="btn btn-success">Tampilkan</button>
          </form>
        </div>
        <div class="col-lg-4">
          <form method="post" action="<?php echo base_url('booking/dataTarif/cariDataTarif/3') ?>" role="form">
            <div class="form-group">
              <label>Tarif Laboratorium</label>
              <input class="form-control" type="text" name="keyword" placeholder="Pencarian..">
            </div><button type="submit" class="btn btn-success">Tampilkan</button>
          </form><br>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-8">
          <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped tablesorter">

              <?php if($id==1) { ?>

                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Kode</th>
                    <th class="text-center">Nama Tindakan</th>
                    <th class="text-center">Tarif <small>(Rp)</small></th>
                  </tr>
                </thead>
                <tbody>

                  <?php $no=1; foreach ($datatarif as $d) : ?>

                  <tr>
                    <td class="text-center"><?php echo $no++;?></td>
                    <td class="text-center"><?php echo $d->kode;?></td>
                    <td class="text-center"><?php echo $d->nama;?></td>
                    <td class="text-center"><?php echo number_format($d->tarif);?></td>
                  </tr>

                <?php endforeach; ?>

              </tbody>

            <?php }elseif ($id==2) { ?>

              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Kode</th>
                  <th class="text-center">Nama Obat</th>
                  <th class="text-center">Tarif <small>(Rp)</small></th>
                </tr>
              </thead>
              <tbody>

                <?php $no=1; foreach ($datatarif as $d) : ?>

                <tr>
                  <td class="text-center"><?php echo $no++;?></td>
                  <td class="text-center"><?php echo $d->no_urut;?></td>
                  <td class="text-center"><?php echo $d->nama;?></td>
                  <td class="text-center"><?php echo number_format($d->harga_jual);?></td>
                </tr>

              <?php endforeach; ?>

            </tbody>

          <?php }elseif ($id==3) { ?>

            <thead>
              <tr>
                <th class="text-center">#</th>
                <th class="text-center">Kode</th>
                <th class="text-center">Jenis Pemeriksaan</th>
                <th class="text-center">Tarif <small>(Rp)</small></th>
              </tr>
            </thead>
            <tbody>

              <?php $no=1; foreach ($datatarif as $d) : ?>

              <tr>
                <td class="text-center"><?php echo $no++;?></td>
                <td class="text-center"><?php echo $d->id_lab_tarif;?></td>
                <td class="text-center"><?php echo $d->nama;?></td>
                <td class="text-center"><?php echo number_format($d->tarif);?></td>
              </tr>

            <?php endforeach; ?>

          </tbody>

        <?php } ?>

      </table>
    </div>
  </div>
  
</div><!-- /.row -->

</div><!-- /#page-wrapper -->

<!--</div> /#wrapper -->
