<?php

   include('../../configuraciones/conexion.php');

   $titulo = 'Eliminar Operador';
   
   $idForm = 'eliminar';
   $headAdicional = '<script type="text/javascript" src="/tienda/recursos/js/operadores.js?1.1"></script>';

   $buscar = array(

        'type' => 'text',
        'id' => 'id_usuario',
        'placeholder' => 'ID operador',
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
                'id' => 'correo',
                'placeholder' => ' Correo',
                'value' => '',
                'estado' => 'disabled'),
        array('type' => 'text',
                'id' => 'nombre_operador',
                'placeholder' => 'Nombre',
                'value' => '',
                'estado' => 'disabled'),
        array('type' =>'text',
                'id' => 'apellidos_operador',
                'placeholder' => 'Apellido',
                'value' => '',
                'estado' => 'disabled'),
        array('type' => 'text',
                'id' => 'telefono',
                'placeholder' => 'Telefono',
                'value' => '',
                'estado' => 'disabled'),
        array('type' =>'password',
                'id' => 'contraseña',
                'placeholder' => 'Contraseña',
                'value' => '',
                'estado' => 'disabled'),
        array('type' =>'text',
                'id' => 'genero',
                'value' => '',
                'placeholder' => 'Genero',
                'estado' => 'disabled'),
        array('type' =>'date',
                'id' => 'fecha',
                'placeholder' => 'Fecha',
                'value' => '',
                'estado' => 'disabled'),
        array('type' =>'text',
                'id' => 'ciudad',
                'placeholder' => 'Ciudad',
                'value' => '',
                'estado' => 'disabled'),

    );

    $botonForm = 'Eliminar';
    $botonAdicional = '<a id="limpiar" class="btn btn-lg btn-primary text-white btn-admin text-uppercase font-weight-bold mb-2 ancho">Limpiar</a>';

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if (isset($_POST['enviar'])) {
            
            $id = mysqli_real_escape_string($conn,$_POST['id_usuario']);
                
            $sql = "DELETE FROM USUARIOS WHERE ID_USUARIO = '$id' ";

            if(mysqli_query($conn,$sql)){

                header('Location: ./Listar.php');

            }
            else{

                

            }
        
        }

    }

    if(isset($_GET['id']) && $conn){

        $id = $_GET['id'];
        $sql = "SELECT ID_USUARIO, CORREO, NOM_USUARIO, AP_USUARIO,TELEFONO,CONTRASENA,GENERO,FECHA_NAC,CIUDAD FROM USUARIOS WHERE ID_USUARIO = '$id' ";
        $consulta = mysqli_query($conn,$sql);

        
        if($consulta && !empty($consulta)){

            $botonAdicional = '';
            $operadores = mysqli_fetch_assoc($consulta);
            mysqli_free_result($consulta);

            //consulta en este caso seria cuestion que remplace el codigo por el serultado de la consulta sql

            $i = 0;
            foreach($operadores as $valor){

                if($i == 0){

                    $buscar['estado'] = 'readonly';
                    $buscar['value'] = $valor;

                }
                else{

                    $inputs[$i-1]['value'] = $valor;

                }

                $i++;

            }

        }
        else{

            $errores = 'sin conexion';

        }

    }
    
    mysqli_close($conn);

?>

<!DOCTYPE html>

<html>

    <?php include('../modelo/admin/encabezadoAdmin.php'); ?>



    <?php include('../modelo/admin/pieAdmin.php'); ?>

</html>