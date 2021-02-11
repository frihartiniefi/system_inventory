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
    	div.header {
    		display: block;
    		text-align: center; 
    		position: running(header);
    	}
    	div.footer {
    		display: block; 
    		margin: 3% 0%;
    		text-align: center;
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

	<div class="header">
		<img src="./assets/images/header_laporan.png">
	</div>
	<hr>
	<div class="content">
		<div style="margin: 2% 0%">
			<p style="font-size: 10px;">Laporan Stock : <?= date("Y-m-d") ?> </p>
			<br>
			<table id="list-keluar" class="table table-bordered">
				<thead>
					<tr>
						<th>Kode Barang</th>
						<th>Nama Alat</th>
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

<!-- JS Bootstrap -->
<script src="./assets/js/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="./assets/js/moment.min.js"></script>

</body>
</html>