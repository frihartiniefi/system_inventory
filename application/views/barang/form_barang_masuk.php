<div class="col-md-12 p-2 mt-2 p-3 slide-in-right">
	
	<div class="container">
		<div class="row">
			<h5>Data Suku Cadang Masuk</h5>
		</div>
		<div class="row">
			<a href="<?= base_url('dashboard') ?>" class="btn btn-dark"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
		</div>
	</div>

	<div class="container">
		<?php

		if ($this->session->flashdata('error_message')) {
			echo $this->session->flashdata('error_message');
		}

		?>
		<div class="row">
			<div class="col-md-6 holder-table m-auto">
				<form id="form-workgroup" method="post" action="<?= $action ?>" enctype="multipart/form-data" >
					<div class="form-group">
						<label for="exampleFormControlInput1">Kode Barang</label>
						<select id="kode-barang" class="form-control js-example-basic-multiple" name="kode" required="required">
								<option value="" data-name=""> -Pilih Kode Barang- </option>
							<?php foreach ($barang as $k => $v) { ?>
								<option value="<?= $v->kode_barang ?>" 
									    data-name="<?= $v->nama_alat ?>" 
									    data-merk="<?= $v->merk ?>"> <?= $v->kode_barang ?> 
								</option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Nama Alat / Modul</label>
						<input type="text" id="nama-alat" name="nama" class="form-control" id="exampleFormControlInput1" value="" required="required" readonly="">
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Tanggal Barang Masuk</label>
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
						<input type="number" id="serial" name="serial" class="form-control nip-input" id="exampleFormControlInput1" value="<?= set_value('serial') ?>" >
						<div class="text-danger">
							<small><?= form_error('serial'); ?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Referensi</label>
						<div id="referensi-add">
							<div>
								<input type="file" name="referensi[]" class="form-control" id="referensi">
							</div>
						</div>
						<a onclick="addmore()" class="btn btn-sm btn-warning m-3">+ Referensi</a>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Pengirim</label>
						<select id="pengirim" class="form-control js-example-basic-multiple" name="pengirim" required="required">
								<option value="" data-name=""> -Pilih Pengirim- </option>
							<?php foreach ($pengirim as $k => $v) { ?>
								<option value="<?= $v->id ?>"> <?= $v->nama_pengirim ?> </option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Jumlah</label>
						<input type="number" name="jumlah" class="form-control" id="exampleFormControlInput1" style="width: 15%;" value="<?= set_value('jumlah') ?>">
						<div class="text-danger">
							<small><?= form_error('jumlah'); ?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Yang Menyerahkan</label>
						<select class="form-control js-example-basic-multiple" name="from" required="required">
								<option value=""> -Pilih Pegawai- </option>
							<?php foreach ($pegawai as $k => $v) { ?>
								<option value="<?= $v->id ?>"> <?= $v->nama ?> </option>
							<?php } ?>
						</select>
						<div class="text-danger">
							<small><?= form_error('from'); ?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Yang Menerima</label>
						<select class="form-control js-example-basic-multiple" name="to" required="required">
								<option value=""> -Pilih Pegawai- </option>
							<?php foreach ($pegawai as $k => $v) { ?>
								<option value="<?= $v->id ?>"> <?= $v->nama ?> </option>
							<?php } ?>
						</select>
						<div class="text-danger">
							<small><?= form_error('to'); ?></small>
						</div>
					</div>
					<button type="submit" class="btn btn-block btn-success mt-4">Process Barang Masuk</button>
				</form>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function () {
		$("#kode-barang").change(function(){
			var res = $('option:selected', this).attr('data-name');
			var merk = $('option:selected', this).attr('data-merk');

			$('#nama-alat').val(res);
			$('#merk').val(merk);
		});
	});

	function addmore() {
		var innerHTML =` <div style="display: -webkit-box;margin-top: 5px;">
		<input type="file" name="referensi[]" class="form-control" id="exampleFormControlInput1"> 
		<span class="delete-referensi" onclick="delete_more(this)"> Hapus </span>
		</div>`;
		$('#referensi-add').append(innerHTML);
	};

	function delete_more(e) {
		var btn = $(e);
		btn.parent('div').remove();
	};
</script>