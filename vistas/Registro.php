<?php 

    include('../vistas/configuraciones/conexion.php');
    
    $headAdicional = '<script type="text/javascript" src="/tienda/recursos/js/usuario.js?4.0"></script>';
    $nombre_proveedor = $direccion = $correo = $nombre_encargado = $apellidos_encargado = $telefono = '';
    $errors = array('nombre' => '','apellidos' => '','fecha' => '', 'genero' => '',
    'correo' => '', 'telefono' => '', 'ciudad' => '','clave' => '',);

    $titulo = 'Registrarse';
    $botonForm = 'enviar';
    $registro='';

    $inputs = array(

        array('type' => 'text',
                'id' => 'nombre',
                'placeholder' => 'Ingrese su nombre'),
        array('type' => 'text',
                'id' => 'apellidos',
                'placeholder' => 'Ingrese sus apellidos'),
        array('type' =>'date',
                'id' => 'fecha',
                'placeholder' => 'Fecha de Nacimiento'),
        array('type' =>'radio',
                'id' => 'genero',
                'values' => array('Mujer','Hombre'),
                'placeholder' => 'Genero'),
        array('type' => 'email',
                'id' => 'correo',
                'placeholder' => 'Ingrese un correo electronico'),
        array('type' => 'number',
                'id' => 'telefono',
                'placeholder' => 'Ingrese un telefono'),
        array('type' => 'text',
                'id' => 'ciudad',
                'placeholder' => 'Ingrese la cuidad donde reside'),
        array('type' =>'password',
                'id' => 'clave',
                'placeholder' => 'Ingrese su contraseña'),
       

    );
    

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        

        if (isset($_POST['enviar'])) {

                              
                $nombre = strtoupper(mysqli_real_escape_string($conn,(empty($_POST['nombre'])? null: $_POST['nombre'])));
                $apellido = strtoupper(mysqli_real_escape_string($conn,(empty($_POST['apellidos'])? null: $_POST['apellidos'])));
                $fecha = mysqli_real_escape_string($conn,(empty($_POST['fecha'])? null: $_POST['fecha']));
                $genero = strtoupper(mysqli_real_escape_string($conn,(empty($_POST['genero'])? null: $_POST['genero'])));
                $email = mysqli_real_escape_string($conn,(empty($_POST['correo'])? null: $_POST['correo']));  
                $numero = mysqli_real_escape_string($conn,(empty($_POST['telefono'])? null: $_POST['telefono'])); 
                $ciudad = strtoupper(mysqli_real_escape_string($conn,(empty($_POST['ciudad'])? null: $_POST['ciudad'])));           
                $contraseña = mysqli_real_escape_string($conn,(empty($_POST['clave'])? null: $_POST['clave'])); 
               
                $sql = "INSERT INTO USUARIOS(CORREO, NOM_USUARIO, AP_USUARIO,TELEFONO,TIPO,CONTRASENA,GENERO,FECHA_NAC,CIUDAD)VALUES
                        ('$email','$nombre','$apellido','$numero','CLIENTE','$contraseña','$genero','$fecha','$ciudad')";
               
                if(mysqli_query($conn,$sql)){    
                                        
                        header('Location: InicioSesion.php');
        
                }
                else{   
                                        
                         $errores = 'Ocurrio un error inesperado';
        
        
                }
        
        }


    }
    

?>

<!DOCTYPE html>
<html>
        
    <?php include('./modelo/sesion/sesion.php'); ?>

</html>