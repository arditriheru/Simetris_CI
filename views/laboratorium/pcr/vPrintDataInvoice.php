<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $title.' '.$subtitle.' '.$no_inv ?></title>

  <style>
    .fixed-footer {
     font-size: 12px;
     position: fixed;
     left: 0;
     right: 50px;
     bottom: 0;
     width: 98%;
     height: 20px;
     text-align: center;
   }

   div.text-center {
    text-align: center;
  }

  div.text-left {
    text-align: left;
  }

  div.text-right {
    text-align: right;
  } 

  div.text-justify {
    text-align: justify;
  } 

  .invoice-box {
    max-width: 800px;
    margin: auto;
    padding: 10px;
    border: 1px solid #eee;
    box-shadow: 0 0 10px rgba(0, 0, 0, .15);
    font-size: 15px;
    line-height: 18px;
    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    color: #555;
  }

  .invoice-box table {
    width: 100%;
    line-height: inherit;
    text-align: left;
  }

  .invoice-box table td {
    padding: 5px;
    vertical-align: top;
  }

  .invoice-box table tr td:nth-child(2) {
    text-align: right;
  }

  .invoice-box table tr.top table td {
    padding-bottom: 5px;
  }

  .invoice-box table tr.top table td.title {
    font-size: 45px;
    line-height: 45px;
    color: #333;
  }

  .invoice-box table tr.information table td {
    padding-left: 6px;
    padding-bottom: 1px;
    line-height: 16px;
  }

  .invoice-box table tr.heading td {
    background: #eee;
    padding-left: 13px;
    padding-right: 13px;
    border-bottom: 1px solid #ddd;
    font-weight: bold;
  }

  .invoice-box table tr.details td {
    padding-bottom: 20px;
  }

  .invoice-box table tr.item td{
    padding-left: 13px;
    padding-right: 13px;
    border-bottom: 1px solid #eee;
  }

  .invoice-box table tr.item.last td {
    border-bottom: none;
  }

  .invoice-box table tr.total td:nth-child(2) {
    padding-right: 13px;
    border-top: 2px solid #eee;
    font-weight: bold;
  }

  @media only screen and (max-width: 600px) {
    .invoice-box table tr.top table td {
      width: 100%;
      display: block;
      text-align: center;
    }

    .invoice-box table tr.information table td {
      width: 100%;
      display: block;
      text-align: left;
    }
  }

  /** RTL **/
  .rtl {
    direction: rtl;
    font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
  }

  .rtl table {
    text-align: right;
  }

  .rtl table tr td:nth-child(2) {
    text-align: left;
  }
</style>
</head>

<body>
  <?php foreach ($data as $d) :?>
    <div class="invoice-box">
     <table cellpadding="0" cellspacing="0">
      <tr class="top">
        <td>
          <img src="<?php echo base_url('assets/images/header.jpg')?>"/>
        </td>
        <td>
          <h2>#INVOICE</h2>
        </td>
      </tr>
      
      <tr class="top">
        <td colspan="2">
          <table>
            <tr>
             <td>
              <strong>RSKIA Rachmi Yogyakarta</strong><br>
              <small>Jalan KH Wachid Hayim No.47 Ngampilan<br>
                Kota Yogyakarta<br>D.I.Yogyakarta<br>
              (0274) 376717 / (0274) 415316</small>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <tr class="top">
      <td colspan="2">
        <table>
          <tr>
           <td>
            <strong>Pemeriksaan SWAB Antigen</strong><br>
            <small>Registrasi : <?php echo formatDateIndo($d->tanggal); ?><br>
              Jam : <?php echo $d->jam.' WIB'; ?></small>
            </td>
            <td>
              <strong></strong><br>
              <small><strong>DATE :</strong> <?php echo getDateIndo(); ?><br>
                <strong>NO. INVOICE :</strong> <?php echo $no_inv; ?></small>
              </td>
            </tr>
          </table><br>
        </td>
      </tr>

      <tr class="heading">
        <td colspan="2">
          Identitas Pasien
        </td>
      </tr>

      <tr class="information">
        <td colspan="2">
          <table>
            <tr>
             <td>
              <div class="text-left">
                <small>No. Identitas</small>
              </div>
            </td>
            <td>
              <div class="text-left">
                <small><i><?php echo $d->no_identitas ?></i></small>
              </div>
            </td>
            <td>
              <div class="text-left">
                <small>Email</small>
              </div>
            </td>
            <td>
              <div class="text-left">
                <small><i><?php echo $d->email ?></i></small>
              </div>
            </td>
          </tr>
          <tr>
           <td>
            <div class="text-left">
              <small>Nama Pasien</small>
            </div>
          </td>
          <td>
            <div class="text-left">
              <small><i><?php echo $d->nama ?></i></small>
            </div>
          </td>
          <td>
            <div class="text-left">
              <small>Kontak</small>
            </div>
          </td>
          <td>
            <div class="text-left">
              <small><i><?php echo $d->kontak ?></i></small>
            </div>
          </td>
        </tr>
        <tr>
         <td>
          <div class="text-left">
            <small>Tanggal Lahir</small>
          </div>
        </td>
        <td>
          <div class="text-left">
            <small><i><?php echo formatDateIndo($d->tgl_lahir) ?></i></small>
          </div>
        </td>
      </tr>
    </table><br><br>
  </td>
</tr>

<tr class="heading">
  <td>
    Deskripsi
  </td>

  <td>
    Sub Total
  </td>
</tr>

<tr class="item">
  <td>
    Pembayaran : Pemeriksaan SWAB Antigen
  </td>

  <td>
    IDR 250.000
  </td>
</tr>

<tr class="total">
  <td></td>

  <td>
    Total: IDR 250.000
  </td>
</tr>


<tr class="heading">
  <td>
    Status
  </td>
  <td>
    <?php if($d->validasi==0){ ?>
      PENDING
    <?php }else{ ?>
      LUNAS
    <?php } ?>
  </td>
</tr><br><br>
</table>
<div class="fixed-footer"><p><small>SIMETRIS - RSKIA Rachmi Yogyakarta | Printed : <?php echo getDateIndo().' / '.getTimenow(); ?></small></p></div>
</div>
<?php endforeach; ?>
</body>
</html>

<!-- <body>
  <div id="wrapper">

    <div id="page-wrapper">

      <div class="row">
        <div class="col-lg-12">
          <div align="left">
            <img class="img-responsive" src="<?php echo base_url('assets/images/logo-rachmi-akreditasi-kars.png') ?>" width="60%" alt="Kop Surat">
          </div>
        </div><br>
      </div>
      <?php foreach ($data as $d) :?>
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td class="text-center" colspan="2"><b>Pemeriksaan SWAB Antigen</b></td>
                  <td class="text-center" colspan="2"><b>#INVOICE</b></td>
                </tr>
                <tr>
                  <td>Registrasi</td>
                  <td><?php echo formatDateIndo($d->tanggal).' / '.$d->jam; ?></td>
                  <td>DATE</td>
                  <td><?php echo getDateIndo(); ?></td>
                </tr>
                <tr>
                  <td>Tempat</td>
                  <td>RSKIA Rachmi Yogyakarta</td>
                  <td>INVOICE</td>
                  <td><?php echo strtoupper($d->no_invoice); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-lg-12">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td>No. Identitas</td>
                  <td><?php echo $d->no_identitas ?></td>
                  <td>Alamat</td>
                  <td><?php echo strtoupper($d->alamat) ?></td>
                </tr>
                <tr>
                  <td>Nama Pasien</td>
                  <td><?php echo strtoupper($d->nama) ?></td>
                  <td>Email</td>
                  <td><?php echo $d->email ?></td>
                </tr>
                <tr>
                  <td>Tgl. Lahir</td>
                  <td><?php echo formatDateIndo($d->tgl_lahir) ?></td>
                  <td>Kontak</td>
                  <td><?php echo $d->kontak ?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-lg-12">
            <table class="table table-bordered table-hover table-striped tablesorter">
              <thead>
                <tr>
                  <td class="text-center"><b>Deskripsi</b></td>
                  <td class="text-center"><b>Sub Total</b></td>
                </tr>
              </thead>
              <tbody>
               <tr>
                <td class="text-center">Pembayaran : Pemeriksaan SWAB Antigen</td>
                <td class="text-center">IDR250.000</td>
              </tr>
              <tr>
                <td class="text-center"><b>TOTAL</b></td>
                <td class="text-center"><b>IDR250.000</b></td>
              </tr>
              <tr>
                <td colspan="2" class="text-center"><b>LUNAS</b></td>
              </tr>
            </tbody>
            </table><?php endforeach; ?>
            <br><br><br>
            <b>Sekretariat :</b><br>
            <p>Rumah Sakit Khusus Ibu dan Anak Rachmi Yogyakarta<br>
              Jalan KH Wachid Hayim No.47, Ngampilan, Kota Yogyakarta<br>
              D.I.Yogyakarta<br>
            (0274) 376717 / (0274) 415316</p>
          </div>
        </div><!-- /.row -->

        <!-- </div>/#page-wrapper -->

      <!-- </div> /#wrapper  -->