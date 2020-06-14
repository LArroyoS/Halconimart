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

                        alert('ocurrio un error inesperado');

                    }

                }

            }

        });

    });

});