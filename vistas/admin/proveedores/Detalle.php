<?php
include('../../configuraciones/conexion.php');


$proveedor = null;
$titulo = 'Detalle Proveedor';
$id_listar = $_GET['id'];
$obtencion = false;

if (isset($_GET['id']) && $conn) {

	/*
    
        En el arreglo de input podemos generar automaticamente los inputs en nuestras pantallas
        type = define el tupo del input, en caso de requerir una lista desplegable(select), defina como tipo select
        id = define el identificador del elemento, este se replicara en el atributo name del formulario
        placeholder = es el mensaje de muestra que indica la instruccion a realizar
        value = el valor del elemento
        values = es necesario cuando el elemento posee varios posibles valores, como en el caso de radiobuttons y selects
        estado = define atributos adicionales comunmente usado para desabilitar los componentes

        */

	$sql = "SELECT ID_PROVEEDOR , NOM_PROVEEDOR, DIRECCION, CORREO, NOMBRE_ENCARGADO, AP_ENCARGADO, TELEFONO 
	FROM proveedores WHERE ID_PROVEEDOR  = '$id_listar'";

	$consulta = mysqli_query($conn, $sql);

	if ($consulta && !empty($consulta)) {
		
		$obtencion = true;
		$proveedor = mysqli_fetch_assoc($consulta);
		mysqli_free_result($consulta);

		$inputs = array(

			array(
				'type' => 'text',
				'id' => 'id',
				'placeholder' => 'ID ',
				'value' => $proveedor['ID_PROVEEDOR'],
				'estado' => 'disabled'
			),
			array(
				'type' => 'text',
				'id' => 'nombre_proveedor',
				'placeholder' => 'NOMBRE PROVEEDOR',
				'value' => $proveedor['NOM_PROVEEDOR'],
				'estado' => 'disabled'
			),
			array(
				'type' => 'text',
				'id' => 'direccion',
				'placeholder' => 'DIRECCION',
				'value' => $proveedor['DIRECCION'],
				'estado' => 'disabled'
			),
			array(
				'type' => 'email',
				'id' => 'correo',
				'placeholder' => 'CORREO',
				'value' => $proveedor['CORREO'],
				'estado' => 'disabled'
			),
			array(
				'type' => 'text',
				'id' => 'nombre_encargado',
				'placeholder' => 'NOMBRE ENCARGADO',
				'value' => $proveedor['NOMBRE_ENCARGADO'],
				'estado' => 'disabled'
			),
			array(
				'type' => 'text',
				'id' => 'apellidos_encargado',
				'placeholder' => 'APELLIDOS ENCARGADO',
				'value' => $proveedor['AP_ENCARGADO'],
				'estado' => 'disabled'
			),
			array(
				'type' => 'tel',
				'id' => 'telefono',
				'placeholder' => 'TELEFONO',
				'value' => $proveedor['TELEFONO'],
				'estado' => 'disabled'
			),

		);

		$botonAdicional = '<a href="./Modificar.php?id=' . $_GET["id"] . '" class="btn btn-lg btn-primary btn-admin text-uppercase font-weight-bold mb-2 ancho">Modificar</a>' .
			'<a href="./Eliminar.php?id=' . $_GET["id"] . '" class="btn btn-lg btn-primary btn-admin text-uppercase font-weight-bold mb-2 ancho">Eliminar</a>';
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	}
}

mysqli_close($conn);

?>

<!DOCTYPE html>

<html>

<?php include('../modelo/admin/encabezadoAdmin.php'); ?>

<?php if (isset($obtencion) && $obtencion == false) : ?>

	<h2 class='text-center'>El dato no existe</h2>

<?php endif; ?>

<?php include('../modelo/admin/pieAdmin.php'); ?>

</html>