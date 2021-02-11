<div class="col-md-12 p-2 mt-2 p-3 slide-in-right">
	
	<div class="container">
		<div class="row">
			<h5>Master Data Pegawai</h5>
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
					<a href="<?= base_url('pegawai/add') ?>" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah data baru</a>
				</div>
				<table id="list-table" class="table table-bordered">
					<thead>
						<tr>
							<th>NIP</th>
							<th>Nama</th>
							<th>Jabatan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($pegawai as $k => $v) { ?>
							<tr>
								<td><?= $v->nip ?></td>
								<td><?= $v->nama ?></td>
								<td><?= $v->status_pegawai ?></td>
								<td>
									<a onclick="detail_pegawai('<?= $v->nip ?>')" class="btn btn-sm btn-secondary">Lihat</a>
									<a href="<?= base_url('pegawai/edit/').$v->id ?>" class="btn btn-sm btn-warning">Edit</a>
									<a onclick="deletePegawai('<?= $v->id ?>')" class="btn btn-sm btn-danger">Hapus</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalPegawai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Detail Pegawai</h5>
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

<script type="text/javascript">
	function detail_pegawai($nip) {
		$( "#modalPegawai" ).modal('show');
		var nip = $nip;
		$.ajax({
			url : "<?php echo base_url('pegawai/get_detail_pegawai/'); ?>"+nip,
			method : "POST",
			data : {nip: nip},
			dataType: "json",
			success: function(data){
				var html = `<span class="font-weight-bold">NIP</span>
					<p>${data.pegawai.pegawai.nip}</p>
					<span class="font-weight-bold">Nama Pegawai</span>
					<p>${data.pegawai.pegawai.nama}</p>
					<span class="font-weight-bold">No. Telp</span>
					<p>${data.pegawai.pegawai.no_telp}</p>
					<span class="font-weight-bold">Email</span>
					<p>${data.pegawai.pegawai.email}</p>
					<span class="font-weight-bold">Status Pegawai</span>
					<p>${data.pegawai.pegawai.status_pegawai}</p>
					<hr>`;

				if(data.pegawai.workgroup_pegawai != undefined){
				html +=`
					<span class="font-weight-bold">Workgroup</span>
					<p>${data.pegawai.workgroup_pegawai.nama}</p>
					<span class="font-weight-bold">Unit Kerja</span>
					<p>${data.pegawai.workgroup_pegawai.unit_kerja}</p>
					<span class="font-weight-bold">Sub-bagian</span>
					<p>${data.pegawai.workgroup_pegawai.sub_bagian}</p>
					`;
				}

				$('#detail-container').html(html);
			},
			error: function(data) {
				console.log(data);
			}
		});
	}

	function deletePegawai(id) {
		var base_url = '<?=base_url('')?>';
		var ask = window.confirm("Anda Yakin Ingin di Hapus ?");

		if (ask) {
			window.alert("Berhasil di Hapus");

			window.location.href = base_url+'pegawai/delete/'+id;

		}
	}
</script>