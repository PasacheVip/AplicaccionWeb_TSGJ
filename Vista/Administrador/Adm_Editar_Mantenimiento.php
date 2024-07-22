<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <title>Editar Mantenimiento</title>

    <!-- USO DE ALERTAS PERZONALISADAS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

    <!-- ==== jQuery (Para Solicitudes Ajax)===== -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="../../Modelo/Archivos_CSS/Gestion_Editar_Mantenimiento.css">

</head>

<body>

    <?php
    // Incluir el archivo de conexión a la base de datos
    require_once '../../Controlador/Utilidades/Conexion_BD.php';

    // Verificar si se ha proporcionado el parámetro 'id' a través de la URL
    if (isset($_GET['IDM']) && !empty($_GET['IDM'])) {

        // Obtener el ID del mantenimiento a editar desde la URL
        $id_mantenimiento = $_GET['IDM'];

        // Crear una instancia de la clase Database
        $connMySQL = new Conexion_BD();

        // Consulta
        $sql = "SELECT * FROM mantenimientos WHERE id_mantenimiento=? ";

        // Preparar la consulta
        $stmt = $connMySQL->prepareStatement($sql);

        // Vincular parámetros y ejecutar la consulta
        $stmt->bind_param("i", $id_mantenimiento);
        $stmt->execute();

        $result = $stmt->get_result(); // Obtener el resultado de la consulta
        $mantemiento = $result->fetch_assoc(); // Obtener los datos del usuario como un array asociativo

        // Consultar el tipo de mantenimiento
        $sqlTipoMantenimiento = "SELECT * FROM tipo_mantenimiento ORDER BY id";
        $dataTipoMantenimientoSelect = $connMySQL->executeQuery($sqlTipoMantenimiento);

        // CONSULTA PARA OBTENER TODOS LOS VEHICULOS
        $sqlFlotaVehiculos = "SELECT * FROM vehiculos ORDER BY id";
        $dataFlotaVehiculosSelect = $connMySQL->executeQuery($sqlFlotaVehiculos);

    ?>

        <!-- Formulario para editar el mantenimiento -->
        <form action="../../Controlador/MySQL_Mantenimientos/MySQL_Editar_Mantenimiento.php" method="POST">

            <h1>Editar Mantenimiento</h1>

            <!-- Campo oculto para almacenar el ID del mantenimiento -->
            <input type="hidden" id="id_mantenimiento" name="id_mantenimiento" value="<?php echo $mantemiento['id_mantenimiento']; ?>">

            <!-- Campo para editar el nombre del Encargado -->
            <label for="nombre">Vehiculo:</label>
            <select id="id_vehiculo" name="id_vehiculo">
                <option value="<?php echo $mantemiento['id_vehiculo']; ?>">Seleccione el Vehiculo Nuevo</option> <!-- Opción por defecto para seleccionar -->
                <?php
                while ($dataSelect = mysqli_fetch_array($dataFlotaVehiculosSelect)) { ?>
                    <option value="<?php echo $dataSelect["id"]; ?>">
                        <?php echo utf8_encode($dataSelect["placa"]); ?>
                    </option>
                <?php } ?>
            </select>

            <!-- Campo para editar el nombre del Encargado -->
            <label for="encargado">Encargado:</label>
            <input type="text" id="encargado" name="encargado" value="<?php echo $mantemiento['encargado']; ?>" required>

            <!-- Campo para editar la descripción del mantenimiento -->
            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" value="<?php echo $mantemiento['descripcion']; ?>" required>

            <!-- Campo para editar la fecha del mantenimiento -->
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $mantemiento['fecha']; ?>" required>
            <br>

            <!-- ===== TIPO DE MANTEMINIENTO ===== -->
            <label for="tipo_mantenimiento">Tipo de Mantenimiento:</label>
            <select id="tipo_mantenimiento" name="tipo_mantenimiento">
                <option value="<?php echo $mantemiento['tipo_mantenimiento']; ?>">Seleccione un tipo</option> <!-- Opción por defecto para seleccionar -->
                <?php
                while ($dataSelect = mysqli_fetch_array($dataTipoMantenimientoSelect)) { ?>
                    <option value="<?php echo $dataSelect["id"]; ?>">
                        <?php echo utf8_encode($dataSelect["descripcion"]); ?>
                    </option>
                <?php } ?>
            </select>

            <!-- Botón de envío para actualizar el mantenimiento -->
            <input type="submit" value="Actualizar">
            <button type="button" onclick="location.href='Adm_Gestion_Mantenimientos.php'">Regresar</button>

        </form>

    <?php } ?>
</body>

</html>