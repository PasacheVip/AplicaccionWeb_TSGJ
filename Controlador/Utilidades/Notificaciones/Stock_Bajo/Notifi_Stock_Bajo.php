<?php
    // Iniciamos Sesion para recuperar los Datos
    session_start();

    // Se incluye el archivo de conexión a la base de datos
    require_once "../../../../Controlador/Utilidades/Conexion_BD.php";

    // Crear un array para almacenar los datos
    $response = array();

    // Verificar si la variable stock_bajo existe
    if (isset($_SESSION['stock_bajo'])) {

        // Obtenemos los datos de la sesión "stock_bajo"
        $id_producto = $_SESSION['stock_bajo'];

        // Construimos la consulta SQL para obtener el nombre del producto
        $sqlMantenimiento = "SELECT producto FROM producto WHERE id_producto = ?";

        // Preparamos la consulta    
        if ($stmt = $conn->prepare($sqlMantenimiento)) {

            // Vincular parámetros
            $stmt->bind_param("i", $id_producto);

            // Ejecutar la consulta
            if ($stmt->execute()) {

                // Obtener el resultado
                $stmt->bind_result($producto);
                $stmt->fetch();

                // Verificamos si se encontró el producto
                if ($producto) {

                    // Enviamos el Nombre del Producto por el JSON
                    $response['idMessage'] = $producto;

                } else {

                    $response['idMessage'] = "Producto no encontrado";

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
        $response['idMessage'] = "No existe un dato en la sesión [stock_bajo]";
    }

    // Convertir el array de respuesta a formato JSON y enviarlo de vuelta al cliente
    echo json_encode($response);

?>
