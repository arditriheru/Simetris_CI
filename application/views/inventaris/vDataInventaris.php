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

          <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped tablesorter">
              <thead>
                <tr>
                  <th class="text-center">#</i></th>
                  <th class="text-center">Nomor Inventaris</i></th>
                  <th class="text-center">Nama Barang</i></th>
                  <th class="text-center">Jenis</i></th>
                  <th class="text-center">Ruangan</i></th>
                  <th class="text-center" colspan="3">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = $total; foreach ($data as $d) : ?>
                <tr class="active">
                  <td class="text-center"><?php echo $no--; ?></td>
                  <td class="text-center"><?php echo $d->nomor_inventaris; ?></td>
                  <td class="text-center"><?php echo $d->nama_barang; ?></td>
                  <td class="text-center"><?php echo $d->nama_jenis; ?></td>
                  <td class="text-center"><?php echo $d->nama_ruangan; ?></td>
                  <td class="text-center">              
                    <a href="<?php echo base_url('inventaris/dataInventaris/detailDataInventaris/'.$d->kode_registrasi) ?>">
                      <button type="button" class="btn btn-warning"><i class='fa fa-folder-open'></i></button></a>
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
