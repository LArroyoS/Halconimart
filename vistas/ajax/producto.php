<?php 

    include('../configuraciones/conexion.php');

    $categoria = null;

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $id = ((isset($_POST['id']))? $_POST['id'] : null);

        $sql = "SELECT NOM_PRODUCTO AS 'nombre_producto', 
        DESCRIPCION AS 'descripcion', PRECIO AS 'precio', 
        ALMACEN AS 'cantidad', ID_PROVEEDOR_FK AS 'proveedor', 
        ID_CATEGORIA_FK AS 'categoria', IMAGEN AS 'imagen' 
        FROM productos WHERE ID_PRODUCTO = '$id' ";


        $resultado = mysqli_query($conn,$sql);

        if($resultado){

            $producto = mysqli_fetch_assoc($resultado);

        }

    }

    mysqli_close($conn);

    echo json_encode((isset($producto))? $producto : null);

?>