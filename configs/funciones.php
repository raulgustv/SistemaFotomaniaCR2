<?php

	$localHost = "localhost";
	$user = "root";
	$passw = "";
	$dbName = "fotomaniasistemacr";

	$mysqli = mysqli_connect($localHost, $user, $passw, $dbName) or die ("Error de conexión");

	/* Funcion limpiar variable */

	function clear($var){
		htmlspecialchars($var);

		return $var;
	}

	function checkAdmin(){
		if(!isset($_SESSION['id'])){
			redir("./");
		}
	}


	function redir($var){
		?>
		<script>
			window.location=("<?=$var?>");
		</script>
		<?php

		die();
	}


	//funcion para mensajes de alerta
	function alert($var){
		?> 
		<script type="text/javascript">
			alert("<?=$var?>");
		</script>
		<?php	
	}

	function  checkUser($url){
		if(!isset($_SESSION['idCliente'])){
			redir("?p=login&return=<?=$url");
		}
	}


	function nombreCliente($idCliente){	

		$mysqli = conectar();
    	$q = $mysqli->query("SELECT * FROM clientes WHERE id = '$idCliente'");
    	$r = mysqli_fetch_array($q);
    	return $r['name'];
	}

	function conectar(){

		$localHost = "localhost";
		$user = "root";
		$passw = "";
		$dbName = "fotomaniacr";


		$mysqli = mysqli_connect($localHost, $user, $passw, $dbName);

		return $mysqli;
	}



?>