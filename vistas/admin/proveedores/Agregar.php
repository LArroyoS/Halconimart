<?php
include('../../configuraciones/conexion.php');
$headAdicional = '<script type="text/javascript" src="/tienda/recursos/js/proveedor.js?4.0"></script>';

$nombre_proveedor = $direccion = $correo = $nombre_encargado = $apellidos_encargado = $telefono = '';

$errors = array('nombre_proveedor' => '', 'direccion' => '', 'correo' => '', 'nombre_encargado' => '', 'apellidos_encargado' => '', 'telefono' => '');

$titulo = 'Agregar Proveedor';

/*
    
        En el arreglo de input podemos generar automaticamente los inputs en nuestras pantallas
        type = define el tupo del input, en caso de requerir una lista desplegable(select), defina como tipo select
        id = define el identificador del elemento, este se replicara en el atributo name del formulario
        placeholder = es el mensaje de muestra que indica la instruccion a realizar
        value = el valor del elemento
        values = es necesario cuando el elemento posee varios posibles valores, como en el caso de radiobuttons y selects
        estado = define atributos adicionales comunmente usado para desabilitar los componentes

    */

$inputs = array(

	array(
		'type' => 'text',
		'id' => 'nombre_proveedor',
		'placeholder' => 'Ingrese nombre del proveedor'
	),
	array(
		'type' => 'text',
		'id' => 'direccion',
		'placeholder' => 'Ingrese direccion del proveedor'
	),
	array(
		'type' => 'email',
		'id' => 'correo',
		'placeholder' => 'Ingrese correo del proveedor'
	),
	array(
		'type' => 'text',
		'id' => 'nombre_encargado',
		'placeholder' => 'Ingrese nombre del encargado'
	),
	array(
		'type' => 'text',
		'id' => 'apellidos_encargado',
		'placeholder' => 'Ingrese apellidos del encargado'
	),
	array(
		'type' => 'number',
		'id' => 'telefono',
		'placeholder' => 'Ingrese telefono del encargado'
	),

);

$botonForm = 'Guardar';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['enviar'])) {
		if (empty($_POST['nombre_proveedor'])) {
			$errors['nombre_proveedor'] = 'nombre del proveedor requerido <br/>';
		} else {
			$nombre_proveedor = $_POST['nombre_proveedor'];
			if (!preg_match('/^[a-zA-Z\s]+$/', $nombre_proveedor)) {
				$errors['nombre_proveedor'] = 'nombre_proveedor error';
			}
		}
		if (empty($_POST['direccion'])) {
			$errors['direccion'] = 'direccion requerida <br/>';
		} else {
			$direccion = $_POST['direccion'];
			if (!preg_match('/^[a-zA-Z\s]+$/', $direccion)) {
				$errors['direccion'] = 'direccion error';
			}
		}
		if (empty($_POST['correo'])) {
			$errors['correo'] = 'correo requerido <br/>';
		} else {
			$correo = $_POST['correo'];
			if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
				$errors['correo'] = 'correo error';
			}
		}
		if (empty($_POST['nombre_encargado'])) {
			$errors['nombre_encargado'] = 'nombre_encargado requerido <br/>';
		} else {
			$nombre_encargado = $_POST['nombre_encargado'];
			if (!preg_match('/^[a-zA-Z\s]+$/', $nombre_encargado)) {
				$errors['nombre_encargado'] = 'nombre_encargado error';
			}
		}
		if (empty($_POST['apellidos_encargado'])) {
			$errors['apellidos_encargado'] = 'apellidos_encargado requeridos <br/>';
		} else {
			$apellidos_encargado = $_POST['apellidos_encargado'];
			if (!preg_match('/^[a-zA-Z\s]+$/', $apellidos_encargado)) {
				$errors['apellidos_encargado'] = 'apellidos_encargado error';
			}
		}
		if (empty($_POST['telefono'])) {
			$errors['telefono'] = 'telefono requerido <br/>';
		} else {
			$telefono = $_POST['telefono'];
			if (!filter_var($telefono, FILTER_VALIDATE_INT)) {
				$errors['telefono'] = 'telefono error';
			}
		}

		if (array_filter($errors)) {
		} else {
			$nombre_proveedor = mysqli_real_escape_string($conn, $_POST['nombre_proveedor']);
			$direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
			$correo = mysqli_real_escape_string($conn, $_POST['correo']);
			$nombre_encargado = mysqli_real_escape_string($conn, $_POST['nombre_encargado']);
			$apellidos_encargado = mysqli_real_escape_string($conn, $_POST['apellidos_encargado']);
			$telefono = mysqli_real_escape_string($conn, $_POST['telefono']);

			//sql
			$sql = "INSERT INTO 
						proveedores(NOM_PROVEEDOR,DIRECCION,CORREO,NOMBRE_ENCARGADO,AP_ENCARGADO,TELEFONO)
							 VALUES('$nombre_proveedor','$direccion','$correo','$nombre_encargado','$apellidos_encargado','$telefono')";

			//guardar en la base de datos
			if (mysqli_query($conn, $sql)) {
				header('Location: Listar.php');
			} else {
				echo 'query error' . mysqli_error($conn);
			}
		}
	}
}
mysqli_close($conn);
?>

<!DOCTYPE html>

<html>

<?php include('../modelo/admin/encabezadoAdmin.php'); ?>

<?php include('../modelo/admin/pieAdmin.php'); ?>

</html>