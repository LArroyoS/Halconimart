<?php 

    include('../configuraciones/conexion.php');

    $insercion = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        session_start();
        $cliente = isset($_SESSION['id'])? $_SESSION['id']: '';
        $sql = "SELECT ID_PEDIDO FROM pedidos Where ID_CLIENTE_FK = '$cliente'
        AND ESTADO_PEDIDO='PENDIENTE' LIMIT 1";
        $resultado = mysqli_query($conn,$sql);
        if($resultado){

            $pedido = mysqli_fetch_assoc($resultado);
            $id = ((isset($_POST['id_producto']))? $_POST['id_producto'] : null);

            if(empty($pedido)){

                $sql = "INSERT INTO pedidos(ID_CLIENTE_FK,ESTADO_PEDIDO) 
                values('$cliente','PENDIENTE')";

                $resultado = mysqli_query($conn, $sql);

                $sql = "SELECT ID_PEDIDO FROM pedidos Where ID_CLIENTE_FK = '$cliente'
                AND ESTADO_PEDIDO='PENDIENTE' LIMIT 1";

                $resultado = mysqli_query($conn,$sql);

                if($resultado){

                    $pedido = mysqli_fetch_assoc($resultado);

                }

            }

            $idPed = $pedido["ID_PEDIDO"];
            $sql = "INSERT INTO detalle_pedido(ID_PEDIDO_FK,ID_PRODUCTO_FK,CANTIDAD) 
            values('$idPed','$id','1')";

            $resultado = mysqli_query($conn, $sql);

            if ($resultado) {
                $insercion = true;
            }

        }

    }

    mysqli_close($conn);

    echo json_encode($insercion);

?>