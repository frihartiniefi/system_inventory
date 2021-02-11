<div class="col-md-12 p-2 mt-2 p-3 slide-in-right">
	
	<div class="container">
		<div class="row">
			<h5>Laporan Barang Masuk / Keluar</h5>
		</div>
		<div class="row">
			<a href="<?= base_url('dashboard') ?>" class="btn btn-dark"><i class="fas fa-arrow-alt-circle-left"></i> Back to Home</a>
		</div>
	</div>

	<div class="container">
		<?php

		if ($this->session->flashdata('error_message')) {
			echo $this->session->flashdata('error_message');
		}
		
		?>
		<div class="row">
			<div class="col-md-12 holder-table">

				<form method="get" action="<?= base_url('barang/laporan_cek') ?>">
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Pilih Rentang Tanggal <span style="font-size: 10px;color: red;">(Max.7 Hari)</span></label>
						<div class="col-sm-9">
							<input id="datepicker" class="form-control" type="text" name="daterange">
						</div>
					</div>
					<button type="submit" class="btn btn-sm btn-block btn-success">Lihat Laporan</button>
				</form>

				<?php if ($this->uri->segment(2) == 'laporan_cek') { ?>
					<?php 
						parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $range);
						$dt_range = json_encode($range);
						$send_dt = urlencode($dt_range);
					?>
					<a href="<?= base_url('barang/laporan') ?>" class="btn btn-sm btn-dark mt-1" style="width: 100%">Reset</a>
					<div class="container project-tab">
						<div class="row">
							<nav>
								<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
									<a class="nav-item nav-link active" id="nav-masuk-tab" data-toggle="tab" href="#nav-masuk" role="tab" aria-controls="nav-masuk" aria-selected="true">Laporan Barang Masuk</a>
									<a class="nav-item nav-link" id="nav-keluar-tab" data-toggle="tab" href="#nav-keluar" role="tab" aria-controls="nav-keluar" aria-selected="false">Laporan Barang Keluar</a>
								</div>
							</nav>
						</div>
					</div>

					<div class="tab-content" id="nav-tabContent">
						<div class="tab-pane fade show active" id="nav-masuk" role="tabpanel" aria-labelledby="nav-masuk-tab">
							<a href="<?= base_url('barang/print_masuk/date?range=').$send_dt ?>" target="_blank" class="btn btn-info m-2">
								<i class="fas fa-print"></i> Print
							</a>
							<table id="list-masuk" class="table table-bordered">
								<thead>
									<tr>
										<th width="15%">Kode Barang</th>
										<th width="15%">Nama Alat</th>
										<th width="10%">Merk</th>
										<th>No. Serial</th>
										<th>Tanggal Masuk</th>
										<th>Pengirim</th>
										<th>Jumlah</th>
										<th>Referensi</th>
										<th>Detail</th>
										<th>Input Barang Keluar</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($barang_masuk as $k => $v) { ?>
										<tr>
											<td><?= $v->kode_barang ?></td>
											<td><?= $v->nama_alat ?></td>
											<td><?= $v->merk ?></td>
											<td><?= $v->no_serial ?></td>
											<td><?= date_format(new DateTime($v->tanggal_masuk), "d-m-Y"); ?></td>
											<td><?= $v->nama_pengirim ?></td>
											<td><?= $v->jumlah ?></td>
											<td>
												<?php if ($v->referensi !== '') { ?>

													<?php foreach ($v->ref_split as $y => $e) { ?>
														<a href="<?= base_url('uploads/referensi/').$e ?>" target="_blank" class="btn btn-sm btn-block btn-warning btn-ref"><span><?= $e ?></span></a>
													<?php } ?>

												<?php }else{?>

													<span>Tidak ada Referensi</span>

												<?php } ?>
											</td>
											<td>
												<a onclick="detail_laporan_masuk('<?= $v->id ?>')" class="btn btn-block btn-secondary">Detail</a>
											</td>
											<td>
												<a onclick="input_barang_masuk('<?= $v->id ?>')" class="btn btn-block btn-warning">Input Barang Keluar</a>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<div class="tab-pane fade show" id="nav-keluar" role="tabpanel" aria-labelledby="nav-keluar-tab">
							<a href="<?= base_url('barang/print_keluar/date?range=').$send_dt ?>" target="_blank" class="btn btn-info m-2">
								<i class="fas fa-print"></i> Print
							</a>
							<table id="list-keluar" class="table table-bordered">
								<thead>
									<tr>
										<th>Kode Barang</th>
										<th>Nama Alat</th>
										<th>Merk</th>
										<th>No. Serial</th>
										<th>Jumlah</th>
										<th>Tanggal Keluar</th>
										<th>Tujuan</th>
										<th>Detail</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($barang_keluar as $k => $v) { ?>
										<tr>
											<td><?= $v->kode_barang ?></td>
											<td><?= $v->nama_alat ?></td>
											<td><?= $v->merk ?></td>
											<td><?= $v->no_serial ?></td>
											<td><?= $v->jumlah ?></td>
											<td><?= date_format(new DateTime($v->tanggal_keluar), "d-m-Y"); ?></td>
											<td><?= $v->tujuan ?></td>
											<td>
												<a onclick="detail_laporan_keluar('<?= $v->id ?>')" class="btn btn-block btn-secondary">Detail</a>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				<?php } ?>

			</div>
		</div>
	</div>

</div>

<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Detail laporan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="detail-container"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="inputBarangKeluar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Input Barang Keluar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-workgroup" method="post" action="<?= base_url('barang/validate_barang_keluar') ?>" >
					<div class="form-group">
						<label for="exampleFormControlInput1">Kode Barang</label>
						<input type="text" id="kode-barang" name="kode" class="form-control" id="exampleFormControlInput1" value="" required="required" readonly="" value="">
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Nama Alat / Modul</label>
						<input type="text" id="nama-alat" name="nama" class="form-control" id="exampleFormControlInput1" value="" required="required" readonly="">
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Tanggal Barang Keluar</label>
						<input type="date" name="date" class="form-control" id="exampleFormControlInput1" value="<?= set_value('date') ?>">
						<div class="text-danger">
							<small><?= form_error('date'); ?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Merk / Type</label>
						<input type="text" id="merk" name="merk" class="form-control" id="exampleFormControlInput1" value="" required="required" readonly="">
						<div class="text-danger">
							<small><?= form_error('merk'); ?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">No. Serial</label>
						<input type="number" id="serial" name="serial" class="form-control nip-input" id="exampleFormControlInput1" value="<?= set_value('serial') ?>" readonly="">
						<div class="text-danger">
							<small><?= form_error('serial'); ?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Jumlah</label>
						<input type="number" id="jumlah" name="jumlah" class="form-control" id="exampleFormControlInput1" style="width: 15%;" value="<?= set_value('jumlah') ?>" readonly="" >
						<div class="text-danger">
							<small><?= form_error('jumlah'); ?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Tujuan</label>
						<input type="text" id="tujuan" name="tujuan" class="form-control" id="exampleFormControlInput1" value="<?= set_value('tujuan') ?>" readonly="" >
						<div class="text-danger">
							<small><?= form_error('tujuan'); ?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleFormControlTextarea1">Keterangan</label>
						<textarea class="form-control" name="keterangan" id="exampleFormControlTextarea1" rows="4"></textarea>
					</div>
					<button type="submit" class="btn btn-block btn-success mt-4">Process Barang Keluar</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	function input_barang_masuk($id) {
		$( "#inputBarangKeluar" ).modal('show');
		var id = $id;
		$.ajax({
			url : "<?php echo base_url('barang/get_itemIn_detail/'); ?>"+id,
			method : "POST",
			data : {id: id},
			dataType: "json",
			success: function(data){
				console.log(data);
				$('#kode-barang').val(data.detail.barang.kode_barang);
			    $('#nama-alat').val(data.detail.barang.nama_alat);
			    $('#merk').val(data.detail.barang.merk);
			    $('#serial').val(data.detail.barang.no_serial);
			    $('#jumlah').val(data.detail.barang.jumlah);
			    $('#tujuan').val(data.detail.pengirim.nama_pengirim);
			},
			error: function(data) {
				console.log(data);
			}
		});
	}

	function detail_laporan_masuk($id) {
		$( "#modalDetail" ).modal('show');
		var id = $id;
		$.ajax({
			url : "<?php echo base_url('barang/get_itemIn_detail/'); ?>"+id,
			method : "POST",
			data : {id: id},
			dataType: "json",
			success: function(data){
				var date = new Date(data.detail.barang.tanggal_masuk);
				var html = `<span class="font-weight-bold">Kode Barang</span>
					<p>${data.detail.barang.kode_barang}</p>
					<span class="font-weight-bold">Nama Alat</span>
					<p>${data.detail.barang.nama_alat}</p>
					<span class="font-weight-bold">Merk</span>
					<p>${data.detail.barang.merk}</p>
					<span class="font-weight-bold">No. Serial</span>
					<p>${data.detail.barang.no_serial}</p>
					<span class="font-weight-bold">Tanggal Masuk</span>
					<p>${date.toLocaleDateString('en-US')}</p>
					<span class="font-weight-bold">Pengirim</span>
					<p>${data.detail.pengirim.nama_pengirim}</p>
					<span class="font-weight-bold">Jumlah</span>
					<p>${data.detail.barang.jumlah}</p>
					<hr>
					<span class="font-weight-bold">Yang Menyerahkan</span>
					<p>${data.detail.dari.nama}</p>
					<span class="font-weight-bold">Yang Menerima</span>
					<p>${data.detail.kepada.nama}</p>
					<hr>
					<span class="font-weight-bold">Di Input Oleh</span>
					<p>${data.detail.pic.nama}</p>
					<span class="font-weight-bold">Input Tanggal</span>
					<p>${data.detail.barang.created_date}</p>
					`;
				$('#detail-container').html(html);
			},
			error: function(data) {
				console.log(data);
			}
		});
	};

	function detail_laporan_keluar($id) {
		$( "#modalDetail" ).modal('show');
		var id = $id;
		$.ajax({
			url : "<?php echo base_url('barang/get_itemOut_detail/'); ?>"+id,
			method : "POST",
			data : {id: id},
			dataType: "json",
			success: function(data){
				var date = new Date(data.detail.barang.tanggal_keluar);
				var html = `<span class="font-weight-bold">Kode Barang</span>
					<p>${data.detail.barang.kode_barang}</p>
					<span class="font-weight-bold">Nama Alat</span>
					<p>${data.detail.barang.nama_alat}</p>
					<span class="font-weight-bold">Merk</span>
					<p>${data.detail.barang.merk}</p>
					<span class="font-weight-bold">No. Serial</span>
					<p>${data.detail.barang.no_serial}</p>
					<span class="font-weight-bold">Jumlah</span>
					<p>${data.detail.barang.jumlah}</p>
					<span class="font-weight-bold">Tanggal Masuk</span>
					<p>${date.toLocaleDateString('en-US')}</p>
					<span class="font-weight-bold">Tujuan</span>
					<p>${data.detail.barang.tujuan}</p>
					<span class="font-weight-bold">Keterangan</span>
					<p>${data.detail.barang.keterangan}</p>
					<hr>
					<span class="font-weight-bold">Di Input Oleh</span>
					<p>${data.detail.pic.nama}</p>
					<span class="font-weight-bold">Input Tanggal</span>
					<p>${data.detail.barang.created_date}</p>
					`;
				$('#detail-container').html(html);
			},
			error: function(data) {
				console.log(data);
			}
		});
	};

</script>