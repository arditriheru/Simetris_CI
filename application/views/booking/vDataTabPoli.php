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
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <ul class="nav nav-pills" style="margin-bottom: 15px;">
            <li class="active"><a href="#0" data-toggle="tab">Semua</a></li>
            <li><a href="#1" data-toggle="tab">Pagi</a></li>
            <li><a href="#2" data-toggle="tab">Siang</a></li>
            <li><a href="#3" data-toggle="tab">Sore</a></li>
            <li><a href="#4" data-toggle="tab">Malam</a></li>
          </ul>
        </div>
      </div>

      <div class="row">
        <div align="left" class="col-lg-6">
          <form method="post" action="laporan-booking-hari-ini-export.php" role="form">
            <div class="btn-group">
              <button type="button" class="btn btn-warning">Dokter</button>
              <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li disabled selected><a>All</a></li>
                <?php foreach($dokterpoli as $d): ?>
                  <li><a href="<?php echo base_url('booking/dataBooking/tabDataPoli/'.$d->id_dokter) ?>"><?php echo $d->nama_dokter ?></a></li>
                <?php endforeach; ?>
              </ul>
            </div><!-- /btn-group -->
          </form>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div id="myTabContent" class="tab-content">

            <!-- tab0 -->
            <div class="tab-pane fade active in" id="0">
              <div align="right" class="col-lg-12">
                <h1><small>Total <?php echo $totaldatapoli ?> Pasien</small></h1>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped tablesorter">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">No.RM</th>
                      <th class="text-center">Nama Pasien</th>
                      <th class="text-center">Dokter</th>
                      <th class="text-center">Sesi</th>
                      <th class="text-center">Keterangan</th>
                      <th class="text-center" colspan="3">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; foreach ($poli as $d) : ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo $d->id_catatan_medik;
                      ?></td>
                      <td class="text-center"><?php echo $d->nama;
                      ?></td>
                      <td class="text-center"><?php echo $d->nama_dokter;
                      ?></td>
                      <td class="text-center"><?php echo $d->nama_sesi;
                      ?></td>
                      <td class="text-center"><?php echo $d->keterangan;
                      ?></td>
                      <?php if($d->status == 'Datang') {?>
                        <td class="text-center">              
                          <a href="<?php echo base_url('booking/dataBooking/ubahBelumDatangPoli/'.$d->id_booking) ?>"><button type="button" class="btn btn-primary"><i class='fa fa-check'></i></button></a>
                        </td>
                      <?php }else{ ?>
                        <td class="text-center">              
                          <a href="<?php echo base_url('booking/dataBooking/ubahDatangPoli/'.$d->id_booking) ?>"><button type="button" class="btn btn-danger"><i class='fa fa-times'></i></button></a>
                        </td>
                      <?php } ?>
                      <td class="text-center">              
                        <a href="<?php echo base_url('booking/dataBooking/detailDataPoli/'.$d->id_booking) ?>"><button type="button" class="btn btn-warning"><i class='fa fa-folder-open'></i></button></a>
                      </td>
                      <td>
                        <div align="center">
                          <a href="https://api.whatsapp.com/send?phone=62<?php echo substr($d->kontak,1) ?>" target="_blank">
                            <button type="button" class="btn btn-success"><i class='fa fa-whatsapp'></i> Chat</button></a>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>

            </div><!-- /tab0 -->

            <!-- tab1 -->
            <div class="tab-pane fade in" id="1">
              <div align="right" class="col-lg-12">
                <h1><small>Total <?php echo $totaldatapoli1 ?> Pasien</small></h1>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped tablesorter">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">No.RM</th>
                      <th class="text-center">Nama Pasien</th>
                      <th class="text-center">Dokter</th>
                      <th class="text-center">Sesi</th>
                      <th class="text-center">Keterangan</th>
                      <th class="text-center" colspan="3">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; foreach ($poli1 as $d) : ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo $d->id_catatan_medik;
                      ?></td>
                      <td class="text-center"><?php echo $d->nama;
                      ?></td>
                      <td class="text-center"><?php echo $d->nama_dokter;
                      ?></td>
                      <td class="text-center"><?php echo $d->nama_sesi;
                      ?></td>
                      <td class="text-center"><?php echo $d->keterangan;
                      ?></td>
                      <?php if($d->status == 'Datang') {?>
                        <td class="text-center">              
                          <a href="<?php echo base_url('booking/dataBooking/ubahBelumDatangPoli/'.$d->id_booking) ?>"><button type="button" class="btn btn-primary"><i class='fa fa-check'></i></button></a>
                        </td>
                      <?php }else{ ?>
                        <td class="text-center">              
                          <a href="<?php echo base_url('booking/dataBooking/ubahDatangPoli/'.$d->id_booking) ?>"><button type="button" class="btn btn-danger"><i class='fa fa-times'></i></button></a>
                        </td>
                      <?php } ?>
                      <td class="text-center">              
                        <a href="<?php echo base_url('booking/dataBooking/detailDataPoli/'.$d->id_booking) ?>"><button type="button" class="btn btn-warning"><i class='fa fa-folder-open'></i></button></a>
                      </td>
                      <td>
                        <div align="center">
                          <a href="https://api.whatsapp.com/send?phone=62<?php echo substr($d->kontak,1) ?>" target="_blank">
                            <button type="button" class="btn btn-success"><i class='fa fa-whatsapp'></i> Chat</button></a>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>

            </div><!-- /tab1 -->

            <!-- tab2 -->
            <div class="tab-pane fade in" id="2">
              <div align="right" class="col-lg-12">
                <h1><small>Total <?php echo $totaldatapoli2 ?> Pasien</small></h1>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped tablesorter">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">No.RM</th>
                      <th class="text-center">Nama Pasien</th>
                      <th class="text-center">Dokter</th>
                      <th class="text-center">Sesi</th>
                      <th class="text-center">Keterangan</th>
                      <th class="text-center" colspan="3">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; foreach ($poli2 as $d) : ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo $d->id_catatan_medik;
                      ?></td>
                      <td class="text-center"><?php echo $d->nama;
                      ?></td>
                      <td class="text-center"><?php echo $d->nama_dokter;
                      ?></td>
                      <td class="text-center"><?php echo $d->nama_sesi;
                      ?></td>
                      <td class="text-center"><?php echo $d->keterangan;
                      ?></td>
                      <?php if($d->status == 'Datang') {?>
                        <td class="text-center">              
                          <a href="<?php echo base_url('booking/dataBooking/ubahBelumDatangPoli/'.$d->id_booking) ?>"><button type="button" class="btn btn-primary"><i class='fa fa-check'></i></button></a>
                        </td>
                      <?php }else{ ?>
                        <td class="text-center">              
                          <a href="<?php echo base_url('booking/dataBooking/ubahDatangPoli/'.$d->id_booking) ?>"><button type="button" class="btn btn-danger"><i class='fa fa-times'></i></button></a>
                        </td>
                      <?php } ?>
                      <td class="text-center">              
                        <a href="<?php echo base_url('booking/dataBooking/detailDataPoli/'.$d->id_booking) ?>"><button type="button" class="btn btn-warning"><i class='fa fa-folder-open'></i></button></a>
                      </td>
                      <td>
                        <div align="center">
                          <a href="https://api.whatsapp.com/send?phone=62<?php echo substr($d->kontak,1) ?>" target="_blank">
                            <button type="button" class="btn btn-success"><i class='fa fa-whatsapp'></i> Chat</button></a>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>

            </div><!-- /tab2 -->

            <!-- tab3 -->
            <div class="tab-pane fade in" id="3">
              <div align="right" class="col-lg-12">
                <h1><small>Total <?php echo $totaldatapoli3 ?> Pasien</small></h1>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped tablesorter">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">No.RM</th>
                      <th class="text-center">Nama Pasien</th>
                      <th class="text-center">Dokter</th>
                      <th class="text-center">Sesi</th>
                      <th class="text-center">Keterangan</th>
                      <th class="text-center" colspan="3">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; foreach ($poli3 as $d) : ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo $d->id_catatan_medik;
                      ?></td>
                      <td class="text-center"><?php echo $d->nama;
                      ?></td>
                      <td class="text-center"><?php echo $d->nama_dokter;
                      ?></td>
                      <td class="text-center"><?php echo $d->nama_sesi;
                      ?></td>
                      <td class="text-center"><?php echo $d->keterangan;
                      ?></td>
                      <?php if($d->status == 'Datang') {?>
                        <td class="text-center">              
                          <a href="<?php echo base_url('booking/dataBooking/ubahBelumDatangPoli/'.$d->id_booking) ?>"><button type="button" class="btn btn-primary"><i class='fa fa-check'></i></button></a>
                        </td>
                      <?php }else{ ?>
                        <td class="text-center">              
                          <a href="<?php echo base_url('booking/dataBooking/ubahDatangPoli/'.$d->id_booking) ?>"><button type="button" class="btn btn-danger"><i class='fa fa-times'></i></button></a>
                        </td>
                      <?php } ?>
                      <td class="text-center">              
                        <a href="<?php echo base_url('booking/dataBooking/detailDataPoli/'.$d->id_booking) ?>"><button type="button" class="btn btn-warning"><i class='fa fa-folder-open'></i></button></a>
                      </td>
                      <td>
                        <div align="center">
                          <a href="https://api.whatsapp.com/send?phone=62<?php echo substr($d->kontak,1) ?>" target="_blank">
                            <button type="button" class="btn btn-success"><i class='fa fa-whatsapp'></i> Chat</button></a>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>

            </div><!-- /tab3 -->

            <!-- tab4 -->
            <div class="tab-pane fade in" id="4">
              <div align="right" class="col-lg-12">
                <h1><small>Total <?php echo $totaldatapoli4 ?> Pasien</small></h1>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped tablesorter">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">No.RM</th>
                      <th class="text-center">Nama Pasien</th>
                      <th class="text-center">Dokter</th>
                      <th class="text-center">Sesi</th>
                      <th class="text-center">Keterangan</th>
                      <th class="text-center" colspan="3">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; foreach ($poli4 as $d) : ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo $d->id_catatan_medik;
                      ?></td>
                      <td class="text-center"><?php echo $d->nama;
                      ?></td>
                      <td class="text-center"><?php echo $d->nama_dokter;
                      ?></td>
                      <td class="text-center"><?php echo $d->nama_sesi;
                      ?></td>
                      <td class="text-center"><?php echo $d->keterangan;
                      ?></td>
                      <?php if($d->status == 'Datang') {?>
                        <td class="text-center">              
                          <a href="<?php echo base_url('booking/dataBooking/ubahBelumDatangPoli/'.$d->id_booking) ?>"><button type="button" class="btn btn-primary"><i class='fa fa-check'></i></button></a>
                        </td>
                      <?php }else{ ?>
                        <td class="text-center">              
                          <a href="<?php echo base_url('booking/dataBooking/ubahDatangPoli/'.$d->id_booking) ?>"><button type="button" class="btn btn-danger"><i class='fa fa-times'></i></button></a>
                        </td>
                      <?php } ?>
                      <td class="text-center">              
                        <a href="<?php echo base_url('booking/dataBooking/detailDataPoli/'.$d->id_booking) ?>"><button type="button" class="btn btn-warning"><i class='fa fa-folder-open'></i></button></a>
                      </td>
                      <td>
                        <div align="center">
                          <a href="https://api.whatsapp.com/send?phone=62<?php echo substr($d->kontak,1) ?>" target="_blank">
                            <button type="button" class="btn btn-success"><i class='fa fa-whatsapp'></i> Chat</button></a>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>

            </div><!-- /tab4 -->
            
          </div>
        </div>

      </div><!-- /.row -->

    </div><!-- /#page-wrapper -->

    <!--</div> /#wrapper -->
