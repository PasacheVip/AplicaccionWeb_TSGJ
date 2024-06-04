<?php

    // Iniciamos Sesion para recuperar los Datos
    session_start();

    // Crear un array para almacenar los datos de sesión
    $response = array();

    // Verificar si existe la sesión ID y eliminarla si está presente
    if (isset($_SESSION['datoplacavehiculo'])) {
        
        // Eliminar la variable de sesión
        unset($_SESSION['datoplacavehiculo']); 

        // Respuesta simple para indicar que la sesión se eliminó correctamente
        $response['vehiculo_delate'] = "¡La Sesión [datoplacavehiculo] se logro eliminar correctamente!";
        
    }else{

        // Respuesta simple para indicar que la sesión nose eliminó correctamente
        $response['error'] = "¡La Sesión [datoplacavehiculo] nose Logro Eliminar Correctamente!";

    }

    
    echo json_encode($response);
    
?>
