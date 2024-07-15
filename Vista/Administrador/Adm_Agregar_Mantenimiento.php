<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSGJ - Agregar Mantenimientos</title>

    <!-- Icono de Pagina -->
    <link rel="icon" href="../../Modelo/Archivos_Media/Color_LogoTipo.png" type="image/png">

    <!-- USO DE ALERTAS PERZONALISADAS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

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

        // CONSULTA PARA OBTENER LOS TIPOS DE MANTENIMIENTOS, DE LA BASE DE DATOS
        $sqlProducto = "SELECT * FROM producto ORDER BY id_producto";
        $dataProductoSelect = $conn->executeQuery($sqlProducto);

    ?>
    
    <form action="../../Controlador\Ctrl_Administrador\MySQL_Agregar_Mantenimiento.php" method="POST" id="Agregar_Mantenimiento" novalidate>
        
        <!-- ===== SELECCIONAR VEHICULO ===== -->
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
        
        <!-- ===== ENCARGADO DEL MANTENIMIENTO ===== -->
        <label for="nombre">Encargado Del Mantenimiento:</label>
        <input type="text" id="encargado" name="encargado" onkeyup="convertirAMayusculas(this)" required>
        
        <!-- ===== DESCRIPCION DEL MANTENIMIENTO ===== -->
        <label for="descripcion">Descripción Del Mantenimiento</label>
        <input type="text" id="descripcion" name="descripcion" onkeyup="convertirAMayusculas(this)" required>
        
        <!-- ===== SELECCIONAR PRODUCTOS ===== -->
        <label for="productos">Productos a Utilizar:</label>
        <select id="produtos" name="produtos">
            <option value="">Seleccione un Producto</option> <!-- Opción por defecto para seleccionar -->
            <?php
                while ($dataSelect = mysqli_fetch_array($dataProductoSelect)) { ?>
                  <option value="<?php echo $dataSelect["id_producto"]; ?>">
                    <?php echo utf8_encode($dataSelect["producto"]); ?>
                  </option>
              <?php } ?>
        </select>

        <button type="button" onclick="agregarProducto()" style="margin-top: 2px;">Agregar Producto</button>
        
        <!-- ===== PRODUCTOS SELECCIONADOS ===== -->
        <label style="margin-top: 20px;" for="productosSeleccionados">Productos Seleccionados:</label>
        <ul id="productosSeleccionados">
            <!-- Aquí se mostrarán los productos seleccionados -->
        </ul>

        <!-- Campos ocultos para enviar productos seleccionados al servidor -->
        <div id="productosSeleccionadosInputs"></div>
    
        <!-- ===== FECHA DEL MANTIMIENTO ===== -->
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha">
        
        <!-- ===== TIPO DE MANTEMINIENTO ===== -->
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
            
        <!-- ===== BOTONES ===== -->
        <input type="submit" value="Agregar">
        <input type="reset" value="Borrar Registros">
        <button type="button" onclick="location.href='Adm_Gestion_Mantenimientos.php'">Regresar</button>

    </form>

    <!--===== ARCHIVO JS - VALIDACION DEL FORMULARIO =====-->
    <script src="../../Modelo/Archivos_JS/Validaciones/Form_Agregar_Mantenimiento.js"></script>

    <!-- ===== ARCHIVO JS - VALIDACION DE ESCRIBIR ===== -->
    <script src="../../Modelo/Archivos_JS/Validacion_Escribir.js"></script>

    <!-- ===== ARCHIVO JS - MANEJO DE PRODUCTOS SELECCIONADOS ===== -->
    <script src="../../Modelo/Archivos_JS/ProductoSelect/SelectProducto.js"></script>

</body>
</html>