<?php

// Incluir OBLIGATORIAMENTE el Archivo CONEXION BADE DE DATOS
require_once '../../Controlador/Utilidades/Conexion_BD.php';
// Incluir OBLIGATORIAMENTE el Archivo Controlador para Mostrar Usuarios
require_once '../../Controlador/Ctrl_Administrador/MySQL_Mostrar_Vehiculos.php';

// Crear una instancia de la clase Database
$conn = new Conexion_BD();

// Crear una instancia de Database pasándole la instancia de Conexion_BD
$MostrarVehiculos = new MostrarVehiculos($conn);

// Obtener todos los usuarios
$vehiculos = $MostrarVehiculos->ObtenerTodosLosVehiculos();

// Cerrar la conexión a la base de datos
$conn->closeConnection();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSGJ - Tabla de vehiculos</title>

    <!-- Icono de Pagina -->
    <link rel="icon" href="../../Modelo/Archivos_Media/Color_LogoTipo.png" type="image/png">

    <!-- USO DE ALERTAS PERZONALISADAS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

    <!-- ==== jQuery (Para Solicitudes Ajax)===== -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- ==== BOX-ICONS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="../../Modelo/Archivos_CSS/Gestion_Vehiculos.css">
    <link rel="stylesheet" href="../../Modelo/Archivos_CSS/Style_table_Gestion.css">

</head>

<body>

    <!-- MENU DE NAVEGACION -->

    <?php
    require_once("../General/Menu_Navegacion.php");
    ?>

    <div id="iframe-container">

        <!-- Mostrar el nombre dentro del h2 -->
        <div class="container">
            <h2>Tabla Gestion de Veh&iacute;culos</h2>
        </div>

        <!-- Botón para agregar Nuevo Vehiculo y eliminar vehiculo -->
        <div class="button-borders">
            <button role="button" class="button-name" onclick="location.href='Adm_Formulario_Flota.php'">Agregar Nuevo Veh&iacute;culo+</button>
            <button role="button" class="button-name" onclick="location.href='Adm_Gestion_Vehicular.php'">Actualizar</button>
        </div>

        <!-- Tabla -->
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Placa</th>
                        <th>Año de Fabricaci&oacute;n</th>
                        <th style="text-align: left">Marca</th>
                        <th style="text-align: left">Modelo</th>
                        <th style="text-align: left">Tipo de veh&iacute;culo</th>
                        <th style="text-align: left">Tipo de Combustible</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Mostrar los datos de la tabla usuarios en la tabla HTML
                    foreach ($vehiculos as $vehiculo) {
                        echo "<tr>";
                        echo "<td>" . $vehiculo["id"] . "</td>";
                        echo "<td>" . $vehiculo["placa"] . "</td>";
                        echo "<td>" . $vehiculo["ano_fabricacion"] . "</td>";
                        echo "<td style='text-align: left;'>" . $vehiculo["marca"] . "</td>";
                        echo "<td style='text-align: left;'>" . $vehiculo["modelo"] . "</td>";
                        echo "<td style='text-align: left;'>" . $vehiculo["tipo_vehiculo"] . "</td>";
                        echo "<td style='text-align: left;'>" . $vehiculo["tipo_combustible"] . "</td>";
                        echo "<td>
                            <a href='Adm_Editar_Vehiculo.php?IV=" . $vehiculo["id"] . "'><i class='bx bx-edit bx-sm'></i><!-- Editar Linea --></a>
                            <a href='../../Controlador/Ctrl_Administrador/MySQL_Borrar_Vehiculo.php?IPV=" . $vehiculo["placa"] . "'><i class='bx bx-trash bx-sm'></i></a>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!--===== ARCHIVO JS - NOTIFIFACION DE AGREGAR VEHICULO ===== -->
    <script src="../../Modelo/Archivos_JS/Notifi_Agregar_Vehiculo.js"></script>

    <!--===== ARCHIVO JS - NOTIFIFACION DE EDITAR VEHICULO ===== -->
    <script src="../../Modelo/Archivos_JS/Notifi_Editar_Vehiculo.js"></script>

    <!--===== ARCHIVO JS - NOTIFIFACION DE ELIMINAR VEHICULO ===== -->
    <script src="../../Modelo/Archivos_JS/Notifi_Eliminar_Vehiculo.js"></script>

</body>

</html>