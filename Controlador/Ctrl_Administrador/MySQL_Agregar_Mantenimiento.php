<?php
    // Se incluye el archivo de conexión a la base de datos
    require_once "../../Controlador/Utilidades/Conexion_BD.php";

    // Verifica si la solicitud es de tipo POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        // Se obtienen los datos del formulario
        $vehiculo = $_POST['flotaVehiculo'];
        $encargado = $_POST['encargado'];
        $descripcion = $_POST['descripcion'];
        $fecha = $_POST['fecha'];
        $tipo_mantenimiento = $_POST['tipo_mantenimiento'];
        $productosSeleccionados = $_POST['productosSeleccionados'];

        // Se crea una instancia de la clase Conexion_BD para establecer la conexión
        $conn = new Conexion_BD();

        // Construimos la consulta SQL para insertar el mantenimiento
        $sqlMantenimiento = "INSERT INTO mantenimientos (id_vehiculo, encargado, descripcion, fecha, tipo_mantenimiento) VALUES (?, ?, ?, ?, ?)";
        
        // Preparamos la consulta    
        $stmt = $conn->prepareStatement($sqlMantenimiento);

        // Vincular parámetros y ejecutar la consulta
        $stmt->bind_param("issss", $vehiculo, $encargado, $descripcion, $fecha, $tipo_mantenimiento);

        if ($stmt->execute() === TRUE) {

            $id_mantenimiento = $stmt->insert_id; // Obtener el ID del mantenimiento recién insertado
            
                // Insertar los productos seleccionados en la tabla `requerimientos`
                foreach ($productosSeleccionados as $id_producto) {
                    
                    $cantidad = 1; // Aquí puedes definir la cantidad según lo necesites

                    // Construimos la consulta SQL para insertar los productos seleccionados
                    $sqlRequerimiento = "INSERT INTO requerimientos (id_mantenimiento, id_producto, cantidad) VALUES (?, ?, ?)";

                    // Preparamos la consulta 
                    $stmtRequerimiento = $conn->prepareStatement($sqlRequerimiento);

                    // Vincular parámetros y ejecutar la consulta
                    $stmtRequerimiento->bind_param("iii", $id_mantenimiento, $id_producto, $cantidad);
                    $stmtRequerimiento->execute();
                    
                    // Se ejecuta la consulta y se verifica si se ha insertado correctamente
                    if ($stmtRequerimiento->affected_rows > 0) {

                        // Se muestra un mensaje de éxito y se redirige a una página de gestión de mantenimientos
                        echo "Mantenimiento registrado exitosamente.";
                        echo "Productos Registrados.";
                        header("Location: ../../Vista/Administrador/Adm_Gestion_Mantenimientos.php");

                    } else {

                        // Si ocurre un error, se muestra un mensaje de error
                        echo "Error al agregar Productos: ";
                    }

                }        

        } else {

            echo "Error: ";

        }

        // Se cierra la conexión a la base de datos.
        $conn->closeConnection();

    }

?>