<?php

// Iniciamos Sesion para recuperar los Datos
session_start();

// Crear un array para almacenar los datos
$response = array();

// Verificar si la Variable ID existe
if (isset($_SESSION['id'])) {

    // Almacenar los datos de ID en el array "MsjBorrarUsuario"
    $response['delate'] = $_SESSION['id'];

} else {
    
    // Si las variables de sesión no existen o están vacías, enviar un mensaje de error
    $response['error'] = "No existe un dato en la session [id]";

}

// Convertir el array de respuesta a formato JSON y enviarlo de vuelta al cliente
echo json_encode($response);

?>
