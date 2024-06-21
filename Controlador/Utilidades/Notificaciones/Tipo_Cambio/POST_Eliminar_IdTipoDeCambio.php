<?php

    // Iniciamos Sesion para recuperar los Datos
    session_start();

    // Crear un array para almacenar los datos de sesión
    $response = array();

    // Verificar si existe la sesión ID y eliminarla si está presente
    if (isset($_SESSION['IdTipoDeCambio'])) {
        
        // Eliminar la variable de sesión
        unset($_SESSION['IdTipoDeCambio']); 

        // Respuesta simple para indicar que la sesión se eliminó correctamente
        $response['IdCorrecto'] = "¡La Sesión [IdTipoDeCambio] se logro eliminar correctamente!";
        
    }else{

        // Respuesta simple para indicar que la sesión nose eliminó correctamente
        $response['IdError'] = "¡La Sesión [idSuministro] nose Logro Eliminar Correctamente!";

    }

    
    echo json_encode($response);
    
?>
