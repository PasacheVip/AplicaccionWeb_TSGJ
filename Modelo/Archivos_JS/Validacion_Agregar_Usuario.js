/* global Swal */

function validarFormulario(evento) {
    evento.preventDefault();

    // Input Usuario - "VALIDA SI EL CAMPO CONTIENE TEXTO, DE ESTAR VACIO RECHAZA"
    var Usuario = document.getElementById('usuario').value;
    if (Usuario.length === 0) {
        Swal.fire({
            width: '23rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Ingrese un Usuario',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }

    // Input Contraseña - "VALIDA SI EL CAMPO CONTIENE TEXTO, DE ESTAR VACIO RECHAZA"
    var Contraseña = document.getElementById('contrasena').value;
    if (Contraseña.length === 0) {
        Swal.fire({
            width: '22rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Ingrese una Contraseña',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }

    // Input NombreUser - "VALIDA SI EL CAMPO CONTIENE TEXTO, DE ESTAR VACIO RECHAZA"
    var nombreuser = document.getElementById('nombre').value;
    if (nombreuser.length === 0) {
        Swal.fire({
            width: '23rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Ingrese el Nombre de Usuario',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }

    // Input ApellidoUser - "VALIDA SI EL CAMPO CONTIENE TEXTO, DE ESTAR VACIO RECHAZA"
    var apellidouser = document.getElementById('apellido').value;
    if (apellidouser.length === 0) {
        Swal.fire({
            width: '23rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Ingrese el Apellido de Usuario',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }

    // Input Correo Electronico - "VALIDA SI EL CAMPO CONTIENE TEXTO, DE ESTAR VACIO RECHAZA"

    // Función para validar el formato de correo electrónico
    var CorreoElectronico = document.getElementById('correo').value;
    
    function isValidEmail(CorreoElectronico) {
        // Expresión regular para validar el formato de correo electrónico
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(CorreoElectronico);
    }
    
    if (!isValidEmail(CorreoElectronico)) {
        Swal.fire({
            width: '23rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Ingresa un Correo Electrónico Válido',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }    

    // Input Telefono - "VALIDA SI EL CAMPO CONTIENE TEXTO, DE ESTAR VACIO RECHAZA"
    var numTelefono = document.getElementById('telefono').value;

    // Verifica si el campo está vacío
    if (numTelefono.length === 0) {
        Swal.fire({
            width: '22rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Ingrese un Número de Teléfono',
            showConfirmButton: false,
            timer: 1500
        });
        return;

        
           // Verifica si el campo contiene exactamente 9 números
    } else if (numTelefono.length !== 9 || isNaN(numTelefono)) {
        Swal.fire({
            width: '22rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Ingrese un Número de Teléfono Válido (9 dígitos)',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }


    // Input Rol - "VALIDA SI EL CAMPO CONTIENE TEXTO, DE ESTAR VACIO RECHAZA"
    var rolUsuario = document.getElementById('rolusuario').value;
    if (isNaN(rolUsuario) || rolUsuario < 1 || rolUsuario > 2 ) {
        Swal.fire({
            width: '26rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Ingrese un Rol Válido para el Usuario (1-2)',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }
    
    this.submit();

}

// Validacion de cada campo del Formulario
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("Form_Registro").addEventListener('submit', validarFormulario);
});

/* Validacion Para Verificar si el registro fue EXITOSO*/
window.onload = function() { 
    var urlParams = new URLSearchParams(window.location.search);
    var mensaje = urlParams.get('mensaje');
    
    if (mensaje === "RegistroExitoso") {
        Swal.fire({
            title: "¡Registro exitoso!",
            text: "¡Tu cuenta ha sido registrada con éxito!",
            icon: "success"
        });
        
    } else if (mensaje === "RegistroErroneo") {
        Swal.fire({
            title: "Error",
            text: "Error al registrar usuario.",
            icon: "error"
        });
    }
};

/*

1. window.onload: Esto es un evento que se activa cuando la página web completa, incluidos todos los recursos, ha terminado de cargarse completamente en el navegador del usuario. Es útil para ejecutar código JavaScript que necesita acceder a los elementos de la página después de que se haya cargado completamente.
2. var urlParams = new URLSearchParams(window.location.search);: Esta línea crea un nuevo objeto URLSearchParams que representa los parámetros de búsqueda en la URL de la página actual. La propiedad window.location.search devuelve la cadena de consulta de la URL actual (la parte después del signo de interrogación ?), que generalmente contiene los parámetros GET.
3. var mensaje = urlParams.get('mensaje');: Esta línea obtiene el valor del parámetro GET llamado mensaje de la URL actual utilizando el método get() del objeto URLSearchParams. Si el parámetro mensaje está presente en la URL, su valor se asignará a la variable mensaje. Si no hay ningún parámetro mensaje en la URL, la variable mensaje será null.

 */