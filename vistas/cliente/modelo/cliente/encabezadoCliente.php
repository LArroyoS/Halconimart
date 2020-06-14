<?php 

    /*

    $categorias = array(

        array('id' => '1',
                'nombre' => 'categoria1'),
        array('id' => '2',
                'nombre' => 'categoria1'),
        array('id' => '3',
                'nombre' => 'categoria1'),

    );

    $productos = array(

        array('id' => '1',
                'nombre' => 'producto1',
                'precio' => '00.00',
                'descripcion' => 'descripcion',
                'imagen' => '',),
        array('id' => '2',
                'nombre' => 'producto2',
                'precio' => '00.00',
                'descripcion' => 'descripcion',
                'imagen' => '',),
        array('id' => '3',
                'nombre' => 'producto1',
                'precio' => '00.00',
                'descripcion' => 'descripcion',
                'imagen' => '',),

    );

    */

    $tienda = "Halconimart";

    $sesion = isset($_SESSION['id']);
    if($sesion){
        
        $nombre = (isset($_SESSION['nombre'])? $_SESSION['nombre']:'');
        $admin = ((isset($_SESSION['tipo']) && $_SESSION['tipo']!='CLIENTE')? true:false);

    }
    else{

        header('Location: ../InicioSesion.php');

    }


?>


<head>

    <?php include('../modelo/general/head.php'); ?>
    <link rel="stylesheet" href="/tienda/recursos/css/cliente.css?1.1" />
    <script src="/tienda/recursos/js/cliente.js?1.2"></script>    

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary border-bottom">

        <a class="navbar-brand" href="/tienda/vistas/cliente/index.php">
        
            <?php echo ((isset($tienda))? $tienda:'NombreTienda'); ?>

        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            
            <span class="navbar-toggler-icon"></span>
        
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

                <li class="nav-item mr-2">
                    
                    <form class="form-inline" action="/tienda/vistas/cliente/index.php" method="GET">
                    
                        <input class="form-control" name='nombre' placeholder="Buscar" style="height:42px;"/>
                        <button class="btn btn-success" type='submit' style="height:42px;">Buscar</button>

                    </form>

                </li>

                <li class="nav-item dropdown mr-2">
                            
                    <button class="nav-link btn bg-dark dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    
                        Categorias
                                    
                    </button>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                        <?php if(isset($categorias) && $categorias!=null): ?>    
                                                
                                <?php foreach($categorias as $categoria): ?>

                                    <a class="dropdown-item" href="<?php echo htmlspecialchars($_SERVER['PHP_SELF'].((isset($categoria['id']))? '?categoria='.$categoria['id'] : '')); ?>">
                                    
                                        <?php echo ((isset($categoria['nombre']))? $categoria['nombre']: 'categoria no reconocida'); ?>
                                        
                                    </a>

                                <?php endforeach; ?>

                        <?php else: ?>

                            <p class="dropdown-item">
                                
                                Lo sentimos<br/>
                                Aun no existe ninguna
                                categoria registrada
                                
                            </p>

                        <?php endif; ?>

                    </div>
        
                </li>

                <li class="nav-item">
                
                    <a class="nav-link" href="./carro.php">
                    
                        <i style="font-size:28px;" class="fa fa-shopping-cart"></i>

                    </a>

                </li>

                <li class="nav-item dropdown">
                            
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            
                        <?php echo ((isset($nombre))? $nombre : 'Usuario'); ?>
                            
                    </a>
                        
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" href="/tienda/vistas/usuario/detalleUsuario.php">Modificar información</a>
                        
                        <?php if($admin): ?>
                        
                            <a class="dropdown-item" href="/tienda/vistas/admin/dashboard/Dashboard.php">Control administrador</a>

                        <?php endif; ?>

                        <div class="dropdown-divider"></div>
                                
                        <a class="dropdown-item" href="/tienda/vistas/SesionCerrada.php">Cerrar Sesión</a>
                            
                    </div>

                </li>

            </ul>

        </div>

    </nav>

    <main role="main">

        <div class="album py-5 bg-light">

            <div class="container">

                <?php if(isset($carro)):?>
                        
                    <div class="card mb-4 p-4 box-shadow">

                        <h2 class="text-center">Carro de Compras</h2>

                        <?php if($carro!=null): ?>    

                            <div class="table-responsive">
                            
                                <table class="table text-center">

                                    <thead>

                                        <tr>

                                            <th>Imagen</th>
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Accion</th>

                                        </tr>

                                    </thead>

                                    <tbody>
                                
                                        <?php foreach($carro as $producto): ?>
                                                
                                            <tr>

                                                <td> 
                                                    
                                                    <img width="100px" src='<?php echo ((isset($producto['imagen']) && $producto['imagen']!='')? $producto['imagen'] : '/tienda/recursos/img/imagenDefecto.png');?>' alt="No se cargo la imagen"/>
                                                
                                                </td>

                                                <td> 
                                                    
                                                    <?php echo ((isset($producto['nombre']))? $producto['nombre'] : 'Sin nombre');?>
                                                
                                                </td>

                                                <td> 
                                                    
                                                    <?php 
                                                    
                                                        $precio = (isset($producto['precio']))? $producto['precio']: 0.00;
                                                        $cantidad = (isset($producto['cantidad']))? $producto['cantidad']: 1;

                                                        echo $cantidad;
                                                        
                                                    ?>
                                                
                                                </td>

                                                <td> 
                                                    
                                                    <?php 
                                                        
                                                        $precio = ($precio*$cantidad);
                                                        $total += $precio;
                                                        echo $precio; 
                                                        
                                                    ?>
                                                
                                                </td>

                                                <td class="td-actions text-right">
                                                        
                                                    <?php if(isset($producto['detalle'])): ?>
                                                            
                                                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">

                                                            <input type="hidden" name="detalle" value="<?php echo $producto['detalle']; ?>" /> 
                                                            <input type='submit' name="eliminarProducto" class="btn btn-round btn-danger btn-just-icon btn-sm eliminar" value="Quitar" />
                                                            
                                                        </form>

                                                    <?php endif; ?>
                                                    
                                                </td>

                                            </tr>

                                        <?php endforeach; ?>
                                
                                    </tbody>
                        
                                </table>

                                <h4 class="text-right"> <?php echo ((isset($total))? 'TOTAL: '.$total: ''); ?> </h4>
                                    
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">

                                    <input type="submit" class="btn btn-success btn-block" name='comprar' value="Comprar"/>

                                </form>
                            
                            </div>

                        <?php else: ?>

                            <h1 class="text-center">Aun no agrega ningun producto</h1>

                        <?php endif; ?>

                    </div>

                <?php elseif(isset($datos)): ?>

                    <div class="card mb-4 p-4 box-shadow">

                        <div class="row">

                            <div class="col-md-4">

                                <img src="<?php echo ((isset($datos['imagen']) && $datos['imagen']!='')? $datos['imagen']: '/tienda/recursos/img/imagenDefecto.png'); ?>" width="100%" alt="No se cargo la imagen"/>

                            </div>

                            <div class="col-md-8">

                                <h2 class="text-center"> <?php echo ((isset($datos['nombre']))? $datos['nombre']:'sin nombre'); ?> </h2>
                                <h6> #<?php echo ((isset($datos['id']))? $datos['id']:'#'); ?> </h6>
                                <h5> <?php echo ((isset($datos['proveedor']))? $datos['proveedor']:'Sin proveedor'); ?> </h5>
                                <h3> <?php echo ((isset($datos['precio']))? '$'.$datos['precio']:'Proximamente'); ?> </h3>
                                <p> <?php echo ((isset($datos['descripcion']))? $datos['descripcion']:'Sin descripcion'); ?> </p>
                                
                                <form class="form-group" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method='POST'>

                                    <input type='hidden' name="productoId" value="<?php echo ((isset($datos['id']))? $datos['id']:''); ?>" />
                                    <input type="submit" name="carro" class="btn btn-sm btn-success carro text-white m-2" value='Añadir a Carro' />

                                </form>

                            </div>

                        </div>

                    </div>

                <?php elseif(isset($productos) && $productos!=null ): ?>

                    <div class="row">
                        
                        <?php foreach($productos as $producto): ?>

                            <div class="col-md-4">
                            
                                <div class="card mb-4 box-shadow">
                                    
                                    <img class="card-img-top" src="<?php echo ((isset($producto['imagen']) && $producto['imagen']!='')? $producto['imagen'] : '/tienda/recursos/img/imagenDefecto.png'); ?>" with="100px" alt="No se cargo la imagen">
                                    
                                    <div class="card-body">

                                        <h3> 
                                            
                                            <?php echo ((isset($producto['nombre']))?  $producto['nombre']:'Sin titulo');?> 
                                    
                                        </h3>
                                        
                                        <p class="card-text">

                                            <?php echo ((isset($producto['descripcion']))?  $producto['descripcion']:'Sin descripción');?>

                                        </p>

                                        <h3> 
                                            
                                            <?php echo ((isset($producto['precio']))?  '$'.$producto['precio']:'Proximamente');?> 
                                        
                                        </h3>
                                        
                                        <div class="d-flex justify-content-between align-items-center">
                                            
                                            <div class="btn-group">
                                            
                                                <a type="button" class="btn btn-sm btn-secondary" href="/tienda/vistas/cliente/detalleProducto.php<?php echo ((isset($producto['id']))? '?producto='.$producto['id'] : ''); ?>">Ver</a>
                                                <a type="sumbit" productoId=<?php echo ((isset($producto['id']))? $producto['id'] : ''); ?> producto class="btn btn-sm btn-success carro text-white agregar">Añadir a Carro</a>
                                            
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        <?php endforeach; ?>
                    
                    </div>

                <?php else: ?>
                
                    <h1 class="text-center">No existen productos con esa descripción</h1>

                <?php endif; ?>

            </div>

        </div>