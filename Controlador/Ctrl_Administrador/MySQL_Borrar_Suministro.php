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

        // Construir la consulta SQL para eliminar el Mantenimiento Registrado
        $sql = "DELETE FROM producto WHERE id_producto = ?";

        // Preparar la consulta
        $stmt = $conn->prepareStatement($sql);

        // Vincular parámetros y ejecutar la consulta
        $stmt->bind_param("i", $idSuministro);
        $stmt->execute();

        // Verificar si la eliminación afectó a alguna fila
        if ($stmt->affected_rows > 0) {

            // La eliminación fue exitosa
            $_SESSION['idSuministro'] = $idSuministro;
            header("Location: ../../Vista/Administrador/Adm_Gestion_Suministros.php");            
            
        } else {

            echo("La eliminación no afectó a ninguna fila (posiblemente el ID SUMINISTRO no existe)");

        }
        
    } else {

        // Redireccionar a la página de gestión de Suministros
        header("Location: ../../Vista/Administrador/Adm_Gestion_Suminitros.php");
        exit();

    }

} else {

    header("Location: ../../Controlador/Utilidades/Sesion_Destroy.php");
    exit();

}    

// Cerrar la conexión a la base de datos
$conn->closeConnection();

?>
