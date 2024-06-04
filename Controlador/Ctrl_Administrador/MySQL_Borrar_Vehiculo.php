<?php

// Incluir OBLIGATORIAMENTE el archivo de conexión a la base de datos en el Documento
require_once "../Utilidades/Conexion_BD.php";

// Iniciar la sesión si no está iniciada
session_start();

// Verificar si el usuario está autenticado, si no lo está, DESTRUYE LA SESSION
if (isset($_SESSION['usuario'])) {
    
    // Verificar si se proporcionó una PLACA valida en la URL
    if (isset($_GET['IPV']) && !empty($_GET['IPV'])) {

        // Obtener el ID de usuario de la URL
        $placa_vehiculo = $_GET['IPV'];

        // Crear una instancia de la clase Database
        $conn = new Conexion_BD();

        // Construir la consulta SQL para eliminar el VEHICULO (con consulta preparada)
        $sql = "DELETE FROM vehiculos WHERE placa = ?";

        // Preparar la consulta
        $stmt = $conn->prepareStatement($sql);

        // Vincular parámetros y ejecutar la consulta
        $stmt->bind_param("s", $placa_vehiculo);
        $stmt->execute();

        // Verificar si la eliminación afectó a alguna fila
        if ($stmt->affected_rows > 0) {

            // La eliminación fue exitosa
            $_SESSION['datoplacavehiculo'] = $placa_vehiculo;
            header("Location: ../../Vista/Administrador/Adm_Gestion_Vehicular.php");            
            
        } else {

            echo("La eliminación no afectó a ninguna fila (posiblemente el usuario no existía)");

        }
        
    } else {

        // Redireccionar a la página de gestión de usuarios
        header("Location: ../../Vista/Administrador/Adm_Gestion_Vehicular.php");
        exit();

    }

} else {

    header("Location: ../../Controlador/Utilidades/Sesion_Destroy.php");
    exit();

}    

// Cerrar la conexión a la base de datos
$conn->closeConnection();

?>
