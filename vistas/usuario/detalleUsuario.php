<?php 

    include('../configuraciones/conexion.php');

    session_start();

    $titulo = 'Modifica Usuario';
    $botonForm = 'Modificar';
    $headAdicional = '<script type="text/javascript" src="/tienda/recursos/js/usuario.js?1.1"></script>';

    $id = isset($_SESSION['id'])? $_SESSION['id']: ''; 

    if ($conn) {
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $nombre = strtoupper(mysqli_real_escape_string($conn, (empty($_POST['nombre'])? null: $_POST['nombre'])));
                $apellido = strtoupper(mysqli_real_escape_string($conn, (empty($_POST['apellidos'])? null: $_POST['apellidos'])));
                $fecha = mysqli_real_escape_string($conn, (empty($_POST['fecha'])? null: $_POST['fecha']));
                $genero = strtoupper(mysqli_real_escape_string($conn, (empty($_POST['genero'])? null: $_POST['genero'])));
                $email = mysqli_real_escape_string($conn, (empty($_POST['correo'])? null: $_POST['correo']));
                $numero = mysqli_real_escape_string($conn, (empty($_POST['telefono'])? null: $_POST['telefono']));
                $ciudad = strtoupper(mysqli_real_escape_string($conn, (empty($_POST['ciudad'])? null: $_POST['ciudad'])));
                                       
                $contraseña = mysqli_real_escape_string($conn, (empty($_POST['clave'])? null: $_POST['clave']));
                $_SESSION['nombre'] = $nombre;

                $sql = "UPDATE usuarios SET  
                         CORREO = '$email', 
                         NOM_USUARIO = '$nombre', 
                         AP_USUARIO = '$apellido',
                         TELEFONO = '$numero',
                         CONTRASENA = '$contraseña',
                         GENERO = '$genero',
                         FECHA_NAC = '$fecha',
                         CIUDAD = '$ciudad'
                         WHERE ID_USUARIO = '$id' ";
               
                if (mysqli_query($conn, $sql)) {
                        
                        $_SESSION['nombre'] = $nombre;
                        header('Location: ../cliente/index.php');
                
                } else {
                    $errores = 'Ocurrio un error inesperado';
                }

        }

        $sql = "SELECT CORREO, NOM_USUARIO, 
        AP_USUARIO,TELEFONO,CONTRASENA,
        GENERO,CIUDAD,FECHA_NAC
        FROM usuarios WHERE ID_USUARIO = '$id' ";

        $consulta = mysqli_query($conn, $sql);

        if ($consulta && !empty($consulta)) {
            
                $usuario = mysqli_fetch_assoc($consulta);

                $inputs = array(
                array('type' => 'text',
                        'id' => 'nombre',
                        'placeholder' => 'Ingrese su nombre',
                        'value' => $usuario['NOM_USUARIO'],
                        'estado' => ''),
                array('type' => 'text',
                        'id' => 'apellidos',
                        'placeholder' => 'Ingrese sus apellidos',
                        'value' => $usuario['AP_USUARIO'],
                        'estado' => ''),
                array('type' => 'email',
                        'id' => 'correo',
                        'placeholder' => 'Ingrese un correo electronico',
                        'value' => $usuario['CORREO'],
                        'estado' => ''),
                array('type' =>'date',
                        'id' => 'fecha',
                        'placeholder' => 'Fecha de Nacimiento',
                        'value' => $usuario['FECHA_NAC'],
                        'estado' => ''),
                array('type' => 'tel',
                        'id' => 'telefono',
                        'placeholder' => 'Ingrese un telefono',
                        'value' => $usuario['TELEFONO'],
                        'estado' => ''),
                array('type' => 'text',
                        'id' => 'ciudad',
                        'placeholder' => 'Ingrese la cuidad donde reside',
                        'value' => $usuario['CIUDAD'],
                        'estado' => ''),
                array('type' =>'password',
                        'id' => 'clave',
                        'placeholder' => 'Ingrese nueva contraseña',
                        'value' => $usuario['CONTRASENA'],
                        'estado' => ''),
                array('type' =>'radio',
                        'id' => 'genero',
                        'value' => $usuario['GENERO'],
                        'values' => array('MUJER','HOMBRE'),
                        'placeholder' => 'Genero'),

                );

        }
        
    }

?>

<!DOCTYPE html>
<html>

    <?php include('./modelo/sesion/encabezadoUsuario.php'); ?>

    <?php include('./modelo/sesion/pieUsuario.php'); ?>

</html>