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
          <?php $this->load->view('templates/welcome') ?>
          <?php echo $this->session->flashdata('alert') ?>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <form method="get" action="<?php echo base_url('booking/dataWhatsapp') ?>" role="form">
            <?php
            if(isset($wa)){ ?>

              <div class="form-group">
                <label>Nomor WhatsApp</label>
                <input class="form-control" type="number" name="wa" value="<?php echo $wa; ?>">
              </div>
              <button type="submit" class="btn btn-success">Submit</button>
              <a href="https://api.whatsapp.com/send?phone=62<?php echo substr($wa,1); ?>" target="_blank">
                <button type="button" class="btn btn-primary">Chat Sekarang</button>
              </a>

            <?php }else{ ?>

              <div class="form-group">
                <label>Nomor WhatsApp</label>
                <input class="form-control" type="number" name="wa" placeholder="Contoh : 089629671717">
              </div>
              <button type="submit" class="btn btn-success">Submit</button>
              
            <?php } ?>
          </form>
        </div>
      </div><!-- /.row -->

    </div><!-- /#page-wrapper -->

    <!--</div> /#wrapper -->
