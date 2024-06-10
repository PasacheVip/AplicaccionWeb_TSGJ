<?php
// Se incluye el archivo de conexión a la base de datos
require_once "../../Controlador/Utilidades/Conexion_BD.php";

// Verifica si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Se obtiene la descripción del tipo de mantenimiento desde el formulario
    $descripcion = $_POST['descripcion'];
    
    // Se prepara la consulta SQL para insertar un nuevo tipo de mantenimiento
    $query = "INSERT INTO tipo_mantenimiento (descripcion) VALUES ('$descripcion')";
    
    // Se ejecuta la consulta y se verifica si se ha insertado correctamente
    if (mysqli_query($conexion, $query)) {
        // Se muestra un mensaje de éxito si la inserción es exitosa
        echo "Tipo de mantenimiento agregado exitosamente.";
    } else {
        // Si ocurre un error durante la ejecución de la consulta, se muestra un mensaje de error
        echo "Error al agregar tipo de mantenimiento: " . mysqli_error($conexion);
    }
}
?>