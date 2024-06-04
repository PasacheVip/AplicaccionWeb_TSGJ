<?php

// Iniciamos Sesion para recuperar los Datos
session_start();

// Crear un array para almacenar los datos de sesión
$response = array();

// Verificar si las variables de sesión existen y no están vacías
if (isset($_SESSION['usuario']) && isset($_SESSION['id_cargo'])) {

    // Almacenar los datos de sesión en el array de respuesta (RESPONSE)
    $response['usuario'] = $_SESSION['usuario'];
    $response['id_cargo'] = $_SESSION['id_cargo'];

} else {
    
    // Si las variables de sesión no existen o están vacías, enviar un mensaje de error
    $response['error'] = "¡Variables de sesion no encontradas!";

}

// Convertir el array de respuesta a formato JSON y enviarlo de vuelta al cliente
echo json_encode($response);

?>
