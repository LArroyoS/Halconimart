$(document).ready(function () {

    $('.agregar').on('click', function () {

        var productoId = $(this).attr('productoId');
        var cadena = 'id_producto=' + productoId;

        $.ajax({

            url: "../../vistas/ajax/cliente.php",
            method: 'POST',
            data: cadena,
            success: function (resultado) {

                if (resultado == null || resultado == '') {

                    alert('Ocurrio un error inesperado');

                }
                else {
                    
                    if(resultado!='true'){

                        alert('producto agotado');

                    }

                }

            }

        });

    });

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

                case "direccion":

                    alert('direccion');
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

});