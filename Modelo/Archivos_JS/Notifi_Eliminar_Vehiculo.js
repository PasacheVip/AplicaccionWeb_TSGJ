     
    // Realizar una solicitud AJAX para obtener los valores de sesión
    $.ajax({

        type: "GET",
        url: "../../Controlador/Utilidades/Notifi_Eliminar_Vehiculo.php",
        dataType: "json",

        success: function(response) {
            
            if (response.hasOwnProperty('placavehiculo')) {
                
                // Acceder a los datos recibidos
                var placa_vehiculo = response.placavehiculo; //Accede al dato recibido ("PLACA VEHICULO")
                
                // Mostrar los datos en una alerta
                Swal.fire({
                    title: 'El Vehiculo: ' + placa_vehiculo ,
                    text: '¡Eliminado Correctamente!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1800
                });

                // Mostrar los datos en la consola para verificar
                console.log("Vehiculo De Placa De Rodaje: "+ placa_vehiculo +" Eliminado Correctamente");               
                
                // Realizar una nueva solicitud AJAX para ELIMINAR LA SESSION ID
                $.ajax({

                    type: "GET",
                    url: "../../Controlador/Utilidades/POST_Eliminar_VehiculoPlaca.php",
                    dataType: "json", // Especificar que esperas una respuesta JSON
                
                    success: function(response) {

                        if (response.hasOwnProperty('vehiculo_delate')) {

                            // Acceder al dato 'vehiculo_delate' en la respuesta JSON
                            var idMessage = response.vehiculo_delate;
                    
                            // Informar en la consola si se eliminó la sesión correctamente
                            console.log("-> Mensaje:", idMessage);

                        } else {

                            // Acceder al dato 'id_delate' en la respuesta JSON
                            var error = response.error;
                    
                            // Informar en la consola si se eliminó la sesión correctamente
                            console.log("-> Mensaje:", error);


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
                console.log("-> Mensaje de [Notifi_Eliminar_Vehiculo.php]:", error);                

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
            console.error("-> AJAX(Notifi_Eliminar_Vehiculo.php):", error);
        }
    });
