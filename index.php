<?php

	include 'configs/config.php';
	include 'configs/funciones.php';

	if(!isset($p)){
		$p="principal";
	}else{
		$p = $p;
	}

?>



<!DOCTYPE html>
<html lang="es">
<head>

	<!-- Bootstrap y CSS-->

	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome/css/all.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap/fonts/">
	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">




	<!-- Javascript -->

	<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="css/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="css/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="css/font-awesome/js/all.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

	





	<meta charset="UTF-8">
	<title>Fotomania CR</title>

</head>
<body>

	
	<div class="header">
		Fotomania CR

		<div class="carrito float-right">
			<a href="?p=carrito"><span class="glyphicon glyphicon-shopping-cart"></span></i></a>
		</div>
	</div>


	<div class="menu"> 
		<a href="?p=principal">Principal</a>
		<a href="?p=tienda">Tienda</a>
		<a href="?p=galeria">Galería</a>
		<a href="?p=videos">Videos</a>
		<a href="?p=rifas">Rifas</a>
		<a href="?p=sobreNosotros">Sobre Nosotros</a>

		<a href="?p=admin">Administrador</a>

		<!-- Verificar inicio de sesión -->

		<?php

			if(isset($_SESSION['idCliente'])){

			
		?>		
		<a class="float-right" href="?p=salir">Salir</a>
		<a class="float-right" href="#"><?=nombreCliente($_SESSION['idCliente'])?></a>



		<?php
			}else{
				?> 
				<a href="?p=login" class="float-right">Iniciar Sesión</a>

				<?php
			}

		?>

	
	</div>

	<div class="cuerpo">
		
		<?php

			if(file_exists("modulos/".$p.".php")){
				include "modulos/".$p.".php";
			}else{
				echo "<i>No se ha encontrado módulo <b>".$p."</b> <a href='./'> Regresar </i>";
			}

		?>

	</div>

	<div class="footer">
		Copyright Sistema Fotomania CR &copy, <?=date("Y")?>
	</div>
	
	

</body>
</html>