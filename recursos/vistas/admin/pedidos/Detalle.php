<?php

    include('../../configuraciones/conexion.php');
    
    $titulo = 'Detalle Categoria';
    
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
        $id = $_GET['id'];
        $sql = "SELECT pedidos.ID_PEDIDO AS 'id', cliente.NOM_USUARIO AS 'cliente', 
        operador.NOM_USUARIO AS 'operador', pedidos.ESTADO_PEDIDO AS 'estado', 
        pedidos.FECHA_PEDIDO AS 'fecha', pedidos.DIRECCION AS 'direccion' 
        FROM pedidos INNER JOIN usuarios cliente ON pedidos.ID_CLIENTE_FK=cliente.ID_USUARIO 
        INNER JOIN usuarios operador ON pedidos.ID_OPERADOR_FK=operador.ID_USUARIO
        WHERE pedidos.ID_PEDIDO='$id'";

        $consulta = mysqli_query($conn,$sql);

        if($consulta && !empty($consulta)){

            $obtencion = true;
            $pedidos = mysqli_fetch_assoc($consulta);
            mysqli_free_result($consulta);

            $inputs = array(

                array('type' => 'text',
                        'id' => 'id',
                        'placeholder' => 'ID ',
                        'value' => $pedidos['id'],
                        'estado' => 'disabled'),
                array('type' => 'text',
                        'id' => 'nombre_operador',
                        'placeholder' => 'NOMBRE OPERADOR',
                        'value' => $pedidos['operador'],
                        'estado' => 'disabled'),
                array('type' => 'text',
                        'id' => 'nombre_cliente',
                        'placeholder' => 'NOMBRE CLIENTE',
                        'value' => $pedidos['cliente'],
                        'estado' => 'disabled'),
                array('type' => 'text',
                        'id' => 'estado',
                        'placeholder' => 'ESTADO',
                        'value' => $pedidos['estado'],
                        'estado' => 'disabled'),
                array('type' =>'text',
                        'id' => 'direccion',
                        'placeholder' => 'DIRECCION',
                        'value' => $pedidos['direccion'],
                        'estado' => 'disabled'),
                array('type' =>'date',
                        'id' => 'fecha',
                        'placeholder' => 'FECHA',
                        'value' => $pedidos['fecha'],
                        'estado' => 'disabled'), 
    
            );

            //permite añadir componentes como botones adicionales al boton del form 
            $botonAdicional = '<a href="./Modificar.php?id='.$_GET["id"].'" class="btn btn-lg btn-primary btn-admin text-uppercase font-weight-bold mb-2 ancho">Modificar</a>'.
            '<a href="./Eliminar.php?id='.$_GET["id"].'" class="btn btn-lg btn-primary btn-admin text-uppercase font-weight-bold mb-2 ancho">Eliminar</a>';

        }

    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        //el valor id de los inputs tambien son del name

    }

    mysqli_close($conn);

?>

<!DOCTYPE html>

<html>

    <?php include('../modelo/admin/encabezadoAdmin.php'); ?>

    <?php if(isset($obtencion) && $obtencion==false): ?>

        <h2 class='text-center'>El dato no existe</h2>

    <?php endif;?>

    <?php include('../modelo/admin/pieAdmin.php'); ?>

</html>