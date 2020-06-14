<head>

    <?php include('./modelo/general/head.php'); ?>
    <!-- Estilos -->
    <link rel="stylesheet" href="/tienda/recursos/css/sesion.css" />
    <script src="/tienda/recursos/js/validaciones.js"></script> 
    <?php print((isset($headAdicional))? $headAdicional : ''); ?> 
      
</head>

<body>

    <div class="container-fluid">
    
        <div class="row no-gutter">
        
            <?php 
                
                $imagen = 'bg-imageCliente';
                if(isset($administrador) && $administrador==true){

                    $imagen = 'bg-imageAdmin';

                }
                else if(isset($cierre) && $cierre==true){

                    $imagen = 'bg-imagenCierre';

                }

            ?>

            <div class="d-none d-md-flex col-md-4 col-lg-6 <?php echo $imagen; ?>"></div>
                
                <div class="col-md-8 col-lg-6">
                    
                    <div class="login d-flex align-items-center py-5">
                        
                        <div class="container">

                            <div class="row">
                                
                                <div class="col-md-9 col-lg-8 mx-auto">
                                
                                    <h3 class="login-heading mb-4"> <?php echo ((isset($titulo))? $titulo:'Titulo'); ?> </h3>
                                    
                                    <?php if(isset($inputs)): ?>
                                        
                                        <div class="text-danger " id="error" role="alert">
                                        
                                            <?php echo htmlspecialchars((isset($errores))? $errores:''); ?>
                                        
                                        </div>

                                        <form id="<?php echo ((isset($iniciar) && $iniciar==true)? 'iniciar' : ''); ?>"
                                            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
                                            method = 'POST' >

                                                <?php foreach($inputs as $input): ?>

                                                    <div class="form-label-group">

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

                                                            <input type="<?php echo ((isset($input['type']))? $input['type']:''); ?>" 
                                                                id="<?php echo ((isset($input['id']))? $input['id']:''); ?>" 
                                                                name="<?php echo ((isset($input['id']))? $input['id']:''); ?>" class="form-control" 
                                                                placeholder="<?php echo ((isset($input['placeholder']))? $input['placeholder']:''); ?>"
                                                                <?php echo ((isset($input['estado']))? $input['estado']:''); ?>
                                                                value="<?php echo ((isset($input['value']))? $input['value']:''); ?>" />

                                                            <label for="<?php echo $input['id']; ?>"><?php echo $input['placeholder']; ?></label>

                                                        <?php endif; ?>

                                                    </div>

                                                <?php endforeach; ?>

                                            <div class="d-flex justify-content-around">

                                                <input name="enviar" class="btn btn-lg btn-primary btn-login text-uppercase font-weight-bold mb-2 ancho" type="submit" value="<?php echo ((isset($botonForm))? $botonForm:'Acción'); ?>" />
                                                
                                                <?php

                                                    if(isset($botonAdicional)){

                                                        echo $botonAdicional;

                                                    }

                                                ?>

                                            </div>

                                        </form>

                                    <?php else: ?>

                                        <h5 class="login-heading mb-4"> <?php echo ((isset($instruccion))? $instruccion:'Intruccion'); ?> </h5>

                                    <?php endif; ?>
                                    
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>