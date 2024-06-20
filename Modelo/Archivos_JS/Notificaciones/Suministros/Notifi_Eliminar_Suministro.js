    // Realizar una solicitud AJAX para obtener los valores de sesión
    $.ajax({

        type: "GET",
        url: "../../Controlador/Utilidades/Notificaciones/Suministro/Notifi_Eliminar_Suministro.php",
        dataType: "json",

        success: function(response) {
            
            if (response.hasOwnProperty('Suministro')) {
                
                // Acceder a los datos recibidos
                var SuministroID = response.Suministro; //Accede al dato recibido ("PLACA VEHICULO")
                
                // Mostrar los datos en una alerta
                Swal.fire({
                    title: 'El Producto: ' + SuministroID ,
                    text: '¡Eliminado Correctamente!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1800
                });

                // Mostrar los datos en la consola para verificar
                console.log("El prodcuto: "+ SuministroID +" Eliminado Correctamente");               
                
                // Realizar una nueva solicitud AJAX para ELIMINAR LA SESSION ID
                $.ajax({

                    type: "GET",
                    url: "../../Controlador/Utilidades/Suministro/POST_Eliminar_SuministroID.php",
                    dataType: "json", // Especificar que esperas una respuesta JSON
                
                    success: function(response) {

                        if (response.hasOwnProperty('idSuministro')) {

                            // Acceder al dato 'vehiculo_delate' en la respuesta JSON
                            var idMessage = response.idSuministro;
                    
                            // Informar en la consola si se eliminó la sesión correctamente
                            console.log("-> Mensaje:", idMessage);

                        } else {

                            // Acceder al dato 'id_delate' en la respuesta JSON
                            var idMessage = response.error;
                    
                            // Informar en la consola si se eliminó la sesión correctamente
                            console.log("-> Mensaje:", idMessage);


                        }    

                    },
                
                    error: function(xhr, status, error) {

                        // Informar en la consola si ocurrió un error al eliminar la sesión
                        console.error("-> AJAX(POST_Eliminar_SuministroID.php):", error);

                    }
                });            
                
            } else {
                
                // Acceder a los datos recibidos
                var error = response.error; //Accede al dato recibido ("ERROR")
                
                // Mostrar los datos en la consola para verificar
                console.log("-> Mensaje de [Notifi_Eliminar_Suministro.php]:", error);                

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
            console.error("-> AJAX(Notifi_Eliminar_Suministro.php):", error);
        }
    });