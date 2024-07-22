<?php
// Iniciar la sesión si no está iniciada
session_start();

// Incluir el archivo de conexión a la base de datos
require_once '../../Controlador/Utilidades/Conexion_BD.php';

// Verificar si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Obtener los datos de la solicitud AJAX
    $data = json_decode(file_get_contents("php://input"));
    $id = $data->id;
    $cantidadNueva = $data->cantidad;

    // Crear una instancia de la clase Conexion_BD
    $conn = new Conexion_BD();

    // Iniciar una transacción
    $conn->begin_transaction();

    try {
        // Obtener la cantidad original
        $sqlOriginal = "SELECT cantidad, id_producto FROM requerimientos WHERE id = ?";
        $stmtOriginal = $conn->prepareStatement($sqlOriginal);
        $stmtOriginal->bind_param("i", $id);
        $stmtOriginal->execute();
        $resultOriginal = $stmtOriginal->get_result();

        if ($resultOriginal->num_rows > 0) {
            $rowOriginal = $resultOriginal->fetch_assoc();
            $cantidadOriginal = $rowOriginal['cantidad'];
            $idProducto = $rowOriginal['id_producto'];

            // Calcular la diferencia entre la cantidad original y la nueva
            $diferencia = $cantidadOriginal - $cantidadNueva;

            // Actualizar el stock disponible
            $sqlUpdateStock = "UPDATE producto SET stock_disponible = stock_disponible + ? WHERE id_producto = ?";
            $stmtUpdateStock = $conn->prepareStatement($sqlUpdateStock);
            $stmtUpdateStock->bind_param("ii", $diferencia, $idProducto);
            $stmtUpdateStock->execute();

            // Verificar si hay suficiente stock disponible
            $sqlCheckStock = "SELECT stock_disponible FROM producto WHERE id_producto = ?";
            $stmtCheckStock = $conn->prepareStatement($sqlCheckStock);
            $stmtCheckStock->bind_param("i", $idProducto);
            $stmtCheckStock->execute();
            $resultCheckStock = $stmtCheckStock->get_result();

            if ($resultCheckStock->num_rows > 0) {

                $rowCheckStock = $resultCheckStock->fetch_assoc();
                $cantidadEnStock = $rowCheckStock['stock_disponible'];

                if ($cantidadEnStock < 0) {
                    // 
                    throw new Exception("El stock no puede ser negativo.");
                }

                if ($cantidadEnStock = 2) {
                    // Aquí se puede enviar una notificación sobre el bajo stock
                    $_SESSION['stock_bajo'] = $idProducto;
                }

                // Actualizar la cantidad en la tabla requerimientos
                $sqlUpdateCantidad = "UPDATE requerimientos SET cantidad = ? WHERE id = ?";
                $stmtUpdateCantidad = $conn->prepareStatement($sqlUpdateCantidad);
                $stmtUpdateCantidad->bind_param("ii", $cantidadNueva, $id);
                $stmtUpdateCantidad->execute();

                // Confirmar la transacción
                $conn->commit();

                // Enviar una respuesta exitosa
                echo json_encode(['success' => true]);
            } else {

                throw new Exception("Producto no encontrado.");
            }
        } else {

            throw new Exception("Requerimiento no encontrado.");
        }
    } catch (Exception $e) {

        // Revertir la transacción en caso de error
        $conn->rollback();

        // Enviar una respuesta de error
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }

    // Cerrar la conexión a la base de datos
    $conn->closeConnection();
}
