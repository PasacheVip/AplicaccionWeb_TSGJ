
/* global Swal */

// Notificaciones de validacion
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("login-in").addEventListener('submit', validarFormulario);
});

function validarFormulario(evento) {
    evento.preventDefault();

    // Input nameuser - "Nos ayudara a validar si el campo esta vacio o si tiene contenido al momento del SUBMIT"
    var nombres = document.getElementById('nameuser').value;
    if (nombres.length === 0) {
        Swal.fire({
            width: '22rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Ingrese un Nombre de Usario',
            showConfirmButton: false,
            timer: 1800
        });
        return;
    }

    // Input password - "Nos ayudara a validar si el campo esta vacio o si tiene contenido al momento del SUBMIT"
    var email = document.getElementById('password').value;
    if (email.length === 0) {
        Swal.fire({
            width: '22rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Ingrese una Contraseña',
            showConfirmButton: false,
            timer: 1800
        });
        return;
    }

    this.submit();
}

/* Validacion Para Verificar si el inicio de sesion es INCORRECTO*/
window.onload = function() { 
    var urlParams = new URLSearchParams(window.location.search);
    var info = urlParams.get('e');

    if (info === "UCI") {
        Swal.fire({
            width: '24rem',
            title: '¡Nombre De Usuario y/o Contraseña Incorrectos!',
            icon: 'error',
            showConfirmButton: false,
            timer: 1800
        });
    }
    
};

/*

1. window.onload: Esto es un evento que se activa cuando la página web completa, incluidos todos los recursos, ha terminado de cargarse completamente en el navegador del usuario. Es útil para ejecutar código JavaScript que necesita acceder a los elementos de la página después de que se haya cargado completamente.
2. var urlParams = new URLSearchParams(window.location.search);: Esta línea crea un nuevo objeto URLSearchParams que representa los parámetros de búsqueda en la URL de la página actual. La propiedad window.location.search devuelve la cadena de consulta de la URL actual (la parte después del signo de interrogación ?), que generalmente contiene los parámetros GET.
3. var mensaje = urlParams.get('mensaje');: Esta línea obtiene el valor del parámetro GET llamado mensaje de la URL actual utilizando el método get() del objeto URLSearchParams. Si el parámetro mensaje está presente en la URL, su valor se asignará a la variable mensaje. Si no hay ningún parámetro mensaje en la URL, la variable mensaje será null.

 */
