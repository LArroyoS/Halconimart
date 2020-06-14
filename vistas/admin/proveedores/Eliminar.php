<?php
include('../../configuraciones/conexion.php');
$headAdicional = '<script type="text/javascript" src="/tienda/recursos/js/proveedor.js?4.0"></script>';

$titulo = 'Eliminar Proveedor';
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
    'type' => 'tel',
    'id' => 'telefono',
    'placeholder' => 'Ingrese telefono del encargado',
    'value' => '',
    'estado' => 'disabled'
  ),

);

$botonForm = 'Eliminar';


if (isset($_GET['id']) && $conn) {

  $id = $_GET['id'];
  $sql = "SELECT ID_PROVEEDOR , NOM_PROVEEDOR, DIRECCION, CORREO,  NOMBRE_ENCARGADO , AP_ENCARGADO, TELEFONO 
    FROM proveedores WHERE ID_PROVEEDOR = '$id'";
  $consulta = mysqli_query($conn, $sql);

  if ($consulta && !empty($consulta)) {

    $proveedor = mysqli_fetch_assoc($consulta);
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
      }

      $i++;
    }
  }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $id_eliminar = mysqli_real_escape_string($conn, $_POST['id']);
  // crear sql
  $sql = "DELETE FROM proveedores WHERE ID_PROVEEDOR = '$id_eliminar' ";

  // Guardar en la base de datos y revisar
  if (mysqli_query($conn, $sql)) {

    header('Location: Listar.php');
  } else {

    //error
    $error = 'Ocurrio un error inesperado, no se pudo eliminar el proveedor';
  }
}

mysqli_close($conn);

?>

<!DOCTYPE html>

<html>

<?php include('../modelo/admin/encabezadoAdmin.php'); ?>



<?php include('../modelo/admin/pieAdmin.php'); ?>

</html>