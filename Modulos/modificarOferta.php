<?php

	checkAdmin();

$id = clear($id);
$query = $mysqli->query("SELECT * FROM ofertas where idOferta = '$id'");
$fquery = mysqli_fetch_array($query);

if(isset($enviar)){
    $idOfer = clear($idOfer);
    $nombre = clear($nombre);
    $oferta = clear($oferta);
    $producto = clear($producto);
    $fechainicio = clear($fechainicio);
    $fechafinal = clear($fechafinal); 

    if($nombre !== '' && !ctype_space($nombre)||$oferta !== '' && !ctype_space($oferta)){
     $mysqli->query("UPDATE ofertas SET titulo = '$nombre',totalOferta = '$oferta',idProducto = '$producto',fechaInicio = '$fechainicio',fechaFinal = '$fechafinal' WHERE idOferta = '$idOfer'");
    redir("?p=agregarOferta");
    }
    else{
        alert("rellena los campos");
    }
}
?>


<form method="post" action="" enctype="multipart/form-data">

	<div class="form-group">
		<input type="text" name="nombre" id="nombre" class="form-control" value="<?=$fquery['titulo']?>" placeholder="Nombre de la oferta">
	</div>	

	<div class="form-group">
        <label for="oferta">Porcentaje Oferta:</label>
		<input type="number" name="oferta" id="oferta" value="<?=$fquery['totalOferta']?>" class="form-control" min ="1" max = "100">
	</div>

    <div class="form-group">
		<select name="producto" required class="form-control">
        <option value="" selected disabled>Seleccione un producto</option>
		<?php
		$q = $mysqli->query("SELECT * FROM productos ORDER BY id ASC");
		while($r = mysqli_fetch_array($q)){
			?>
           <option <?php if($fquery['idProducto'] == $r['id']){ echo 'selected'; } ?> value="<?=$r['id']?>"><?=$r['nombre']?></option>
			<?php
		}
		?>
		</select>
	</div>	

    <label for="fechainicio">Fecha Inicio:</label>
    <input type="datetime-local" id="fechainicio" name="fechainicio" >
    <div><a><?=$fquery['fechaInicio']?></a></div>
    <label for="fechafinal">Fecha Finalizacion:</label>
    <input type="datetime-local" id="fechafinal" name="fechafinal">
    <div><a><?=$fquery['fechaFinal']?></a></div>
    <div class="form-group">
		<button type="submit" class="btn btn-success" name="enviar"><i class="fas fa-check"></i>Modificar oferta</button>	
	</div>
    <input  type="hidden" name="idOfer" value="<?=$id?>"/>  	
</form>