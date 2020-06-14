<?php
include('../../configuraciones/conexion.php');
$headAdicional = '<script type="text/javascript" src="/tienda/recursos/js/proveedor.js?4.0"></script>';

$titulo = 'Modificar Proveedor';

$buscar = array(

	'type' => 'text',
  'id' => 'id',
  'placeholder' => 'ID proveedor',
  'value' => '',
  'estado' => '',

);

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
    'placeholder' => 'Ingrese nombre del proveedor',
    'value' => '',
    'estado' => 'disabled'
  ),
  array(
    'type' => 'text',
    'id' => 'direccion',
    'placeholder' => 'Ingrese direccion del proveedor',
    'value' => '',
    'estado' => 'disabled'
  ),
  array(
    'type' => 'email',
    'id' => 'correo',
    'placeholder' => 'Ingrese correo del proveedor',
    'value' => '',
    'estado' => 'disabled'
  ),
  array(
    'type' => 'text',
    'id' => 'nombre_encargado',
    'placeholder' => 'Ingrese nombre del encargado',
    'value' => '',
    'estado' => 'disabled'
  ),
  array(
    'type' => 'text',
    'id' => 'apellidos_encargado',
    'placeholder' => 'Ingrese apellidos del encargado',
    'value' => '',
    'estado' => 'disabled'
  ),
  array(
    'type' => 'number',
    'id' => 'telefono',
    'placeholder' => 'Ingrese telefono del encargado',
    'value' => '',
    'estado' => 'disabled'
  ),

);

$botonForm = 'Guardar';

if (isset($_GET['id']) && $conn) {

	$id = $_GET['id'];
	$sql = "SELECT ID_PROVEEDOR , NOM_PROVEEDOR, DIRECCION, CORREO, NOMBRE_ENCARGADO, AP_ENCARGADO, TELEFONO 
    FROM proveedores WHERE ID_PROVEEDOR  = '$id'";
	$consulta = mysqli_query($conn, $sql);

	if ($consulta && !empty($consulta)) {
		$proveedor= mysqli_fetch_assoc($consulta);
		mysqli_free_result($consulta);


		$consulta = array(
      'id' => $proveedor['ID_PROVEEDOR'],
      'nombre' => $proveedor['NOM_PROVEEDOR'],
      'direccion' => $proveedor['DIRECCION'],
      'correo' => $proveedor['CORREO'],
      'encargado' => $proveedor['NOMBRE_ENCARGADO'],
      'apellidos' => $proveedor['AP_ENCARGADO'],
      'telefono' => $proveedor['TELEFONO'],
    );
		$i = 0;
		foreach ($consulta as $valor) {

			if ($i == 0) {

				$buscar['estado'] = 'readonly';
				$buscar['value'] = $valor;
			} else {

				$inputs[$i - 1]['value'] = $valor;
				$inputs[$i - 1]['estado'] = '';
			}

			$i++;
		}
	}
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$id = mysqli_real_escape_string($conn, $_POST['id']);
	$nombre_proveedor = mysqli_real_escape_string($conn, $_POST['nombre_proveedor']);
	$direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
	$correo = mysqli_real_escape_string($conn, $_POST['correo']);
	$nombre_encargado = mysqli_real_escape_string($conn, $_POST['nombre_encargado']);
	$apellidos_encargado = mysqli_real_escape_string($conn, $_POST['apellidos_encargado']);
	$telefono = mysqli_real_escape_string($conn, $_POST['telefono']);

	// crear sql
	$sql = "UPDATE proveedores SET
						NOM_PROVEEDOR = '$nombre_proveedor',DIRECCION = '$direccion',
						CORREO = '$correo',NOMBRE_ENCARGADO = '$nombre_encargado',
						AP_ENCARGADO = '$apellidos_encargado',TELEFONO = '$telefono'
						 WHERE ID_PROVEEDOR  = '$id' ";

	// Guardar en la base de datos y revisar
	if (mysqli_query($conn, $sql)) {

		//Exito
		//echo  'form es valido';
		header('Location: Listar.php');
	} else {

		//error
		$error = 'Ocurrio un error inesperado, no se pudo modificar el proveedor';
	}
}

mysqli_close($conn);

?>

<!DOCTYPE html>

<html>

<?php include('../modelo/admin/encabezadoAdmin.php'); ?>



<?php include('../modelo/admin/pieAdmin.php'); ?>

</html>