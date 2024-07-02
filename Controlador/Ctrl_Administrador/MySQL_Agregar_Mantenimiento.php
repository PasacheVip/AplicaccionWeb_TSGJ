<?php

    // Iniciamos Sesion para recuperar los Datos
    session_start();

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
            // Validar la cantidad en stock antes de insertar el nuevo mantenimiento
            foreach ($productosSeleccionados as $index => $id_producto) {
                $cantidadSolicitada = $cantidadesSeleccionadas[$index];
                $sqlStock = "SELECT stock_disponible FROM producto WHERE id_producto = ?";
                $stmtStock = $conn->prepareStatement($sqlStock);
                $stmtStock->bind_param("i", $id_producto);
                $stmtStock->execute();
                $resultStock = $stmtStock->get_result();

                if ($resultStock->num_rows > 0) {
                    $row = $resultStock->fetch_assoc();
                    $cantidadEnStock = $row['stock_disponible'];

                    if ($cantidadSolicitada > $cantidadEnStock) {
                        throw new Exception("No hay suficiente stock para el producto ID: $id_producto");
                    }
                } else {
                    throw new Exception("Producto no encontrado en el stock: ID $id_producto");
                }
            }

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

            // Actualizar el stock y verificar niveles bajos
            foreach ($productosSeleccionados as $index => $id_producto) {
                $cantidad = $cantidadesSeleccionadas[$index];
                $stmtRequerimiento->bind_param("iii", $id_mantenimiento, $id_producto, $cantidad);
                $stmtRequerimiento->execute();

                // Actualizar el stock
                $sqlUpdateStock = "UPDATE producto SET stock_disponible = stock_disponible - ? WHERE id_producto = ?";
                $stmtUpdateStock = $conn->prepareStatement($sqlUpdateStock);
                $stmtUpdateStock->bind_param("ii", $cantidad, $id_producto);
                $stmtUpdateStock->execute();

                // Verificar si el stock es bajo
                $sqlCheckStock = "SELECT stock_disponible FROM producto WHERE id_producto = ?";
                $stmtCheckStock = $conn->prepareStatement($sqlCheckStock);
                $stmtCheckStock->bind_param("i", $id_producto);
                $stmtCheckStock->execute();
                $resultCheckStock = $stmtCheckStock->get_result();
                $rowCheckStock = $resultCheckStock->fetch_assoc();

                if ($rowCheckStock['stock_disponible'] <= 1) {

                    // Aquí se envia una notificación sobre el bajo stock
                    echo "Advertencia: El producto ID $id_producto tiene un stock bajo.";
                    $_SESSION['stock_bajo'] = $id_producto;
                }
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
