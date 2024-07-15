<?php

// Incluir OBLIGATORIAMENTE el archivo de conexión a la base de datos en el Documento
require_once "../Utilidades/Conexion_BD.php";

// Iniciar la sesión si no está iniciada
session_start();

// Verificar si el usuario está autenticado, si no lo está, DESTRUYE LA SESSION
if (isset($_SESSION['usuario'])) {
    
    // Verificar si se proporcionó un ID correcto de Mantenimiento
    if (isset($_GET['IDM']) && !empty($_GET['IDM'])) {

        // Obtener el ID del MANTENIMIENTO de usuario de la URL
        $idMantenimiento = $_GET['IDM'];

        // Crear una instancia de la clase Database
        $conn = new Conexion_BD();
        
        // Iniciar una transacción
        $conn->begin_transaction();

        try {
            // Construir la consulta SQL para eliminar en Primera instancia los requerimientos.
            $sql = "DELETE FROM requerimientos WHERE id_mantenimiento = ?";
            $stmt = $conn->prepareStatement($sql);
            $stmt->bind_param("i", $idMantenimiento);
            $stmt->execute();

            // Construir la consulta SQL para eliminar en Segunda instancia los mantenimientos.
            $sql = "DELETE FROM mantenimientos WHERE id_mantenimiento = ?";
            $stmt = $conn->prepareStatement($sql);
            $stmt->bind_param("i", $idMantenimiento);
            $stmt->execute();

            // Verificar si la eliminación afectó a alguna fila
            if ($stmt->affected_rows > 0) {

                // Confirmar la transacción
                $conn->commit();

                // La eliminación fue exitosa
                $_SESSION['message'] = "Mantenimiento eliminado correctamente.";
                $_SESSION['message_type'] = "success";

            } else {

                // Revertir la transacción
                $conn->rollback();

                $_SESSION['message'] = "La eliminación no afectó a ninguna fila (posiblemente el mantenimiento no existía).";
                $_SESSION['message_type'] = "error";

            }

        } catch (Exception $e) {

            // Revertir la transacción en caso de error
            $conn->rollback();

            $_SESSION['message'] = "Error al eliminar el mantenimiento: " . $e->getMessage();
            $_SESSION['message_type'] = "error";

        }

        // Redireccionar a la página de gestión de mantenimientos
        header("Location: ../../Vista/Administrador/Adm_Gestion_Mantenimientos.php");
        exit();

    } else {

        // Redireccionar a la página de gestión de mantenimientos
        header("Location: ../../Vista/Administrador/Adm_Gestion_Mantenimientos.php");
        exit();

    }

} else {

    header("Location: ../../Controlador/Utilidades/Sesion_Destroy.php");
    exit();
    
}

// Cerrar la conexión a la base de datos
$conn->closeConnection();

?>
