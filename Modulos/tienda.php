<select id="selectcat" onchange= "redirCat()" class="form-control">
<option value="" selected disabled>Seleccione un filtro</option>
<option value="0">Sin filtro</option>
<?php
$categorias = $mysqli->query("SELECT * FROM categorias ORDER BY nombre ASC");
while($fcategorias = mysqli_fetch_array($categorias)){
?>
<option value="<?=$fcategorias['idCategoria'] ?>"> <?=$fcategorias['nombre'] ?> </option>
<?php
}
?>
</select>
<?php

	checkUser("tienda"); //descomentar para que cliente pueda ver tienda solo al iniciar sesión (temporal)
if(isset($categoria)and $categoria!== "0"){
	$sc= $mysqli->query("SELECT * FROM categorias WHERE idCategoria = '$categoria'");
	$fc = mysqli_fetch_array($sc);
	?>
	<h1>Mostrando productos por: <?=$fc['nombre']?></h1>
	<?php
}


	if(isset($agregar) && isset($cant)){

		$idProd = clear($agregar);
		$cant = clear($cant);
		$idCliente = clear($_SESSION['idCliente']);

		$v = $mysqli->query("SELECT * FROM carro where idCliente = '$idCliente' AND idProducto = '$idProd'");
		if(mysqli_num_rows($v)>0){ //si ya el producto esta en carrito, con la sesión iniciada

			$q = $mysqli->query("UPDATE carro SET cantidad = cantidad + $cant WHERE idCliente = '$idCliente' AND idProducto = '$idProd'"); //actualiza cantidad productos

		}else{
			$q = $mysqli->query("INSERT INTO carro (idCliente, idProducto, cantidad) VALUES ($idCliente, $idProd, $cant)");
			//solo inserta producto
		}

		
		alert("Se añadieron productos");
		redir("?p=tienda");
	}

    if(isset($categoria)and $categoria!== "0"){
	$q = $mysqli->query("SELECT * FROM productos WHERE idCategoria = '$categoria' ORDER by id DESC");	
	}else{
	 $q = $mysqli->query("SELECT * FROM productos ORDER by id DESC");
	 }
	while($r=mysqli_fetch_array($q)){
		?>
		<div class="producto">
			<div class="nombreProducto"><?=$r['nombre']?></div>

			<div>
				<img class="imgProducto" src="imagenproductos/<?=$r['imagen']?>"/>
			</div>

			 <?php //Aplica la oferta a cualquier producto con una oferta actualmente registrada
			 $idprod = $r['id'];
			 $of = $mysqli->query("SELECT * FROM ofertas WHERE idProducto = '$idprod'");
			 if(mysqli_num_rows($of)>0){
			$ofer=mysqli_fetch_array($of);
			$desc = 1-($ofer['totalOferta']/100);
			 $preciofinal = round($r['precio']*$desc);
			 }else{
			 $preciofinal = $r['precio'];	 
			 }
			 ?> <!-- fin aplicar oferta --->

			<span class="precio"><?php if($preciofinal!=$r['precio']){echo'<font color="red"><del>'; echo $divisa; echo $r['precio']; echo'</del></font>  ';} ?><?=$divisa?><?=$preciofinal?></span>


			<?php
				if(isset($_SESSION['idCliente'])){
					?>

					<button class= "btn btn-primary float-right" onclick="agregarCarro('<?=$r['id']?>');"><i class="fas fa-shopping-cart"></i></button>

					<?php
				}
			?>



		

		</div>

		

		<?php
	}

?>

<script type="text/javascript">
	function agregarCarro (idProd) {
		var cant = prompt("Cantidad a agregar?", 1);

		if(cant.length > 0){
			window.location="?p=tienda&agregar="+idProd+"&cant="+cant;
		}
		
	}

	function redirCat(){
		window.location = "?p=tienda&categoria="+$("#selectcat").val();
	}
</script>