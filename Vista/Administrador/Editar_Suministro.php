<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>TSGJ - Editar Suministro</title>

  <!-- Icono de Pagina -->
  <link rel="icon" href="../../Modelo/Archivos_Media/Color_LogoTipo.png" type="image/png">

  <!-- USO DE ALERTAS PERZONALISADAS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

  <!-- ==== jQuery (Para Solicitudes Ajax)===== -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- ===== CSS ===== -->
  <link rel="stylesheet" href="../../Modelo/Archivos_CSS/Style_ForSuministros.css">

</head>

<body>
  <?php
  // Incluir el archivo de conexión a la base de datos
  require_once '../../Controlador/Utilidades/Conexion_BD.php';

  // Verificar si se ha proporcionado el parámetro 'id' a través de la URL
  if (isset($_GET['ID_S']) && !empty($_GET['ID_S'])) {

    // Obtener el ID del mantenimiento a editar desde la URL
    $SuministroID = $_GET['ID_S'];

    // Crear una instancia de la clase Database
    $connMySQL = new Conexion_BD();

    // Consulta
    $sql = "SELECT * FROM producto WHERE id_producto=? ";

    // Preparar la consulta
    $stmt = $connMySQL->prepareStatement($sql);

    // Vincular parámetros y ejecutar la consulta
    $stmt->bind_param("i", $SuministroID);
    $stmt->execute();

    $result = $stmt->get_result(); // Obtener el resultado de la consulta
    $ResultSuministro = $result->fetch_assoc(); // Obtener los datos del usuario como un array asociativo

    // CONSULTA PARA OBTENER LOS TIPOS DE MANTENIMIENTOS, DE LA BASE DE DATOS
    $sqlSuministros = "SELECT * FROM categoria ORDER BY id";
    $dataTipoCategoriaSelect = $connMySQL->executeQuery($sqlSuministros);

    // CONSULTA PARA OBTENER LOS TIPOS DE MANTENIMIENTOS, DE LA BASE DE DATOS
    $sqlSuministros = "SELECT * FROM presentacion ORDER BY id";
    $dataTipoPresentacionSelect = $connMySQL->executeQuery($sqlSuministros);

    // CONSULTA PARA OBTENER LOS TIPOS DE MANTENIMIENTOS, DE LA BASE DE DATOS
    $sqlSuministros = "SELECT * FROM proveedor ORDER BY id";
    $dataTipoProveedorSelect = $connMySQL->executeQuery($sqlSuministros);

  ?>

    <form action="../../Controlador/MySQL_Suministros/MySQL_Editar_Suministro.php" method="POST">

    <!-- Campo oculto para almacenar el ID del mantenimiento -->
    <input type="hidden" id="id_producto" name="id_producto" value="<?php echo $ResultSuministro['id_producto']; ?>">

      <!-- TIPO DE CATEGORIA -->
      <label for="tipo_Categoria">Tipo de Categoria:</label>
      <select id="tipo_Categoria" name="tipo_Categoria">
        <option value="<?php echo $ResultSuministro['id_categoria']; ?>">Categoria Seleccionada</option> <!-- Opción por defecto para seleccionar -->
        <?php
        while ($dataSelect = mysqli_fetch_array($dataTipoCategoriaSelect)) { ?>
          <option value="<?php echo $dataSelect["id"]; ?>">
            <?php echo utf8_encode($dataSelect["descripcion"]); ?>
          </option>
        <?php } ?>
      </select>

      <!-- TIPO DE PRESENTACION -->
      <label for="tipo_presentacion">Unidad de Medida:</label>
      <select id="tipo_presentacion" name="tipo_presentacion">
        <option value="<?php echo $ResultSuministro['id_presentacion']; ?>">Unidad de Medida Seleccionada</option> <!-- Opción por defecto para seleccionar -->
        <?php
        while ($dataSelect = mysqli_fetch_array($dataTipoPresentacionSelect)) { ?>
          <option value="<?php echo $dataSelect["id"]; ?>">
            <?php echo utf8_encode($dataSelect["descripcion"]); ?>
          </option>
        <?php } ?>
      </select>

      <!-- PROVEEDOR -->
      <label for="proveedor">Tipo de Proveedor:</label>
      <select id="proveedor" name="proveedor">
        <option value="<?php echo $ResultSuministro['id_proveedor']; ?>">Proveedor Seleccionado</option> <!-- Opción por defecto para seleccionar -->
        <?php
        while ($dataSelect = mysqli_fetch_array($dataTipoProveedorSelect)) { ?>
          <option value="<?php echo $dataSelect["id"]; ?>">
            <?php echo utf8_encode($dataSelect["descripcion"]); ?>
          </option>
        <?php } ?>
      </select>

      <!-- CODIGO PRODUCTO -->
      <label for="codigo_producto">Codigo del Producto:</label>
      <input 
      type="text" 
      id="codigo_producto" 
      name="codigo_producto"
      value="<?php echo $ResultSuministro['codigo']; ?>" 
      onkeyup="convertirAMayusculas(this)">

      <!-- NOMBRE PRODUCTO -->
      <label for="nombre_producto">Nombre del Producto:</label>
      <input 
      type="text" 
      id="nombre_producto" 
      name="nombre_producto"
      value="<?php echo $ResultSuministro['producto']; ?>"
      onkeyup="convertirAMayusculas(this)">

      <!-- PRECIO PRODUCTO -->
      <label for="precio_producto">Precio en S/ del Producto:</label>
      <input 
      type="num" 
      id="precio_producto" 
      name="precio_producto"
      value="<?php echo $ResultSuministro['precio']; ?>" 
      onkeyup="limitarDigitos(this, 10)">

      <!-- STOCK PRODUCTO -->
      <label for="stock_producto">Cantidad del Producto:</label>
      <input 
      type="num" 
      id="stock_producto" 
      name="stock_producto"
      value="<?php echo $ResultSuministro['stock_disponible']; ?>" 
      onkeyup="limitarDigitos(this, 10)">

      <!-- BOTONES -->
      <input type="submit" value="Actualizar Suministro">
      <button type="button" onclick="location.href='Adm_Gestion_Suministros.php'">Regresar</button>

    </form>
  <?php } ?>

  <!--===== ARCHIVO JS - VALIDACION DEL FORMULARIO =====-->
  <script src="../../Modelo/Archivos_JS/Validaciones/Form_Editar_Suministro.js"></script>

  <!-- ==== NOTIFICACION DE LA ELIMINACION DEL MANTENIMIENTO ===== -->
  <?php require_once '../../Modelo/Archivos_JS/Notificaciones/Succes_Error/notification.php'; ?>

  <!--===== ARCHIVO JS - VALIDACION DE ESCRIBIR =====-->
  <script src="../../Modelo/Archivos_JS/Validacion_Escribir.js"></script>

</body>

</html>