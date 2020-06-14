<?php 

    session_start();
    $sesion = isset($_SESSION['id']);
    if($sesion){
                
        session_unset();
        session_destroy();

        header('Location: ./InicioSesion.php');
                
    }

    $cierre = true;
    $titulo = 'Sesion Cerrada';
    $instruccion = 'La Sesion Se Cerro Correctamente
                    <br/>
                    Favor de cerrar la ventana';

?>

<!DOCTYPE html>

<html>

    <?php include('./modelo/sesion/sesion.php'); ?>

</html>