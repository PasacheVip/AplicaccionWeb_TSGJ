<?php

    // Iniciamos Sesion para recuperar los Datos
    session_start();

    // Crear un array para almacenar los datos de sesión
    $response = array();

    // Verificar si existe la sesión ID y eliminarla si está presente
    if (isset($_SESSION['idSuministro'])) {
        
        // Eliminar la variable de sesión
        unset($_SESSION['idSuministro']); 

        // Respuesta simple para indicar que la sesión se eliminó correctamente
        $response['idSuministro'] = "¡La Sesión [idSuministro] se logro eliminar correctamente!";
        
    }else{

        // Respuesta simple para indicar que la sesión nose eliminó correctamente
        $response['error'] = "¡La Sesión [datoplacavehiculo] nose Logro Eliminar Correctamente!";

    }

    
    echo json_encode($response);
    
?>
