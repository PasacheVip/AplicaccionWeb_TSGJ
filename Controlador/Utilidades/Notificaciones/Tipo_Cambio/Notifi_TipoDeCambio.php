<?php

    // Iniciamos Sesion para recuperar los Datos
    session_start();

    // Crear un array para almacenar los datos
    $response = array();

    // Verificar si existe un valor en la session
    if (isset($_SESSION['IdTipoDeCambio'])) {

        // Almacenar los datos de PLACA en el array "response"
        $response['IdCorrecto'] = $_SESSION['IdTipoDeCambio'];

    } else {
        
        // Si las variables de sesión no existen o están vacías, enviar un mensaje de error
        $response['IdError'] = "No existe un dato en la session [idSuministro]";

    }

    // Convertir el array de respuesta a formato JSON y enviarlo de vuelta al cliente
    echo json_encode($response);

?>
