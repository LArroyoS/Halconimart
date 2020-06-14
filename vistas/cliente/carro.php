<?php
include('../configuraciones/conexion.php');
$titulo = 'Ver Producto';

$carro = null;

if ($conn) {
    
    session_start();
    $cliente = isset($_SESSION['id'])? $_SESSION['id']: '';

    $carro = array(

        array(
          'id' => '1',
          'nombre' => 'producto1',
          'precio' => '00.00',
          'imagen' => '',
          'cantidad' => '2',
        ),
        array(
          'id' => '2',
          'nombre' => 'producto2',
          'precio' => '00.00',
          'imagen' => '',
          'cantidad' => '2',
        ),
        array(
          'id' => '3',
          'nombre' => 'producto3',
          'precio' => '00.00',
          'imagen' => '',
          'cantidad' => '1',
        ),
        array(
          'id' => '4',
          'nombre' => 'producto4',
          'precio' => '00.00',
          'imagen' => '',
          'cantidad' => '1',
        ),
      );
      
      $total = 0;
    $sql = "SELECT pedidos.ID_PEDIDO AS 'pedido',
    detalle_pedido.ID_DETALLE AS 'detalle',
    productos.ID_PRODUCTO AS 'id',
    productos.NOM_PRODUCTO AS 'nombre', 
    productos.PRECIO AS 'precio', 
    productos.IMAGEN AS 'imagen'
    FROM detalle_pedido
    INNER JOIN pedidos ON detalle_pedido.ID_PEDIDO_FK=pedidos.ID_PEDIDO
    INNER JOIN productos ON productos.ID_PRODUCTO=detalle_pedido.ID_PRODUCTO_FK
    WHERE pedidos.ESTADO_PEDIDO='PENDIENTE' AND pedidos.ID_CLIENTE_FK='$cliente'";

  $consulta = mysqli_query($conn, $sql);

  if ($consulta) {

    $carro = mysqli_fetch_all($consulta, MYSQLI_ASSOC);
  } else {

    $carro = null;
  }

  mysqli_free_result($consulta);

}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if(isset($_POST['eliminarProducto'])) {

    $id_eliminar = $id_eliminar = mysqli_real_escape_string($conn, $_POST['detalle']);

      $sql = "SELECT detalle_pedido.ID_PRODUCTO_FK, productos.ALMACEN
      FROM detalle_pedido
      INNER JOIN productos 
      ON productos.ID_PRODUCTO = detalle_pedido.ID_PRODUCTO_FK 
      WHERE ID_DETALLE = '$id_eliminar'";

      $resultado = mysqli_query($conn, $sql);
      $producto = mysqli_fetch_assoc($resultado);
      if(!empty($producto)){

        $agregar = $producto['ALMACEN']+1;
        $producto = $producto['ID_PRODUCTO_FK'];
        $sql = "UPDATE productos SET ALMACEN = '$agregar' 
        WHERE  ID_PRODUCTO = '$producto'";
        $resultado = mysqli_query($conn, $sql);

        $sql = "DELETE FROM detalle_pedido WHERE ID_DETALLE = '$id_eliminar'";

        if (mysqli_query($conn, $sql)) {

          header('Location: carro.php');

        } else {

          $errores = 'Ocurrio un error inesperado, no se pudo eliminar el Producto de carrito';
          
        }

      }
      else{

        $errores = 'Ocurrio un error inesperado, no se pudo eliminar el Producto de carrito';

      }

  }
  if (isset($_POST['comprar'])) {
    
    echo $carro[0]['pedido'];
    $pedido = $carro[0]['pedido'];
    $sql = "UPDATE pedidos SET
          ESTADO_PEDIDO = 'COMPRADO'
          FECHA_PEDIDO = NOW()
          WHERE ID_PEDIDO = '$pedido' ";

    if (mysqli_query($conn, $sql)) {

      header('Location: index.php');

    } else {

      $error = 'Ocurrio un error inesperado, no se pudo eliminar el Producto de carrito';
    }
  }
  if (isset($_POST['comprar'])) {
    
    $direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
    $pedido = mysqli_real_escape_string($conn, $_POST['pedido']);
    $sqlcomprar = "UPDATE pedidos SET ESTADO_PEDIDO = 'COMPRADO',
      DIRECCION = '$direccion'  WHERE ID_PEDIDO = '$pedido'";

    if (mysqli_query($conn, $sqlcomprar)) {
      header('Location: index.php');
    } else {
      //error
      $error = 'Ocurrio un error inesperado, no se pudo comprar el Producto';
    }
  }
}

?>

<!DOCTYPE html>

<html>

<?php include('./modelo/cliente/encabezadoCliente.php'); ?>

<?php include('./modelo/cliente/pieCliente.php'); ?>

</html>