<!DOCTYPE html>
<html>
<head>
	<title>Laporan Barang Keluar</title>
	<link rel="shortcut icon" href="./assets/images/favicon.png">

	 <!-- CSS -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/select2.min.css">
    <link rel="stylesheet" href="./assets/css/bootstrap-reboot.min.css">

    <!-- jquery -->
    <script src="./assets/js/jquery.min.js"></script>

     <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="./assets/css/custom.css">

    <style type="text/css">
    	body{
    		font-family: Arial, Helvetica, sans-serif;
    	}
    	.header {
    		display: block; 
    		text-align: center; 
    		position: running(header);
    	}
    	.footer {
    		display: block;
    		margin: 30px 0%;
    		position: running(footer);
    	}
    	@page {
    		@top-center { content: element(header) }
    	}
    	@page { 
    		@bottom-center { content: element(footer) }
    	}
    </style>

</head>
<body>
	<?php 

		if (count($barang_keluar) > 5) {
			$pageBreak =  "style='page-break-before: always;' ";
		}else{
			$pageBreak = "";
		}

	 ?>

	<div class="header">
		<img src="./assets/images/header_laporan.png">
	</div>
	<hr>

	<div class="content">
		<div style="margin: 2% 0%">
			<p style="font-size: 10px;">Laporan Suku Cadang Keluar : <?= $from ?> - <?= $to ?></p>
			<br>
			<p style="text-align: center;text-transform: uppercase;font-weight: bold;">Serah Terima Keluar Modul/Alat Perbaikan</p>
			<table id="list-keluar" class="table table-bordered">
				<thead>
					<tr>
						<th>Kode Barang</th>
						<th>Nama Alat</th>
						<th>Merk</th>
						<th>No. Serial</th>
						<th>Tanggal Keluar</th>
						<th>Tujuan</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($barang_keluar as $k => $v) { ?>
						<tr>
							<td><?= $v->kode_barang ?></td>
							<td><?= $v->nama_alat ?></td>
							<td><?= $v->merk ?></td>
							<td><?= $v->no_serial ?></td>
							<td><?= date_format(new DateTime($v->tanggal_keluar), "d-m-Y"); ?></td>
							<td><?= $v->tujuan ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="footer" <?= $pageBreak ?> >
		<div style="text-align: right;">
			<p style="margin-right: 130px">Tanggal Dikeluarkan : </p>
		</div>
		<br>
		<br>

		<div style="display: flex; justify-content: space-around;">
			<div style="width: 50%;">
				<div>
					<p style="text-align: center;">Stakeholder <br> Yang Menerima</p>
					<br>
					<br>
					<p style="text-align: center;">....................</p>
				</div>
			</div>
			<div style="width: 50%; float:right;">
				<div>
					<p style="text-align: center;">Petugas BMN <br> Yang Menyerhakan</p>
					<br>
					<br>
					<p style="text-align: center;">....................</p>
				</div>
			</div>	
		</div>
		<br>
		<br>
		<div style="text-align: center;">
			<div style="text-align: center;">
				<p>Mengetahui,<br>Kepala Balai Teknik Penerbangan</p>
				<br>
				<br>
				<br>
				<p style="margin-bottom: 5px; text-decoration: underline; font-weight: 700">PRASETIYOHADI</p>
				<p style="margin-bottom: 3px;">Pembina (IV/a)</p>
				<p style="margin-bottom: 3px;">NIP. 19780404 200212 1 003</p>
			</div>
		</div>
	</div>

<!-- JS Bootstrap -->
<script src="./assets/js/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="./assets/js/moment.min.js"></script>

</body>
</html>