<?php

/*

    EJEMPLO:

    $titulo = 'Titilo de la pagina';
    $inputs = array(

        array('type' => 'text',
                'id' => '0',
                'placeholder' => 'Ingrese'),
        array('type' =>'email',
                'id' => '1',
                'placeholder' => 'Ingrese'),
        array('type' =>'date',
                'id' => '2',
                'placeholder' => 'Ingrese'),
        array('type' =>'number',
                'id' => '3',
                'placeholder' => 'Ingrese'),

    );

    $botonForm = 'Guardar';

    if($_SERVER["REQUEST_METHOD"] == "POST"){



    }

    $resultado = array(

        array('campo1' => '1',
                'campo2' => '2',
                'campo3' => '3',
                'campo4' => '4',
                'campo5' => '5',
                'campo6' => '6',),
        array('campo1' => '1',
                'campo2' => '2',
                'campo3' => '3',
                'campo4' => '4',
                'campo5' => '5',
                'campo6' => '6',),
        array('campo1' => '1',
                'campo2' => '2',
                'campo3' => '3',
                'campo4' => '4',
                'campo5' => '5',
                'campo6' => '6',),
        array('campo1' => '1',
                'campo2' => '2',
                'campo3' => '3',
                'campo4' => '4',
                'campo5' => '5',
                'campo6' => '6',),
        array('campo1' => '1',
                'campo2' => '2',
                'campo3' => '3',
                'campo4' => '4',
                'campo5' => '5',
                'campo6' => '6',),
        array('campo1' => '1',
                'campo2' => '2',
                'campo3' => '3',
                'campo4' => '4',
                'campo5' => '5',
                'campo6' => '6',),

    );

*/
    $tienda = "Halconimart";

    session_start();
    $sesion = isset($_SESSION['id']);
    if($sesion){
        
        $correoUsuario = (isset($_SESSION['nombre'])? $_SESSION['nombre']:'');
        $admin = ((isset($_SESSION['tipo']) && $_SESSION['tipo']!='CLIENTE')? true:false);
        if(!$admin){

            header('Location: ../../cliente/index.php');

        }
        $operador = ((isset($_SESSION['tipo']) && $_SESSION['tipo']=='OPERADOR')? true:false);

    }
    else{

        header('Location: ../../InicioSesion.php');

    }

?>

<head>

    <?php include('../../modelo/general/head.php'); ?>
    <link rel="stylesheet" href="/tienda/recursos/css/admin.css?0.0" />
    <script type="text/javascript" src="/tienda/recursos/js/validaciones.js?1.0"></script>    
    <?php print((isset($headAdicional))? $headAdicional : ''); ?>

</head>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-dark" id="sidebar-wrapper">
            
            <h1 class="sidebar-heading font-weight-bolder text-white"> <?php echo ((isset($tienda))? $tienda:'NombreTienda'); ?> </h1>

            <div class="list-group list-group-flush">

                <a href="/tienda/vistas/admin/dashboard/Dashboard.php" class="list-group-item text-white list-group-item-action bg-secondary">Dashboard</a>
                
                <?php if(!$operador): ?>

                    <!-- Proveedores -->
                    <button class="list-group-item text-white list-group-item-action bg-secondary" data-toggle="collapse" data-target="#proveedores">Proveedores</button>

                    <div class="collapse navbar-collapse" id="proveedores">
                        
                        <div class="list-group list-group-flush">

                            <a class="list-group-item list-group-item-action bg-light" href="/tienda/vistas/admin/proveedores/Agregar.php">Agregar</a>
                            <a class="list-group-item list-group-item-action bg-light" href="/tienda/vistas/admin/proveedores/Modificar.php">Modificar</a>
                            <a class="list-group-item list-group-item-action bg-light" href="/tienda/vistas/admin/proveedores/Eliminar.php">Eliminar</a>
                            <a class="list-group-item list-group-item-action bg-light" href="/tienda/vistas/admin/proveedores/Listar.php">Listar</a>

                        </div>

                    </div>

                    <!-- Operadores -->
                    <button class="list-group-item text-white list-group-item-action bg-secondary" data-toggle="collapse" data-target="#operadores">Operadores</button>

                    <div class="collapse navbar-collapse" id="operadores">
                        
                        <div class="list-group list-group-flush">

                            <a class="list-group-item list-group-item-action bg-light" href="/tienda/vistas/admin/operadores/Agregar.php">Agregar</a>
                            <a class="list-group-item list-group-item-action bg-light" href="/tienda/vistas/admin/operadores/Modificar.php">Modificar</a>
                            <a class="list-group-item list-group-item-action bg-light" href="/tienda/vistas/admin/operadores/Eliminar.php">Eliminar</a>
                            <a class="list-group-item list-group-item-action bg-light" href="/tienda/vistas/admin/operadores/Listar.php">Listar</a>

                        </div>

                    </div>

                    <!-- Almacen -->
                    <button class="list-group-item text-white list-group-item-action bg-secondary" data-toggle="collapse" data-target="#almacenes">Almacen</button>

                    <div class="collapse navbar-collapse" id="almacenes">
                        
                        <div class="list-group list-group-flush">

                            <!-- Productos -->
                            <button class="list-group-item text-white list-group-item-action bg-info" data-toggle="collapse" data-target="#productos">Productos</button>

                            <div class="collapse navbar-collapse" id="productos">
                                    
                                <div class="list-group list-group-flush">

                                    <a class="list-group-item list-group-item-action bg-light" href="/tienda/vistas/admin/productos/Agregar.php">Agregar</a>
                                    <a class="list-group-item list-group-item-action bg-light" href="/tienda/vistas/admin/productos/Modificar.php">Modificar</a>
                                    <a class="list-group-item list-group-item-action bg-light" href="/tienda/vistas/admin/productos/Eliminar.php">Eliminar</a>
                                    <a class="list-group-item list-group-item-action bg-light" href="/tienda/vistas/admin/productos/Listar.php">Listar</a>

                                </div>

                            </div>

                            <!-- Categorias -->
                            <button class="list-group-item text-white list-group-item-action bg-info" data-toggle="collapse" data-target="#categorias">Categorias</button>

                            <div class="collapse navbar-collapse" id="categorias">
                                    
                                <div class="list-group list-group-flush">

                                    <a class="list-group-item list-group-item-action bg-light" href="/tienda/vistas/admin/categorias/Agregar.php">Agregar</a>
                                    <a class="list-group-item list-group-item-action bg-light" href="/tienda/vistas/admin/categorias/Modificar.php">Modificar</a>
                                    <a class="list-group-item list-group-item-action bg-light" href="/tienda/vistas/admin/categorias/Eliminar.php">Eliminar</a>
                                    <a class="list-group-item list-group-item-action bg-light" href="/tienda/vistas/admin/categorias/Listar.php">Listar</a>

                                </div>

                            </div>

                        </div>

                    </div>

                <?php endif; ?>

                <a href="/tienda/vistas/admin//pedidos/Listar.php" class=" text-white list-group-item list-group-item-action bg-secondary">Pedidos</a>
            
            </div>

        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
                
                <button class="btn btn-light shadow" id="menu-toggle">
                        
                    <i class="fa fa-bars"></i>
                
                </button>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            
                    <span class="navbar-toggler-icon"></span>
                
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        
                        <li class="nav-item dropdown">
                            
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            
                                <?php echo ((isset($correoUsuario))? $correoUsuario : 'Usuario'); ?>
                            
                            </a>
                            
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                
                                <a class="dropdown-item" href="/tienda/vistas/usuario/detalleUsuario.php">Modificar información</a>
                                <a class="dropdown-item" href="/tienda/vistas/cliente/index.php">Ir a tienda</a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="/tienda/vistas/SesionCerrada.php">Cerrar Sesión</a>
                            
                            </div>

                        </li>

                    </ul>

                </div>

            </nav>

            <div class="container-fluid bg-light">

                <h1 class="login-heading m-4"> <?php echo ((isset($titulo))? $titulo:'Titulo'); ?> </h1>
                
                <div class="card shadow p-4 mt-5">

                    <?php if((isset($inputs)) || (isset($selects))): ?>
                        
                        <form id="<?php echo htmlspecialchars(((isset($idForm)))? $idForm : ''); ?>" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
        
                            <div class="card-head">
                            
                                <div class="text-danger" id="error"> <?php echo ((isset($errores))? $errores: '' ); ?> </div>

                            </div>

                            <div class="card-body">
                    
                                <?php if(isset($buscar)): ?>

                                    <div class="row">

                                        <div class="form-label-group col-md-6">

                                            <input type="<?php echo ((isset($buscar['type']))? $buscar['type']:'text'); ?>" 
                                                                    id="<?php echo ((isset($buscar['id']))? $buscar['id']:''); ?>" 
                                                                    name="<?php echo ((isset($buscar['id']))? $buscar['id']:''); ?>" class="form-control" 
                                                                    placeholder="<?php echo ((isset($buscar['placeholder']))? $buscar['placeholder']:''); ?>"
                                                                    value="<?php echo ((isset($buscar['value']))? $buscar['value']:''); ?>"
                                                                    <?php echo ((isset($buscar['estado']))? $buscar['estado']:''); ?>/>

                                            <label for="<?php echo ((isset($buscar['id']))? $buscar['id']: ''); ?>"> <?php echo ((isset($buscar['placeholder']))? $buscar['placeholder']:''); ?></label>

                                        </div>

                                        <div class="form-label-group col-md-6">

                                            <a id="buscar" class="btn btn-lg btn-primary btn-admin text-uppercase font-weight-bold mb-2 btn-block text-white"
                                            <?php echo ((isset($buscar['estado']))? (($buscar['estado']=='disabled' || $buscar['estado']=='readonly')? 'hidden': $buscar['estado']):''); ?>>
                                                
                                                Buscar
                                                
                                            </a>

                                        </div>

                                    </div>

                                <?php endif; ?>

                                <?php foreach($inputs as $i => $input): ?>
                                
                                    <?php if($i%2==0): ?>

                                        <div class="row">

                                    <?php endif; ?>
                                    
                                        <div class="form-label-group col-md-6">
                                               
                                            <?php if(isset($input['type']) && $input['type']=="radio"): ?>
                                                
                                                <h6> <?php echo ((isset($input['placeholder']))? $input['placeholder']:''); ?> </h6>

                                                <?php 
                                                    
                                                    $radios = ((isset($input['values']))? $input['values']: null);
                                                    $valor = (isset($input['value']))? $input['value']: ''; 
                                                    
                                                    foreach($radios as $radio): 
                                                    
                                                ?>

                                                                                                   
                                                    <input type="<?php echo ((isset($input['type']))? $input['type']:'text'); ?>" 
                                                            id="<?php echo ($radio); ?>" 
                                                            name="<?php echo ((isset($input['id']))? $input['id']:''); ?>"
                                                            value="<?php echo $radio; ?>"
                                                            <?php echo ((isset($input['estado']))? $input['estado']:''); ?>
                                                            <?php echo (($valor==$radio)? 'checked': ''); ?> />
                                                    
                                                    <p style="display:inline-block"><?php echo $radio; ?></p>

                                                <?php endforeach; ?>

                                            <?php elseif(isset($input['type']) && $input['type']=="select"): ?>

                                                <h6> <?php echo ((isset($input['placeholder']))? $input['placeholder']:''); ?> </h6>

                                                <select class="form-control"
                                                name="<?php echo ((isset($input['id']))? $input['id']: ''); ?>"
                                                id="<?php echo ((isset($input['id']))? $input['id']: ''); ?>" 
                                                <?php echo ((isset($input['estado']))? $input['estado']:''); ?> >
                                            
                                                    <option value="">Seleccione una opcion</option>
                                                    <?php 
                                                        
                                                        $opciones = ((Isset($input['values']))? $input['values']:null);
                                                        $valor = ((isset($input['value']))? $input['value'] : '');
                                                        foreach($opciones as $opcion): 
                                                        
                                                    ?>
                                                    
                                                            <option value="<?php echo ((isset($opcion['id']))? $opcion['id']:''); ?>" 
                                                            <?php echo ((isset($opcion['id']) && $opcion['id']==$valor && $opcion['id']!="")? 'selected': ''); ?> >
                                                                
                                                                <?php echo ((isset($opcion['nombre']))? $opcion['nombre'] : '' ); ?>
                                                            
                                                            </option>

                                                    <?php endforeach; ?>

                                                </select>

                                            <?php else: ?>

                                                <input type="<?php echo ((isset($input['type']))? $input['type']:'text'); ?>" 
                                                        id="<?php echo ((isset($input['id']))? $input['id']: ''); ?>" 
                                                        name="<?php echo ((isset($input['id']))? $input['id']:''); ?>" class="form-control" 
                                                        placeholder="<?php echo ((isset($input['placeholder']))? $input['placeholder']:''); ?>"
                                                        value="<?php echo ((isset($input['value']))? $input['value']:''); ?>"
                                                        <?php echo ((isset($input['estado']))? $input['estado']:''); ?>/>
                                            
                                                <label for="<?php echo ((isset($input['id']))? $input['id']: ''); ?>"> <?php echo ((isset($input['placeholder']))? $input['placeholder']:''); ?></label>

                                            <?php endif; ?>

                                        </div>

                                    <?php if($i%2!=0): ?>

                                        </div>

                                    <?php endif; ?>
                                                
                                <?php endforeach; ?>

                                <?php if($i%2==0): ?>

                                    </div>

                                <?php endif; ?>

                                <?php if(isset($InputImagen)):?>
                                    
                                    <div class="contenedor-imagen">
                                    
                                        <input type="file" 
                                        name="<?php echo ((isset($InputImagen['id']))? $InputImagen['id'] : ''); ?>" 
                                        id="<?php echo ((isset($InputImagen['id']))? $InputImagen['id'] : ''); ?>"
                                        <?php echo ((isset($InputImagen['estado']))? $InputImagen['estado']:''); ?> 
                                        style="display:none;" />
                                        
                                        <img
                                        id='imagen-prod'
                                        for="<?php echo ((isset($InputImagen['id']))? $InputImagen['id'] : ''); ?>"
                                        width="50%" 
                                        src="<?php echo ((isset($InputImagen['ruta']) && $InputImagen['ruta']!='')? $InputImagen['ruta']: '/tienda/recursos/img/imagenDefecto.png'); ?>" alt="No se cargo la imagen"/>

                                        <?php if(!isset($obtencion) || $obtencion!=true): ?>

                                            <div for="<?php echo ((isset($InputImagen['id']))? $InputImagen['id'] : ''); ?>" class="centered d-flex align-items-center justify-content-center insertar-imagen"> Insertar Imagen </div>

                                        <?php endif; ?>

                                    </div>
                                    
                                <?php endif; ?>

                            </div>

                            <div class="card-footer d-flex justify-content-around">

                                <?php if((isset($botonForm))): ?>
                                    
                                    <input id="enviar" name="enviar" class="btn btn-lg btn-primary btn-admin text-uppercase font-weight-bold mb-2 ancho" type="submit" value="<?php echo $botonForm; ?>" 
                                    <?php echo ((isset($buscar['estado']) && $buscar['estado']=='')? 'disabled': ''); ?> />

                                <?php endif; ?>

                                <?php echo ((isset($botonAdicional))? $botonAdicional:''); ?>

                            </div>

                        </form>

                    <?php endif; if(isset($resultado) && $resultado!=null): ?>

                        <?php if(count($resultado) > 0): ?>

                            <div class="table-responsive">
                        
                                <table class="table text-center">

                                    <thead>

                                        <tr>

                                            <?php 
                                            
                                                $encabezado = $resultado[0];
                                                while($cabecera = current($encabezado)): 
                                                
                                            ?>

                                                    <th> <?php echo key($encabezado); ?> </th>

                                            <?php 
                                                
                                                    next($encabezado);

                                                endwhile; 
                                                    
                                            ?>

                                            <?php if(isset($nombreLlaveprimaria)): ?>
                                            
                                                <th> ACCION </th>

                                            <?php endif; ?>

                                        </tr>

                                    </thead>

                                    <tbody>
                            
                                        <?php foreach($resultado as $dato): ?>
                                            
                                            <tr>

                                                <?php foreach($dato as $valor): ?>

                                                    <td><?php echo $valor; ?></td>

                                                <?php endforeach; ?>

                                                <?php if(isset($nombreLlaveprimaria)): ?>

                                                    <td class="td-actions text-right">
                                                        
                                                        <?php if(isset($dato[$nombreLlaveprimaria])): ?>
                                                            
                                                            <a href='./Detalle.php?id=<?php echo htmlspecialchars($dato[$nombreLlaveprimaria]); ?>' class="btn btn-round btn-info btn-just-icon btn-sm">
                                                            
                                                                <i class="fa fa-eye"></i>
                                                            
                                                            </a>

                                                            <a href="./Modificar.php?id=<?php echo htmlspecialchars($dato[$nombreLlaveprimaria]); ?>" class="btn btn-round btn-success btn-just-icon btn-sm">
                                                                
                                                                <i class="fa fa-edit"></i>
                                                            
                                                            </a>
                                                            
                                                            <a href="./Eliminar.php?id=<?php echo htmlspecialchars($dato[$nombreLlaveprimaria]); ?>" class="btn btn-round btn-danger btn-just-icon btn-sm">
                                                                
                                                                <i class="fa fa-trash"></i>
                                                            
                                                            </a>

                                                        <?php endif; ?>
                                                    
                                                    </td>

                                                <?php endif; ?>

                                            </tr>

                                        <?php endforeach; ?>
                            
                                    </tbody>
                    
                                </table>

                                <h4 class="text-right"> <?php echo ((isset($total))? 'TOTAL: '.$total: ''); ?> </h4>
                    
                            </div>
                        
                        <?php else: ?>

                            <h2 class="text-center" >Sin Datos</h2>

                        <?php endif; ?>

                    <?php endif; ?>