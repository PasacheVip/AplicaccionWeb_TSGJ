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

    <!-- Icono de Pagina -->
    <link rel="icon" href="../../Modelo/Archivos_Media/Color_LogoTipo.png" type="image/png">

    <!-- USO DE ALERTAS PERZONALISADAS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

    <!-- ==== jQuery (Para Solicitudes Ajax)===== -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- ==== BOX-ICONS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="../../Modelo/Archivos_CSS/Gestion_Suministros.css">
    <link rel="stylesheet" href="../../Modelo/Archivos_CSS/Style_table_Gestion.css">

</head>
<body class="Manteni-body">
    <!-- Mostrar el nombre dentro del h2 -->
    <div class="container">
        <h2>Tabla Gestion De Suministros</h2>    
    </div>
    
    <!-- Botón para agregar nuevo usuario -->
    <button role="button" class="button-name" onclick="location.href='Adm_Agregar_Suministros.php'">Registrar Nuevo Suministro +</button>
    <button role="button" class="button-name" onclick="location.href='Adm_Gestion_Suministros.php'">Actualizar</button>

    <!-- Tabla -->
    <div class="table-wrapper"> 
    <table>
        <thead>
            <tr>
                <th style="text-align: center">ID</th>
                <th style="text-align: left">Categoria</th>
                <th style="text-align: left">Unidad de Medida</th>
                <th style="text-align: left">Proveedor</th>
                <th style="text-align: center">Codigo_Producto</th>
                <th style="text-align: left">Nombre Del Producto</th>
                <th style="text-align: right">Precio Referencial</th>
                <th style="text-align: right">Stock Disponible</th>
                <th style="text-align: Center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php

                // Preparamos la consulta SQL

                $sql = "SELECT p.*, 
                c.descripcion AS id_categoria,
                pr.descripcion AS id_presentacion,
                prd.descripcion AS id_proveedor
                FROM producto p 
                INNER JOIN categoria c ON p.id_categoria = c.id
                INNER JOIN presentacion pr ON p.id_presentacion = pr.id
                INNER JOIN proveedor prd ON p.id_proveedor = prd.id";

                // Ejecutamos la consulta SQL
                $result = $conn->executeQuery($sql);

                // Se verificar si la consulta devolvió resultados
                if ($result) {

                    while ($row = $result->fetch_assoc()) {

                        echo "<tr>";
                        echo "<td style='text-align: center;'>" . $row['id_producto'] . "</td>";
                        echo "<td style='text-align: left;'>" . $row['id_categoria'] . "</td>";
                        echo "<td style='text-align: left;'>" . $row['id_presentacion'] . "</td>";
                        echo "<td style='text-align: left;'>" . $row['id_proveedor'] . "</td>";
                        echo "<td style='text-align: center;'>" . $row['codigo'] . "</td>";
                        echo "<td style='text-align: left;'>" . $row['producto'] . "</td>";
                        echo "<td style='text-align: right;'> S/ " . $row['precio'] . ".00 (U/C)  <a href='../../Controlador/Tipo_Cambio/MySQL_TipoDeCambio.php?valor=". $row['precio'] ."'><i class='bx bxs-badge-dollar'></i></a></td>";
                        echo "<td style='text-align: right;'>" . $row['stock_disponible'] . " " . $row['id_presentacion'] . "</td>";
                        echo "<td>
                                <a href='Adm_Editar_Mantenimiento?ID_S=" . $row['id_producto'] . "'><i class='bx bx-edit bx-sm'></i></a>
                                <a href='../../Controlador/Ctrl_Administrador/MySQL_Borrar_Suministro.php?ID_S=" . $row['id_producto'] . "'><i class='bx bx-trash bx-sm'></i></a>
                             </td>";
                        echo "</tr>";
                    }

                } else {

                    echo "<tr><td colspan='6'>¡Actualmente no cuentas con ningun Suministro!</td></tr>";

                }

            ?>

        </tbody>
    </table>

    <!-- ==== ARCHIVO JS - NOTIFIFACION DE AGREGAR SUMINISTRO ===== -->
    <script src="../../Modelo/Archivos_JS/Notificaciones/Suministros/Notifi_Agregar_Suministro.js"></script>

    <!-- ===== ARCHIVO JS - NOTIFIFACION DE EDITAR VEHICULO ===== 
    <script src="../../Modelo/Archivos_JS/Notifi_Editar_Vehiculo.js"></script>-->
    
    <!--===== ARCHIVO JS - NOTIFIFACION DE ELIMINAR SUMINISTRO ===== -->
    <script src="../../Modelo/Archivos_JS/Notificaciones/Suministros/Notifi_Eliminar_Suministro.js"></script>
    
    <!--===== ARCHIVO JS - NOTIFIFACION DE TIPO DE CAMBIO ===== -->
    <script src="../../Modelo/Archivos_JS/Notificaciones/Tipo_Cambio/TipoDeCambio.js"></script>

</body>
</html>