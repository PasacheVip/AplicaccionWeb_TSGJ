<?php

    // Iniciar sesión para recuperar los datos
    session_start();

    // Incluir el archivo de conexión a la base de datos
    require_once '../../Controlador/Utilidades/Conexion_BD.php';

    // Verificar si se enviaron datos del formulario de edición
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Recuperar los datos del formulario
        $id_mantenimiento = $_POST["id_mantenimiento"];
        $id_vehiculo = $_POST["id_vehiculo"];   
        $encargado = $_POST["encargado"];
        $descripcion = $_POST["descripcion"];
        $fecha = $_POST["fecha"];
        $tipo_mantenimiento = $_POST["tipo_mantenimiento"];

        // Crear una instancia de la clase Database
        $connMySQL = new Conexion_BD();

        // Establecer el modo de informe de errores de MySQLi
        $connMySQL->mysqli->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;

        try {
            // Construir la consulta SQL para editar el mantenimiento
            $sql = "UPDATE mantenimientos SET id_vehiculo=?, encargado=?, descripcion=?, fecha=?, tipo_mantenimiento=? WHERE id_mantenimiento=?";
            
            // Preparar la consulta
            $stmt = $connMySQL->prepareStatement($sql);

            // Verificar que la consulta se preparó correctamente
            if (!$stmt) {
                throw new Exception("Error al preparar la consulta: " . $connMySQL->mysqli->error);
            }

            // Vincular parámetros y ejecutar la consulta
            $stmt->bind_param("isssii", $id_vehiculo, $encargado, $descripcion, $fecha, $tipo_mantenimiento, $id_mantenimiento);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Enviar un dato en la sesión para verificar que se editó el mantenimiento correctamente
                $_SESSION['MantenimientoEditado'] = $id_vehiculo;

                // Redirigir a alguna página de éxito o a la lista de mantenimientos
                header("Location: ../../Vista/Administrador/Adm_Gestion_Mantenimientos.php");
                exit();

            } else {
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

?>
