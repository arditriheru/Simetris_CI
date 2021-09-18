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
            <a href="<?php echo base_url("inventaris/dataInventaris/excelDataInventaris?$id") ?>"><button type="button" name="button" class="btn btn-primary"><i class="fa fa-download"></i> Export</button></a><br><br>
            <table class="table table-bordered table-hover table-striped tablesorter">
              <thead>
                <tr>
                  <th class="text-center">#</i></th>
                  <th class="text-center">Nomor Inventaris</i></th>
                  <th class="text-center">Nama Barang</i></th>
                  <th class="text-center">Ruangan</i></th>
                  <th class="text-center">Kondisi</i></th>
                  <th class="text-center">Status</i></th>
                  <th class="text-center">Kalibrasi</i></th>
                  <th class="text-center">Re-kalibrasi</i></th>
                  <th class="text-center" colspan="3">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($data as $d) : ?>
                <tr class="active">
                  <td class="text-center"><?php echo $no++; ?></td>
                  <td class="text-center"><?php echo $d->nomor_inventaris; ?></td>
                  <td class="text-center"><?php echo $d->nama_barang; ?></td>
                  <td class="text-center"><?php echo $d->nama_ruangan; ?></td>
                  <td class="text-center"><?php echo $d->nama_kondisi; ?></td>
                  <td class="text-center"><?php echo $d->nama_status; ?></td>
                  <td class="text-center">
                    <?php
                    if($d->tanggal_kalibrasi=="0000-00-00")
                    {
                      echo "-";
                    }else{
                      echo date('d/m/Y', strtotime($d->tanggal_kalibrasi));
                    }
                    ?>
                  </td>
                  <td class="text-center">
                    <?php
                    if($d->kalibrasi_ulang=="0000-00-00")
                    {
                      echo "-";
                    }else{
                      echo date('d/m/Y', strtotime($d->kalibrasi_ulang));
                    }
                    ?>
                  </td>
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
