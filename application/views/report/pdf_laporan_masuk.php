<!DOCTYPE html>
<html>
<head>
	<title>Laporan Barang Masuk</title>
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

		if (count($barang_masuk) > 4) {
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
			<p style="font-size: 10px;">Laporan Suku Cadang Masuk : <?= $from ?> - <?= $to ?></p>
			<br>
			<p style="text-align: center;text-transform: uppercase;font-weight: bold;">Serah Terima Modul/Alat Perbaikan</p>
			<table id="list-masuk" class="table table-bordered">
				<thead>
					<tr>
						<th width="15%">Kode Barang</th>
						<th width="15%">Nama Alat</th>
						<th width="10%">Merk</th>
						<th>No. Serial</th>
						<th>Tanggal Masuk</th>
						<th>Pengirim</th>
						<th>Jumlah</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($barang_masuk as $k => $v) { ?>
						<tr>
							<td><?= $v->kode_barang ?></td>
							<td><?= $v->nama_alat ?></td>
							<td><?= $v->merk ?></td>
							<td><?= $v->no_serial ?></td>
							<td><?= date_format(new DateTime($v->tanggal_masuk), "d-m-Y"); ?></td>
							<td><?= $v->pengirim ?></td>
							<td><?= $v->jumlah ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="footer" <?= $pageBreak ?> >
		<div style="text-align: right;">
			<p style="margin-right: 130px">Tanggal Diserahkan : </p>
		</div>
		<br>
		<br>

		<div style="display: flex; justify-content: space-around;">
			<div style="width: 50%;">
				<div>
					<p style="text-align: center;">Teknisi EP/MLP/TSL <br> Yang Menerima</p>
					<br>
					<br>
					<p style="text-align: center;">....................</p>
				</div>
			</div>
			<div style="width: 50%; float:right;">
				<div>
					<p style="text-align: center;">Staff  Tata Usaha <br> Yang Menyerhakan</p>
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
				<p>Mengetahui,<br>Kepala Seksi EP/MLP/TSL</p>
				<br>
				<br>
				<br>
				<p style="text-align: center;">....................</p>
			</div>
		</div>
	</div>

<!-- JS Bootstrap -->
<script src="./assets/js/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="./assets/js/moment.min.js"></script>

</body>
</html>