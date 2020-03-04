<?php

	if(isset($_SESSION['idCliente'])){
		redir("./");
	}



	if(isset($enviar)){

		//limpiar variables
		$username = clear($username);
		$password = clear($password);

		//consulta inicio sesión

		$q = $mysqli->query("SELECT * FROM clientes WHERE user = '$username' AND pass = '$password'");
  
    	if(mysqli_num_rows($q)>0){
    		$r = mysqli_fetch_array($q);
			$_SESSION['idCliente'] = $r['id'];

			if(isset($return)){
				redir("?p=".$return);
			}else{
				redir("./");
			}

			
   		}else{
   			alert("Datos no son validos");
   			redir("?p=login");
   		}



	}


		?>
		<center>
			<form method="post" action="">				
			
				<div class="centrarLogin">
					<label><h2><i class="fas fa-key"></i>Iniciar Sesión</h2></label>
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


