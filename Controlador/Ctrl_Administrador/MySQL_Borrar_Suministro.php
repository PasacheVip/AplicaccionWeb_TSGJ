<?php

// Incluir OBLIGATORIAMENTE el archivo de conexión a la base de datos en el Documento
require_once "../Utilidades/Conexion_BD.php";

// Iniciar la sesión si no está iniciada
session_start();

// Verificar si el usuario está autenticado, si no lo está, DESTRUYE LA SESSION
if (isset($_SESSION['usuario'])) {

    // Verificar si se proporcionó un ID correcto del SUMINISTRO
    if (isset($_GET['ID_S']) && !empty($_GET['ID_S'])) {

        // Obtener el ID del MANTENIMIENTO de usuario de la URL
        $idSuministro = $_GET['ID_S'];

        // Crear una instancia de la clase Database
        $conn = new Conexion_BD();

        // Construir la consulta SQL para obtener el producto
        $sql = "SELECT producto FROM producto WHERE id_producto = ?";
        $stmt = $conn->prepareStatement($sql);
        $stmt->bind_param("i", $idSuministro);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si se encontró el producto
        if ($result->num_rows > 0) {

            $productoCon = $result->fetch_assoc();
            $_SESSION['Producto'] = $productoCon['producto']; // Guarda el nombre del producto en la sesión

            // Construir la consulta SQL para eliminar en Primera instancia los productos de la tabla requerimientos.
            $sql = "DELETE FROM requerimientos WHERE id_producto = ?";
            $stmt = $conn->prepareStatement($sql);
            $stmt->bind_param("i", $idSuministro);
            $stmt->execute();

            // Construir la consulta SQL para eliminar en Segunda instancia el Suministro.
            $sql = "DELETE FROM producto WHERE id_producto = ?";
            $stmt = $conn->prepareStatement($sql);
            $stmt->bind_param("i", $idSuministro);
            $stmt->execute();

            // Verificar si la eliminación afectó a alguna fila
            if ($stmt->affected_rows > 0) {

                // Confirmar la transacción
                $conn->commit();

                // La eliminación fue exitosa
                $_SESSION['message'] = "Suministro eliminado correctamente.";
                $_SESSION['message_type'] = "success";

                // Se redirige a la Pagina Gestion De Suministro
                header("Location: ../../Vista/Administrador/Adm_Gestion_Suministros.php");

            } else {

                // Revertir la transacción
                $conn->rollback();

                $_SESSION['message'] = "La eliminación no afectó a ninguna fila (posiblemente el Suministro no existía).";
                $_SESSION['message_type'] = "error";

                // Se redirige a la Pagina Gestion De Suministro
                header("Location: ../../Vista/Administrador/Adm_Gestion_Suministros.php");
                
            }

        } else {

            $_SESSION['message'] = "No se encontró ningún producto con el ID proporcionado";
            $_SESSION['message_type'] = "error";
        }

    } else {

        $_SESSION['message'] = "No se encontró ningún producto con el ID proporcionado";
        $_SESSION['message_type'] = "error";

        header("Location: ../../Vista/Administrador/Adm_Gestion_Suministros.php");
        exit();

    }

} else {

    header("Location: ../../Controlador/Utilidades/Sesion_Destroy.php");
    exit();
    
}

// Cerrar la conexión a la base de datos
$conn->closeConnection();
