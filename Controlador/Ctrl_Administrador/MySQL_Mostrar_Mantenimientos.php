<?php 
// Se incluye el archivo de conexión a la base de datos
require_once "../../Controlador/Utilidades/Conexion_BD.php";

// Se prepara la consulta SQL para seleccionar todos los registros de la tabla "mantenimientos"
$query = "SELECT * FROM mantenimientos";

// Se ejecuta la consulta
$result = mysqli_query($conexion, $query);

// Se inicializa un array para almacenar los resultados
$mantenimientos = array();

// Se recorren los resultados y se almacenan en el array $mantenimientos
while ($row = mysqli_fetch_assoc($result)) {
    $mantenimientos[] = $row;
}

// Se convierte el array $mantenimientos a formato JSON y se imprime
echo json_encode($mantenimientos);
?>