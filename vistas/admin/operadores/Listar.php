<?php

    include('../../configuraciones/conexion.php');

    $titulo = 'Operadores';
    
    $errores = '';

    $nombreLlaveprimaria = 'ID';

    $resultado = null;

    if ($conn) {
        
       
        $sql =  "SELECT ID_USUARIO AS ID , NOM_USUARIO as 'NOMBRE', AP_USUARIO AS APELLIDO,GENERO as 'GENERO',FECHA_NAC AS 'FECHA DE NACIMIENTO' FROM usuarios where tipo = 'OPERADOR' ";

        $operadores = mysqli_query($conn,$sql);
        $resultado = mysqli_fetch_all($operadores,MYSQLI_ASSOC);

        mysqli_free_result($operadores);

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