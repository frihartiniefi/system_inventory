<div class="col-md-12 p-2 mt-2 p-3 slide-in-right">
	
	<div class="container">
		<div class="row">
			<h5>Stock Suku Cadang</h5>
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
				<a href="<?= base_url('barang/print_stock') ?>" target="_blank" class="btn btn-info m-2">
					<i class="fas fa-print"></i> Print
				</a>
				<hr>
				<table id="list-table" class="table table-bordered">
					<thead>
						<tr>
							<th>Kode Barang</th>
							<th>Nama</th>
							<th>Stock</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($barang as $k => $v) { ?>
							<tr>
								<td><?= $v->kode_barang ?></td>
								<td><?= $v->nama_alat ?></td>
								<td><?= $v->stock ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>