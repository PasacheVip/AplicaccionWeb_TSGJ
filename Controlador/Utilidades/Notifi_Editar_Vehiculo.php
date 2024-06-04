<?php

// Iniciamos Sesion para recuperar los Datos
session_start();

// Crear un array para almacenar los datos
$response = array();

// Verificar si existe un valor en la session
if (isset($_SESSION['vehiculoUpdate'])) {

    // Almacenar los datos de PLACA en el array "response"
    $response['UpdateVehiculo'] = $_SESSION['vehiculoUpdate'];

} else {
    
    // Si las variables de sesión no existen o están vacías, enviar un mensaje de error
    $response['error'] = "No existe un dato en la session [vehiculoUpdate]";

}

// Convertir el array de respuesta a formato JSON y enviarlo de vuelta al cliente
echo json_encode($response);

?>
