<div class="col-md-12 p-2 mt-2 p-3 slide-in-right">
	
	<div class="container">
		<div class="row">
			<h5>Master Data Suku Cadang</h5>
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
					<a href="<?= base_url('barang/add') ?>" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah data baru</a>
				</div>
				<table id="list-table" class="table table-bordered">
					<thead>
						<tr>
							<th>Kode Barang</th>
							<th>Nama Modul</th>
							<th>Merk</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($barang as $k => $v) { ?>
							<tr>
								<td><?= $v->kode_barang ?></td>
								<td><?= $v->nama_alat ?></td>
								<td><?= $v->merk ?></td>
								<td>
									<a onclick="detail_barang('<?= $v->id ?>')" class="btn btn-sm btn-secondary">Lihat</a>
									<a href="<?= base_url('barang/edit/').$v->id ?>" class="btn btn-sm btn-warning">Edit</a>
									<a onclick="deleteBarang('<?= $v->id ?>')" class="btn btn-sm btn-danger">Hapus</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Detail Barang</h5>
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
	function detail_barang($id) {
		$( "#modalBarang" ).modal('show');
		var id = $id;
		$.ajax({
			url : "<?php echo base_url('barang/get_detail_barang/'); ?>"+id,
			method : "POST",
			data : {id: id},
			dataType: "json",
			success: function(data){
				var html = `<span class="font-weight-bold">Kode Barang</span>
					<p>${data.barang.kode_barang}</p>
					<span class="font-weight-bold">Nama Alat / Modul</span>
					<p>${data.barang.nama_alat}</p>
					<span class="font-weight-bold">Merk</span>
					<p>${data.barang.merk}</p>
					<span class="font-weight-bold">Di Tambahkan Pada</span>
					<p>${data.barang.created_date}</p>`;

				$('#detail-container').html(html);
			},
			error: function(data) {
				console.log(data);
			}
		});
	}

	function deleteBarang(id) {
		var base_url = '<?=base_url('')?>';
		var ask = window.confirm("Anda Yakin Ingin di Hapus ?");

		if (ask) {
			window.alert("Berhasil di Hapus");

			window.location.href = base_url+'barang/delete/'+id;

		}
	}
</script>