    // Realizar una solicitud AJAX para obtener los valores de sesión
    $.ajax({

        type: "GET",
        url: "../../Controlador/Utilidades/Notificaciones/Suministro/Notifi_Agregar_Suministro.php",
        dataType: "json",

        success: function(response) {
            
            if (response.hasOwnProperty('productoNombre')) {
                
                // Acceder a los datos recibidos
                var producto = response.productoNombre; //Accede al dato recibido ("VEHICULO PLACA")
                
                // Mostrar los datos en una alerta
                Swal.fire({
                    title: 'Producto: ' + producto ,
                    text: '¡Registrado Correctamente!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1800
                });

                // Mostrar los datos en la consola para verificar
                console.log("El Producto: "+ producto +" Registrado Correctamente");

                // Realizar una nueva solicitud AJAX para ELIMINAR LA SESSION ID
                $.ajax({

                    type: "GET",
                    url: "../../Controlador/Utilidades/Notificaciones/Suministro/POST_Eliminar_productoNombre.php",
                    dataType: "json", // Especificar que esperas una respuesta JSON
                
                    success: function(response) {

                        if (response.hasOwnProperty('idMessage')) {

                            // Acceder al dato 'sesionVehiculo' en la respuesta JSON
                            var idMessage = response.idMessage;
                    
                            // Informar en la consola si se eliminó la sesión correctamente
                            console.log("-> If Mensaje: ", idMessage);

                        } else {

                            // Acceder al dato 'id_delate' en la respuesta JSON
                            var idMessage = response.idMessage;
                    
                            // Informar en la consola si se eliminó la sesión correctamente
                            console.log("-> Else Mensaje: ", idMessage);


                        }    

                    },
                
                    error: function(xhr, status, error) {

                        // Informar en la consola si ocurrió un error al eliminar la sesión
                        console.error("-> AJAX(DELATE_Notifi_Agregar_Suministro.php): ", error);

                    }
                });         

            } else {
                
                // Acceder a los datos recibidos
                var idMessage = response.idMessage; //Accede al dato recibido ("ERROR")

                // Mostrar los datos en la consola para verificar
                console.log("-> Mensaje de [Notifi_Agregar_Suministro.js]:", idMessage);
                                        
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
            console.error("-> AJAX(Notifi_Agregar_Suministro.php):", error);
        }
    });
