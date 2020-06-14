$(document).ready(function() {

    console.log(MinimoCatacteres('as', 7));
    //validar formulario
    $("form").submit(function(e){

        var id = '';
        var error = '';
        var texto = '';
        var valor = '';
        var radio = 0;

        $('form input').each(function(){

            id = $(this).attr('name');
            valor = $(this).val();
            switch(id){

                case "nombre_operador":
                case "apellidos_operador":
                case "ciudad":

                    if(!validarVacios(valor)){
                        texto = id.toUpperCase();
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
                case 'genero':
                    
                    var accion = $('form').attr('id');
                    if(accion!='eliminar'){

                        texto = id.toUpperCase();
                        radio += $(this).is(':checked');

                    }
                    else{

                        radio = true;

                    }

                break;
                case "fecha":
                    valor = new Date($(this).val());
                    if(isNaN(valor)){

                        texto = id.replace('_',' ');
                        error += texto.toUpperCase()+' es requerido<br/>';

                    }

                break;
                case "correo":
                    if(!validarVacios(valor)){

                        texto = id.replace('_',' ');
                        error += texto.toUpperCase()+' es requerido<br/>';

                    }
                    else{

                        if(!validacionEmail(valor)){

                            texto = id.replace('_',' ');
                            error += texto.toUpperCase()+' no es valido<br/>';

                        }

                    }

                break;

                case "telefono":
                    
                    if (!validacionEntero(valor)) {

                        texto = id.replace('_', ' ');
                        error += texto.toUpperCase() + ' deben ser numeros<br/>'

                    } else {
                        
                        if (!MinimoCatacteres(valor, 7)) {

                            texto = id.replace('_', ' ');
                            error += texto.toUpperCase() + ' tiene menos de 7 digítos<br/>';
                        
                        }

                        if (!MaximoCatacteres(valor, 12)) {
                            
                            texto = id.replace('_', ' ');
                            error += texto.toUpperCase() + ' tiene mas de 12 digítos<br/>';
                        }

                    }

                break;

                case "contraseña":

                    if(!validarVacios(valor)){

                        texto = id.replace('_',' ');
                        error += texto.toUpperCase()+' es requerido<br/>';

                    }
                    else{

                        if(!validacionClave(valor)){

                            texto = id.replace('_',' ');
                            error += texto.toUpperCase()+' debe tener entre 8 y 10 caracteres, por lo menos un digito y un alfanumérico, y no puede contener caracteres espaciales<br/>';

                        }

                    }
                break;

            }

        });

        if(radio==0){
            error +='Genero es requerido<br/>';
        }

        $('#error').html(error);

        return ((error=='')? true:false);

    });

    //buscar
    $('a#buscar').on('click',function(e){

        var id = $('#id_usuario').val();
        var idComponente = $('#id_usuario').attr('id');
        var error = '';

        if(!validarVacios(id)){

            texto = idComponente.replace('_',' ');
            error += texto.toUpperCase()+' es requerido<br/>';

        }
        else{

            var cadena = 'ID_USUARIO='+id;

            $.ajax({

                url: "../../ajax/operadores.php",
                method: 'POST',
                data: cadena,
                success: function(resultado){

                    if(resultado == null || resultado == ''){

                        error = 'No se encontro el operador <br/>';
                        limpiar();

                    }
                    else{

                        var json = JSON.parse(resultado);
                        if(isNaN(json)){

                            $('#ID_USUARIO').prop('readonly',true);

                            var accion = $('form').attr('id');

                            if(accion!='eliminar'){

                                $('form input[disabled]').attr('enabled',true);
                                $('form input[disabled]').prop('disabled', false);
                                

                                $('input[name="genero"]').each(function(){

                                    if($(this).val().toLowerCase()==json['GENERO'].toLowerCase()){
    
                                        $(this).prop('checked',true);
                                    
                                    }
    
                                });

                            }
                            else{

                                $('form input[type="submit"]').attr('enabled',true);
                                $('form input[type="submit"]').prop('disabled', false);

                                $('#genero').val(json['GENERO']);

                            }

                            $('#nombre_operador').val(json['NOM_USUARIO']);
                            $('#apellidos_operador').val(json['AP_USUARIO']);
                            $('#fecha').val(json['FECHA_NAC']);
                            $('#ciudad').val(json['CIUDAD']);
                            $('#correo').val(json['CORREO']);
                            $('#telefono').val(json['TELEFONO']);
                            $('#contraseña').val(json['CONTRASENA']);
                            

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

        $('#id_usuario').prop('readonly',false);
        $('#id_usuario').val('');
        $('#nombre_operador').prop('readonly',false);
        $('#nombre_operador').val('');
        $('#apellidos_operador').prop('readonly',false);
        $('#apellidos_operador').val('');
        $('#fecha').prop('readonly',false);
        $('#fecha').val('');
        $('#genero').prop('readonly',false);
        $('#genero').val('');
        $('#correo').prop('readonly',false);
        $('#correo').val('');
        $('#contraseña').prop('readonly',false);
        $('#contraseña').val('');
        $('#telefono').prop('readonly',false);
        $('#telefono').val('');
        $('input[type="radio"]').prop('checked',false);
        $('#ciudad').prop('readonly',false);
        $('#ciudad').val('');
        $('input[type="radio"]').prop('checked',false);
      
        $('form input[enabled="true"]').prop('disabled', true);
        $('form input[enabled="true"]').attr('enabled',false);

    }

});