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

        // Construir la consulta SQL para eliminar el Mantenimiento Registrado
        $sql = "DELETE FROM mantenimientos WHERE id_mantenimiento = ?";

        // Preparar la consulta
        $stmt = $conn->prepareStatement($sql);

        // Vincular parámetros y ejecutar la consulta
        $stmt->bind_param("i", $idMantenimiento);
        $stmt->execute();

        // Verificar si la eliminación afectó a alguna fila
        if ($stmt->affected_rows > 0) {

            // La eliminación fue exitosa
            $_SESSION['idMantenimiento'] = $idMantenimiento;
            header("Location: ../../Vista/Administrador/Adm_Gestion_Mantenimientos.php");            
            
        } else {

            echo("La eliminación no afectó a ninguna fila (posiblemente el usuario no existía)");

        }
        
    } else {

        // Redireccionar a la página de gestión de usuarios
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
