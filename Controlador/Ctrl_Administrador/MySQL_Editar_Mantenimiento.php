<?php
// Se incluye el archivo de conexión a la base de datos
require_once "../../Controlador/Utilidades/Conexion_BD.php";

// Verifica si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Se obtienen los datos del formulario
    $id_mantenimiento = $_POST['id_mantenimiento'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];
    $tipo_mantenimiento = $_POST['tipo_mantenimiento'];

    // Se prepara la consulta SQL para actualizar el mantenimiento
    $sql = "UPDATE mantenimientos SET nombre='$nombre', descripcion='$descripcion', fecha='$fecha', tipo_mantenimiento='$tipo_mantenimiento' WHERE id_mantenimiento='$id_mantenimiento'";

    // Se ejecuta la consulta y se verifica si se ha actualizado correctamente
    if (mysqli_query($conexion, $sql)) {
        // Se muestra un mensaje de éxito si la actualización es exitosa
        echo "Mantenimiento actualizado correctamente.";
    } else {
        // Si ocurre algún error durante la ejecución de la consulta, se muestra un mensaje de error
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }

    // Se cierra la conexión a la base de datos
    mysqli_close($conexion);
}
?>