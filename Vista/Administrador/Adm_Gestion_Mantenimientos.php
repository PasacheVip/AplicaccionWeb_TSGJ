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
</head>
<body>
    <?php
    // Incluir el archivo de menú de navegación
    $menu_path = '../../General/Adm_Menu_Navegacion.php';
    if (file_exists($menu_path)) {
        include($menu_path);
    } else {
        echo "Errror: No se puede encontrar el archivo de menú de navegación.";
    }
    ?>
    <h1>Gestión de Mantenimientos</h1>
    <a href="Adm_Agregar_Mantenimiento.php">Agregar Mantenimiento</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
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
                    echo "<td>" . $row['nombre'] . "</td>";
                    echo "<td>" . $row['descripcion'] . "</td>";
                    echo "<td>" . $row['fecha'] . "</td>";
                    echo "<td>" . $row['tipo_mantenimiento'] . "</td>";
                    echo "<td><a href='Adm_Editar_Mantenimiento.php?id=" . $row['id_mantenimiento'] . "'>Editar</a> | <a href='MySQL_Borrar_Mantenimiento.php?id=" . $row['id_mantenimiento'] . "'>Eliminar</a></td>";
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