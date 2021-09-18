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
          <?php $this->load->view('templates/welcome') ?>
          <?php echo $this->session->flashdata('alert') ?>

        </div>

        <div class="col-lg-6">
          <?php foreach ($data as $d) : ?>
            <div align="left" class="col-lg-6">
              <a href="<?php echo base_url('inventaris/dataInventaris/updateDataInventaris/'.$d->kode_registrasi) ?>">
                <button type="button" class="btn btn-success"><i class="fa fa-edit"></i> Edit</button>
              </a>
            </div>
            <div align="right" class="col-lg-6">
              <a href="<?php echo base_url('inventaris/dataInventaris/deleteDataInventaris/'.$d->kode_registrasi) ?>"
                onclick="javascript: return confirm('Anda yakin hapus?')">
                <button type="button" class="btn btn-danger"><i class='fa fa-trash'></i></button></a><br><br>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped tablesorter">
                  <tbody>
                    <tr>
                      <td><b>Nomor Inventaris</b></td>
                      <td><?php echo $d->nomor_inventaris ?></td>
                    </tr>
                    <tr>
                      <td><b>Nama Barang</b></td>
                      <td><?php echo $d->nama_barang ?></td>
                    </tr>
                    <tr>
                      <td><b>Jenis Barang</b></td>
                      <td><?php echo $d->nama_jenis ?></td>
                    </tr>
                    <tr>
                      <td><b>Lokasi Ruangan</b></td>
                      <td><?php echo $d->nama_ruangan ?></td>
                    </tr>
                    <tr>
                      <td><b>Tanggal Pengadaan</b></td>
                      <td><?php echo formatDateIndo($d->tanggal_pengadaan) ?></td>
                    </tr>
                    <tr>
                      <td><b>Kondisi</b></td>
                      <td><?php echo $d->nama_kondisi ?></td>
                    </tr>
                    <tr>
                      <td><b>Status Pembelian</b></td>
                      <td><?php echo $d->nama_status ?></td>
                    </tr>
                    <tr>
                      <td><b>Kalibrasi</b></td>
                      <td>
                        <?php 
                        if($d->tanggal_kalibrasi==0000-00-00)
                        {
                          echo "-";
                        }else{
                          echo formatDateIndo($d->tanggal_kalibrasi);
                        }
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td><b>Kalibrasi Ulang</b></td>
                      <td>
                        <?php 
                        if($d->kalibrasi_ulang==0000-00-00)
                        {
                          echo "-";
                        }else{
                          echo formatDateIndo($d->kalibrasi_ulang);
                        }
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td><b>Keterangan</b></td>
                      <td><?php echo $d->keterangan ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>

        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->

      <!--</div> /#wrapper -->
