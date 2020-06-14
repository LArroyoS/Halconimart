<?php
    include('../../configuraciones/conexion.php');

    $titulo = 'Agregar Operador';

    $headAdicional = '<script type="text/javascript" src="/tienda/recursos/js/operadores.js?1.1"></script>';


    $inputs = array(

        array('type' => 'text',
                'id' => 'nombre_operador',
                'placeholder' => 'Ingrese nombre del operador'),
        array('type' => 'text',
                'id' => 'apellidos_operador',
                'placeholder' => 'Ingrese apellidos del operador'),
        array('type' =>'date',
                'id' => 'fecha',
                'placeholder' => 'Ingrese fecha'),
        array('type' =>'radio',
                'id' => 'genero',
                'values' => array('Mujer','Hombre'),
                'placeholder' => 'Genero'),
         array('type' =>'text',
                'id' => 'ciudad',
                'placeholder' => 'Ciudad de nacimiento'),
         array('type' =>'number',
                'id' => 'telefono',
                'placeholder' => 'Telefono'),
         array('type' =>'email',
                'id' => 'correo',
                'placeholder' => 'Correo'),
         array('type' =>'password',
                'id' => 'contraseña',
                'placeholder' => 'Contraseña'),
    );
    

    $botonForm = 'Guardar';

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if (isset($_POST['enviar'])) {

         $nombre = strtoupper(mysqli_real_escape_string($conn,(empty($_POST['nombre_operador'])? null: $_POST['nombre_operador'])));

         $apellido = strtoupper(mysqli_real_escape_string($conn,(empty($_POST['apellidos_operador'])? null: $_POST['apellidos_operador'])));

         $fecha = mysqli_real_escape_string($conn,(empty($_POST['fecha'])? null: $_POST['fecha']));

         $genero = strtoupper(mysqli_real_escape_string($conn,(empty($_POST['genero'])? null: $_POST['genero'])));

         $ciudad = strtoupper(mysqli_real_escape_string($conn,(empty($_POST['ciudad'])? null: $_POST['ciudad'])));

         $numero = mysqli_real_escape_string($conn,(empty($_POST['telefono'])? null: $_POST['telefono'])); 

         $email = mysqli_real_escape_string($conn,(empty($_POST['correo'])? null: $_POST['correo']));  
         
         $contraseña = mysqli_real_escape_string($conn,(empty($_POST['contraseña'])? null: $_POST['contraseña'])); 

            $sql = "INSERT INTO USUARIOS(CORREO, NOM_USUARIO, AP_USUARIO,TELEFONO,TIPO,CONTRASENA,GENERO,FECHA_NAC,CIUDAD)VALUES
                        ('$email','$nombre','$apellido','$numero','OPERADOR','$contraseña','$genero','$fecha','$ciudad')";

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