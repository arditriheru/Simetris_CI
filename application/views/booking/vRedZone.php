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

      <div class="row">
        <div class="col-lg-12">
          <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Cara memperbarui daftar zona merah COVID-19 : <b>Copy jpg / jpeg / png terbaru - explorer - network - RACHMI-SVR - folder redzone - paste - rename menjadi redzone - kembali ke simetris - CTRL+F5</b>
          </div>

          <?php echo $this->session->flashdata('alert') ?>

        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <img class="img-responsive" src="<?php echo base_url('assets/images/redzone.jpg') ?>" width="100%">
          <img class="img-responsive" src="<?php echo base_url('assets/images/redzone.jpeg') ?>" width="100%">
          <img class="img-responsive" src="<?php echo base_url('assets/images/redzone.png') ?>" width="100%">
        </div>
      </div><!-- /.row -->

    </div><!-- /#page-wrapper -->

    <!--</div> /#wrapper -->
