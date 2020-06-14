<?php 

    include('../configuraciones/conexion.php');

    $operadores = null;

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $id = ((isset($_POST['ID_USUARIO']))? $_POST['ID_USUARIO'] : null);

        $sql = "SELECT ID_USUARIO, CORREO, NOM_USUARIO, AP_USUARIO,TELEFONO,TIPO,CONTRASENA,GENERO,FECHA_NAC,CIUDAD FROM USUARIOS WHERE ID_USUARIO = '$id' ";

        $resultado = mysqli_query($conn,$sql);

        if($resultado){

            $operadores = mysqli_fetch_assoc($resultado);

        }

    }

    mysqli_close($conn);

    echo json_encode((isset($operadores))? $operadores : null);