<?php
        
        include('../../configuraciones/conexion.php');

    $headAdicional = '<script type="text/javascript" src="/tienda/recursos/js/producto.js?1.0"></script>';
    $idForm = 'eliminar';
    
    if(isset($_POST['enviar'])){
                $id = mysqli_real_escape_string($conn, $_POST['id']);
                $sql = "DELETE FROM productos WHERE ID_PRODUCTO = '$id'";

                if (mysqli_query($conn, $sql)) {        

                        header('Location: Listar.php');

                }else{

                        echo mysqli_error($conn);

                }
        }
    
   $titulo = 'Eliminar Producto';

   $buscar = array(

        'type' => 'text',
        'id' => 'id',
        'placeholder' => 'ID producto',
        'value' => '',
        'estado' => '',

    );

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
                'values' => $listaProveedores,
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

    $botonForm = 'Eliminar';

    if($_SERVER["REQUEST_METHOD"] == "POST"){



    }

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

        $i = 0;
        foreach($consulta as $llave => $valor){

            if($i == 0){

                $buscar['estado'] = 'readonly';
                $buscar['value'] = $valor;

            }
            else if($llave=='imagen'){

                $InputImagen['ruta'] = $valor;

            }
            else{

                $inputs[$i-1]['value'] = $valor;

            }

            $i++;

        }

    }

?>

<!DOCTYPE html>

<html>

    <?php include('../modelo/admin/encabezadoAdmin.php'); ?>



    <?php include('../modelo/admin/pieAdmin.php'); ?>

</html>