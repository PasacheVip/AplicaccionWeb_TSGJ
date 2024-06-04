    // Realizar una solicitud AJAX para obtener los valores de sesión
    $.ajax({

        type: "GET",
        url: "../../Controlador/Utilidades/Notifi_Editar_Usuario.php",
        dataType: "json",

        success: function(response) {
            
            if (response.hasOwnProperty('update')) {
                
                // Acceder a los datos recibidos
                var usuario_Update = response.update; //Accede al dato recibido ("ID")
                
                // Mostrar los datos en una alerta
                Swal.fire({
                    title: 'Usuario ' + usuario_Update ,
                    text: '¡Editado Correctamente!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1800
                });

                // Mostrar los datos en la consola para verificar
                console.log("Usuario de ID N°: "+ usuario_Update +" Editado Correctamente");

                // Realizar una nueva solicitud AJAX para ELIMINAR LA SESSION ID
                $.ajax({

                    type: "GET",
                    url: "../../Controlador/Utilidades/POST_Eliminar_UsuarioUpdate.php",
                    dataType: "json", // Especificar que esperas una respuesta JSON
                
                    success: function(response) {

                        if (response.hasOwnProperty('usuario_delate')) {

                            // Acceder al dato 'usuario_delate' en la respuesta JSON
                            var idMessage = response.usuario_delate;
                    
                            // Informar en la consola si se eliminó la sesión correctamente
                            console.log("-> Delate Usuario: ", idMessage);

                        } else {

                            // Acceder al dato 'usuario_delate' en la respuesta JSON
                            var idMessage = response.usuario_delate;
                    
                            // Informar en la consola si se eliminó la sesión correctamente
                            console.log("-> Delate Usuario: ", idMessage);


                        }    

                    },
                
                    error: function(xhr, status, error) {

                        // Informar en la consola si ocurrió un error al eliminar la sesión
                        console.error("-> AJAX(POST_Eliminar_UsuarioUpdate.php): ", error);

                    }
                });         

            } else {
                
                // Acceder a los datos recibidos
                var error = response.error; //Accede al dato recibido ("ERROR")

                // Mostrar los datos en la consola para verificar
                console.log("-> Mensaje de [Notifi_Editar_Usuario.php]:", error);
                                        
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
            console.error("-> Mensaje de la Solicitud AJAX:", error);
        }
    });
