<?php
    // Iniciamos Sesion para recuperar los Datos
    session_start();

    // Se incluye el archivo de conexión a la base de datos
    require_once "../../../../Controlador/Utilidades/Conexion_BD.php";

    // Crear un array para almacenar los datos
    $response = array();

    // Se crea una instancia de la clase Conexion_BD para establecer la conexión
    $conn = new Conexion_BD();

    // Verificar si la variable stock_bajo existe
    if (isset($_SESSION['MantenimientoEditado'])) {

        // Obtenemos los datos de la sesión "stock_bajo"
        $id_vehiculo = $_SESSION['MantenimientoEditado'];

        // Construimos la consulta SQL para obtener el nombre del producto
        $sqlVehiculo = "SELECT placa FROM vehiculos WHERE id = ?";

        // Preparamos la consulta    
        if ($stmt = $conn->prepareStatement($sqlVehiculo)) {

            // Vincular parámetros
            $stmt->bind_param("i", $id_vehiculo);

            // Ejecutar la consulta
            if ($stmt->execute()) {

                // Obtener el resultado
                $stmt->bind_result($id_vehiculo);
                $stmt->fetch();

                // Verificamos si se encontró el producto
                if ($id_vehiculo) {

                    // Enviamos el Nombre del Producto por el JSON
                    $response['idMessage'] = $id_vehiculo;

                } else {

                    $response['idMessage'] = "Vehiculo no encontrado";

                }

            } else {

                // Error en la ejecución de la consulta
                header("Location: ../../Controlador/Utilidades/Sesion_Destroy.php");
                exit();

            }

            // Se cierra la conexión a la base de datos
            $conn->closeConnection();

        } else {
            // Error al preparar la consulta
            $response['idMessage'] = "Error al preparar la consulta SQL";
        }

    } else {

        // Si las variables de sesión no existen o están vacías, enviar un mensaje de error
        $response['idMessageFalse'] = "No existe un dato en la sesión [MantenimientoEditado]";
    }

    // Convertir el array de respuesta a formato JSON y enviarlo de vuelta al cliente
    echo json_encode($response);

?>
