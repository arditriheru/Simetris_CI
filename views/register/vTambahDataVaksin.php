<body>

  <div id="wrapper">

    <div id="page-wrapper">

      <div class="row">
        <div class="col-lg-12">
          <h1><?php echo $title ?> <small> <?php echo $subtitle ?></small></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('register/dahboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-plus"></i> <?php echo $title ?></li>
          </ol>

          <?php $this->load->view('templates/welcome') ?>
          <?php echo $this->session->flashdata('alert') ?>

        </div>
      </div>

      <?php if($id==1){ ?>
        <div class="row">
          <form method="post" action="<?php echo base_url('register/dataVaksin/filterDataVaksinAksi/'.$id) ?>" role="form">
            <div class="col-lg-4">
              <div class="form-group">
                <label>Nomor Rekam Medik</label>
                <input class="form-control" type="text" name="id_catatan_medik" placeholder="Pencarian.." required="">
              </div>
            </div>
            <div class="col-lg-2"><br>
              <button type="submit" class="btn btn-success">Tampilkan</button>
            </div>
          </form>
          <form method="post" action="<?php echo base_url('register/dataVaksin/filterDataVaksinAksi/'.$id) ?>" role="form">
            <div class="col-lg-2">
              <div class="form-group">
                <label>Bulan</label>
                <select class="form-control" type="text" name="bln"required="">
                  <option value="">Pilih</option>
                  <option value="1">Januari</option>
                  <option value="2">Februari</option>
                  <option value="3">Maret</option>
                  <option value="4">April</option>
                  <option value="5">Mei</option>
                  <option value="6">Juni</option>
                  <option value="7">Juli</option>
                  <option value="8">Agustus</option>
                  <option value="9">September</option>
                  <option value="10">Oktober</option>
                  <option value="11">November</option>
                  <option value="12">Desember</option>
                </select>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="form-group">
                <label>Tahun</label>
                <input class="form-control" type="number" name="thn" placeholder="Contoh : <?php echo getYearNow(); ?>" required="">
              </div>
            </div>
            <div class="col-lg-2"><br>
              <button type="submit" class="btn btn-success">Tampilkan</button>
            </div>
          </form>
        </div>

        <?php
        if(isset($value)){ ?>

          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped tablesorter">
                  <thead>
                    <tr>
                      <th class="text-center">No.RM</th>
                      <th class="text-center">Nama Pasien</th>
                      <th class="text-center">Dokter</th>
                      <th class="text-center">Vaksin</th>
                      <th class="text-center">Tanggal / Jam</th>
                      <th class="text-center">Keterangan</th>
                      <th class="text-center" colspan="3">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data as $d) : ?>
                      <tr>
                        <td class="text-center"><?php echo $d->id_catatan_medik; ?></td>
                        <td class="text-center"><?php echo $d->nama_pasien; ?></td>
                        <td class="text-center"><?php echo $d->nama_dokter; ?></td>
                        <td class="text-center"><?php echo substr($d->nama_vaksin,7); ?></td>
                        <td class="text-center"><?php echo formatDateIndo($d->tanggal).' / '.$d->jam; ?></td>
                        <td class="text-center"><?php echo $d->keterangan; ?></td>
                        <td class="text-center">              
                          <a href="<?php echo base_url('register/dataVaksin/deleteDataVaksin/'.$d->id_vaksin_register) ?>" onclick="javascript: return confirm('Anda yakin hapus?')"><button type="button" class="btn btn-danger"><i class='fa fa-trash'></i></button></a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>

              <?php } }else{ ?>

                <div class="col-lg-6">
                  <form method="post" action="<?php echo base_url('register/dataVaksin/tambahDataVaksinAksi/'.$id) ?>" role="form">
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
                      <label>Tanggal Lahir</label>
                      <input class="form-control" type="text" id="tgl_lahir" placeholder="Tanggal Lahir (otomatis)" readonly>
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
                      <label>Vaksin</label>
                      <select class="form-control" type="text" name="kode_vaksin" required="">
                        <option value="">Pilih</option>
                        <?php foreach($datavaksin as $d): ?>
                          <option value="<?php echo $d->no_urut ?>"><?php echo substr($d->nama,7); ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Keterangan</label>
                      <input class="form-control" type="text" name="keterangan" placeholder="Masukkan.." required="">
                    </div>
                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                  </form>
                </div>

                <datalist id="data_mahasiswa">
                  <?php
                  foreach ($record->result() as $b)
                  {
                    echo "<option value='$b->id_catatan_medik'>$b->nama.$b->tgl_lahir</option>";
                  }
                  ?>

                </datalist>   
                <script>
                  function autofill(){
                    var id_catatan_medik =document.getElementById('id_catatan_medik').value;
                    $.ajax({
                      url:"<?php echo base_url('register/dataVaksin/cari'); ?>",
                      data:'&id_catatan_medik='+id_catatan_medik,
                      success:function(data){
                       var hasil = JSON.parse(data);  

                       $.each(hasil, function(key,val){ 

                         document.getElementById('id_catatan_medik').value=val.id_catatan_medik;
                         document.getElementById('nama').value=val.nama;
                         document.getElementById('tgl_lahir').value=val.tgl_lahir;
                       });
                     }
                   });

                  }
                </script>

              <?php } ?>

            </div>
          </div>
        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->

      <!--</div> /#wrapper -->
