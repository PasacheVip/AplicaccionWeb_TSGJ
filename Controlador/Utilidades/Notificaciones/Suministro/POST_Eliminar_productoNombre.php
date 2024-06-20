<?php

    // Iniciamos Sesion para recuperar los Datos
    session_start();

    // Crear un array para almacenar los datos de sesión
    $response = array();

    // Verificar si existe la sesión ID y eliminarla si está presente
    if (isset($_SESSION['productoNombre'])) {
        
        // Eliminar la variable de sesión
        unset($_SESSION['productoNombre']); 

        // Respuesta simple para indicar que la sesión se eliminó correctamente
        $response['idMessage'] = "¡La Sesión [productoNombre] se logro eliminar correctamente!";
        
    }else{

        // Respuesta simple para indicar que la sesión se eliminó correctamente
        $response['idMessage'] = "¡La Sesión [productoNombre] nose Logro Eliminar Correctamente!";

    }

    
    echo json_encode($response);
    
?>
