<?php

    // Iniciamos Sesion para recuperar los Datos
    session_start();

    // Crear un array para almacenar los datos de sesión
    $response = array();

    // Verificar si existe la sesión ID y eliminarla si está presente
    if (isset($_SESSION['Producto'])) {
        
        // Eliminar la variable de sesión
        unset($_SESSION['Producto']); 

        // Respuesta simple para indicar que la sesión se eliminó correctamente
        $response['Producto'] = "¡La Sesión [Producto] se logro eliminar correctamente!";
        
    }else{

        // Respuesta simple para indicar que la sesión nose eliminó correctamente
        $response['error'] = "¡La Sesión [Producto] nose Logro Eliminar Correctamente!";

    }

    
    echo json_encode($response);
    
?>
