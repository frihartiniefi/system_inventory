<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Balai Teknik Penerbangan</title>
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-reboot.min.css') ?>">

    <!-- Font -->
    <link href="<?= base_url('assets/font/fontsgoogleapis.css') ?>" rel="stylesheet">

    <!-- datatables -->
    <link href="<?= base_url('assets/datatables/datatables.min.css') ?>" rel="stylesheet">

    <!-- datepicker -->
    <link href="<?= base_url('assets/css/daterangepicker.css') ?>" rel="stylesheet">

    <!-- jquery -->
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>

    <!-- <script src="<?= base_url('assets/js/jquery-3.2.1.slim.min.js') ?>"></script> -->

    <!-- FontAwesome -->
    <script src="<?= base_url('assets/font/fontawesome.js') ?>"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/custom.css')  ?>">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light">
	<a class="navbar-brand" href="<?= base_url('/') ?>">
		<img src="<?= base_url('assets/images/logo-balai.png') ?>" width="250px">
	</a>
	<button class="btn btn-btn-primary navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
		<ul class="navbar-nav">
			<li class="nav-item dropdown">
				<a class="btn btn-sm btn-primary nav-link dropdown-toggle dropdown-profile" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Hi, <?= $this->session->userdata('nama'); ?>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
					<!-- <a class="dropdown-item" href="#"><i class="fas fa-wrench"></i> Edit Profil</a> -->
					<a class="dropdown-item" href="<?= base_url('auth/change_password') ?>"><i class="fas fa-key"></i> Ubah Password</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="<?= base_url('auth/logout') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
				</div>
			</li>
		</ul>
	</div>
</nav>

<div class="container-fluid">
	<div class="row">
		