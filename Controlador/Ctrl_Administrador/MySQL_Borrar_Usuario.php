<?php

// Incluir OBLIGATORIAMENTE el archivo de conexión a la base de datos en el Documento
require_once "../Utilidades/Conexion_BD.php";

// Iniciar la sesión si no está iniciada
session_start();

// Verificar si el usuario está autenticado, si no lo está, DESTRUYE LA SESSION
if (isset($_SESSION['usuario'])) {
    
    // Verificar si se proporcionó un ID de usuario válido en la URL
    if (isset($_GET['id']) && !empty($_GET['id'])) {

        // Obtener el ID de usuario de la URL
        $id_usuario = $_GET['id'];

        // Crear una instancia de la clase Database
        $conn = new Conexion_BD();

        // Construir la consulta SQL para eliminar el usuario (con consulta preparada)
        $sql = "DELETE FROM usuarios WHERE id_usuario = ?";

        // Preparar la consulta
        $stmt = $conn->prepareStatement($sql);

        // Vincular parámetros y ejecutar la consulta
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();

        // Verificar si la eliminación afectó a alguna fila
        if ($stmt->affected_rows > 0) {

            // La eliminación fue exitosa
            $_SESSION['id'] = $id_usuario;
            header("Location: ../../Vista/Administrador/Adm_Gestion_Usuarios.php");            
            
        } else {

            echo("La eliminación no afectó a ninguna fila (posiblemente el usuario no existía)");

        }
        
    } else {

        // Redireccionar a la página de gestión de usuarios
        header("Location: ../../Vista/Administrador/Adm_Gestion_Usuarios.php");
        exit();

    }

} else {

    header("Location: ../../Controlador/Utilidades/Sesion_Destroy.php");
    exit();

}    

// Cerrar la conexión a la base de datos
$conn->close();

?>
