<body>

  <div id="wrapper">

    <div id="page-wrapper">

      <div class="row">
        <div class="col-lg-12">
          <h1><?php echo $title ?> <small><?php echo $subtitle ?></small></h1>
          <ol class="breadcrumb">
            <li class="active"><i class="fa fa-dashboard"></i> <?php echo $title ?></li>
          </ol>
          
          <?php $this->load->view('templates/welcome') ?>
          <?php echo $this->session->flashdata('alert') ?>

          <div align="left" class="col-lg-6">

           <?php if($value==1) { ?>

            <div class="btn-group">
              <button type="button" class="btn btn-primary">Per Dokter</button>
              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <?php foreach ($datadokter as $d) : ?>

                  <li><a href="<?php echo base_url('hpl/dataHpl/tabDataHpl/1/'.$d->id_dokter) ?>"><?php echo $d->nama_dokter ?></a></li>

                <?php endforeach; ?>
              </ul>
            </div>

          <?php }else{ ?>

           <div class="btn-group">
            <button type="button" class="btn btn-primary">Per Bulan</button>
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <?php foreach ($databulan as $d) : ?>

                <li><a href="<?php echo base_url('hpl/dataHpl/tabDataHpl/2/'.$d->id_bulan) ?>"><?php echo getYearNow()." ".$d->nama_bulan ?></a></li>

              <?php endforeach; ?>
            </ul>
          </div>

        <?php }  ?>

      </div>

      <div align="right" class="col-lg-6">
        <h1><small>Total <?php echo $totalDataHplTab ?> Pasien</small></h1>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped tablesorter">
          <thead>
            <tr>
              <th class="text-center">#</i></th>
              <th class="text-center">No.RM</i></th>
              <th class="text-center">Nama Pasien</i></th>
              <th class="text-center">Kontak</i></th>
              <th class="text-center">Dokter</i></th>
              <th class="text-center">Prakiraan HPL</i></th>
              <th class="text-center" colspan="3">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($dataHplTab as $d) : ?>
            <tr>
              <td class="text-center"><?php echo $no++; ?></td>
              <td class="text-center"><?php echo $d->id_catatan_medik; ?></td>
              <td class="text-center"><?php echo $d->nama; ?></td>
              <td class="text-center"><?php echo $d->telp; ?></td>
              <td class="text-center"><?php echo $d->nama_dokter; ?></td>
              <td class="text-center"><?php echo date('d F Y', strtotime($d->tgl_hpl)); ?></td>
              <!-- <td class="text-center">              
                <a href="<?php echo base_url('hpl/dataHpl/detailDataHpl/'.$d->id_hpl_register) ?>"><button type="button" class="btn btn-warning"><i class='fa fa-folder-open'></i></button></a>
              </td> -->
              <td>
                <div align="center">
                  <a href="https://api.whatsapp.com/send?phone=62<?php echo substr($d->telp,1) ?>" target="_blank">
                    <button type="button" class="btn btn-success"><i class='fa fa-whatsapp'></i> Chat</button></a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div><!-- /.row -->

</div><!-- /#page-wrapper -->

<!--</div> /#wrapper -->
