<?php
include('../../configuraciones/conexion.php');


$titulo = 'Proveedores';

$errores = '';

$nombreLlaveprimaria = 'ID';

$resultado = null;

if ($conn) {
  $sql = "SELECT ID_PROVEEDOR  as 'ID', NOM_PROVEEDOR as 'PROVEEDOR', CORREO as 'CORREO', TELEFONO as 'TELEFONO' 
        FROM proveedores";
  $consulta = mysqli_query($conn, $sql);
  $resultado = mysqli_fetch_all($consulta, MYSQLI_ASSOC);

  mysqli_free_result($consulta);
}

mysqli_close($conn);

?>

<!DOCTYPE html>

<html>

<?php include('../modelo/admin/encabezadoAdmin.php'); ?>

<?php if ($resultado == null) : ?>

  <h2 class="text-center">Sin Datos</h2>

<?php endif; ?>

<?php include('../modelo/admin/pieAdmin.php'); ?>

</html>