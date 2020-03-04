<?php
checkUser("carrito");


if(isset($finalizar)){

	$monto = clear($montoTotal);
	$idCliente = clear($_SESSION['idCliente']);


	//ingresar a tabla compra la compra de un producto, antes ingresar hay que verificar compra con paypal. Pendiente!
	$q = $mysqli->query("INSERT INTO compra (idCliente, fecha, monto, estado) VALUES ('$idCliente', NOW(), '$monto', 0) ");

	$sc = $mysqli->query("SELECT * FROM compra WHERE idCliente = '$idCliente' ORDER BY id DESC LIMIT 1");
	$rc = mysqli_fetch_array($sc);
	$ultimaCompra = $rc['id'];


	$q2 = $mysqli->query("SELECT * FROM carro where idCliente = '$idCliente' ");
	while($r2=mysqli_fetch_array($q2)){

		$sp = $mysqli->query("SELECT * FROM productos WHERE id = '".$r2['idProducto']."'");
		$rp = mysqli_fetch_array($sp);
		$monto = $rp['precio'];

		$mysqli->query("INSERT INTO productosCompra (idCompra, idProducto, cantidad, monto) VALUES  ('$ultimaCompra', '".$r2['idProducto']."','".$r2['cantidad']."','$monto')");
	}

	$mysqli->query("DELETE FROM carro WHERE idCliente = '$idCliente'"); //comentar es solo prueba por ahora
	alert("Compra finalizada");
	// redir("./");

}

?>

<h1><i class="fas fa-shopping-cart"></i>Carrito de compras</h1>

<br><br>

<table class="table table-striped">
	
	<tr>
		<th>Producto</th>
		<th>Nombre producto</th>
		<th>Cantidad</th>
		<th>Precio Unitario</th>
		<th>Precio Total (IVA incluído)</th>
		<th>Descuento</th>
		
		<th>Precio Final</th>
		
		<?php
		$idCliente = clear($_SESSION['idCliente']);
		$q = $mysqli->query("SELECT * FROM carro Where idCliente = '$idCliente'"); // recorre carro 

		$montoTotal = 0;
	
		while($r = mysqli_fetch_array($q)){
		     $of = $mysqli->query("SELECT * FROM ofertas WHERE idProducto = '".$r['idProducto']."'"); // recorre productos para determinar el nombre
			$of2 = mysqli_fetch_array($of);
			
		}
			?>	
	</tr>

<?php

	$idCliente = clear($_SESSION['idCliente']);

	$q = $mysqli->query("SELECT * FROM carro Where idCliente = '$idCliente'"); // recorre carro 

	$montoTotal = 0;

	while($r = mysqli_fetch_array($q)){

			$q2 = $mysqli->query("SELECT * FROM productos WHERE id = '".$r['idProducto']."'"); // recorre productos para determinar el nombre
			$r2 = mysqli_fetch_array($q2);

			$imagen = $r2['imagen'];
			$nombreProducto = $r2['nombre'];
			$cantidad = $r['cantidad'];
			$precioUnidad = $r2['precio'];
			$impuesto = $cantidad * $precioUnidad * $iva; // aun no se muestra
			$precioTotal = $cantidad * $precioUnidad + $impuesto;
            $desctotal = 0;
			
			$ofertas = $mysqli->query("SELECT * FROM ofertas WHERE idProducto = '".$r2['id']."'"); //recorre ofertas para saber cual es la del producto, si tiene
			$of = mysqli_fetch_array($ofertas);
			if(mysqli_num_rows($ofertas)>0){
				$desc = 1-($of['totalOferta']/100);
				$descunitario = round($r2['precio']*$desc)-$r2['precio'];
				$desctotal = $descunitario*$cantidad;
			}else{
				$desctotal = 0;
			}
			$montoTotal = ($montoTotal + $precioTotal) + $desctotal;
			?>

			
			<tr>
				<td><img src="imagenproductos/<?=$imagen?>" class="imagenCarro"/></td>
				<td><?=$nombreProducto?></td>
				<td><?=$cantidad?></td>
				<td><?=$divisa?><?=$precioUnidad?></td>
				<td><?=$divisa?><?=$precioTotal?></td>
                <td><?=$divisa?><?=$desctotal?></td>

				<td><?=$divisa?><?=$precioTotal + $desctotal?></td>
			</tr>

			<?php
	}

?>

</table>

<h4>Monto total <b class="text-success"><?=$divisa?><?=$montoTotal?></b></h4>

<br><br>

<form method="post" action="">
	<input type="hidden" name="montoTotal" value="<?=$montoTotal?>"/>
	<div class="btnCompra float-right">
		<button class="btn btn-primary" name="finalizar"><i class="fas fa-check"></i> Finalizar compra</button>
	</div>	
</form>

