<div class="col-md-12 p-2 mt-2 p-3 slide-in-right">
	
	<div class="container">
		<div class="row">
			<h5>Master Data Pengirim</h5>
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
				<div class="mb-4">
					<a href="<?= base_url('pengirim/add') ?>" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah data baru</a>
				</div>
				<table id="list-table" class="table table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Pengirim</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($pengirim as $k => $v) { ?>
							<tr>
								<td><?= $v->id ?></td>
								<td><?= $v->nama_pengirim ?></td>
								<td>
									<a href="<?= base_url('pengirim/edit/').$v->id ?>" class="btn btn-sm btn-warning">Edit</a>
									<a onclick="deletePengirim('<?= $v->id ?>')" class="btn btn-sm btn-danger">Hapus</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	function deletePengirim(id) {
		var base_url = '<?=base_url('')?>';
		var ask = window.confirm("Anda Yakin Ingin di Hapus ?");

		if (ask) {
			window.alert("Berhasil di Hapus");

			window.location.href = base_url+'pengirim/delete/'+id;

		}
	}
</script>