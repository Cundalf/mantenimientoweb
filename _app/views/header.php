<!DOCTYPE html>
<html lang="es">

<head>
	<!-- META -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<meta name="msapplication-TileColor" content="#00ba8b">
	<meta name="msapplication-TileImage" content="<?= base_url('assets/icons/ms-icon-144x144.png') ?>">
	<meta name="theme-color" content="#00ba8b">
    <!-- LINK -->
	<link rel="apple-touch-icon" sizes="57x57" href="<?= base_url('assets/icons/apple-icon-57x57.png') ?>">
	<link rel="apple-touch-icon" sizes="60x60" href="<?= base_url('assets/icons/apple-icon-60x60.png') ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?= base_url('assets/icons/apple-icon-72x72.png') ?>">
	<link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/icons/apple-icon-76x76.png') ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?= base_url('assets/icons/apple-icon-114x114.png') ?>">
	<link rel="apple-touch-icon" sizes="120x120" href="<?= base_url('assets/icons/apple-icon-120x120.png') ?>">
	<link rel="apple-touch-icon" sizes="144x144" href="<?= base_url('assets/icons/apple-icon-144x144.png') ?>">
	<link rel="apple-touch-icon" sizes="152x152" href="<?= base_url('assets/icons/apple-icon-152x152.png') ?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/icons/apple-icon-180x180.png') ?>">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?= base_url('assets/icons/android-icon-192x192.png') ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/icons/favicon-32x32.png') ?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('assets/icons/favicon-96x96.png') ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/icons/favicon-16x16.png') ?>">
	<link rel="manifest" href="<?= base_url('assets/icons/manifest.json') ?>">
	
    <link href="<?= base_url('assets/css/bootstrap.css') ?>" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,100,300,500' rel='stylesheet' type='text/css'>
	<link href="<?= base_url('assets/css/font-awesome-edit.css') ?>" rel="stylesheet" type="text/css" >
	<link href="<?= base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" >
	<link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
	
	<title>Sanatorio Las Lomas - Mantenimiento</title>		
</head>

<body class="sitio">
	
	<header class="Site-header">
		<nav class="navbar">
			<div class="navbar-inner">
				<div class="container">
					<div class="navbar-header">
						<span class="logo-text" href="#">Sanatorio Las Lomas</span>
					</div>
					<?php if ($this->session->userdata('login') != null) : ?>
					<div class="col-lg-2 derecha">
						<div class="dropdown">
							<button class="btn btn-danger dropdown-toggle btn-header" type="button" data-toggle="dropdown">
								<i class="fa fa-fw fa-user"></i> <?= $this->session->userdata('username') ?>
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a href="<?= base_url('user/actualizarDatos') ?>"><i class="fa fa-fw fa-user"></i> Actualizar Datos</a></li>
								<li><a href="<?= base_url('user/logout') ?>"><i class="fa fa-fw fa-power-off"></i> Desconectarse</a></li>
							</ul>
						</div>
					</div>
					<?php endif; ?>
				</div>
				
			</div>
		</nav>
		
		<? if (isset($pagina)) : ?>
			<div class="subnavbar">
				<div class="subnavbar-inner">
					<div class="container">
						<ul class="mainnav">
							<li <?=($pagina=='propias' ? ' class="active"' : '') ?> ><a href="<?= base_url('') ?>"><i class="icon-book"></i><span>Mis Solicitudes</span></a></li>
							<li <?=($pagina=='pendientes' ? ' class="active"' : '') ?>><a href="<?= base_url('mantenimiento/pendientes') ?>"><i class="icon-list-alt"></i><span>Lista de Solicitudes</span></a>
						</ul>
					</div>
					<!-- /container --> 
				</div>
				<!-- /subnavbar-inner --> 
			</div>
		<? endif; ?>
		
	</header>