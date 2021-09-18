<body>

  <div id="wrapper">

    <div id="page-wrapper">

      <div class="row">
        <div class="col-lg-12">
          <h1><?php echo $title ?> <small> <?php echo $subtitle ?></small></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('covid/dataRapidTest') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-plus"></i> <?php echo $title ?></li>
          </ol>
          <?php $this->load->view('templates/welcome') ?>
          <?php echo $this->session->flashdata('alert') ?>
        </div>
        <div class="col-lg-6">
          <div class="table-responsive">
            <form method="post" action="<?php echo base_url('covid/dataRapidtest/tambahDataAksi') ?>" role="form">
              <div class="form-group">
                <label>Nomor Rekam Medik</label>
                <input class="form-control" type="text" onkeyup="autofill()" id="id_catatan_medik"
                placeholder="Masukkan Nomor Rekam Medik" name="id_catatan_medik" required="">
              </div>
              <div class="form-group">
                <label>Nama</label>
                <input class="form-control" type="text" id="nama" placeholder="Nama Anak (otomatis)" readonly>
              </div>
              <div class="form-group">
                <label>Dokter</label>
                <select class="form-control" type="text" name="id_dokter" required="">
                  <option value="">Pilih</option>
                  <?php foreach($datadokter as $d): ?>
                    <option value="<?php echo $d->id_dokter ?>"><?php echo $d->nama_dokter ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label>Asal Unit</label>
                <select class="form-control" type="text" name="id_unit" required="">
                  <option value="">Pilih</option>
                  <?php foreach($dataunit as $d): ?>
                    <option value="<?php echo $d->id_unit ?>"><?php echo $d->nama_unit ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label>Tanggal Periksa</label>
                <input class="form-control" type="date" name="tgl_periksa" required="">
              </div>
              <div class="form-group">
                <label>Jam Periksa</label>
                <input class="form-control" type="text" name="jam_periksa" required="">
              </div>
              <button type="submit" name="submit" class="btn btn-success">Submit</button>
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
                  url:"<?php echo base_url('covid/dataRapidtest/cari');?>",
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
      </div><!-- /.row -->

    </div><!-- /#page-wrapper -->

    <!--</div> /#wrapper -->
