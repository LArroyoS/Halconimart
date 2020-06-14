<?php 

    include('../configuraciones/conexion.php');

    $proveedor = null;

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $id = ((isset($_POST['id']))? $_POST['id'] : null);

        $sql = "SELECT NOM_PROVEEDOR  AS 'nombre_proveedor', DIRECCION AS 'direccion', CORREO AS 'correo', NOMBRE_ENCARGADO AS 'nombre_encargado', AP_ENCARGADO AS 'apellidos_encargado', TELEFONO AS 'telefono'
        FROM proveedores WHERE ID_PROVEEDOR = '$id'";
        $resultado = mysqli_query($conn,$sql);

        if($resultado){

            $proveedor = mysqli_fetch_assoc($resultado);

        }

    }

    mysqli_close($conn);

    echo json_encode((isset($proveedor))? $proveedor : null);

?>