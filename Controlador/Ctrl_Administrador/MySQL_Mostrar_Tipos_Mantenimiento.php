<?php
// Se incluye el archivo de conexión a la base de datos
require_once '../../Controlador/Utilidades/Conexion_BD.php';

// Consulta SQL para obtener los tipos de mantenimiento
$query = "SELECT id_tipo_mantenimiento, descripcion FROM tipo_mantenimiento";

// Ejecutar la consulta
$result = mysqli_query($conexion, $query);

// Verificar si la consulta fue exitosa y si hay al menos un tipo de mantenimiento registrado
if ($result && mysqli_num_rows($result) > 0) {
    // Inicializar un array para almacenar los tipos de mantenimiento
    $tipos_mantenimiento = array();

    // Recorrer los resultados y almacenarlos en el array
    while ($row = mysqli_fetch_assoc($result)) {
        $tipos_mantenimiento[] = $row;
    }

    // Convertir el array $tipos_mantenimiento a formato JSON y mostrarlo
    echo json_encode($tipos_mantenimiento);
} else {
    echo "No se encontraron tipos de mantenimiento registrados.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>