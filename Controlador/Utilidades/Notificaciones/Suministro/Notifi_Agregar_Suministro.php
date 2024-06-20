<?php

    // Iniciamos Sesion para recuperar los Datos
    session_start();

    // Crear un array para almacenar los datos
    $response = array();

    // Verificar si la Variable usuarioUpdate existe
    if (isset($_SESSION['productoNombre'])) {

        // Obtenemos los datos de la session "vehiculoPlaca"
        $response['productoNombre'] = $_SESSION['productoNombre'];

    } else {
        
        // Si las variables de sesión no existen o están vacías, enviar un mensaje de error
        $response['idMessage'] = "No existe un dato en la session [productoNombre]";

    }

    // Convertir el array de respuesta a formato JSON y enviarlo de vuelta al cliente
    echo json_encode($response);

?>
