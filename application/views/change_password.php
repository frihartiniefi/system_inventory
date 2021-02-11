<div class="col-md-12 p-2 mt-2 p-3 slide-in-right">
	
	<div class="container">
		<div class="row">
			<h5>Ubah Password</h5>
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
				<form id="form-workgroup" method="post" action="<?= base_url('auth/validate_password') ?>" >
					<div class="form-group">
						<label for="exampleFormControlInput1">Password Lama</label>
						<input type="password" name="old_password" class="form-control nip-input" id="exampleFormControlInput1">
						<div class="text-danger">
							<small><?= form_error('old_password'); ?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Password baru</label>
						<input type="password" name="new_password" class="form-control" id="exampleFormControlInput1">
						<div class="text-danger">
							<small><?= form_error('new_password'); ?></small>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Konfirmasi Password Baru</label>
						<input type="password" name="new_password2" class="form-control" id="exampleFormControlInput1">
						<div class="text-danger">
							<small><?= form_error('new_password2'); ?></small>
						</div>
					</div>

					<button type="submit" class="btn btn-block btn-success mt-4">Simpan Password</button>
				</form>
			</div>
		</div>
	</div>
</div>