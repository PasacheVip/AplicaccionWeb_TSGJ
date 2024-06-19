<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSGJ - Agregar Mantenimientos</title>

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="../../Modelo/Archivos_CSS/Style_ForMantenimiento.css">

</head>
<body>
    <?php

        // Se incluye el archivo de conexión a la base de datos
        require_once '../../Controlador/Utilidades/Conexion_BD.php';

        // Crear una instancia de la clase "Conexion_BD"
        $conn = new Conexion_BD();

        // CONSULTA PARA OBTENER LOS TIPOS DE MANTENIMIENTOS, DE LA BASE DE DATOS
        $sqlTipoMantenimiento = "SELECT * FROM tipo_mantenimiento ORDER BY id";
        $dataTipoMantenimientoSelect = $conn->executeQuery($sqlTipoMantenimiento);

        // CONSULTA PARA OBTENER LOS TIPOS DE MANTENIMIENTOS, DE LA BASE DE DATOS
        $sqlFlotaVehiculos = "SELECT * FROM vehiculos ORDER BY id";
        $dataFlotaVehiculosSelect = $conn->executeQuery($sqlFlotaVehiculos);

    ?>
    
    <form action="../../Controlador\Ctrl_Administrador\MySQL_Agregar_Mantenimiento.php" method="POST">
        
        <label for="flotaVehiculo">Vehiculo Mantenimiento:</label>
        <select id="flotaVehiculo" name="flotaVehiculo">
            <option value="">Seleccione un Vehiculo</option> <!-- Opción por defecto para seleccionar -->
            <?php
                while ($dataSelect = mysqli_fetch_array($dataFlotaVehiculosSelect)) { ?>
                  <option value="<?php echo $dataSelect["id"]; ?>">
                    <?php echo utf8_encode($dataSelect["placa"]); ?>
                  </option>
              <?php } ?>
        </select>

        <label for="nombre">Encargado Del Mantenimiento:</label>
        <input type="text" id="encargado" name="encargado" onkeyup="convertirAMayusculas(this)" required>
        
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" onkeyup="convertirAMayusculas(this)" required>
        
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required>
        
        <label for="tipo_mantenimiento">Tipo de Mantenimiento:</label>
        <select id="tipo_mantenimiento" name="tipo_mantenimiento">
            <option value="">Seleccione un tipo</option> <!-- Opción por defecto para seleccionar -->
            <?php
                while ($dataSelect = mysqli_fetch_array($dataTipoMantenimientoSelect)) { ?>
                  <option value="<?php echo $dataSelect["id"]; ?>">
                    <?php echo utf8_encode($dataSelect["descripcion"]); ?>
                  </option>
              <?php } ?>
        </select>
        
        <input type="submit" value="Agregar">
        <input type="reset" value="Borrar Registros">
        <button type="button" onclick="location.href='Adm_Gestion_Mantenimientos.php'">Regresar</button>

    </form>

    <!--===== ARCHIVO JS - VALIDACION DE ESCRIBIR =====-->
    <script src="../../Modelo/Archivos_JS/Validacion_Escribir.js"></script>

</body>
</html>