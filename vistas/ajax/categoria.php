<?php 

    include('../configuraciones/conexion.php');

    $categoria = null;

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $id = ((isset($_POST['id_categoria']))? $_POST['id_categoria'] : null);

        $sql = "SELECT NOM_CATEGORIA AS 'nombre_categoria', DESC_CATEGORIA AS 'descripcion' FROM categorias WHERE ID_CATEGORIA = '$id' ";

        $resultado = mysqli_query($conn,$sql);

        if($resultado){

            $categoria = mysqli_fetch_assoc($resultado);

        }

    }

    mysqli_close($conn);

    echo json_encode((isset($categoria))? $categoria : null);

?>