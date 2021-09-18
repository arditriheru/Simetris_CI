<body>

  <div id="wrapper">

    <div id="page-wrapper">

      <div class="row">
        <div class="col-lg-12">
          <h1><?php echo $title ?> <small><?php echo getDateIndo(); ?></small></h1>
          <ol class="breadcrumb">
            <li class="active"><i class="fa fa-dashboard"></i> <?php echo $title ?></li>
          </ol>
        </div>
      </div><!-- /.row -->

      <div class="row">
        <div class="col-lg-12">
          <?php $this->load->view('templates/welcome') ?>
          <?php echo $this->session->flashdata('alert') ?>
        </div>
      </div><!-- /.row -->

      <div class="row">
        <div class="col-lg-12">
          <img class="img-responsive" src="<?php echo base_url('assets/images/image-lab.jpg') ?>" width="100%" alt="">
        </div>
      </div><!-- /.row -->

    </div><!-- /#page-wrapper -->

    <!--</div> /#wrapper -->
