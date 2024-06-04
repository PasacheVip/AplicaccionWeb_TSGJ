<?php

    // Iniciamos Sesion para recuperar los Datos
    session_start();

    // Crear un array para almacenar los datos de sesión
    $response = array();

    // Verificar si existe la sesión ID y eliminarla si está presente
    if (isset($_SESSION['vehiculoPlaca'])) {
        
        // Eliminar la variable de sesión
        unset($_SESSION['vehiculoPlaca']); 

        // Respuesta simple para indicar que la sesión se eliminó correctamente
        $response['sesionVehiculo'] = "¡La Sesión [vehiculoPlaca] se logro eliminar correctamente!";
        
    }else{

        // Respuesta simple para indicar que la sesión se eliminó correctamente
        $response['id_delate'] = "¡La Sesión [vehiculoPlaca] nose Logro Eliminar Correctamente!";

    }

    
    echo json_encode($response);
    
?>
