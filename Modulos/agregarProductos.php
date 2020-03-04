<?php

	checkAdmin();

	if(isset($enviar)){
		$name = clear($nombre);
		$precio = clear($precio);
		$imagen = "";

		if(is_uploaded_file($_FILES['imagen']['tmp_name'])){
			$imagen = $nombre.rand(0,1000).".png";
			move_uploaded_file($_FILES['imagen']['tmp_name'], "imagenproductos/".$imagen);
		}

		$q = $mysqli->query("INSERT INTO productos(nombre, precio, imagen) VALUES ('$nombre', '$precio', '$imagen')");
		alert("Producto agregado");
		redir("?p=agregarProductos");

		if(isset($eliminar)){
			$eliminar = clear($eliminar);
			$mysqli->query("DELETE FROM productos WHERE id = $eliminar");
			redir("?p=agregarProductos");
		}
  

	}


?>


<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
		<input type="text" name="nombre" class="form-control" placeholder="Nombre del Producto">
	</div>	

	<div class="form-group">
		<input type="text" name="precio" class="form-control" placeholder="Precio del Producto">
	</div>	

	<label>Imagen</label>

	<div class="form-group">
		<input type="file" name="imagen" class="form-control" placeholder="Imagen del Producto">
	</div>	

	<div class="form-group">
		<select name="categoria" required class="form-control">
        <option value="" selected disabled>Seleccione una categoria</option>
		<?php
		$q = $mysqli->query("SELECT * FROM categorias ORDER BY nombre ASC");
		while($r = mysqli_fetch_array($q)){
			?>
           <option value="<?=$r['idCategoria']?>"><?=$r['nombre']?></option>
			<?php
		}
		?>
		</select>
	</div>	

	<div class="form-group">
		<button type="submit" class="btn btn-success" name="enviar"><i class="fas fa-check"></i>Agregar Producto</button>	
	</div>
</form><br>

<br>
<!-- Lista de productos -->
<table class="table table-stripped"> 
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Categoria</th>
		<th>Precio</th>
		<th>Imagen</th>
		<th>Acciones</th>
    </tr>

    <?php
   $productos = $mysqli ->query("SELECT * FROM productos ORDER by id ASC");
   while($pr=mysqli_fetch_array($productos)){
	$cat = $mysqli->query("SELECT * FROM categorias WHERE idCategoria ='".$pr['idCategoria'] . "'");
	if(mysqli_num_rows($cat)>0){
		$fcat = mysqli_fetch_array($cat);
		$categoria = $fcat['nombre'];
	}else{
		$categoria="no";
	}
	
    ?>
     
     <tr>
         <td><?=$pr['id']?></td>
         <td><?=$pr['nombre']?></td>
		 <td><?=$categoria?></td>
         <td><?=$pr['precio']?></td>
		 <td><img src="imagenproductos/<?=$pr['imagen']?>" class="imagenCarro"/></td>
         <td>
		     <a href="?p=modificarProducto&id=<?=$pr['id']?>"><i class="fa fa-edit"></i></a> <!-- Boton modificar producto -->
			 &nbsp;
             <a href="?p=agregarProducto&eliminar=<?=$pr['id']?>"><i class="fa fa-times"></i></a> <!-- Boton eliminar producto -->
         </td>
     </tr>

    <?php
    }
    ?>
</table>