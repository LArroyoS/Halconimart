<?php

    include('../../configuraciones/conexion.php');

    $titulo = 'Pedidos';
    
    $errores = '';

    $nombreLlaveprimaria = 'ID';

    $resultado = null;

    if ($conn) {
        
        $sql = "SELECT pedidos.ID_PEDIDO AS 'ID', cliente.NOM_USUARIO AS 'CLIENTE', operador.NOM_USUARIO AS 'OPERADOR', pedidos.ESTADO_PEDIDO AS 'ESTADO', pedidos.FECHA_PEDIDO AS 'FECHA' FROM pedidos INNER JOIN usuarios cliente ON pedidos.ID_CLIENTE_FK=cliente.ID_USUARIO 
        LEFT JOIN usuarios operador ON pedidos.ID_OPERADOR_FK=operador.ID_USUARIO WHERE pedidos.ESTADO_PEDIDO!='PENDIENTE'";
        
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