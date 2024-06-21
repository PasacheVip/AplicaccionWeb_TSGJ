    // Realizar una solicitud AJAX para obtener los valores de sesión
    $.ajax({

        type: "GET",
        url: "../../Controlador/Utilidades/Notificaciones/Tipo_Cambio/Notifi_TipoDeCambio.php",
        dataType: "json",

        success: function(response) {
            
            if (response.hasOwnProperty('IdCorrecto')) {
                
                // Acceder a los datos recibidos
                var TipoDeCambio = response.IdCorrecto; //Accede al dato recibido ("PLACA VEHICULO")
                
                // Mostrar los datos en una alerta
                Swal.fire({
                    icon: "success",
                    title: "Tipo de Cambio en $ " + TipoDeCambio,
                    showConfirmButton: false,
                    timer: 1500
                });

                // Mostrar los datos en la consola para verificar
                console.log("El precio en Dolares es: $/ "+ TipoDeCambio);               
                
                // Realizar una nueva solicitud AJAX para ELIMINAR LA SESSION ID
                $.ajax({

                    type: "GET",
                    url: "../../Controlador/Utilidades/Notificaciones/Tipo_Cambio/POST_Eliminar_IdTipoDeCambio.php",
                    dataType: "json", // Especificar que esperas una respuesta JSON
                
                    success: function(response) {

                        if (response.hasOwnProperty('IdCorrecto')) {

                            // Acceder al dato 'vehiculo_delate' en la respuesta JSON
                            var idMessage = response.IdCorrecto;
                    
                            // Informar en la consola si se eliminó la sesión correctamente
                            console.log("-> Mensaje:", idMessage);

                        } else {

                            // Acceder al dato 'id_delate' en la respuesta JSON
                            var idMessage = response.IdError;
                    
                            // Informar en la consola si se eliminó la sesión correctamente
                            console.log("-> Mensaje:", idMessage);


                        }    

                    },
                
                    error: function(xhr, status, error) {

                        // Informar en la consola si ocurrió un error al eliminar la sesión
                        console.error("-> AJAX(POST_Eliminar_IdTipoDeCambio.php):", error);

                    }
                });            
                
            } else {
                
                // Acceder a los datos recibidos
                var error = response.IdError; //Accede al dato recibido ("ERROR")
                
                // Mostrar los datos en la consola para verificar
                console.log("-> Mensaje de [Notifi_TipoDeCambio.php]:", error);                

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
            console.error("-> AJAX(Notifi_TipoDeCambio.php):", error);
        }
    });
