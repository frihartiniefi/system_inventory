<div class="col-md-12 p-2 mt-2 p-3 slide-in-right">
	
	<div class="container">
		<div class="row">
			<h5><?= $this->uri->segment(2) == 'add'? 'Tambah Data':'Edit Data' ?> Pengirim</h5>
		</div>
		<div class="row">
			<a href="<?= base_url('pengirim') ?>" class="btn btn-dark"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-6 holder-table m-auto">
				<form id="form-workgroup" method="post" action="<?= $action ?>" >
					<div class="form-group">
						<label for="exampleFormControlInput1">Nama pengirim</label>
						<input type="text" name="nama" class="form-control" id="exampleFormControlInput1" 
							   value="<?= isset($pengirim->nama_pengirim)?$pengirim->nama_pengirim:set_value('nama') ?>">
						<div class="text-danger">
							<small><?= form_error('nama'); ?></small>
						</div>
					</div>
					<button type="submit" class="btn btn-block btn-success mt-4">Simpan Pengirim</button>
				</form>
			</div>
		</div>
	</div>
</div>