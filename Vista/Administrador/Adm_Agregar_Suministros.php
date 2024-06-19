<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSGJ - Agregar Mantenimientos</title>

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
    
    <form action="../../Controlador\Ctrl_Administrador\MySQL_Agregar_Suministro.php" method="POST">
        
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
        <label for="tipo_presentacion">Tipo de Presentacion:</label>
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
        <input type="num" id="codigo_producto" name="codigo_producto">
        
        <!-- NOMBRE PRODUCTO -->
        <label for="nombre_producto">Descripción:</label>
        <input type="text" id="nombre_producto" name="nombre_producto" onkeyup="convertirAMayusculas(this)" required> 
        
        <!-- PRECIO PRODUCTO -->
        <label for="precio_producto">Precio S/ del Producto:</label>
        <input type="num" id="precio_producto" name="precio_producto">

        <!-- STOCK PRODUCTO -->
        <label for="stock_producto">Cantidad del Producto:</label>
        <input type="num" id="stock_producto" name="stock_producto">

        <!-- PESO PRODUCTO -->
        <label for="peso_producto">Peso del Producto:</label>
        <input type="num" id="peso_producto" name="peso_producto">
        
        <!-- BOTONES -->
        <input type="submit" value="Agregar">
        <input type="reset" value="Borrar Registros">
        <button type="button" onclick="location.href='Adm_Gestion_Suministros.php'">Regresar</button>

    </form>

    <!--===== ARCHIVO JS - VALIDACION DE ESCRIBIR =====-->
    <script src="../../Modelo/Archivos_JS/Validacion_Escribir.js"></script>

</body>
</html>

<?php
    // Cerrar la conexión a la base de datos
    if ($conn) {
        // Cerrar conexión
        $conn->closeConnection();
    }
?>