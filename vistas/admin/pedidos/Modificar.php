<?php

include('../../configuraciones/conexion.php');

$titulo = 'Modificar Pedido';

$headAdicional = '<script type="text/javascript" src="/tienda/recursos/js/pedidos.js?1.0"></script>';

$buscar = array(

    'type' => 'text',
    'id' => 'id_pedido',
    'placeholder' => 'ID pedido',
    'value' => '',
    'estado' => '',

);

$inputs = array(

    array('type' => 'select',
            'id' => 'operador',
            'placeholder' => 'Ingrese nombre del operador',
            'estado' => 'disabled',
            'values' => null,
            'value' => ""),
    array('type' => 'select',
            'id' => 'estado',
            'placeholder' => 'Ingrese estado del pedido',
            'estado' => 'disabled',
            'values' => array(
                            array('id' => 'COMPRADO',
                                    'nombre' => 'COMPRADO'),
                            array('id' => 'ENVIADO',
                                    'nombre' => 'ENVIADO'),
                            array('id' => 'ENTREGADO',
                                    'nombre' => 'ENTREGADO'),
                            ),

            'value' => ""),
);

$botonForm = 'Guardar';
$botonAdicional = '<a id="limpiar" class="btn btn-lg btn-primary text-white btn-admin text-uppercase font-weight-bold mb-2 ancho">Limpiar</a>';

if ($conn) {

    $sql = "SELECT usuarios.ID_USUARIO AS 'id', usuarios.NOM_USUARIO as 'nombre' 
    FROM usuarios WHERE usuarios.TIPO='OPERADOR'";

    $consulta = mysqli_query($conn,$sql);

    if($consulta){

        $operadores = mysqli_fetch_all($consulta, MYSQLI_ASSOC);
        mysqli_free_result($consulta);

        $inputs[0]['values'] = $operadores;

    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['enviar'])) {

            $id = mysqli_real_escape_string($conn, $_POST['id_pedido']);
            $operador = mysqli_real_escape_string($conn, $_POST['operador']);
            $estado = mysqli_real_escape_string($conn, $_POST['estado']);
    
            $sql = "UPDATE pedidos SET
                ID_OPERADOR_FK = '$operador',
                ESTADO_PEDIDO = '$estado'
                WHERE ID_PEDIDO = '$id' ";

            if (mysqli_query($conn, $sql)) {
                header('Location: ./Listar.php');
            } else {
                $errores = 'error';
            }
        }
    }

    if (isset($_GET['id'])) {

        $id = $_GET['id'];
        $sql = "SELECT pedidos.ID_PEDIDO AS 'id', pedidos.ID_OPERADOR_FK AS 'nombre',
        pedidos.ESTADO_PEDIDO AS 'estado' FROM pedidos WHERE ID_PEDIDO='$id' ";
        $consulta = mysqli_query($conn, $sql);

        if ($consulta && !empty($consulta)) {
            $botonAdicional = '';
            $categoria = mysqli_fetch_assoc($consulta);
            mysqli_free_result($consulta);

            $i = 0;
            foreach ($categoria as $valor) {
                if ($i == 0) {
                    $buscar['estado'] = 'readonly';
                    $buscar['value'] = $valor;
                } else {
                    $inputs[$i-1]['value'] = $valor;
                    $inputs[$i-1]['estado'] = '';
                }

                $i++;
            }

        }

    }
    else{

        $buscar = null;
        $inputs = null;
        $botonForm = null;
        $botonAdicional = null;

    }

}

mysqli_close($conn);

?>
<!DOCTYPE html>

<html>

    <?php include('../modelo/admin/encabezadoAdmin.php'); ?>



    <?php include('../modelo/admin/pieAdmin.php'); ?>

</html>