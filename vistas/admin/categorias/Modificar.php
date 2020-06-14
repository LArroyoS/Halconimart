<?php

    include('../../configuraciones/conexion.php');

    $titulo = 'Modificar Categoaria';
    
    $headAdicional = '<script type="text/javascript" src="/tienda/recursos/js/categoria.js?2.0"></script>';

    $buscar = array(

        'type' => 'text',
        'id' => 'id_categoria',
        'placeholder' => 'ID categoria',
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

        array('type' => 'text',
                'id' => 'nombre_categoria',
                'placeholder' => 'Ingrese nombre de categoria',
                'estado' => 'disabled'),
        array('type' => 'text',
                'id' => 'descripcion',
                'placeholder' => 'Ingrese descripcion de categoria',
                'estado' => 'disabled'),
    );

    $botonForm = 'Guardar';
    $botonAdicional = '<a id="limpiar" class="btn btn-lg btn-primary text-white btn-admin text-uppercase font-weight-bold mb-2 ancho">Limpiar</a>';

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(isset($_POST['enviar'])) {
            
            $id = mysqli_real_escape_string($conn,$_POST['id_categoria']);
            $nombre = mysqli_real_escape_string($conn,$_POST['nombre_categoria']);
            $descripcion = mysqli_real_escape_string($conn,$_POST['descripcion']);

            $sql = "UPDATE categorias SET
                        NOM_CATEGORIA = '$nombre',
                        DESC_CATEGORIA = '$descripcion'
                        WHERE ID_CATEGORIA = '$id' ";

            if(mysqli_query($conn,$sql)){

                header('Location: ./Listar.php');

            }
            else{

                $errores = 'error';

            }
        
        }

    }

    if(isset($_GET['id']) && $conn){

        $id = $_GET['id'];
        $sql = "SELECT ID_CATEGORIA AS 'id_categoria', NOM_CATEGORIA AS 'nombre_categoria', DESC_CATEGORIA AS 'descripcion' 
        FROM categorias 
        WHERE ID_CATEGORIA = '$id' ";
        $consulta = mysqli_query($conn,$sql);

        
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

    mysqli_close($conn);

?>

<!DOCTYPE html>

<html>

    <?php include('../modelo/admin/encabezadoAdmin.php'); ?>



    <?php include('../modelo/admin/pieAdmin.php'); ?>

</html>