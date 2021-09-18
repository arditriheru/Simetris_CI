<body>

  <div id="wrapper">

    <div id="page-wrapper">

      <div class="row">
        <div class="col-lg-12">
          <h1><?php echo $title ?> <small> <?php echo $subtitle ?></small></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('laboratorium/dataAntibody') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-plus"></i> <?php echo $title ?></li>
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
        <div class="col-lg-4">
          <div class="panel panel-success">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-6">
                  <i class="fa fa-check fa-5x"></i>
                </div>
                <div class="col-xs-6 text-right">
                  <p class="announcement-heading"><?php echo $nonreaktif ?></p>
                  <p class="announcement-text">Non Reaktif</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="panel panel-warning">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-6">
                  <i class="fa fa-warning fa-5x"></i>
                </div>
                <div class="col-xs-6 text-right">
                  <p class="announcement-heading"><?php echo $igmreaktif ?></p>
                  <p class="announcement-text">IgM Reaktif</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="panel panel-danger">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-6">
                  <i class="fa fa-warning fa-5x"></i>
                </div>
                <div class="col-xs-6 text-right">
                  <p class="announcement-heading"><?php echo $iggreaktif ?></p>
                  <p class="announcement-text">IgG Reaktif</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.row -->

      <div class="row">
        <div class="col-lg-4">
          <div class="table-responsive">
            <form method="post" action="<?php echo base_url('laboratorium/dataAntibody/tambahDataAksi') ?>" role="form">
              <div class="form-group">
                <label>Nomor Rekam Medik</label>
                <input class="form-control" type="text" onkeyup="autofill()" id="id_catatan_medik"
                placeholder="Masukkan Nomor Rekam Medik" name="id_catatan_medik" required="">
              </div>
              <div class="form-group">
                <label>Nama Pasien</label>
                <input class="form-control" type="text" id="nama" placeholder="Nama Anak (otomatis)" readonly>
              </div>
              <div class="form-group">
                <label>Dokter Pengirim</label>
                <select class="form-control" type="text" name="id_dokter" required="">
                  <option value="">Pilih</option>
                  <?php foreach($datadokter as $d): ?>
                    <option value="<?php echo $d->id_dokter ?>"><?php echo $d->nama_dokter ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <button type="submit" name="submit" class="btn btn-success">Tambah</button>
            </form>
            <datalist id="data_mahasiswa">
              <?php
              foreach ($record->result() as $b)
              {
                echo "<option value='$b->id_catatan_medik'>$b->nama</option>";
              }
              ?>

            </datalist>   
            <script>
              function autofill(){
                var id_catatan_medik =document.getElementById('id_catatan_medik').value;
                $.ajax({
                  url:"<?php echo base_url('laboratorium/dataAntibody/cari');?>",
                  data:'&id_catatan_medik='+id_catatan_medik,
                  success:function(data){
                   var hasil = JSON.parse(data);  

                   $.each(hasil, function(key,val){ 

                     document.getElementById('id_catatan_medik').value=val.id_catatan_medik;
                     document.getElementById('nama').value=val.nama;
                     document.getElementById('alamat').value=val.alamat;
                     document.getElementById('telp').value=val.telp;  


                   });
                 }
               });

              }
            </script>
          </div>
        </div>

        <div class="col-lg-8">
         <?php if($this->session->userdata('laboratorium_akses') =='Operator') { ?>

          <button name="next" type="submit" 
          class="btn btn-primary" onClick="window.location.reload()"><i class="fa fa-refresh"></i> Refresh</button><br><br>

        <?php } ?>
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped tablesorter">
            <thead>
              <tr>
                <th class="text-center">#</i></th>
                <th class="text-center">No.RM</i></th>
                <th class="text-center">Nama Pasien</i></th>
                <th class="text-center">Dokter</i></th>
                <th class="text-center">IgM</i></th>
                <th class="text-center">IgG</i></th>
                <?php if($this->session->userdata('laboratorium_akses') =='Admin') { ?>
                  <th class="text-center" colspan="3">Action</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php $no = $totaldata; foreach ($antibody as $d) : ?>
              <tr>
                <td class="text-center"><?php echo $no--; ?></td>
                <td class="text-center"><?php echo $d->id_catatan_medik ?></td>
                <td class="text-center"><?php echo $d->nama ?></td>
                <td class="text-center"><?php echo $d->nama_dokter ?></td>
                <?php 
                if($d->igm==1){
                  echo '<td class="text-center link-danger"><p class="text-danger">'.$d->nama_igm.'</p></td>';
                }else{
                  echo '<td class="text-center">'.$d->nama_igm.'</td>';
                }
                ?>
                <?php 
                if($d->igg==1){
                  echo '<td class="text-center link-danger"><p class="text-danger">'.$d->nama_igg.'</p></td>';
                }else{
                  echo '<td class="text-center">'.$d->nama_igg.'</td>';
                }
                ?>
                <?php if($this->session->userdata('laboratorium_akses') =='Admin') { ?>
                  <td class="text-center">              
                    <a href="<?php echo base_url('laboratorium/dataAntibody/printData/'.$d->id_test_antibody) ?>" target="_blank"><button type="button" class="btn btn-primary"><i class='fa fa-print'></i></button></a>
                  </td>
                  <td class="text-center">              
                    <a href="<?php echo base_url('laboratorium/dataAntibody/updateData/'.$d->id_test_antibody) ?>"><button type="button" class="btn btn-warning"><i class='fa fa-edit'></i></button></a>
                  </td>
                <?php } ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div><!-- /.row -->

</div><!-- /#page-wrapper -->

<!--</div> /#wrapper -->
