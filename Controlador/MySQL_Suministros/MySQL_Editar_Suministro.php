<?php

// Iniciar sesión para recuperar los datos
session_start();

// Incluir el archivo de conexión a la base de datos
require_once '../../Controlador/Utilidades/Conexion_BD.php';

// Verificar si se enviaron datos del formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Se obtienen los datos del formulario
    $id_producto = $_POST["id_producto"];
    $id_categoria = $_POST['tipo_Categoria'];
    $id_presentacion = $_POST['tipo_presentacion'];
    $id_proveedor = $_POST['proveedor'];
    $codigo = $_POST['codigo_producto'];
    $producto = $_POST['nombre_producto'];
    $precio = $_POST['precio_producto'];
    $stock_disponible = $_POST['stock_producto'];

    // Crear una instancia de la clase Database
    $connMySQL = new Conexion_BD();

    try {

        // Construir la consulta SQL para editar el mantenimiento
        $sql = "UPDATE producto SET id_categoria=?, id_presentacion=?, id_proveedor=?, codigo=?, producto=?, precio=?, stock_disponible=? WHERE id_producto=?";

        // Preparar la consulta
        $stmt = $connMySQL->prepareStatement($sql);

        // Verificar que la consulta se preparó correctamente
        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $connMySQL->conexion->error);
        }

        // Vincular parámetros y ejecutar la consulta
        $stmt->bind_param("iiissdii", $id_categoria, $id_presentacion, $id_proveedor, $codigo, $producto, $precio, $stock_disponible, $id_producto);

        // Ejecutar la consulta
        if ($stmt->execute()) {

            // Confirmar la transacción
            $connMySQL->commit();

            // La eliminación fue exitosa
            $_SESSION['message'] = "Suministro Actualizado correctamente.";
            $_SESSION['message_type'] = "success";

            // Redirigir a alguna página de éxito o a la lista de mantenimientos
            header("Location: ../../Vista/Administrador/Adm_Gestion_Suministros.php");
            exit();

        } else {

            $_SESSION['message'] = "La Actualizacion no afectó a ninguna fila (posiblemente el Suministro no existía).";
            $_SESSION['message_type'] = "error";

            // Revertir la transacción
            $connMySQL->rollback();
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);

        }
    } catch (Exception $e) {
        // Mostrar el error específico
        echo "Algo falló en la consulta: " . $e->getMessage();
        exit();
    }
} else {
    // Cerrar la conexión a la base de datos
    $connMySQL->closeConnection();

    // Redirigir a la página de menú de navegación si no existen datos del formulario de edición
    header("Location: ../../Vista/General/Adm_Menu_Navegacion.php");
    exit();
}
