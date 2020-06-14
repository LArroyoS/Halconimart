$(document).ready(function() {

    //validar formulario
    $("form").submit(function(e){

        var id = '';
        var error = '';
        var texto = '';
        var valor = '';

        console.log()

        $('form input').each(function(){

            id = $(this).attr('id');
            valor = $(this).val();
            switch(id){

                case "nombre_categoria":
                case "descripcion":

                    if(!validarVacios(valor)){

                        texto = id.replace('_',' ');
                        error += texto.toUpperCase()+' es requerido<br/>';

                    }
                    else{

                        if(!validarTexto(valor)){

                            texto = id.replace('_',' ');
                            error += texto.toUpperCase()+' debe empezar con una letra<br/>';

                        }

                    }

                break;

            }

        });

        $('#error').html(error);

        return ((error=='')? true:false);

    });

    //buscar
    $('a#buscar').on('click',function(e){

        var id = $('#id_categoria').val();
        var idComponente = $('#id_categoria').attr('id');
        var error = '';

        if(!validarVacios(id)){

            texto = idComponente.replace('_',' ');
            error += texto.toUpperCase()+' es requerido<br/>';

        }
        else{

            var cadena = 'id_categoria='+id;

            $.ajax({

                url: "../../ajax/categoria.php",
                method: 'POST',
                data: cadena,
                success: function(resultado){

                    if(resultado == null || resultado == ''){

                        error = 'No se encontro la categoria <br/>';
                        limpiar();

                    }
                    else{

                        var json = JSON.parse(resultado);
                        if(isNaN(json)){

                            $('#id_categoria').prop('readonly',true);

                            var accion = $('form').attr('id');

                            if(accion!='eliminar'){

                                $('form input[disabled]').attr('enabled',true);
                                $('form input[disabled]').prop('disabled', false);

                            }
                            else{

                                $('form input[type="submit"]').attr('enabled',true);
                                $('form input[type="submit"]').prop('disabled', false);

                            }

                            $('#nombre_categoria').val(json['nombre_categoria']);
                            $('#descripcion').val(json['descripcion']);

                        }
                        else{

                            error = 'No se encontro la categoria <br/>';
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

        $('#id_categoria').prop('readonly',false);
        $('#id_categoria').val('');

        $('#nombre_categoria').val('');
        $('#descripcion').val('');

        $('form input[enabled="true"]').prop('disabled', true);
        $('form input[enabled="true"]').attr('enabled',false);

    }

});