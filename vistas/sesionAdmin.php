<?php 

    include('../vistas/configuraciones/conexion.php');
    $titulo = 'Administrador';
    $headAdicional = '<script type="text/javascript" src="/tienda/recursos/js/usuario.js?1.1"></script>';
    $iniciar = true;
    session_start();
    $usuario = '';
    $sesion = isset($_SESSION['id']);
    if($sesion){

        header('Location: ./cliente/index.php');

    }
    else{
        $administrador = true;
        $botonForm = 'Ingresar';

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

        array('type' => 'email',
                'id' => 'correo',
                'placeholder' => 'Ingrese un correo electronico'),
        array('type' =>'password',
                'id' => 'clave',
                'placeholder' => 'Ingrese su contraseña'),

        );

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $email = mysqli_real_escape_string($conn,$_POST['correo']);
            $clave = mysqli_real_escape_string($conn,$_POST['clave']);

            $sql = "SELECT ID_USUARIO,NOM_USUARIO,TIPO 
            FROM usuarios WHERE CORREO='$email' AND CONTRASENA='$clave' LIMIT 1 ";

            $consulta = mysqli_query($conn,$sql);

            if($consulta){

                $usuario = mysqli_fetch_assoc($consulta);
                session_start();
                $_SESSION["nombre"] = $usuario['NOM_USUARIO'];
                $_SESSION["tipo"] = $usuario['TIPO'];
                $_SESSION["id"] = $usuario['ID_USUARIO'];
                header('Location: ./admin/dashboard/Dashboard.php');

            }
            else{

                $errores = 'El usuario o contraseña no son validos';

            }

        }

    }

?>

<!DOCTYPE html>

<html>

    <?php include('./modelo/sesion/sesion.php'); ?>

</html>