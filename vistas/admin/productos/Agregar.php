<?php

        include('../../configuraciones/conexion.php');        

    $errors = array('nombre_producto' => '', 'proveedor' => '', 'categoria' => '', 'precio' => '', 'descripcion' => '', 'cantidad' => '');

    $titulo = 'Agregar Producto';

    $headAdicional = '<script type="text/javascript" src="/tienda/recursos/js/producto.js?1.0"></script>';


    /*
    
        En el arreglo de input podemos generar automaticamente los inputs en nuestras pantallas
        type = define el tupo del input, en caso de requerir una lista desplegable(select), defina como tipo select
        id = define el identificador del elemento, este se replicara en el atributo name del formulario
        placeholder = es el mensaje de muestra que indica la instruccion a realizar
        value = el valor del elemento
        values = es necesario cuando el elemento posee varios posibles valores, como en el caso de radiobuttons y selects
        estado = define atributos adicionales comunmente usado para desabilitar los componentes

    */
        //El siguiente código obtiene la lista de proveedores
        $sql = "SELECT * FROM proveedores";
        $result = mysqli_query($conn, $sql);
        $proveedores = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $listaProveedores=array();
        $i=0;
        foreach($proveedores as $proveedor){
            $listaProveedores[$i] =
                array('id' => $proveedor['ID_PROVEEDOR'],
                'nombre' => $proveedor['NOM_PROVEEDOR'],
                );
            
            $i++;
        }

        $i=0;
        mysqli_free_result($result);
        //El siguiente código obtiene la lista de categorías
        $sql = "SELECT * FROM categorias";
        $result = mysqli_query($conn, $sql);
        $categorias = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $listaCategorias=array();
        $i=0;
        foreach($categorias as $categoria){
            $listaCategorias[$i] =
                array('id' => $categoria['ID_CATEGORIA'],
                'nombre' => $categoria['NOM_CATEGORIA'],
                );
            
            $i++;
        }

        $i=0;
        mysqli_free_result($result);

    $inputs = array(

        array('type' => 'select',
                'id' => 'proveedor',
                'values' => $listaProveedores,
                'placeholder' => 'Seleccione un proveedor'),
        array('type' => 'select',
                'id' => 'categoria',
                'values' => $listaCategorias,
                'placeholder' => 'Seleccione una categoria',),
        array('type' => 'text',
                'id' => 'nombre_producto',
                'placeholder' => 'Ingrese nombre del producto'),
        array('type' =>'number',
                'id' => 'precio',
                'placeholder' => 'Ingrese precio'),
        array('type' =>'text',
                'id' => 'descripcion',
                'placeholder' => 'Ingrese descripcion'),
        array('type' =>'number',
                'id' => 'cantidad',
                'placeholder' => 'Ingrese cantidad'),        

    );

    $InputImagen = array('ruta' =>'',
                                'id' => 'imagen',
                                'estado' => '');

    $botonForm = 'Guardar';

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        
    if(isset($_POST['enviar'])){    

        if(empty($_POST['proveedor'])){
            $errors['proveedor'] = 'Necesita seleccionar un proveedor <br/>';
        }
        if(empty($_POST['categoria'])){
            $errors['categoria'] = 'Necesita seleccionar una categoria <br/>';
        }
        if (empty($_POST['nombre_producto'])) {
            $errors['nombre_producto'] = 'nombre del producto requerido <br/>';
        }
        if(empty($_POST['precio'])){
            $errors['precio'] = 'Necesita indicar el precio <br/>';
        }else{
            $precio = $_POST['precio'];
            if (!filter_var($precio, FILTER_VALIDATE_INT)) {
                $errors['precio'] = 'error en el precio';
            }
        }
        if(empty($_POST['descripcion'])){
            $errors['descripcion'] = 'La descripcion es requerida <br/>';
        }
       if(empty($_POST['cantidad'])){
            $errors['cantidad'] = 'Necesita indicar el cantidad <br/>';
        }else{
            $cantidad=$_POST['cantidad'];
            if (!filter_var($cantidad, FILTER_VALIDATE_INT)) {
                $errors['cantidad'] = "error en el numero de cantidad";
            }
        }
    
        if (array_filter($errors)) {
            
        } else {
            $ruta_fichero_origen = $_FILES['imagen']['tmp_name'];
            $ruta_nuevo_destino = '../../../recursos/img/' . $_FILES['imagen']['name'];
            $ruta_sql = '/tienda/recursos/img/' . $_FILES['imagen']['name'];

            if( move_uploaded_file ( $ruta_fichero_origen, $ruta_nuevo_destino ) ) {
               
            }else{
                echo "error al guardar el archivo";
            }
            $proveedor = mysqli_real_escape_string($conn, $_POST['proveedor']);
            $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);
            $nombre = mysqli_real_escape_string($conn, $_POST['nombre_producto']);
            $precio = mysqli_real_escape_string($conn, $_POST['precio']);
            $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);    
            $cantidad = mysqli_real_escape_string($conn, $_POST['cantidad']);
    
            $sql = "INSERT INTO productos(ID_PROVEEDOR_FK, ID_CATEGORIA_FK,NOM_PRODUCTO, PRECIO, DESCRIPCION, ALMACEN, IMAGEN) 
            VALUES('$proveedor', '$categoria', '$nombre', '$precio', '$descripcion', '$cantidad', '$ruta_sql' )";


            if (mysqli_query($conn, $sql)) {        
    
                header('Location: Listar.php');

            }else{

                echo mysqli_error($conn);

            }
            
        }
    }//END isset enviar
    else{
        
    }



    }else{
        
    }
mysqli_close($conn);
?>

<!DOCTYPE html>

<html>

    <?php include('../modelo/admin/encabezadoAdmin.php'); ?>

    <?php 
    if (isset($errors['nombre_producto'])) {
        echo $errors['nombre_producto'];
    } 
    if (isset($errors['proveedor'])) {
        echo $errors['proveedor'];
    } 
    if (isset($errors['categoria'])) {
        echo $errors['categoria'];
    } 
    if (isset($errors['precio'])) {
        echo $errors['precio'];
    } 
    if (isset($errors['descripcion'])) {
        echo $errors['descripcion'];
    } 
    if (isset($errors['cantidad'])) {
        echo $errors['cantidad'];
    } 
    ?>

    <?php include('../modelo/admin/pieAdmin.php'); ?>

</html>