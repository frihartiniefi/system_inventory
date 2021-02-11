<div class="col-md-12 p-2 mt-2 p-3 slide-in-right">
	
	<div class="container">
		<div class="row">
			<h5><?= $this->uri->segment(2) == 'add'? 'Tambah Data':'Edit Data' ?> Workgroup</h5>
		</div>
		<div class="row">
			<a href="<?= base_url('workgroup') ?>" class="btn btn-dark"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-6 holder-table m-auto">
				<form id="form-workgroup" method="post" action="<?= $action ?>" >
					<div class="form-group">
						<label for="exampleFormControlInput1">Nama Workgroup</label>
						<input type="text" name="nama" class="form-control" id="exampleFormControlInput1" value="<?= isset($workgroup->nama)?$workgroup->nama:''; ?>">
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Unit Kerja</label>
						<input type="text" name="unit" class="form-control" id="exampleFormControlInput1" value="<?= isset($workgroup->unit_kerja)?$workgroup->unit_kerja:''; ?>">
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Sub-bagian</label>
						<input type="text" name="bagian" class="form-control" id="exampleFormControlInput1" value="<?= isset($workgroup->sub_bagian)?$workgroup->sub_bagian:''; ?>">
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Anggota</label>
						<select class="form-control js-example-basic-multiple" name="anggota[]" multiple="multiple">
							<?php foreach ($listPegawai as $k => $v) {

								if ($v->workgroup_id != 0 && $this->uri->segment(3) != $v->workgroup_id) {
									$disabled = "disabled='disabled'";
								}else{
									$disabled = "";
								}

								if (isset($workgroup->id) && $v->workgroup_id == $workgroup->id) {
									$selected = "selected";
								}else{
									$selected = "";
								}
							?>
								<option value="<?= $v->id ?>" <?= $disabled ?> <?= $selected ?> > <?= $v->nama ?> </option>
							<?php } ?>
						</select>
					</div>

					<button type="submit" class="btn btn-block btn-success mt-4">Simpan Workgroup</button>
				</form>
			</div>
		</div>
	</div>
</div>