<?php
include('../configuraciones/conexion.php');

$titulo = 'Catalogo';
$productos = null;
session_start();
if($conn){
	
	$sql = "SELECT ID_CATEGORIA AS 'id', NOM_CATEGORIA AS 'nombre' FROM categorias";
	$consulta= mysqli_query($conn, $sql);

	if($consulta){

		$categorias = mysqli_fetch_all($consulta,MYSQLI_ASSOC);

	}

	mysqli_free_result($consulta);

	$sql = "SELECT ID_PRODUCTO AS 'id', NOM_PRODUCTO AS 'nombre', PRECIO AS 'precio', DESCRIPCION AS 'descripcion', IMAGEN AS 'imagen' FROM productos";
	$consulta = mysqli_query($conn, $sql);

	if($consulta){

		$productos = mysqli_fetch_all($consulta,MYSQLI_ASSOC);

	}

	mysqli_free_result($consulta);

	if ($_SERVER["REQUEST_METHOD"] == "GET") {

		if (isset($_GET['categoria'])) {
			
			$tipo =  $_GET['categoria'];
			$sql = "SELECT ID_PRODUCTO AS 'id', NOM_PRODUCTO AS 'nombre', PRECIO AS 'precio', DESCRIPCION AS 'descripcion', IMAGEN AS 'imagen' FROM productos 
					WHERE ID_CATEGORIA_FK='$tipo'";
			
			$consulta = mysqli_query($conn, $sql);

            if ($consulta) {

				$productos = mysqli_fetch_all($consulta, MYSQLI_ASSOC);
				
			}
			else{

				$productos = null;

			}
			
			mysqli_free_result($consulta);	

		} 
		else if (isset($_GET['nombre'])) {
						
			$nombre =  $_GET['nombre'];
			$sql = "SELECT ID_PRODUCTO AS 'id', NOM_PRODUCTO AS 'nombre', PRECIO AS 'precio', DESCRIPCION AS 'descripcion', IMAGEN AS 'imagen' FROM productos 
					WHERE NOM_PRODUCTO LIKE '%$nombre%'";
			
			$consulta = mysqli_query($conn, $sql);
			
			if ($consulta) {
				
				$productos = mysqli_fetch_all($consulta, MYSQLI_ASSOC);
			
			}
			else{

				$productos = null;

			}
			mysqli_free_result($consulta);	

		}

	}
		
}
else {
			
	$error = 'Error: ' . mysqli_connect_error();

}

mysqli_close($conn);

?>

<!DOCTYPE html>

<html>

<?php include('./modelo/cliente/encabezadoCliente.php'); ?>

<?php include('./modelo/cliente/pieCliente.php'); ?>

</html>