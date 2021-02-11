<div class="col-md-12 p-2 mt-2 p-3 slide-in-right">
	
	<div class="container">
		<div class="row">
			<h5>Master Data Workgroup</h5>
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
					<a href="<?= base_url('workgroup/add') ?>" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah data baru</a>
				</div>
				<table id="list-table" class="table table-bordered">
					<thead>
						<tr>
							<th>Nama Workgroup</th>
							<th>Unit Kerja </th>
							<th>Sub-bagian</th>
							<th>Anggota</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($workgroup as $k => $v) { ?>
							<tr>
								<td><?= $v->nama ?></td>
								<td><?= $v->unit_kerja ?></td>
								<td><?= $v->sub_bagian ?></td>
								<td><?= count($v->total_pegawai) ?></td>
								<td>
									<button class="btn btn-sm btn-dark" onclick="detail_workgroup('<?= $v->id ?>')" >Lihat</button>
									<a href="<?= base_url('workgroup/edit/').$v->id ?>" class="btn btn-sm btn-warning">Edit</a>
									<a onclick="deleteWorkgroup('<?= $v->id ?>')" class="btn btn-sm btn-danger">Hapus</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Detail Workgroup</h5>
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
	function detail_workgroup($id) {
		$( "#modalDetail" ).modal('show');
		var id = $id;

		$.ajax({
			url : "<?php echo base_url('workgroup/detail_workgroup/'); ?>"+id,
			method : "POST",
			data : {id: id},
			dataType: "json",
			success: function(data){
				console.log(data)
				var html = `<span class="font-weight-bold">Nama Workgroup</span>
					<p>${data.workgroup.nama}</p>
					<span class="font-weight-bold">Unit Kerja</span>
					<p>${data.workgroup.unit_kerja}</p>
					<span class="font-weight-bold">Sub-Bagian</span>
					<p>${data.workgroup.sub_bagian}</p>
					<span class="font-weight-bold">Anggota</span>
					<table class="table table-bordered mt-2" width="100%">
					<thead class="thead-reply">
					<tr>
					<th width="15%">NIP</th>
					<th width="65%">Nama</th>
					</tr>
					</thead>
					<tbody>
					`;

				for (i = 0; i < data.pegawai.length; i++){
					html += `<tr>
								<td>${data.pegawai[i].nip}</td>
								<td>${data.pegawai[i].nama}</td>
							</tr>`;	
				}

				html += `</tbody>
						</table>`

				$('#detail-container').html(html);
			},
			error: function(data) {
				console.log(data);
			}
		});

	}

	function deleteWorkgroup(id) {
		var base_url = '<?=base_url('')?>';
		var ask = window.confirm("Anda Yakin Ingin di Hapus ?");

		if (ask) {
			window.alert("Berhasil di Hapus");

			window.location.href = base_url+'workgroup/delete/'+id;

		}
	}
</script>