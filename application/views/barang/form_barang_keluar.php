<div class="col-md-12 p-2 mt-2 p-3 slide-in-right">
	
	<div class="container">
		<div class="row">
			<h5>Data Suku Cadang Keluar</h5>
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
				<form id="form-workgroup" method="post" action="<?= $action ?>" >
					<div class="form-group">
						<label for="exampleFormControlInput1">Kode Barang</label>
						<select id="kode-barang" class="form-control js-example-basic-multiple" name="kode" required="required">
								<option value="" data-name=""> -Pilih Kode Barang- </option>
							<?php foreach ($barang as $k => $v) { ?>
								<option value="<?= $v->kode_barang ?>" 
									    data-name="<?= $v->nama_alat ?>" 
									    data-merk="<?= $v->merk ?>" > <?= $v->kode_barang ?> </option>
							<?php } ?>
						</select>
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
						<input type="number" id="serial" name="serial" class="form-control nip-input" id="exampleFormControlInput1" value="<?= set_value('serial') ?>" >
						<div class="text-danger">
							<small><?= form_error('serial'); ?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Jumlah</label>
						<input type="number" name="jumlah" class="form-control" id="exampleFormControlInput1" style="width: 15%;" value="<?= set_value('jumlah') ?>">
						<div class="text-danger">
							<small><?= form_error('jumlah'); ?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Tujuan</label>
						<input type="text" name="tujuan" class="form-control" id="exampleFormControlInput1" value="<?= set_value('tujuan') ?>">
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
</script>