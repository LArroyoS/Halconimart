<?php

    include('../../configuraciones/conexion.php');
    
    $titulo = 'Detalle Categoria';
    
    $obtencion = false;

    if (isset($_GET['id']) && $conn) {

        $id = $_GET['id'];
        $sql = "SELECT 	ID_CATEGORIA AS 'id_categoria', NOM_CATEGORIA AS 'nombre_categoria', DESC_CATEGORIA AS 'descripcion' FROM categorias WHERE ID_CATEGORIA = '$id' ";
        $consulta = mysqli_query($conn,$sql);

        if($consulta && !empty($consulta)){

            $obtencion = true;
            $categoria = mysqli_fetch_assoc($consulta);
            mysqli_free_result($consulta);

            $inputs = array(

                array('type' => 'text',
                        'id' => 'id',
                        'placeholder' => 'ID ',
                        'value' => $categoria['id_categoria'],
                        'estado' => 'disabled',),
                array('type' => 'text',
                        'id' => 'nombre_categoria',
                        'value' => $categoria['nombre_categoria'],
                        'placeholder' => 'Categoria',
                        'estado' => 'disabled'),
                array('type' => 'text',
                        'id' => 'descripcion',
                        'value' => $categoria['descripcion'],
                        'placeholder' => 'Descripcion',
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