    
    // Realizar una solicitud AJAX para obtener los valores de sesión
    $.ajax({

        type: "GET",
        url: "../../Controlador/Utilidades/Notifi_Agregar_Vehiculo.php",
        dataType: "json",

        success: function(response) {
            
            if (response.hasOwnProperty('vehiculo')) {
                
                // Acceder a los datos recibidos
                var vehiculomostrar = response.vehiculo; //Accede al dato recibido ("VEHICULO PLACA")
                
                // Mostrar los datos en una alerta
                Swal.fire({
                    title: 'Vehiculo ' + vehiculomostrar ,
                    text: '¡Registrado Correctamente!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1800
                });

                // Mostrar los datos en la consola para verificar
                console.log("Vehiculo Con Placa De Rodaje:: "+ vehiculomostrar +" Registrado Correctamente");

                // Realizar una nueva solicitud AJAX para ELIMINAR LA SESSION ID
                $.ajax({

                    type: "GET",
                    url: "../../Controlador/Utilidades/DELATE_Notifi_Agregar_Vehiculo.php",
                    dataType: "json", // Especificar que esperas una respuesta JSON
                
                    success: function(response) {

                        if (response.hasOwnProperty('sesionVehiculo')) {

                            // Acceder al dato 'sesionVehiculo' en la respuesta JSON
                            var idMessage = response.sesionVehiculo;
                    
                            // Informar en la consola si se eliminó la sesión correctamente
                            console.log("-> If Mensaje: ", idMessage);

                        } else {

                            // Acceder al dato 'id_delate' en la respuesta JSON
                            var idMessage = response.id_delate;
                    
                            // Informar en la consola si se eliminó la sesión correctamente
                            console.log("-> Else Mensaje: ", idMessage);


                        }    

                    },
                
                    error: function(xhr, status, error) {

                        // Informar en la consola si ocurrió un error al eliminar la sesión
                        console.error("-> AJAX(DELATE_Notifi_Agregar_Vehiculo.php): ", error);

                    }
                });         

            } else {
                
                // Acceder a los datos recibidos
                var error = response.error; //Accede al dato recibido ("ERROR")

                // Mostrar los datos en la consola para verificar
                console.log("-> Mensaje de [Notifi_Agregar_Vehiculo.php]::", error);
                                        
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
            console.error("-> AJAX(Notifi_Agregar_Vehiculo.php):", error);
        }
    });
