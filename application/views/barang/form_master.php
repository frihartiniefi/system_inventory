<div class="col-md-12 p-2 mt-2 p-3 slide-in-right">
	
	<div class="container">
		<div class="row">
			<h5><?= $this->uri->segment(2) == 'add'? 'Tambah Data':'Edit Data' ?> Barang</h5>
		</div>
		<div class="row">
			<a href="<?= base_url('barang/master') ?>" class="btn btn-dark"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-6 holder-table m-auto">
				<form id="form-workgroup" method="post" action="<?= $action ?>" >
					<div class="form-group">
						<label for="exampleFormControlInput1">Kode Barang</label>
						<input type="text" name="kode" class="form-control" id="exampleFormControlInput1" 
						       value="<?= isset($barang->kode_barang)?$barang->kode_barang:set_value('kode'); ?>">
						<div class="text-danger">
							<small><?= form_error('kode'); ?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Nama Alat / Modul</label>
						<input type="text" name="nama" class="form-control" id="exampleFormControlInput1" 
						       value="<?= isset($barang->nama_alat)?$barang->nama_alat:set_value('nama'); ?>">
						<div class="text-danger">
							<small><?= form_error('nama'); ?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Merk / Type</label>
						<input type="text" name="merk" class="form-control" id="exampleFormControlInput1" 
						       value="<?= isset($barang->merk)?$barang->merk:set_value('merk') ?>">
						<div class="text-danger">
							<small><?= form_error('merk'); ?></small>
						</div>
					</div>
					<button type="submit" class="btn btn-block btn-success mt-4">Simpan Barang</button>
				</form>
			</div>
		</div>
	</div>
</div>