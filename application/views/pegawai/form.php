<div class="col-md-12 p-2 mt-2 p-3 slide-in-right">
	
	<div class="container">
		<div class="row">
			<h5><?= $this->uri->segment(2) == 'add'? 'Tambah Data':'Edit Data' ?> Pegawai</h5>
		</div>
		<div class="row">
			<a href="<?= base_url('pegawai') ?>" class="btn btn-dark"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-6 holder-table m-auto">
				<form id="form-workgroup" method="post" action="<?= $action ?>" >
					<div class="form-group">
						<label for="exampleFormControlInput1">NIP</label>
						<input type="number" name="nip" class="form-control nip-input" id="exampleFormControlInput1" 
						       value="<?= isset($pegawai->nip)?$pegawai->nip:set_value('nip'); ?>">
						<div class="text-danger">
							<small><?= form_error('nip'); ?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Nama</label>
						<input type="text" name="nama" class="form-control" id="exampleFormControlInput1" 
							   value="<?= isset($pegawai->nama)?$pegawai->nama:set_value('nama') ?>">
						<div class="text-danger">
							<small><?= form_error('nama'); ?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">No. Telephone</label>
						<input type="number" name="no_telp" class="form-control" id="exampleFormControlInput1" 
						       value="<?= isset($pegawai->no_telp)?$pegawai->no_telp:set_value('no_telp') ?>">
						<div class="text-danger">
							<small><?= form_error('no_telp'); ?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Email</label>
						<input type="email" name="email" class="form-control" id="exampleFormControlInput1" value="<?= isset($pegawai->email)?$pegawai->email:set_value('email') ?>">
						<div class="text-danger">
							<small><?= form_error('email'); ?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Status Pegawai</label>
						<input type="text" name="status_pegawai" class="form-control" id="exampleFormControlInput1" value="<?= isset($pegawai->status_pegawai)?$pegawai->status_pegawai:set_value('status_pegawai') ?>">
						<div class="text-danger">
							<small><?= form_error('status_pegawai'); ?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Role / Jabatan</label>
						<select class="form-control" name="role">
							<?php foreach ($role as $k => $v) { 
								if (isset($pegawai->user_type_id) && $pegawai->user_type_id == $v->id ) {
									$selected = "selected";
								}else{
									$selected = "";
								}
							?>
								<option value="<?= $v->id ?>" <?= $selected ?> > <?= $v->nama ?> </option>
							<?php } ?>
						</select>
						<div class="text-danger">
							<small><?= form_error('role'); ?></small>
						</div>
					</div>

					<button type="submit" class="btn btn-block btn-success mt-4">Simpan Anggota</button>
				</form>
			</div>
		</div>
	</div>
</div>