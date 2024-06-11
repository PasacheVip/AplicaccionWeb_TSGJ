<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Mantenimiento</title>
    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="../../Modelo/Archivos_CSS/Gestion_Mantenimiento.css">
</head>
<body>
    <?php

    // Se incluye el archivo de conexión a la base de datos
    require_once '../../Controlador/Utilidades/Conexion_BD.php';

    // Crear una instancia de la clase "Conexion_BD"
    $conn = new Conexion_BD();

    // Verificar si la conexión se estableció correctamente
    if (!$conn) {
        echo "Error: No se pudo conectar a la base de datos.";
    } else {
        // Consulta SQL para obtener los tipos de mantenimiento
        $sql = "SELECT id_tipo_mantenimiento, descripcion FROM tipo_mantenimiento";
        $result= $conn->executeQuery($sql);
    }
    ?>
    
    <h1>Agregar Mantenimiento</h1>

    <form action="../../Controlador\Ctrl_Administrador\MySQL_Agregar_Mantenimiento.php" method="POST">
        <label for="nombre">Encargado Del Mantenimiento:</label>
        <input type="text" id="encargado" name="encargado" required>
        
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" required>
        
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required>
        
        <label for="tipo_mantenimiento">Tipo de Mantenimiento:</label>
        <select id="tipo_mantenimiento" name="tipo_mantenimiento">
            <option value="">Seleccione un tipo</option> <!-- Opción por defecto para seleccionar -->
            <?php
            // Verificar si la consulta fue exitosa y si hay al menos un tipo de mantenimiento registrado
            if ($result && mysqli_num_rows($result) > 0) {
                // Recorrer los resultados y generar las opciones del select
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['id_tipo_mantenimiento'] . "'>" . $row['descripcion'] . "</option>";
                }
            } else {
                echo "<option value=''>No hay tipos de mantenimiento disponibles</option>";
            }
            ?>
        </select>
        
        <input type="submit" value="Agregar">
        <button type="button" onclick="location.href='index.php'">Cancelar</button>
    </form>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
if ($conn) {
    // Cerrar conexión
    $conn->closeConnection();
}
?>