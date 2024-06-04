
window.onload = function() { 
    
    // Realizar una solicitud AJAX para obtener los valores de sesión
    $.ajax({

        type: "GET",
        url: "../../Controlador/Utilidades/Notifi_Inicio_Session.php",
        dataType: "json",

        success: function(response) {
            
            if (response.hasOwnProperty('error')) {
                
                // Acceder a los datos recibidos
                var error = response.error; //Accede al dato recibido ("ERROR")

                // Mostrar los datos en una alerta
                Swal.fire({
                    with: '20rem',
                    title: 'Error',
                    text: error, 
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                });

                // Mostrar los datos en la consola para verificar
                console.log("Error:", error);

            } else {

                // Acceder a los datos recibidos
                var username = response.usuario; //Accede al dato recibido ("USUARIO")
                var cargo = response.id_cargo; //Accede al dato recibido ("CARGO")
                
                // Mostrar los datos en una alerta
                Swal.fire({
                    title: '¡Bienvenido ' + username + '!',
                    text: 'Cargo Actual: ' + cargo,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1800
                });

                // Mostrar los datos en la consola para verificar
                console.log("Nombre de usuario:", username);
                console.log("Cargo:", cargo);
            }
        },

        error: function(xhr, status, error) {
            // Mostrar un mensaje de error al usuario
            Swal.fire({
                title: 'Error',
                text: 'Hubo un error al obtener la sesión. Por favor, inténtalo de nuevo más tarde.',
                icon: 'error',
                showConfirmButton: true
            });

            // Registrar el error en la consola
            console.error("-> AJAX(Notifi_Inicio_Session): ", error);
        }
    });
    
};

/*

1. window.onload: Esto es un evento que se activa cuando la página web completa, incluidos todos los recursos, ha terminado de cargarse completamente en el navegador del usuario. Es útil para ejecutar código JavaScript que necesita acceder a los elementos de la página después de que se haya cargado completamente.
2. var urlParams = new URLSearchParams(window.location.search);: Esta línea crea un nuevo objeto URLSearchParams que representa los parámetros de búsqueda en la URL de la página actual. La propiedad window.location.search devuelve la cadena de consulta de la URL actual (la parte después del signo de interrogación ?), que generalmente contiene los parámetros GET.
3. var mensaje = urlParams.get('mensaje');: Esta línea obtiene el valor del parámetro GET llamado mensaje de la URL actual utilizando el método get() del objeto URLSearchParams. Si el parámetro mensaje está presente en la URL, su valor se asignará a la variable mensaje. Si no hay ningún parámetro mensaje en la URL, la variable mensaje será null.

 */