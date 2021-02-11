<div class="col-md-9 p-2 mt-5 p-4 slide-in-right">
	<div class="d-block text-center">
		<h4 class="font-weight-bold mb-3">PORTAL BALAI TEKNIK PENERBANGAN <br> SISTEM PENGELOLAAN SUKU CADANG</h4>
	</div>
	<div class="container">
		<div class="row">

			<div class="col-md-4 p-2">
				<a href="<?= base_url('barang/barang_masuk') ?>">
					<div class="btn-dashboard">
						<span><i class="fas fa-dolly-flatbed"></i></span>
						<h6>Suku Cadang Masuk</h6>	
					</div>
				</a>
			</div>

			<?php if ($this->session->userdata('user_type') == 1) { ?>
				<div class="col-md-4 p-2">
					<a href="<?= base_url('barang/master') ?>">
						<div class="btn-dashboard">
							<span><i class="fas fa-clipboard-list"></i></span>
							<h6>Master Data Suku Cadang</h6>	
						</div>
					</a>
				</div>
			<?php } ?>

			<div class="col-md-4 p-2">
				<a href="<?= base_url('barang/barang_keluar') ?>">
					<div class="btn-dashboard">
						<span><i class="fas fa-dolly"></i></span>
						<h6>Suku Cadang Keluar</h6>	
					</div>
				</a>
			</div>

			<?php if ($this->session->userdata('user_type') == 1) { ?> 
				<div class="col-md-4 p-2">
					<a href="<?= base_url('workgroup') ?>">
						<div class="btn-dashboard">
							<span><i class="fas fa-users"></i></span>
							<h6>Master Data Workgroup</h6>	
						</div>
					</a>
				</div>

				<div class="col-md-4 p-2">
					<a href="<?= base_url('pegawai') ?>">
						<div class="btn-dashboard">
							<span><i class="fas fa-user-tie"></i></span>
							<h6>Master Data Pegawai</h6>	
						</div>
					</a>
				</div>

				<div class="col-md-4 p-2">
					<a href="<?= base_url('pengirim') ?>">
						<div class="btn-dashboard">
							<span><i class="far fa-id-card"></i></span>
							<h6>Master Data Pengirim</h6>	
						</div>
					</a>
				</div>
			<?php } ?>

			<div class="col-md-4 p-2">
				<a href="<?= base_url('barang/laporan') ?>">
					<div class="btn-dashboard">
						<span><i class="fas fa-file"></i></span>
						<h6>Laporan Suku Cadang</h6>	
					</div>
				</a>
			</div>

			<?php if ($this->session->userdata('user_type') == 2) { ?>
				<div class="col-md-4 p-2">
					<a href="<?= base_url('barang/stock') ?>">
						<div class="btn-dashboard">
							<span><i class="fas fa-database"></i></span>
							<h6>Persediaan Stock Suku Cadang</h6>	
						</div>
					</a>
				</div>
			<?php } ?>


		</div>
	</div>
</div>