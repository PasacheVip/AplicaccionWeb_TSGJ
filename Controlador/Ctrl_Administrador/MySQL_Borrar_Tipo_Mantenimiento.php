<?php
// Se incluye el archivo de conexión a la base de datos
require_once "../../Controlador/Utilidades/Conexion_BD.php";

// Verifica si se ha proporcionado un parámetro 'id' a través de la URL (GET)
if (isset($_GET['id'])) {
    // Se obtiene el ID del tipo de mantenimiento a eliminar desde la URL
    $id_tipo_mantenimiento = $_GET['id'];
    
    // Se prepara la consulta SQL para eliminar el tipo de mantenimiento correspondiente
    $query = "DELETE FROM tipo_mantenimiento WHERE id_tipo_mantenimiento='$id_tipo_mantenimiento'";
    
    // Se ejecuta la consulta y se verifica si se ha eliminado correctamente
    if (mysqli_query($conexion, $query)) {
        // Se muestra un mensaje de éxito si la eliminación es exitosa
        echo "Tipo de mantenimiento eliminado exitosamente.";
    } else {
        // Si ocurre algún error durante la ejecución de la consulta, se muestra un mensaje de error
        echo "Error al eliminar tipo de mantenimiento: " . mysqli_error($conexion);
    }
}
?>