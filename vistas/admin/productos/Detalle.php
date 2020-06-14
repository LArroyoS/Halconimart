<?php
    
    include('../../configuraciones/conexion.php');
    $titulo = 'Detalle Producto';
    
    $headAdicional = '<script type="text/javascript" src="/tienda/recursos/js/producto.js"></script>';
    
    $obtencion = false;
    $i=0;
    if (isset($_GET['id'])) {
        
        $obtencion = true;

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

                array('type' => 'text',
                        'id' => 'id',
                        'placeholder' => 'ID',
                        'value' => $_GET['id'],
                        'estado' => 'disabled'),
                array('type' => 'text',
                        'id' => 'nombre_proveedor',
                        'placeholder' => 'Proveedor',
                        'value' => 'proveedor muestra',
                        'estado' => 'disabled'),
                array('type' => 'text',
                        'id' => 'nombre_categoria',
                        'placeholder' => 'Categoria',
                        'value' => 'categoria muestra',
                        'estado' => 'disabled'),
                array('type' => 'text',
                        'id' => 'nombre_producto',
                        'placeholder' => 'Producto',
                        'value' => 'producto muestra',
                        'estado' => 'disabled'),
                array('type' =>'number',
                        'id' => 'precio',
                        'placeholder' => 'Precio',
                        'value' => '0.00',
                        'estado' => 'disabled'),
                array('type' =>'text',
                        'id' => 'descripcion',
                        'placeholder' => 'Descripcion',
                        'value' => 'DescripcionM',
                        'estado' => 'disabled'),
                /*array('type' =>'number',
                        'id' => 'cantidad',
                        'placeholder' => 'Cantidad',
                        'value' => '1',
                        'estado' => 'disabled'),*/
        
        );

        $InputImagen = array('ruta' =>'',
                                'id' => 'imagen',
                                'estado' => 'disabled');

        $botonAdicional = '<a href="./Modificar.php?id='.$_GET["id"].'" class="btn btn-lg btn-primary btn-admin text-uppercase font-weight-bold mb-2 ancho">Modificar</a>'.
        '<a href="./Eliminar.php?id='.$_GET["id"].'" class="btn btn-lg btn-primary btn-admin text-uppercase font-weight-bold mb-2 ancho">Eliminar</a>';
    
    }
    if(isset($_GET['id'])){

        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "SELECT * FROM productos WHERE ID_PRODUCTO = $id";
        $result = mysqli_query($conn, $sql);
        $producto = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $proveedor = $producto['ID_PROVEEDOR_FK'];
        $sql2 ="SELECT * FROM proveedores WHERE ID_PROVEEDOR= '$proveedor'";
        $result2 = mysqli_query($conn, $sql2);
        $datoProv = mysqli_fetch_array($result2,MYSQLI_ASSOC);        
        $categoria = $producto['ID_CATEGORIA_FK'];
        $sql3 ="SELECT * FROM categorias WHERE ID_CATEGORIA= '$categoria'";
        $result3 = mysqli_query($conn, $sql3);
        $datoCat = mysqli_fetch_array($result3,MYSQLI_ASSOC);
        $consulta = array(
            'id' => $_GET['id'],            
            'nombre_proveedor' => $datoProv['NOM_PROVEEDOR'], //$producto['ID_PROVEEDOR_FK'],
            'categoria' => $datoCat['NOM_CATEGORIA'], //$producto['ID_CATEGORIA_FK'],
            'producto' => $producto['NOM_PRODUCTO'],
            'precio' => $producto['PRECIO'],
            'descripcion' => $producto['DESCRIPCION'] ,
            //'cantidad' => '1',
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

                $inputs[$i]['value'] = $valor;
                $inputs[$i]['estado'] = 'readonly';

            }

            $i++;

        }

    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){



    }

?>

<!DOCTYPE html>

<html>

    <?php include('../modelo/admin/encabezadoAdmin.php'); ?>

    <?php if(isset($obtencion) && $obtencion==false): ?>

        <h2 class='text-center'>El dato no existe</h2>

    <?php endif;?>

    <?php include('../modelo/admin/pieAdmin.php'); ?>

</html>