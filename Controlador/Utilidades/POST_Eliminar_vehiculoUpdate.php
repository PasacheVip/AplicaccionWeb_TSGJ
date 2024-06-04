<?php

    // Iniciamos Sesion para recuperar los Datos
    session_start();

    // Crear un array para almacenar los datos de sesión
    $response = array();

    // Verificar si existe la sesión ID y eliminarla si está presente
    if (isset($_SESSION['vehiculoUpdate'])) {
        
        // Eliminar la variable de sesión
        unset($_SESSION['vehiculoUpdate']); 

        // Respuesta simple para indicar que la sesión se eliminó correctamente
        $response['vehiculo_delate'] = "¡La Variable de la Session [vehiculoUpdate], Eliminada correctamente!";
        
    }else{

        // Respuesta simple para indicar que la sesión se eliminó correctamente
        $response['vehiculo_delate'] = "¡La Variable de la Session [vehiculoUpdate], No Eliminada correctamente!";

    }
    
    echo json_encode($response);
    
?>
