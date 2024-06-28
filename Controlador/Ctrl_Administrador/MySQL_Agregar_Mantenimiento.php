<?php
// Se incluye el archivo de conexión a la base de datos
require_once "../../Controlador/Utilidades/Conexion_BD.php";

// Verifica si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Se obtienen los datos del formulario
    $vehiculo = $_POST['flotaVehiculo'];
    $encargado = $_POST['encargado'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];
    $tipo_mantenimiento = $_POST['tipo_mantenimiento'];
    $productosSeleccionados = $_POST['productosSeleccionados'];
    $cantidadesSeleccionadas = $_POST['cantidadesSeleccionadas'];

    // Se crea una instancia de la clase Conexion_BD para establecer la conexión
    $conn = new Conexion_BD();

    // Iniciar una transacción
    $conn->begin_transaction();

    try {
        // Construimos la consulta SQL para insertar el mantenimiento
        $sqlMantenimiento = "INSERT INTO mantenimientos (id_vehiculo, encargado, descripcion, fecha, tipo_mantenimiento) VALUES (?, ?, ?, ?, ?)";
        
        // Preparamos la consulta    
        $stmt = $conn->prepareStatement($sqlMantenimiento);

        // Vincular parámetros y ejecutar la consulta
        $stmt->bind_param("issss", $vehiculo, $encargado, $descripcion, $fecha, $tipo_mantenimiento);
        $stmt->execute();

        // Obtener el ID del mantenimiento recién insertado
        $id_mantenimiento = $stmt->insert_id;

        // Insertar los productos seleccionados en la tabla `requerimientos`
        $sqlRequerimiento = "INSERT INTO requerimientos (id_mantenimiento, id_producto, cantidad) VALUES (?, ?, ?)";
        $stmtRequerimiento = $conn->prepareStatement($sqlRequerimiento);

        // Recorrer productos seleccionados y sus cantidades
        for ($i = 0; $i < count($productosSeleccionados); $i++) {
            $id_producto = $productosSeleccionados[$i];
            $cantidad = $cantidadesSeleccionadas[$i];
            $stmtRequerimiento->bind_param("iii", $id_mantenimiento, $id_producto, $cantidad);
            $stmtRequerimiento->execute();
        }

        // Si todo está bien, se confirma la transacción
        $conn->commit();

        // Se muestra un mensaje de éxito y se redirige a una página de gestión de mantenimientos
        echo "Mantenimiento y productos agregados exitosamente.";
        header("Location: ../../Vista/Administrador/Adm_Gestion_Mantenimientos.php");
        exit();

    } catch (Exception $e) {
        // Si ocurre un error, se revierte la transacción
        $conn->rollback();
        // Se muestra un mensaje de error
        echo "Error al agregar mantenimiento y productos: " . $e->getMessage();
    }

    // Se cierra la conexión a la base de datos
    $conn->closeConnection();
}
?>
