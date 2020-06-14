$(document).ready(function() {

    //Imagenes

    $('input[type="file"]').on('change', function(e){

        input = this;
        if(this.files && this.files[0]) {

            var id=$(input).attr('id');

            var reader = new FileReader();

            reader.onload = function (e) {

                if(validarArchivo(input)){

                    $('img[for="'+id+'"]').attr('src', e.target.result);

                }
                else{

                    $('img[for="'+id+'"]').attr('src','/tienda/recursos/img/imagenDefecto.png');
                    $('#imagen').replaceWith($('#imagen').val('').clone(true));

                }

            }

            reader.readAsDataURL(this.files[0]);

        }else{

            $('img[for="'+id+'"]').attr('src','/tienda/recursos/img/imagenDefecto.png');
            $('#imagen').replaceWith($('#imagen').val('').clone(true));

        }

    });//FIN IMAGENES

    $(".insertar-imagen").on('click',function(){

        var id = $(this).attr('for');
        $('input#'+id).click();

    });//FIN INSERTAR

    //Buscar
     $('a#buscar').on('click',function(e){

        var id = $('#id').val();
        var idComponente = $('#id').attr('id');
        var error = '';

        if(!validarVacios(id)){

            texto = idComponente.replace('_',' ');
            error += texto.toUpperCase()+' es requerido<br/>';

        }
        else{

            var cadena = 'id='+id;

            $.ajax({

                url: "../../ajax/producto.php",
                method: 'POST',
                data: cadena,
                success: function(resultado){

                    if(resultado == null || resultado == ''){

                        error = 'No se encontro el producto  <br/>';
                        limpiar();

                    }
                    else{

                        var json = JSON.parse(resultado);
                        if(isNaN(json)){

                            $('#id').prop('readonly',true);

                            var accion = $('form').attr('id');

                            if(accion!='eliminar'){

                                $('form input[disabled]').attr('enabled',true);
                                $('form input[disabled]').prop('disabled', false);

                            }
                            else{

                                $('form input[type="submit"]').attr('enabled',true);
                                $('form input[type="submit"]').prop('disabled', false);

                            }
                            
                            $('#nombre_producto').val(json['nombre_producto']);
                            $('#descripcion').val(json['descripcion']);
                            $('#precio').val(json['precio']);
                            $('#cantidad').val(json['cantidad']);
                            $('#proveedor').val(json['proveedor']);
                            $('#categoria').val(json['categoria']);
                            $('#imagen').val(json['imagen']);

                        }
                        else{

                            error = 'No se encontro El producto <br/>';
                            limpiar();

                        }

                    }

                    $('#error').html(error);

                }

            });

        }

        $('#error').html(error);

    });

    $('a#buscar').on('click',function(e){

        var id = $('#id').val();
        var idComponente = $('#id').attr('id');
        var error = '';

        if(!validarVacios(id)){

            texto = idComponente.replace('_',' ');
            error += texto.toUpperCase()+' es requerido<br/>';

        }
        else{

            var cadena = 'id='+id;

            $.ajax({

                url: "../../ajax/producto.php",
                method: 'POST',
                data: cadena,
                success: function(resultado){

                    if(resultado == null || resultado == ''){

                        error = 'No se encontro el producto  <br/>';
                        limpiar();

                    }
                    else{

                        var json = JSON.parse(resultado);
                        if(isNaN(json)){

                            $('#id').prop('readonly',true);

                            var accion = $('form').attr('id');

                            if(accion!='eliminar'){

                                $('form input[disabled]').attr('enabled',true);
                                $('form input[disabled]').prop('disabled', false);
                                $('form select[disabled]').attr('enabled',true);
                                $('form select[disabled]').prop('disabled', false);

                            }
                            else{

                                $('form input[type="submit"]').attr('enabled',true);
                                $('form input[type="submit"]').prop('disabled', false);

                            }

                            $('#nombre_producto').val(json['nombre_producto']);
                            $('#descripcion').val(json['descripcion']);
                            $('#precio').val(json['precio']);
                            $('#cantidad').val(json['cantidad']);
                            $('#imagen-prod').attr('src',json['imagen']);

                            var opcion

                            opcion = $('#proveedor').children('option[value="'+json['proveedor']+'"]');
                            $(opcion).attr("selected",true);
                            opcion = $('#categoria').children('option[value="'+json['categoria']+'"]');
                            $(opcion).attr("selected",true);

                        }
                        else{

                            error = 'No se encontro El producto <br/>';
                            limpiar();

                        }

                    }

                    $('#error').html(error);

                }

            });

        }

        $('#error').html(error);

    });

    //limpiar
    $('a#limpiar').on('click',function(e){

        limpiar();

    });

    function limpiar(){

        $('#id').prop('readonly',false);
        $('#id').val('');

        $('#nombre_producto').val();
        $('#descripcion').val();
        $('#precio').val();
        $('#cantidad').val();
        $('#imagen-prod').attr('src','/tienda/recursos/img/imagenDefecto.png');

        var opcion

        $('#proveedor').children('option').attr('selected',false);
        $('#categoria').children('option').attr('selected',false);

        $('form select[enabled="true"]').prop('disabled', true);
        $('form select[enabled="true"]').attr('enabled',false);
        $('form input[enabled="true"]').prop('disabled', true);
        $('form input[enabled="true"]').attr('enabled',false);

    }


});