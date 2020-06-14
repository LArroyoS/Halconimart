<?php

    include('../../configuraciones/conexion.php');

    $titulo = 'Modificar Operador';

    $headAdicional = '<script type="text/javascript" src="/tienda/recursos/js/operadores.js?1.1"></script>';
    
    $buscar = array(

        'type' => 'text',
        'id' => 'id_usuario',
        'placeholder' => 'ID operador',
        'value' => '',
        'estado' => '',

    );

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
        array('type' => 'number',
                'id' => 'telefono',
                'placeholder' => 'Telefono',
                'value' => '',
                'estado' => 'disabled'),
        array('type' =>'password',
                'id' => 'contraseña',
                'placeholder' => 'Contraseña',
                'value' => '',
                'estado' => 'disabled'),
        array('type' =>'radio',
                'id' => 'genero',
                'value' => '',
                'values' => array('MUJER','HOMBRE'),
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

    $botonForm = 'Guardar';
    $botonAdicional = '<a id="limpiar" class="btn btn-lg btn-primary text-white btn-admin text-uppercase font-weight-bold mb-2 ancho">Limpiar</a>';

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(isset($_POST['enviar'])) {
            
            $id = mysqli_real_escape_string($conn,$_POST['id_usuario']);
            $correo = mysqli_real_escape_string($conn,$_POST['correo']);
            $nombre = strtoupper(mysqli_real_escape_string($conn,$_POST['nombre_operador']));
            $apellido = strtoupper(mysqli_real_escape_string($conn,$_POST['apellidos_operador']));
            $telefono = mysqli_real_escape_string($conn,$_POST['telefono']);
            $contraseña = mysqli_real_escape_string($conn,$_POST['contraseña']);
            $genero = strtoupper(mysqli_real_escape_string($conn,$_POST['genero']));
            $fecha = mysqli_real_escape_string($conn,$_POST['fecha']);
            $cuidad = strtoupper(mysqli_real_escape_string($conn,$_POST['ciudad']));
            
            $sql = "UPDATE usuarios SET  
                         CORREO = '$correo', 
                         NOM_USUARIO = '$nombre', 
                         AP_USUARIO = '$apellido',
                         TELEFONO = '$telefono',
                         CONTRASENA = '$contraseña',
                         GENERO = '$genero',
                         FECHA_NAC = '$fecha',
                         CIUDAD = '$cuidad'
                         WHERE ID_USUARIO = '$id' ";

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
        $sql = "SELECT ID_USUARIO, CORREO, NOM_USUARIO, AP_USUARIO,TELEFONO,CONTRASENA,GENERO,FECHA_NAC,CIUDAD FROM USUARIOS WHERE ID_USUARIO = '$id' ";
        $consulta = mysqli_query($conn,$sql);

        
        if ($consulta && !empty($consulta)) {

            $botonAdicional = '';
            $operadores = mysqli_fetch_assoc($consulta);
            mysqli_free_result($consulta);

            $i = 0;
            foreach ($operadores as $valor) {

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