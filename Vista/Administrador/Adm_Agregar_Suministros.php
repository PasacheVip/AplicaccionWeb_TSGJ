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
    <link rel="stylesheet" href="../../Modelo/Archivos_CSS/Style_ForSuministros.css">

</head>
<body>
    <?php

        // Se incluye el archivo de conexión a la base de datos
        require_once '../../Controlador/Utilidades/Conexion_BD.php';

        // Crear una instancia de la clase "Conexion_BD"
        $conn = new Conexion_BD();

        // CONSULTA PARA OBTENER LOS TIPOS DE MANTENIMIENTOS, DE LA BASE DE DATOS
        $sqlSuministros = "SELECT * FROM categoria ORDER BY id";
        $dataTipoCategoriaSelect = $conn->executeQuery($sqlSuministros);

        // CONSULTA PARA OBTENER LOS TIPOS DE MANTENIMIENTOS, DE LA BASE DE DATOS
        $sqlSuministros = "SELECT * FROM presentacion ORDER BY id";
        $dataTipoPresentacionSelect = $conn->executeQuery($sqlSuministros);

        // CONSULTA PARA OBTENER LOS TIPOS DE MANTENIMIENTOS, DE LA BASE DE DATOS
        $sqlSuministros = "SELECT * FROM proveedor ORDER BY id";
        $dataTipoProveedorSelect = $conn->executeQuery($sqlSuministros);

    ?>
    
    <form action="../../Controlador\Ctrl_Administrador\MySQL_Agregar_Suministro.php" method="POST" id="Agregar_Suministro" novalidate>
        
        <!-- TIPO DE CATEGORIA -->
        <label for="tipo_Categoria">Tipo de Categoria:</label>
        <select id="tipo_Categoria" name="tipo_Categoria">
            <option value="">Seleccione un tipo</option> <!-- Opción por defecto para seleccionar -->
            <?php
                while ($dataSelect = mysqli_fetch_array($dataTipoCategoriaSelect)) { ?>
                  <option value="<?php echo $dataSelect["id"]; ?>">
                    <?php echo utf8_encode($dataSelect["descripcion"]); ?>
                  </option>
              <?php } ?>
        </select>

        <!-- TIPO DE CATEGORIA -->
        <label for="tipo_presentacion">Unidad de Medida:</label>
        <select id="tipo_presentacion" name="tipo_presentacion">
            <option value="">Seleccione un Vehiculo</option> <!-- Opción por defecto para seleccionar -->
            <?php
                while ($dataSelect = mysqli_fetch_array($dataTipoPresentacionSelect)) { ?>
                  <option value="<?php echo $dataSelect["id"]; ?>">
                    <?php echo utf8_encode($dataSelect["descripcion"]); ?>
                  </option>
              <?php } ?>
        </select>

        <!-- TIPO DE CATEGORIA -->
        <label for="proveedor">Tipo de Proveedor:</label>
        <select id="proveedor" name="proveedor">
            <option value="">Seleccione un tipo</option> <!-- Opción por defecto para seleccionar -->
            <?php
                while ($dataSelect = mysqli_fetch_array($dataTipoProveedorSelect)) { ?>
                  <option value="<?php echo $dataSelect["id"]; ?>">
                    <?php echo utf8_encode($dataSelect["descripcion"]); ?>
                  </option>
              <?php } ?>
        </select>

        <!-- CODIGO PRODUCTO -->
        <label for="codigo_producto">Codigo del Producto:</label>
        <input type="text" id="codigo_producto" name="codigo_producto" onkeyup="convertirAMayusculas(this)">
        
        <!-- NOMBRE PRODUCTO -->
        <label for="nombre_producto">Nombre del Producto:</label>
        <input type="text" id="nombre_producto" name="nombre_producto" onkeyup="convertirAMayusculas(this)"> 
        
        <!-- PRECIO PRODUCTO -->
        <label for="precio_producto">Precio en S/ del Producto:</label>
        <input type="num" id="precio_producto" name="precio_producto" onkeyup="limitarDigitos(this, 10)">

        <!-- STOCK PRODUCTO -->
        <label for="stock_producto">Cantidad del Producto:</label>
        <input type="num" id="stock_producto" name="stock_producto" onkeyup="limitarDigitos(this, 10)">
        
        <!-- BOTONES -->
        <input type="submit" value="Agregar">
        <input type="reset" value="Borrar Registros">
        <button type="button" onclick="location.href='Adm_Gestion_Suministros.php'">Regresar</button>

    </form>

    <!--===== ARCHIVO JS - VALIDACION DEL FORMULARIO =====-->
    <script src="../../Modelo/Archivos_JS/Validaciones/Form_Agregar_Suministro.js"></script>

    <!--===== ARCHIVO JS - VALIDACION DE ESCRIBIR =====-->
    <script src="../../Modelo/Archivos_JS/Validacion_Escribir.js"></script>

</body>
</html>