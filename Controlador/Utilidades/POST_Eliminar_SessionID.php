<?php

    // Iniciamos Sesion para recuperar los Datos
    session_start();

    // Crear un array para almacenar los datos de sesión
    $response = array();

    // Verificar si existe la sesión ID y eliminarla si está presente
    if (isset($_SESSION['id'])) {
        
        // Eliminar la variable de sesión
        unset($_SESSION['id']); 

        // Respuesta simple para indicar que la sesión se eliminó correctamente
        $response['id_delate'] = "¡La Sesión ID se logro eliminar correctamente!";
        
    }else{

        // Respuesta simple para indicar que la sesión se eliminó correctamente
        $response['id_delate'] = "¡La Sesión ID nose Logro Eliminar Correctamente!";

    }

    
    echo json_encode($response);
    
?>
