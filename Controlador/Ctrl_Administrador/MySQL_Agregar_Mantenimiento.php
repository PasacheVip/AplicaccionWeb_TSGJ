<?php
    // Se incluye el archivo de conexión a la base de datos
    require_once "../../Controlador/Utilidades/Conexion_BD.php";

    // Verifica si la solicitud es de tipo POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Se obtienen los datos del formulario
        $encargado = $_POST['encargado'];
        $descripcion = $_POST['descripcion'];
        $fecha = $_POST['fecha'];
        $tipo_mantenimiento = $_POST['tipo_mantenimiento'];

        // Si el tipo de mantenimiento está vacío, se inserta como NULL
        if (empty($tipo_mantenimiento)) {
            $tipo_mantenimiento = NULL; 
        }

        // Se crea una instancia de la clase Conexion_BD para establecer la conexión
        $conn = new Conexion_BD();

        // Construimos la consulta SQL
        $sql = ("INSERT INTO mantenimientos (encargado, descripcion, fecha, tipo_mantenimiento) VALUES (?, ?, ?, ?)");

        // Preparamos la consulta    
        $stmt = $conn->prepareStatement($sql);

        // Vincular parámetros y ejecutar la consulta
        $stmt->bind_param("ssss", $encargado, $descripcion, $fecha, $tipo_mantenimiento);
        $stmt->execute();

        // Se ejecuta la consulta y se verifica si se ha insertado correctamente
        if ($stmt->affected_rows > 0) {
            // Se muestra un mensaje de éxito y se redirige a una página de gestión de mantenimientos
            echo "Mantenimiento agregado exitosamente.";
            header("Location: ../../Vista/Administrador/Adm_Gestion_Mantenimientos.php");

        } else {
            // Si ocurre un error, se muestra un mensaje de error
            echo "Error al agregar mantenimiento: " . $query->error;
        }

        // Se cierra la conexión a la base de datos
        $conn->closeConnection();
    }
?>