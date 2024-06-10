<?php
// Se incluye el archivo de conexión a la base de datos
require_once "../../Controlador/Utilidades/Conexion_BD.php";

// Verifica si se ha proporcionado un parámetro 'id' a través de la URL (GET)
if (isset($_GET['id'])) {
    // Se obtiene el ID del mantenimiento a eliminar desde la URL
    $id_mantenimiento = $_GET['id'];

    // Se prepara la consulta SQL para eliminar el mantenimiento correspondiente
    $sql = "DELETE FROM mantenimientos WHERE id_mantenimiento='$id_mantenimiento'";

    // Se ejecuta la consulta y se verifica si se ha eliminado correctamente
    if (mysqli_query($conexion, $sql)) {
        // Se muestra un mensaje de éxito si la eliminación es exitosa
        echo "Mantenimiento eliminado correctamente.";
    } else {
        // Si ocurre algún error durante la ejecución de la consulta, se muestra un mensaje de error
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }

    // Se cierra la conexión a la base de datos
    mysqli_close($conexion);
}
?>