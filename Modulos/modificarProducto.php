<?php

	checkAdmin();

$id = clear($id);

$query = $mysqli->query("SELECT * FROM productos where id = '$id'");
$fquery = mysqli_fetch_array($query);

if(isset($enviar)){
$idProd = clear($idProd);
$nombre = clear($nombre);
$precio = clear($precio);
$categoria = clear($categoria);

$mysqli->query("UPDATE productos SET nombre = '$nombre',precio = '$precio',idCategoria = '$categoria' WHERE id = '$idProd'");
redir("?p=agregarProductos");
}
?>


<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
		<input type="text" name="nombre" class="form-control" value="<?=$fquery['nombre']?>" placeholder="Nombre del Producto">
	</div>	

	<div class="form-group">
		<input type="text" name="precio" class="form-control" value="<?=$fquery['precio']?>" placeholder="Precio del Producto">
	</div>	

	

	<div class="form-group">
		<select name="categoria" required class="form-control">
        <option value="" selected disabled>Seleccione una categoria</option>
		<?php
		$q = $mysqli->query("SELECT * FROM categorias ORDER BY nombre ASC");
		while($r = mysqli_fetch_array($q)){
			?>
           <option <?php if($fquery['idCategoria'] == $r['idCategoria']){ echo 'selected'; } ?> value="<?=$r['idCategoria']?>"><?=$r['nombre']?></option>
			<?php
		}
		?>
		</select>
	</div>	

	<div class="form-group">
		<button type="submit" class="btn btn-success" name="enviar"><i class="fas fa-check"></i>Modificar Producto</button>	
	</div>

    <input  type="hidden" name="idProd" value="<?=$id?>"/>
</form>