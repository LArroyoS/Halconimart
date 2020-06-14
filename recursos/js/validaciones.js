/* Retorna true si es valido o false si no es valido*/
/* Verifica si el valor no esta vacio */
var validarVacios = function(valor) {

    if (valor != null && valor != '') {

        return true;

    }

    return false;

}

/* Retorna true si es valido o false si no es valido*/
/* Verifica si el archivo es un tipo imagen */
var validarArchivo = function(valor) {

    if (valor.files && valor.files[0]) {

        var extensiones_permitidas = [".png", ".bmp", ".jpg", ".jpeg"];
        var tamano = 100; // EXPRESADO EN MB.
        var rutayarchivo = valor.value;
        var ultimo_punto = valor.value.lastIndexOf(".");
        var extension = rutayarchivo.slice(ultimo_punto, rutayarchivo.length);
        if (extensiones_permitidas.indexOf(extension) == -1) {


        } else if ((valor.files[0].size / 1048576) > tamano) {


        } else {

            return true;

        }

    }

    return false;

}

/* Retorna true si es valido o false si no es valido*/
/* Verifica si el valor es entero */
var validacionEntero = function(valor) {

    if (isNaN(parseInt(valor))) {

        return false;

    }

    return true;

}

/* Retorna true si es valido o false si no es valido*/
/* Verifica si el valor es real */
var validacionReal = function(valo) {

    if (isNaN(parseFloat(valor))) {

        return false;

    }

    return true;

}

/* Retorna true si es valido o false si no es valido*/
/* Valida que empiece texto con una letra */
var validarTexto = function(valor) {

    var regex = /^[a-zA-Z].*$/

    if (!regex.test(valor.trim())) {

        return false;

    }

    return true;

}

/* Retorna true si es valido o false si no es valido*/
/* Verifica si el valor tiene formato de correo electronico  */
var validacionEmail = function(valor) {

    var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

    if (!regex.test(valor.trim())) {

        return false;

    }

    return true;

}

/* Retorna true si es valido o false si no es valido*/
/* Entre 8 y 10 caracteres, por lo menos un digito y un alfanumérico, y no puede contener caracteres espaciales */
var validacionClave = function(valor) {

        var regex = /(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{8,10})$/;

        if (!regex.test(valor.trim())) {

            return false;

        }

        return true;

    }

    /* Retorna true si es valido o false si no es valido*/
    /* Verifica si la longitud del valor es menor a el limite */
    var MinimoCatacteres = function(valor, limite) {

        if (valor.length < limite) {
    
            return false;
        }
    
        return true;
    
    }
    
    /* Retorna true si es valido o false si no es valido*/
    /* Verifica si el la longitud del valor es mayor */
    var MaximoCatacteres = function(valor, limite) {
    
        if (valor.length > limite) {
    
            return false;
        }
    
        return true;
    
    }
    