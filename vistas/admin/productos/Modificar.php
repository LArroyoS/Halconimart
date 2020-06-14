<?php
    
    include('../../configuraciones/conexion.php');
    $errors = array('nombre_producto' => '', 'proveedor' => '', 'categoria' => '', 'precio' => '', 'descripcion' => '', 'almacen' => '');

    $titulo = 'Modificar Producto';

    $headAdicional = '<script type="text/javascript" src="/tienda/recursos/js/producto.js?1.0"></script>';

    $buscar = array(

        'type' => 'text',
        'id' => 'id',
        'placeholder' => 'ID producto',
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
                'value' => '',
                'values' => $listaProveedores, /*array(
                                array('id' => '1',
                                        'nombre' => 'prov1'),
                                array('id' => '2',
                                        'nombre' => 'prov2'),
                                array('id' => '3',
                                        'nombre' => 'prov3'),
                                array('id' => '4',
                                        'nombre' => 'prov4'),
                                ), */
                'placeholder' => 'Seleccione un proveedor',
                'estado' => 'enabled'),
        array('type' => 'select',
                'id' => 'categoria',
                'values' => $listaCategorias,
                'placeholder' => 'Seleccione una categoria',
                'estado' => 'enabled',),
        array('type' => 'text',
                'id' => 'nombre_producto',
                'placeholder' => 'Ingrese nombre del producto',
                'value' => '',
                'estado' => 'disabled'),
        array('type' =>'number',
                'id' => 'precio',
                'placeholder' => 'Ingrese precio',
                'value' => '',
                'estado' => 'disabled'),
        array('type' =>'text',
                'id' => 'descripcion',
                'placeholder' => 'Ingrese descripcion',
                'value' => '',
                'estado' => 'disabled'),
        array('type' =>'number',
                'id' => 'cantidad',
                'placeholder' => 'Ingrese cantidad',
                'value' => '',
                'estado' => 'disabled'),
    );

    $InputImagen = array('ruta' =>'',
                                'id' => 'imagen',
                                'estado' => 'disabled');

    $botonForm = 'Guardar';

    $botonAdicional = '<a id="limpiar" class="btn btn-lg btn-primary text-white btn-admin text-uppercase font-weight-bold mb-2 ancho">Limpiar</a>';

    if(isset($_GET['id'])){

        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "SELECT * FROM productos WHERE ID_PRODUCTO = $id";
        $result = mysqli_query($conn, $sql);
        $producto = mysqli_fetch_array($result,MYSQLI_ASSOC);
                

        $consulta = array(
            'id' => $_GET['id'],
            'proveedor' => $producto['ID_PROVEEDOR_FK'],
            'categoria' => $producto['ID_CATEGORIA_FK'],
            'producto' => $producto['NOM_PRODUCTO'],
            'precio' => $producto['PRECIO'],
            'descripcion' => $producto['DESCRIPCION'] ,
            'cantidad' => '1',
            'imagen' => $producto['IMAGEN'],
        );

        
        mysqli_free_result($result);
        

        foreach($consulta as $llave=>$valor){

            if($i == 0){

                $buscar['estado'] = 'readonly';
                $buscar['value'] = $valor;

            }
            else if($llave=='imagen'){

                $InputImagen['ruta'] = $valor;

            }
            else{

                $inputs[$i-1]['value'] = $valor;
                $inputs[$i-1]['estado'] = '';

            }

            $i++;

        }

    }

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
       /*if(empty($_POST['almacen'])){
            $errors['almacen'] = 'Necesita indicar el almacen <br/>';
        }else{
            $almacen=$_POST['almacen'];
            if (!filter_var($almacen, FILTER_VALIDATE_INT)) {
                $errors['almacen'] = "error en el numero de almacen";
            }
        }*/
    
        if (array_filter($errors)) {
            $errores = "hay errores";
        } else {
            
            $proveedor = mysqli_real_escape_string($conn, $_POST['proveedor']);
            $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);
            $nombre = mysqli_real_escape_string($conn, $_POST['nombre_producto']);
            $precio = mysqli_real_escape_string($conn, $_POST['precio']);
            $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);    
            $cantidad = mysqli_real_escape_string($conn, $_POST['cantidad']); //no exist
            $id = mysqli_real_escape_string($conn, $_POST['id']);

                $sql = "UPDATE productos SET ID_PROVEEDOR_FK='$proveedor',  ID_CATEGORIA_FK='$categoria', 
                NOM_PRODUCTO = '$nombre', PRECIO='$precio', DESCRIPCION = '$descripcion', ALMACEN = '$cantidad'
                WHERE ID_PRODUCTO='$id'" ;


                if (mysqli_query($conn, $sql)) {        

                        if ($_FILES['imagen']['tmp_name']!=null) {
                            $ruta_fichero_origen = $_FILES['imagen1']['tmp_name'];
                            $ruta_nuevo_destino = '../../../recursos/img/' . $_FILES['imagen1']['name'];
                            $ruta_sql = '/tienda/recursos/img/' . $_FILES['imagen']['name'];
                            

                            if( move_uploaded_file ( $ruta_fichero_origen, $ruta_nuevo_destino ) ) {
                                $sql = "UPDATE productos SET IMAGEN = '$ruta_sql' WHERE ID_PRODUCTO='$id'";
                                if (mysqli_query($conn, $sql)) {        
    
                                    header('Location: Listar.php');

                                }else{

                                    $errores = mysqli_error($conn);

                                }
                            }else{
                                $errores = "error al guardar el archivo";
                            }
                        }
                        else{

                            header('Location: Listar.php');

                        }
                        

                }else{

                    $errores = mysqli_error($conn);

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
    if (isset($errors['almacen'])) {
        echo $errors['almacen'];
    } 
    ?>

    <?php include('../modelo/admin/pieAdmin.php'); ?>

</html>