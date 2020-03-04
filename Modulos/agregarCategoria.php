<?php
checkAdmin();
if(isset($enviar)){
    $categoria = clear($categoria);
    $s = $mysqli->query("SELECT * FROM categorias WHERE categoria = '$categoria'"); //revisa si categoria ya existe en el sistema
    if(mysqli_num_rows($s)>0){
alert("La categoria ingresada ya existe");
redir("");
    }else{
        $mysqli->query("INSERT INTO categorias (nombre) VALUES ('$categoria')");//agrega categoria ingresada en los campos
        alert("Categoria agregada");
        redir("");
    }
}
if(isset($eliminar)){
    $eliminar = clear($eliminar);
    $mysqli->query("DELETE FROM categorias WHERE idCategoria = $eliminar");//elimina la categoria al presionar boton
    alert("Categoria eliminada");
}

?>

<h1>Agregar Categoria</h1>

<form method="post" action="">
<div class="form-group">
    <input type="text" class="form-control" name="categoria" placeholder="Categoria"/>

</div>

<div class="form-group">
    <input type="submit" class="btn btn-primary" name="enviar" value="Agregar categoria"/>
    
</div>

</form>

<table class="table table-stripped">
    <tr>
        <th>ID</th>
        <th>Categoria</th>
        <th>Acciones</th>
    </tr>

    <?php
   $q = $mysqli ->query("SELECT * FROM categorias ORDER by idCategoria ASC");
   while($r=mysqli_fetch_array($q)){
    ?>
     
     <tr>
         <td><?=$r['idCategoria']?></td>
         <td><?=$r['nombre']?></td>
         <td>
             <a href="?p=agregarCategoria&eliminar=<?=$r['idCategoria']?>"><i class="fa fa-times"></i></a> <!-- Boton para eliminar categorias  --->
         </td>
     </tr>

    <?php
    }
    ?>
    
</table>