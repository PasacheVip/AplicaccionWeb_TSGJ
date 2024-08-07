<?php

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

    <!-- MENU DE NAVEGACION -->

    <?php
    require_once("../General/Menu_Navegacion.php");
    ?>

    <div id="iframe-container">

        <!-- Mostrar el nombre dentro del h2 -->
        <div class="container">
            <h2>Tabla Gestion De Mantenimientos</h2>
        </div>

        <!-- Botón para agregar nuevo usuario -->
        <button role="button" class="button-name" onclick="location.href='Adm_Agregar_Mantenimiento.php'">Registrar Nuevo Mantenimiento +</button>
        <button role="button" class="button-name" onclick="location.href='Adm_Gestion_Mantenimientos.php'">Actualizar</button>

        <!-- Tabla -->
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th style="text-align: center">ID</th>
                        <th style="text-align: center">Productos</th>
                        <th style="text-align: center">Vehiculo</th>
                        <th style="text-align: left">Responsable del Mantenimiento</th>
                        <th style="text-align: left">Descripción del Mantenimiento</th>
                        <th>Fecha</th>
                        <th>Tipo de Mantenimiento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    // Preparamos la consulta SQL

                    $sql = "SELECT m.*, tm.descripcion AS tipo_mantenimiento, v.placa AS id_vehiculo 
                FROM mantenimientos m 
                INNER JOIN tipo_mantenimiento tm ON m.tipo_mantenimiento = tm.id
                INNER JOIN vehiculos v ON m.id_vehiculo = v.id";

                    // Ejecutamos la consulta SQL
                    $result = $conn->executeQuery($sql);

                    if ($result && $result->num_rows > 0) {

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td style='text-align: center;'>" . $row['id_mantenimiento'] . "</td>";
                            echo "<td style='text-align: center;'><a href='Adm_Gestion_Productos.php?IDP=" . $row['id_mantenimiento'] . "' style:'text-decoration: none;'>Visualizar</a></td>";
                            echo "<td style='text-align: center;'>" . $row['id_vehiculo'] . "</td>";
                            echo "<td style='text-align: left;'>" . $row['encargado'] . "</td>";
                            echo "<td style='text-align: left;'>" . $row['descripcion'] . "</td>";
                            echo "<td>" . $row['fecha'] . "</td>";
                            echo "<td>" . $row['tipo_mantenimiento'] . "</td>";
                            echo "<td>
                                <a href='Adm_Editar_Mantenimiento.php?IDM=" . $row['id_mantenimiento'] . "'><i class='bx bx-edit bx-sm'></i></a>
                                <a href='#' onclick='confirmarEliminacion(" . $row['id_mantenimiento'] . ")'><i class='bx bx-trash bx-sm'></i></a>
                             </td>";
                            echo "</tr>";
                        }
                    } else {

                        echo "<tr><td colspan='8'>No se encontraron registros</td></tr>";
                    }

                    // Se cierra la conexión a la base de datos
                    $conn->closeConnection();

                    ?>

                </tbody>
            </table>

        </div>

        <!-- ==== ARCHIVO JS - CONFIRMACION PARA LA ELIMINACION DEL MANTENIMIENTO ===== -->
        <script src="../../Modelo/Archivos_JS/Gestion_Mantenimientos/Eliminar_Mantenimiento.js"></script>

        <!-- ==== NOTIFICACION DE USO GENERAL (SUCCES-ERROR) ===== -->
        <?php require_once '../../Modelo/Archivos_JS/Notificaciones/Succes_Error/notification.php'; ?>

</body>

</html>