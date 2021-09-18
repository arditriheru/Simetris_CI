<body>

	<div id="wrapper">

		<div id="page-wrapper">

			<div class="row">
				<div class="col-lg-12">
					<h1><?php echo $title ?> <small><?php echo getDateIndo() ?></small></h1>
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
					</ol>
					<?php $this->load->view('templates/welcome') ?>
					<?php echo $this->session->flashdata('alert') ?>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<ul class="nav nav-pills" style="margin-bottom: 15px;">
						<li class="active"><a href="#1" data-toggle="tab">Poliklinik</a></li>
						<li><a href="#2" data-toggle="tab">Tumbuh Kembang</a></li>
						<li><a href="#3" data-toggle="tab">Antenatal Care</a></li>
					</ul>
				</div>
			</div>

			<div id="myTabContent" class="tab-content">

				<div class="tab-pane fade active in" id="1">

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
						<div align="right" class="col-lg-6">
							<h1><small>Total <?php echo $totaldatapoli ?> Pasien</small></h1>
						</div>
					</div>

					<div class="row">
						<div align="right" class="col-lg-12">
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
										<?php
										$no = 1; foreach ($poli as $d) : ?>

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

												<?php if($this->session->userdata('booking_akses')=='Admin'){ ?>

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

													<?php }elseif($this->session->userdata('booking_akses')=='Operator') { ?>

														<?php if($d->status == 'Datang') {?>
															<td class="text-center">							
																<a href="#"><button type="button" class="btn btn-primary"><i class='fa fa-check'></i></button></a>
															</td>
														<?php }else{ ?>
															<td class="text-center">
																<a href="#"><button type="button" class="btn btn-danger"><i class='fa fa-times'></i></button></a>
															</td>
														<?php } ?>
														<td class="text-center">							
															<a href="<?php echo base_url('booking/dataBooking/detailDataPoli/'.$d->id_booking) ?>"><button type="button" class="btn btn-warning"><i class='fa fa-folder-open'></i></button></a>
														</td>

													<?php } ?>

												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

					<div class="tab-pane fade in" id="2">

						<div class="row">
							<div align="left" class="col-lg-6">
								<form method="post" action="laporan-booking-hari-ini-export.php" role="form">
									<div class="btn-group">
										<button type="button" class="btn btn-warning">Petugas</button>
										<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
											<span class="caret"></span>
										</button>
										<ul class="dropdown-menu">
											<li disabled selected><a>All</a></li>
											<?php foreach($doktertumbang as $d): ?>
												<li><a href="<?php //echo base_url('booking/dataBooking/datangData/'.$d->id_petugas) ?>"><?php echo $d->nama_petugas ?></a></li>
											<?php endforeach; ?>
										</ul>
									</div><!-- /btn-group -->
								</form>
							</div>
							<div align="right" class="col-lg-6">
								<h1><small>Total <?php echo $totaldatatumbang ?> Pasien</small></h1>
							</div>
						</div>

						<div class="row">
							<div align="right" class="col-lg-12">
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
											<?php $no = 1; foreach ($tumbang as $d) : ?>
											<tr>
												<td class="text-center"><?php echo $no++; ?></td>
												<td class="text-center"><?php echo $d->id_catatan_medik;
												?></td>
												<td class="text-center"><?php echo $d->nama;
												?></td>
												<td class="text-center"><?php echo $d->nama_petugas;
												?></td>
												<td class="text-center"><?php echo $d->nama_sesi;
												?></td>
												<td class="text-center"><?php echo $d->keterangan;
												?></td>
												<?php if($d->status == 'Datang') {?>
													<td class="text-center">							
														<a href="<?php echo base_url('booking/dataBooking/ubahBelumDatangTumbang/'.$d->id_tumbang) ?>"><button type="button" class="btn btn-primary"><i class='fa fa-check'></i></button></a>
													</td>
												<?php }else{ ?>
													<td class="text-center">							
														<a href="<?php echo base_url('booking/dataBooking/ubahDatangTumbang/'.$d->id_tumbang) ?>"><button type="button" class="btn btn-danger"><i class='fa fa-times'></i></button></a>
													</td>
												<?php } ?>
												<td class="text-center">							
													<a href="<?php echo base_url('booking/dataBooking/detailDataTumbang/'.$d->id_tumbang) ?>"><button type="button" class="btn btn-warning"><i class='fa fa-folder-open'></i></button></a>
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
							</div>
						</div>
					</div>

					<div class="tab-pane fade in" id="3">

						<div class="row">
							<div align="left" class="col-lg-6">
								<form method="post" action="laporan-booking-hari-ini-export.php" role="form">
									<div class="btn-group">
										<button type="button" class="btn btn-warning">Petugas</button>
										<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
											<span class="caret"></span>
										</button>
										<ul class="dropdown-menu">
											<li disabled selected><a>All</a></li>
											<?php foreach($dokteranc as $d): ?>
												<li><a href="<?php //echo base_url('booking/dataBooking/datangData/'.$d->id_petugas) ?>"><?php echo $d->nama_petugas ?></a></li>
											<?php endforeach; ?>
										</ul>
									</div><!-- /btn-group -->
								</form>
							</div>
							<div align="right" class="col-lg-6">
								<h1><small>Total <?php echo $totaldataanc ?> Pasien</small></h1>
							</div>
						</div>

						<div class="row">
							<div align="right" class="col-lg-12">
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
											<?php $no = 1; foreach ($anc as $d) : ?>
											<tr>
												<td class="text-center"><?php echo $no++; ?></td>
												<td class="text-center"><?php echo $d->id_catatan_medik;
												?></td>
												<td class="text-center"><?php echo $d->nama;
												?></td>
												<td class="text-center"><?php echo $d->nama_petugas;
												?></td>
												<td class="text-center"><?php echo $d->nama_sesi;
												?></td>
												<td class="text-center"><?php echo $d->keterangan;
												?></td>
												<?php if($d->status == 'Datang') {?>
													<td class="text-center">							
														<a href="<?php echo base_url('booking/dataBooking/ubahBelumDatangAnc/'.$d->id_anc) ?>"><button type="button" class="btn btn-primary"><i class='fa fa-check'></i></button></a>
													</td>
												<?php }else{ ?>
													<td class="text-center">							
														<a href="<?php echo base_url('booking/dataBooking/ubahDatangAnc/'.$d->id_anc) ?>"><button type="button" class="btn btn-danger"><i class='fa fa-times'></i></button></a>
													</td>
												<?php } ?>
												<td class="text-center">							
													<a href="<?php echo base_url('booking/dataBooking/detailDataAnc/'.$d->id_anc) ?>"><button type="button" class="btn btn-warning"><i class='fa fa-folder-open'></i></button></a>
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
							</div>
						</div>
					</div>

				</div><!-- content -->
			</div>
		</div><!-- /.row -->

	</div><!-- /#page-wrapper -->

	<!--</div> /#wrapper -->
