
<body>

	<div class="container">
		<a class="noprint"><button class="btn btn-danger" type="button" onclick="windowClose();">Tutup</button></a>
		<div class="row">
			<div class="col-xs-12">
				<div align="center" class="invoice-title">
					<img class="img-responsive" src="<?php echo base_url('assets/images/Kop Surat Laboratorium.jpg') ?>" width="90%" alt="Kop Surat Laboratorium"><br>
					<u><b>RINCIAN PEMERIKSAAN LABORATORIUM</b></u>
				</div><br>

				<div class="row">
					<div class="col-xs-6">
						<address>
							<p><strong>Nomor RM: </strong><?php echo $id_catatan_medik; ?><br>
								<strong>Nama Pasien: </strong><?php echo $nama_pasien; ?><br>
								<strong>Gender: </strong><?php echo $nama_sex; ?><br>
								<strong>Tgl Lahir: </strong><?php echo formatDateIndo($tgl_lahir)." (".getAge($tgl_lahir).")"; ?>
							</p>
						</address>
					</div>
					<div class="col-xs-6 text-right">
						<address>
							<p><strong>Pengirim:</strong><br>
								<?php echo $nama_dokter; ?><br><br>
								<!-- <strong>Pemeriksaan:</strong><br>
									<small><?php echo formatDateIndo($tgl_kunj).' / '.$jam_kunj; ?></small> -->
							</p>
						</address>
					</div>
				</div>

			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>Rincian Pemeriksaan</strong></h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr>
										<td class="text-center"><strong>Tanggal</strong></td>
										<td><strong>Nama Pemeriksaan</strong></td>
										<td class="text-center"><strong>Qty</strong></td>
										<td class="text-center"><strong>Tarif (Rp)</strong></td>
										<td class="text-center"><strong>Diskon (%)</strong></td>
										<td class="text-right"><strong>Sub Total</strong></td>
									</tr>
								</thead>
								<tbody>

									<?php
									$no = 1; $grandtotal = 0; foreach ($data as $d):

									if(isset($d->diskon)){
										$diskon = $d->tarif*$d->qty*$d->diskon/100;
									}else{
										$diskon = 0;
									}

									$subtotal = $d->tarif*$d->qty-$diskon;
									$grandtotal += $subtotal;

									?>

									<tr>
										<td class="text-center"><p><?php echo date('d/m/Y', strtotime($d->tgl_kunj)); ?></p></td>
										<td class="text-left"><p><?php echo $d->pemeriksaan; ?></p></td>
										<td class="text-center"><p><?php echo $d->qty; ?></p></td>
										<td class="text-center"><p><?php echo number_format($d->tarif,0,",","."); ?></p></td>
										<td class="text-center">
											<p>
												<?php
												if(isset($d->diskon)){
													echo $d->diskon;
												}else{
													echo "0";
												} ?>
											</p>
										</td>
										<td class="text-right"><p><?php echo number_format($subtotal,0,",","."); ?></p></td>
									</tr>

								<?php endforeach; ?>

								<tr>
									<td class="no-line"></td>
									<td class="no-line"></td>
									<td class="no-line"></td>
									<td class="no-line"></td>
									<td class="no-line text-center"><strong>Grand Total</strong></td>
									<td class="no-line text-right"><large><b><?php echo "Rp".number_format($grandtotal,0,",","."); ?></b></large></td>
								</tr>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="text-right">
				<p><small>Printed : <?php echo getdateindo()." / ".gettimenow() ?></small></p>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<table class="table table-condensed">
				<tbody>
					<tr>
						<td class="text-right">
							<p>Yogyakarta, <?php echo getDateIndo(); ?><br><strong>Petugas,</strong></p><br><br><br>
							<p><?php echo ucfirst($this->session->userdata('laboratorium_nama_petugas')); ?><br><small><u>Unit Laboratorium</u></small></p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>