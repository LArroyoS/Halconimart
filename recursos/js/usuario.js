$(document).ready(function() {

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

                case "nombre":
                case "apellidos":
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

                case "contrasena":
                case "clave":

                    if(!validarVacios(valor)){

                        texto = id.replace('_',' ');
                        error += texto.toUpperCase()+' es requerido<br/>';

                    }
                    
                break;

            }

        });

        if(radio==0 && $(this).attr('id')!='iniciar'){

            error +='Genero es requerido<br/>';

        }

        $('#error').html(error);

        return ((error=='')? true:false);

    });

});