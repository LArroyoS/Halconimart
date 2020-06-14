<?php

    include('../../configuraciones/conexion.php');

    $titulo = 'Categorias';
    
    $errores = '';

    $nombreLlaveprimaria = 'ID';

    $resultado = null;

    if ($conn) {
        
        $sql = "SELECT ID_CATEGORIA AS 'ID', NOM_CATEGORIA AS 'NOMBRE' FROM categorias";
        $consulta = mysqli_query($conn,$sql);
        $resultado = mysqli_fetch_all($consulta,MYSQLI_ASSOC);

        mysqli_free_result($consulta);

    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){



    }

    mysqli_close($conn);

?>

<!DOCTYPE html>

<html>

    <?php include('../modelo/admin/encabezadoAdmin.php'); ?>

    <?php if($resultado==null): ?>

        <h2 class="text-center" >Sin Datos</h2>

    <?php endif; ?>

    <?php include('../modelo/admin/pieAdmin.php'); ?>

</html>