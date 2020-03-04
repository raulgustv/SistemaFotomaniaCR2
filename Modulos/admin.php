<?php

	if(isset($enviar)){

		//limpiar variables
		$username = clear($username);
		$password = clear($password);

		//consulta inicio sesión

		$q = $mysqli->query("SELECT * FROM admin WHERE user = '$username' AND pass = '$password'");
  
    	if(mysqli_num_rows($q)>0){
    		$r = mysqli_fetch_array($q);
			$_SESSION['id'] = $r['id'];
			redir("./");
   		}else{
   			alert("Datos no son validos");
   			redir("?p=admin");
   		}



	}


	if(isset($_SESSION['id'])){
		?>

		<a href="?p=agregarProductos">
			<button class="btn btn-primary"><i class="fas fa-plus-circle"></i>Agregar Productos</button>	
		</a>
		<a href="?p=agregarCategoria">
			<button class="btn btn-info"><i class="fas fa-plus-circle"></i>Agregar Categoria</button>	
		</a>
		<a href="?p=agregarOferta">
			<button class="btn btn-info"><i class="fas fa-plus-circle"></i>Agregar Oferta</button>	
		</a>
		<?php
	}else{
		?>
		<center>
			<form method="post" action="">				
			
				<div class="centrarLogin">
					<label><h2><i class="fas fa-key"></i>Iniciar Sesión como Administrador</h2></label>
					<div class="form-group">
						<input type="text" name="username" class="form-control" placeholder="Usuario">
					</div>

					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Contraseña">
					</div>

					<div class="form-group">
						<button class="btn btn-primary" name="enviar"><i class="fas fa-sign-in-alt"></i>Ingresar</button>
					</div>
				</div>
			</form>
		</center>

		<?php
	}

?>