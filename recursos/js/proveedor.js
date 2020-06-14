$(document).ready(function() {

    $("form").submit(function(e) {
        var id = '';
        var error = '';
        texto = '';
        valor = '';

        $('form input').each(function() {

            id = $(this).attr('id');
            valor = $(this).val();
            texto = id.replace('_', ' ');

            switch (id) {

                case "nombre_proveedor":
                case "direccion":
                case "nombre_encargado":
                case "apellidos_encargado":

                    if (!validarVacios(valor)) {

                        texto = id.replace('_', ' ');
                        error += texto.toUpperCase() + ' es requerido<br/>';

                    } else {

                        if (!validarTexto(valor)) {

                            texto = id.replace('_', ' ');
                            error += texto.toUpperCase() + ' debe empezar con una letra<br/>';
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
                        } else {
                            if (!MaximoCatacteres(valor, 12)) {
                                texto = id.replace('_', ' ');
                                error += texto.toUpperCase() + ' tiene mas de 12 digítos<br/>';
                            }
                        }
                    }

                    break;
                case "correo":
                    if (!validacionEmail(valor)) {
                        texto = id.replace('_', ' ');
                        error += texto.toUpperCase() + ' no es un correo <br/>';
                    }
                    break;
            }
        });
        $('#error').html(error);
        return ((error == '') ? true : false);
    });

    //buscar
    $('a#buscar').on('click', function(e) {

        var id = $('#id').val();
        var idComponente = $('#id').attr('id');
        var error = '';

        if (!validarVacios(id)) {

            texto = idComponente.replace('_', ' ');
            error += texto.toUpperCase() + ' es requerido<br/>';

        } else {

            var cadena = 'id=' + id;

            $.ajax({

                url: "../../ajax/proveedor.php",
                method: 'POST',
                data: cadena,
                success: function(resultado) {

                    if (resultado == null || resultado == '') {

                        error = 'No se encontro el proveedor <br/>';
                        limpiar();

                    } else {

                        var json = JSON.parse(resultado);
                        if (isNaN(json)) {

                            $('#id').prop('readonly', true);

                            var accion = $('form').attr('id');

                            if (accion != 'eliminar') {

                                $('form input[disabled]').attr('enabled', true);
                                $('form input[disabled]').prop('disabled', false);

                            } else {

                                $('form input[type="submit"]').attr('enabled', true);
                                $('form input[type="submit"]').prop('disabled', false);

                            }

                            $('#nombre_proveedor').val(json['nombre_proveedor']);
                            $('#direccion').val(json['direccion']);
                            $('#correo').val(json['correo']);
                            $('#nombre_encargado').val(json['nombre_encargado']);
                            $('#apellidos_encargado').val(json['apellidos_encargado']);
                            $('#telefono').val(json['telefono']);


                        } else {

                            error = 'No se encontro el proveedor <br/>';
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
    $('a#limpiar').on('click', function(e) {

        limpiar();

    });

    function limpiar() {

        $('#id').prop('readonly', false);
        $('#id').val('');

        $('#nombre_proveedor').val('');
        $('#direccion').val('');
        $('#correo').val('');
        $('#nombre_encargado').val('');
        $('#apellidos_encargado').val('');
        $('#telefono').val('');

        $('form input[enabled="true"]').prop('disabled', true);
        $('form input[enabled="true"]').attr('enabled', false);

    }

});