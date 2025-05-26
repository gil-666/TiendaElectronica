<?php 
date_default_timezone_set('America/Mexico_City');
session_start();
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Tienda Electronica</title>
	<link rel="icon" type="image/x-icon" href="/favicon.ico">
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords" content="Startup Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //Meta tag Keywords -->

	<!-- Custom-Files -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
	<!-- Bootstrap-Core-CSS -->
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<!-- Style-CSS -->
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<!-- Font-Awesome-Icons-CSS -->
	<!-- //Custom-Files -->

	<!-- Web-Fonts -->
	<link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=devanagari,latin-ext"
	 rel="stylesheet">
	<!-- //Web-Fonts -->
	<style>
		a {
  text-decoration: none;
}
	</style>
</head>

<body>
	<!-- main banner -->
	<div class="main-top" id="home">
		<!-- header -->
		<header>
			<div class="container-fluid">
				<div class="header d-lg-flex justify-content-between align-items-center py-3 px-sm-3">
					<!-- logo -->
					<div id="logo">
					<h1><a href="index.php" style="color: #3F72AF;"><img src="images/tec.png" alt="Icono" class="icono-png" style="max-width: 100%;"> E-Electronics</a></h1>


					</div>
					<!-- //logo -->
					<!-- nav -->
					<div class="nav_w3ls">
						<nav>
							<label for="drop" class="toggle">Menu</label>
							<input type="checkbox" id="drop" />
							<ul class="menu">
							<?php if(!isset($_SESSION['idUsuario'])): ?>
								<li><a href="index.php" class="active">Inicio</a></li>
								<?php else: ?>
								<?php endif; ?>
								<li><a href="articulos.php" class="active">Artículos</a></li>
								<?php if(isset($_SESSION['idUsuario'])): ?>
									<li><a href="nuevo.php" class="active">Vender Artículos</a></li>
								<?php else: ?>
								<?php endif; ?>
								
								<!-- <li><a href="contact.php" class="active">Contact Us</a></li> -->

								<?php if(isset($_SESSION['idUsuario'])): ?>
									<li>
										<a href="cuenta.php" class="active">Mi Cuenta</a>
										
									</li>
									<li class="separator"></li>
									<li><a href="cerrar_sesion.php" class="active" style="color: red;">Cerrar Sesión</a></li>
									
								<?php else: ?>
									<li><a href="login.php" class="active">Iniciar Sesión</a></li>
								<?php endif; ?>
							</ul>
						</nav>
					</div>
					<!-- //nav -->
					<div class="d-flex mt-lg-1 mt-sm-2 mt-3 justify-content-center">
						<!-- search -->
						<div class="search-w3layouts mr-3">
							<form action="articulos.php" method="get" class="search-bottom-wthree d-flex">
								<input class="search" type="search" name="query" placeholder="Buscar Artículos..." required="">
								<button class="form-control btn" type="submit"><span class="fa fa-search"></span></button>
							</form>
						</div>
						
					</div>
				</div>
			</div>
		</header>
