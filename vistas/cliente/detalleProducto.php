<?php 

    include('../configuraciones/conexion.php');

    $titulo = 'Ver Producto';

    $datos = null;
    session_start();
    if ($conn) {

        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            if (isset($_GET['producto'])) {

                $id =  $_GET['producto'];

                $sql = "SELECT productos.ID_PRODUCTO AS 'id', 
                productos.NOM_PRODUCTO AS 'nombre', 
                productos.PRECIO AS 'precio', 
                productos.DESCRIPCION AS 'descripcion', 
                productos.IMAGEN AS 'imagen',
                proveedores.NOM_PROVEEDOR AS 'proveedor' 
                FROM productos INNER JOIN proveedores
                ON productos.ID_PROVEEDOR_FK=proveedores.ID_PROVEEDOR
                WHERE productos.ID_PRODUCTO='$id'";
                        
                $consulta = mysqli_query($conn, $sql);
            
                if ($consulta) {

                    $datos = mysqli_fetch_assoc($consulta);
                
                }

                mysqli_free_result($consulta);

            }
        }

    }   

?>

<!DOCTYPE html>

<html>

    <?php include('./modelo/cliente/encabezadoCliente.php'); ?>

    <?php include('./modelo/cliente/pieCliente.php'); ?>

</html>