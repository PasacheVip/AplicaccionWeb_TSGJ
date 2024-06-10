<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <title>Editar Mantenimiento</title>
</head>
<body>
    <?php include('Vista\General\Adm_Menu_Navegacion.php'); ?>
    <h1>Editar Mantenimiento</h1>
    <?php
    // Incluir el archivo de conexión a la base de datos
    require_once '../../Controlador/Utilidades/Conexion_BD.php';
    
    // Verificar si se ha proporcionado el parámetro 'id' a través de la URL
    if (isset($_GET['id'])) {
        // Obtener el ID del mantenimiento a editar desde la URL
        $id_mantenimiento = $_GET['id'];
        
        // Ejecutar una consulta SQL para obtener los detalles del mantenimiento con el ID proporcionado
        $result = mysqli_query($conexion, "SELECT * FROM mantenimientos WHERE id_mantenimiento='$id_mantenimiento'");
        
        // Verificar si se encontró el mantenimiento
        if (mysqli_num_rows($result) > 0) {
            // Obtener los detalles del mantenimiento
            $row = mysqli_fetch_assoc($result);
    ?>
    <!-- Formulario para editar el mantenimiento -->
    <form action="controladores/MySQL_Editar_Mantenimiento.php" method="POST">
        <!-- Campo oculto para almacenar el ID del mantenimiento -->
        <input type="hidden" name="id_mantenimiento" value="<?php echo $row['id_mantenimiento']; ?>">
        <!-- Campo para editar el nombre del mantenimiento -->
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required>
        <!-- Campo para editar la descripción del mantenimiento -->
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" value="<?php echo $row['descripcion']; ?>" required>
        <!-- Campo para editar la fecha del mantenimiento -->
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" value="<?php echo $row['fecha']; ?>" required>
        <!-- Campo para seleccionar el tipo de mantenimiento -->
        <label for="tipo_mantenimiento">Tipo de Mantenimiento:</label>
        <select id="tipo_mantenimiento" name="tipo_mantenimiento" required>
            <?php
            // Ejecutar una consulta SQL para obtener todos los tipos de mantenimiento disponibles
            $result_tipos = mysqli_query($conexion, "SELECT * FROM tipo_mantenimiento");
            
            // Recorrer los resultados y generar las opciones del select
            while ($row_tipos = mysqli_fetch_assoc($result_tipos)) {
                // Verificar si el tipo de mantenimiento es el seleccionado actualmente
                $selected = ($row_tipos['id_tipo_mantenimiento'] == $row['tipo_mantenimiento']) ? 'selected' : '';
                // Generar la opción del select con el ID y la descripción del tipo de mantenimiento
                echo "<option value='" . $row_tipos['id_tipo_mantenimiento'] . "' $selected>" . $row_tipos['descripcion'] . "</option>";
            }
            ?>
        </select>
        <!-- Botón de envío para actualizar el mantenimiento -->
        <input type="submit" value="Actualizar">
    </form>
    <?php
        } else {
            // Si el mantenimiento no se encuentra, mostrar un mensaje de error
            echo "Mantenimiento no encontrado.";
        }
    }
    ?>
</body>
</html>