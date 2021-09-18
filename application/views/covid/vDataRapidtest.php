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

				<div class="col-lg-12">

					<?php if($this->session->userdata('covid_akses') =='Operator') { ?>

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
									<th class="text-center">Registrasi</i></th>
									<?php if($this->session->userdata('covid_akses') =='Admin') { ?>
										<th class="text-center" colspan="3">Action</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php $no = $totaldata; foreach ($rapidtest as $d) : ?>
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
									<td class="text-center"><?php echo $d->tanggal.' / '.$d->jam;
									?></td>
									<?php if($this->session->userdata('covid_akses') =='Admin') { ?>
										<td class="text-center">							
											<a href="<?php echo base_url('covid/dataRapidtest/printData/'.$d->id_rapidtest) ?>"><button type="button" class="btn btn-primary"><i class='fa fa-print'></i></button></a>
										</td>
										<td class="text-center">							
											<a href="<?php echo base_url('covid/dataRapidtest/updateData/'.$d->id_rapidtest) ?>"><button type="button" class="btn btn-warning"><i class='fa fa-edit'></i></button></a>
										</td>
										<td class="text-center">							
											<a href="<?php echo base_url('covid/dataRapidtest/deleteData/'.$d->id_rapidtest) ?>"
												onclick="javascript: return confirm('Anda yakin hapus?')">
												<button type="button" class="btn btn-danger"><i class='fa fa-trash'></i></button></a>
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
