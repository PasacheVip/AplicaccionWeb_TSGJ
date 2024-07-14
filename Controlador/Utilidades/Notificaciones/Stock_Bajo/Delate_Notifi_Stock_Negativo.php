<?php

    // Iniciamos Sesion para recuperar los Datos
    session_start();

    // Crear un array para almacenar los datos de sesión
    $response = array();

    // Verificar si existe la sesión ID y eliminarla si está presente
    if (isset($_SESSION['stock_negativo'])) {
        
        // Eliminar la variable de sesión
        unset($_SESSION['stock_negativo']); 

        // Respuesta simple para indicar que la sesión se eliminó correctamente
        $response['idMessage'] = "¡La Sesión [stock_negativo] se logro eliminar correctamente!";
        
    }else{

        // Respuesta simple para indicar que la sesión se eliminó correctamente
        $response['idMessage'] = "¡La Sesión [stock_negativo] nose Logro Eliminar Correctamente!";

    }

    
    echo json_encode($response);
    
?>
