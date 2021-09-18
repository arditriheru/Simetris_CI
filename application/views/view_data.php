<script src="<?php echo base_url(); ?>assets/ajax.js"></script>
<form autocomplete="off">
  <h1>Contoh Autocomplete</h1>
  <div>
    <label>id_catatan_medik</label><br>
    <input list="data_mahasiswa" type="text" name="id_catatan_medik" id="id_catatan_medik" placeholder="id_catatan_medik / nama" onkeyup="autofill();">
  </div>
  <div>
    <label>NAMA</label><br>
    <input type="text" name="nama" id="nama">
  </div>
  <div>
    <label>ALAMAT</label><br>
    <textarea name="alamat" id="alamat">

    </textarea>
  </div>
  <div>
    <label>No Telp</label><br>
    <input type="text" name="telp" id="telp">        
  </div>
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
      url:"<?php echo base_url('autocomplete/cari');?>",
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