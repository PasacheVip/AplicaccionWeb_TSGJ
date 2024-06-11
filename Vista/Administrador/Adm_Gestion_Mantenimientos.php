<?php
    // Iniciar la sesión si no está iniciada
    session_start();

    // Incluir el archivo de conexión a la base de datos
    require_once '../../Controlador/Utilidades/Conexion_BD.php';

    // Crear una instancia de la clase Conexion_BD
    $conn = new Conexion_BD();
?>

<?php
    // Iniciar la sesión si no está iniciada
    session_start();

    // Incluir el archivo de conexión a la base de datos
    require_once '../../Controlador/Utilidades/Conexion_BD.php';

    // Crear una instancia de la clase Conexion_BD
    $conn = new Conexion_BD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Mantenimientos</title>
    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="../../Modelo/Archivos_CSS/Gestion_Mantenimiento.css">
</head>
<body class="Manteni-body">
    <h1 class="Manteni-h1">Gestión de Mantenimientos</h1>
    <a href="Adm_Agregar_Mantenimiento.php" class="Manteni-a">Agregar Mantenimiento</a>
    <table class="Manteni-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Responsable</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Tipo de Mantenimiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Se ejecuta la consulta utilizando el método executeQuery de la clase Conexion_BD
            $result = $conn->executeQuery("SELECT * FROM Mantenimientos");

            // Se verificar si la consulta devolvió resultados
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id_mantenimiento'] . "</td>";
                    echo "<td>" . $row['encargado'] . "</td>";
                    echo "<td>" . $row['descripcion'] . "</td>";
                    echo "<td>" . $row['fecha'] . "</td>";
                    echo "<td>" . $row['tipo_mantenimiento'] . "</td>";
                    echo "<td><a href='Adm_Editar_Mantenimiento.php?id=" . $row['id_mantenimiento'] . "' class='Manteni-a'>Editar</a> | <a href='MySQL_Borrar_Mantenimiento.php?id=" . $row['id_mantenimiento'] . "' class='Manteni-a'>Eliminar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No se encontraron registros</td></tr>";
            }

            // Se cierra la conexión a la base de datos
            $conn->closeConnection();
            ?>
        </tbody>
    </table>
</body>
</html>