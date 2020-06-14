
<?php

    include('../../configuraciones/conexion.php');

    $titulo = 'Detalle Operador';
    
    $obtencion = false;

    if (isset($_GET['id'])) {


        $id = $_GET['id'];


        $sql = "SELECT ID_USUARIO, CORREO, NOM_USUARIO, AP_USUARIO,TELEFONO,TIPO,CONTRASENA,GENERO,FECHA_NAC,CIUDAD FROM USUARIOS WHERE ID_USUARIO = '$id' ";
       
        $consulta = mysqli_query($conn,$sql);

        if($consulta && !empty($consulta)){

            $obtencion = true;
            $operadores = mysqli_fetch_assoc($consulta);
            mysqli_free_result($consulta);

            $inputs = array(

                array('type' => 'text',
                        'id' => 'id',
                        'placeholder' => 'ID ',
                        'value' => $operadores['ID_USUARIO'],
                        'estado' => 'disabled',),
                array('type' => 'text',
                        'id' => 'correo',
                        'value' => $operadores['CORREO'],
                        'placeholder' => 'Correo',
                        'estado' => 'disabled'),
                array('type' => 'text',
                        'id' => 'nombre',
                        'value' => $operadores['NOM_USUARIO'],
                        'placeholder' => 'Nombre',
                        'estado' => 'disabled'),
                array('type' => 'text',
                        'id' => 'apellido',
                        'value' => $operadores['AP_USUARIO'],
                        'placeholder' => 'Apellidos',
                        'estado' => 'disabled'),
                array('type' => 'text',
                        'id' => 'telefono',
                        'value' => $operadores['TELEFONO'],
                        'placeholder' => 'Telefono',
                        'estado' => 'disabled'),
                array('type' => 'text',
                        'id' => 'tipo',
                        'value' => $operadores['TIPO'],
                        'placeholder' => 'Tipo',
                        'estado' => 'disabled'),
                array('type' => 'password',
                        'id' => 'contraseña',
                        'value' => $operadores['CONTRASENA'],
                        'placeholder' => 'Contraseña',
                        'estado' => 'disabled'),
                array('type' => 'text',
                        'id' => 'genero',
                        'value' => $operadores['GENERO'],
                        'placeholder' => 'Genero',
                        'estado' => 'disabled'),
                array('type' => 'date',
                        'id' => 'fecha',
                        'value' => $operadores['FECHA_NAC'],
                        'placeholder' => 'Fecha',
                        'estado' => 'disabled'),
                array('type' => 'text',
                        'id' => 'ciudad',
                        'value' => $operadores['CIUDAD'],
                        'placeholder' => 'Cuidad',
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

    mysqli_close($conn)

?>

<!DOCTYPE html>

<html>

    <?php include('../modelo/admin/encabezadoAdmin.php'); ?>

    <?php if(isset($obtencion) && $obtencion==false): ?>

        <h2 class='text-center'>El dato no existe</h2>

    <?php endif;?>

    <?php include('../modelo/admin/pieAdmin.php'); ?>

</html>