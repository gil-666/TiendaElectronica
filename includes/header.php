<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Startup a Corporate Category Bootstrap Responsive Website Template | Home :: W3layouts</title>
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
	<!--<link rel="stylesheet" href="css/bootstrap.css">-->
	<!-- Bootstrap-Core-CSS -->
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<!-- Style-CSS -->
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<!-- Font-Awesome-Icons-CSS -->
	<!-- //Custom-Files -->

	<!-- Web-Fonts -->
	<link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=devanagari,latin-ext"
	 rel="stylesheet">
	<!-- //Web-Fonts -->
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
								
								<li><a href="index.php" class="active">Inicio</a></li>
								<?php if(isset($_SESSION['idUsuario'])): ?>
								<li><a href="articulos.php" class="active">Artículos</a></li>
								<?php else: ?>
								<?php endif; ?>
								<li><a href="nuevo.php" class="active">Agregar Artículos</a></li>
								<li><a href="contact.php" class="active">Contact Us</a></li>

								<?php if(isset($_SESSION['idUsuario'])): ?>
									<li class="dropdown">
										<a href="#" class="active">Cuenta</a>
										<ul class="dropdown-content">
											<li><a href="cuenta.php">Ver Cuenta</a></li>
											<li><a href="cambiar_contrasena.php">Cambiar Contraseña</a></li>
										</ul>
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
							<form action="#" method="post" class="search-bottom-wthree d-flex">
								<input class="search" type="search" placeholder="Buscar Artículos..." required="">
								<button class="form-control btn" type="submit"><span class="fa fa-search"></span></button>
							</form>
						</div>
						
					</div>
				</div>
			</div>
		</header>