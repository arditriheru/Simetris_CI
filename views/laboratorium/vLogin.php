<header>
  <!-- Page Specific CSS -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/css/style.css">
</header>

<style type="text/css">
  body {
    background-color: #eeeded;
  }
</style>

<body>

  <div class="login_box">
    <div align="center">
      <a href="https://instagram.com/arditriheru">
        <img class="img-responsive" src="<?php echo base_url('assets/images/logo-rskia-rachmi-akreditasi.jpg') ?>" width="70%" height="auto" alt="Author Ardi Tri Heru Hatmoko / arditriheruh@gmail.com"></a><!-- <i class="fa fa-user-circle-o fa-3x"></i> -->
      </div><br>
      <?php echo $this->session->flashdata('alert') ?>
      <form method="post" action="<?php echo base_url('laboratorium/Login/login') ?>" role="form">
       <input type="hidden" name="id_aplikasi" value="5">
       <input type="text" name="username" class="login_form" placeholder="Username" required>
       <input type="password" name="password" class="login_form" placeholder="Password" required>
       <input type="submit" class="login_submit" name="login" value="Login">
       <br><br>      
     </form>
     <a href="<?php echo base_url() ?>"><i class="fa fa-arrow-left"></i> Back</a>
   </div>