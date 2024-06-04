<?php

    // Iniciamos Sesion para recuperar los Datos
    session_start();

    // Crear un array para almacenar los datos de sesión
    $response = array();

    // Verificar si existe la sesión ID y eliminarla si está presente
    if (isset($_SESSION['usuarioUpdate'])) {
        
        // Eliminar la variable de sesión
        unset($_SESSION['usuarioUpdate']); 

        // Respuesta simple para indicar que la sesión se eliminó correctamente
        $response['usuario_delate'] = "¡El Nombre de Usuario de la Tabla HTML se logro eliminar correctamente!";
        
    }else{

        // Respuesta simple para indicar que la sesión se eliminó correctamente
        $response['usuario_delate'] = "¡El Nombre de Usuario de la Tabla HTML no se Logro Eliminar Correctamente!";

    }
    
    echo json_encode($response);
    
?>
