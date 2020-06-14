$(document).ready(function() {

    //validar formulario
    $("form").submit(function(e){

        var id = '';
        var error = '';
        var texto = '';
        var valor = '';

        console.log()

        $('form select').each(function(){

            id = $(this).attr('id');
            valor = $(this).val();
            switch(id){

                case "operador":
                case "estado":

                    if(!validarVacios(valor)){

                        texto = id.replace('_',' ');
                        error += texto.toUpperCase()+' es requerido<br/>';

                    }

                break;

            }

        });

        $('#error').html(error);

        return ((error=='')? true:false);

    });

});