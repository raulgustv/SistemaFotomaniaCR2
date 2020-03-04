<?php

	checkAdmin();

	if(isset($enviar)){
        
		$nombre = clear($nombre);
        $oferta = clear($oferta);
        $producto = clear($producto);
        $fechainicio = clear($fechainicio);
        $fechafinal = clear($fechafinal); 
        if($nombre !== '' && !ctype_space($nombre)||$oferta !== '' && !ctype_space($oferta)){
		$q = $mysqli->query("INSERT INTO ofertas(idProducto,titulo,totalOferta,fechaInicio,fechaFinal) VALUES ('$producto', '$nombre', '$oferta', '$fechainicio', '$fechafinal')");
		alert("Oferta agregada");
		redir("?p=agregarOferta");
        }else{
        alert("existen algunos espacios vacios");   
        }
        }
        
        if(isset($eliminar)){
			$eliminar = clear($eliminar);
			$mysqli->query("DELETE FROM ofertas WHERE idOferta=$eliminar");
			redir("?p=agregarOferta");
  

	}


?>

<form method="post" action="" enctype="multipart/form-data">

	<div class="form-group">
		<input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre de la oferta">
	</div>	

	<div class="form-group">
        <label for="oferta">Porcentaje Oferta:</label>
		<input type="number" name="oferta" id="oferta" class="form-control" min ="1" max = "100">
	</div>

    <div class="form-group">
		<select name="producto" required class="form-control">
        <option value="" selected disabled>Seleccione un producto</option>
		<?php
		$q = $mysqli->query("SELECT * FROM productos ORDER BY id ASC");
		while($r = mysqli_fetch_array($q)){
			?>
           <option value="<?=$r['id']?>"><?=$r['nombre']?></option>
			<?php
		}
		?>
		</select>
	</div>	

    <label for="fechainicio">Fecha Inicio:</label>
    <input type="datetime-local" id="fechainicio" name="fechainicio" >
    
    <label for="fechafinal">Fecha Finalizacion:</label>
    <input type="datetime-local" id="fechafinal" name="fechafinal">
    <div class="form-group">
		<button type="submit" class="btn btn-success" name="enviar"><i class="fas fa-check"></i>Agregar oferta</button>	
	</div>
    	
</form>
<br>

<br>
<!-- Lista de productos -->
<table class="table table-stripped"> 
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Producto</th>
		<th>Descuento</th>
		<th>Fecha Inicio</th>
		<th>Fecha Finalizacion</th>
    </tr>

    <?php
   $ofertas = $mysqli ->query("SELECT * FROM ofertas ORDER by idOferta ASC");
   while($of=mysqli_fetch_array($ofertas)){
	$prod = $mysqli->query("SELECT * FROM productos WHERE id ='".$of['idProducto'] . "'");
	if(mysqli_num_rows($prod)>0){
		$fprod = mysqli_fetch_array($prod);
		$producto = $fprod['nombre'];
	}else{
		$producto="no";
	}
	
    ?>
     
     <tr>
         <td><?=$of['idOferta']?></td>
         <td><?=$of['titulo']?></td>
		 <td><?=$producto?></td>
         <td><?=$of['totalOferta']?>% de descuento</td>
		 <td><?=$of['fechaInicio']?></td>
         <td><?=$of['fechaFinal']?></td>
         <td>
		     <a href="?p=modificarOferta&id=<?=$of['idOferta']?>"><i class="fa fa-edit"></i></a> <!-- Boton modificar oferta -->
			 &nbsp;
             <a href="?p=agregarOferta&eliminar=<?=$of['idOferta']?>"><i class="fa fa-times"></i></a> <!-- Boton eliminar oferta -->
         </td>
     </tr>

    <?php
    }
    ?>
</table>