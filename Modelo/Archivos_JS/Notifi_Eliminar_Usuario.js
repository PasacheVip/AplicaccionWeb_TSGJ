     
    // Realizar una solicitud AJAX para obtener los valores de sesión
    $.ajax({

        type: "GET",
        url: "../../Controlador/Utilidades/Notifi_Eliminar_Usuario.php",
        dataType: "json",

        success: function(response) {
            
            if (response.hasOwnProperty('delate')) {
                
                // Acceder a los datos recibidos
                var id_Delate = response.delate; //Accede al dato recibido ("ID")
                
                // Mostrar los datos en una alerta
                Swal.fire({
                    title: 'Usuario de ID N°: ' + id_Delate ,
                    text: '¡Eliminado Correctamente!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1800
                });

                // Mostrar los datos en la consola para verificar
                console.log("Usuario de ID N°: "+ id_Delate +" Eliminado Correctamente");               
                
                // Realizar una nueva solicitud AJAX para ELIMINAR LA SESSION ID
                $.ajax({

                    type: "GET",
                    url: "../../Controlador/Utilidades/POST_Eliminar_SessionID.php",
                    dataType: "json", // Especificar que esperas una respuesta JSON
                
                    success: function(response) {

                        if (response.hasOwnProperty('id_delate')) {

                            // Acceder al dato 'id_delate' en la respuesta JSON
                            var idMessage = response.id_delate;
                    
                            // Informar en la consola si se eliminó la sesión correctamente
                            console.log("-> DelateID:", idMessage);

                        } else {

                            // Acceder al dato 'id_delate' en la respuesta JSON
                            var idMessage = response.id_delate;
                    
                            // Informar en la consola si se eliminó la sesión correctamente
                            console.log("-> DelateID:", idMessage);


                        }    

                    },
                
                    error: function(xhr, status, error) {

                        // Informar en la consola si ocurrió un error al eliminar la sesión
                        console.error("-> AJAX(POST_Eliminar_SessionID.php):", error);

                    }
                });            
                
            } else {
                
                // Acceder a los datos recibidos
                var error = response.error; //Accede al dato recibido ("ERROR")
                
                // Mostrar los datos en la consola para verificar
                console.log("-> Mensaje de [Notifi_Eliminar_Usuario.php]::", error);                

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
            console.error("-> AJAX(Notifi_Eliminar_Usuario.php):", error);
        }
    });
