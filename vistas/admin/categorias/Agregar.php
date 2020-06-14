<?php

    include('../../configuraciones/conexion.php');
    //$titulo define el titulo de la aplicacion
    $titulo = 'Agregar Categoria';

    $headAdicional = '<script type="text/javascript" src="/tienda/recursos/js/categoria.js?1.0"></script>';

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

        array('type' => 'text',
                'id' => 'nombre_categoria',
                'placeholder' => 'Ingrese nombre de categoria'),
        array('type' => 'text',
                'id' => 'descripcion',
                'placeholder' => 'Ingrese descripcion de categoria'),

    );

    //bootonForm = le da nombre al boton del form
    $botonForm = 'Guardar';

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if (isset($_POST['enviar'])) {

            $nombre = mysqli_real_escape_string($conn,(empty($_POST['nombre_categoria'])? null: $_POST['nombre_categoria']));
            $descripcion = mysqli_real_escape_string($conn,(empty($_POST['descripcion'])? null: $_POST['descripcion'])); 

            $sql = "INSERT INTO categorias
                        (NOM_CATEGORIA,	DESC_CATEGORIA) values 
                        ('$nombre','$descripcion')";

            if(mysqli_query($conn,$sql)){

                header('Location: ./Listar.php');

            }
            else{



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