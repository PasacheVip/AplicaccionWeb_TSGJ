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
    <title>Gestión de Producto Utilizados</title>

    <!-- Icono de Pagina -->
    <link rel="icon" href="../../Modelo/Archivos_Media/Color_LogoTipo.png" type="image/png">

    <!-- USO DE ALERTAS PERZONALISADAS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

    <!-- ==== jQuery (Para Solicitudes Ajax)===== -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- ==== BOX-ICONS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="../../Modelo/Archivos_CSS/Gestion_Mantenimiento.css">
    <link rel="stylesheet" href="../../Modelo/Archivos_CSS/Style_table_Gestion.css">

</head>

<body class="Manteni-body">

    <!-- Mostrar el nombre dentro del h2 -->
    <div class="container">
        <h2>Productos Utilizados en el Mantenimiento:</h2> <!--  agregar algun dato -->
    </div>

    <!-- Botón para agregar nuevo usuario -->
    <button role="button" class="button-name" onclick="location.href='Adm_Gestion_Mantenimientos.php'">Regresar</button>
    <button role="button" class="button-name" onclick="location.href='Adm_Gestion_Productos.php'">Actualizar</button>

    <!-- Tablas -->
    <div class="table-wrapper">

        <!-- TABLA MANTENIMIENTO -->
        <table>
            <thead>
                <tr>
                    <th style="text-align: center">ID</th>
                    <th style="text-align: left">Mantenimiento Realizado</th>
                </tr>
            </thead>
            <tbody>
                <?php

                // Verificar si se proporcionó un ID correcto de Mantenimiento
                if (isset($_GET['IDP']) && !empty($_GET['IDP'])) {

                    // Obtener el ID del MANTENIMIENTO de usuario de la URL
                    $idMantenimiento = $_GET['IDP'];

                    // Preparamos la consulta SQL
                    $sql = "SELECT * FROM mantenimientos WHERE id_mantenimiento = ?";

                    // Preparar la consulta
                    $stmt = $conn->prepareStatement($sql);

                    // Vincular parámetros y ejecutar la consulta
                    $stmt->bind_param("i", $idMantenimiento);
                    $stmt->execute();

                    // Obtener el resultado de la consulta
                    $result = $stmt->get_result();

                    // Se verificar si la consulta devolvió resultados
                    if ($result->num_rows > 0) {

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td style='text-align: center;'>" . $row['id_mantenimiento'] . "</td>";
                            echo "<td style='text-align: left;'>" . $row['descripcion'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr>";
                        echo "<td colspan='6'>No se seleccionó un registro de Mantenimiento</td>";
                        echo "</tr>";
                    }

                    // Cerrar la declaración
                    $stmt->close();
                } else {
                    // Redireccionar a la página de gestión de usuarios
                    header("Location: ../../Vista/Administrador/Adm_Gestion_Mantenimientos.php");
                    exit();
                }

                ?>

            </tbody>
        </table>

        <!-- TABLA PRODUCTO -->
        <table>
            <thead>
                <tr>
                    <th style="text-align: center">ID</th>
                    <th style="text-align: left">Productos</th>
                    <th style="text-align: center">Cantidad</th>
                    <th style="text-align: center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php

                // Preparamos la consulta SQL

                $sql = "SELECT r.*,  p.producto AS productos
                    FROM requerimientos r
                    INNER JOIN producto p ON r.id_producto = p.id_producto
                    WHERE id_mantenimiento = ?";

                // Preparar la consulta
                $stmt = $conn->prepareStatement($sql);

                // Vincular parámetros y ejecutar la consulta
                $stmt->bind_param("i", $idMantenimiento);
                $stmt->execute();

                // Obtener el resultado de la consulta
                $result = $stmt->get_result();

                // Se verificar si la consulta devolvió resultados
                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td style='text-align: center;'>" . $row['id'] . "</td>";
                        echo "<td style='text-align: left;'>" . $row['productos'] . "</td>";
                        echo "<td class='cantidad' data-id='" . $row['id'] . "' style='text-align: center;'>" . $row['cantidad'] . "</td>";
                        echo "<td>
                                        <a href='#' onclick='editarCantidad(" . $row['id'] . ", " . $row['cantidad'] . ")'><i class='bx bx-edit bx-sm'></i></a>
                                    </td>";
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
    </div>


    <!-- ==== ARCHIVO JS - NOTIFIFACION DE AGREGAR SUMINISTRO ===== -->
    <script src="../../Modelo/Archivos_JS/Editar_Productos/Editar.js"></script>

</body>

</html>