<?php
// Se incluye el archivo de conexión a la base de datos
require_once "../../Controlador/Utilidades/Conexion_BD.php";

// Verifica si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Se obtienen los datos del formulario
    $id_tipo_mantenimiento = $_POST['id_tipo_mantenimiento'];
    $descripcion = $_POST['descripcion'];
    
    // Se prepara la consulta SQL para actualizar el tipo de mantenimiento
    $query = "UPDATE tipo_mantenimiento SET descripcion='$descripcion' WHERE id_tipo_mantenimiento='$id_tipo_mantenimiento'";
    
    // Se ejecuta la consulta y se verifica si se ha actualizado correctamente
    if (mysqli_query($conexion, $query)) {
        // Se muestra un mensaje de éxito si la actualización es exitosa
        echo "Tipo de mantenimiento actualizado exitosamente.";
    } else {
        // Si ocurre algún error durante la ejecución de la consulta, se muestra un mensaje de error
        echo "Error al actualizar tipo de mantenimiento: " . mysqli_error($conexion);
    }
}
?>