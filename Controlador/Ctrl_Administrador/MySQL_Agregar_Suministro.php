<?php
    // Se incluye el archivo de conexión a la base de datos
    require_once "../../Controlador/Utilidades/Conexion_BD.php";

    // Verifica si la solicitud es de tipo POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Se obtienen los datos del formulario
        $id_categoria = $_POST['tipo_Categoria'];
        $id_presentacion = $_POST['tipo_presentacion'];
        $id_proveedor = $_POST['encargado'];
        $codigo = $_POST['descripcion'];
        $producto = $_POST['fecha'];
        $precio = $_POST['tipo_mantenimiento'];
        $stock_disponible = $_POST['descripcion'];
        $peso = $_POST['fecha'];

        // Se crea una instancia de la clase Conexion_BD para establecer la conexión
        $conn = new Conexion_BD();

        // Construimos la consulta SQL
        $sql = ("INSERT INTO mantenimientos (id_categoria, id_presentacion, id_proveedor, codigo, producto, precio, stock_disponible, peso) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        // Preparamos la consulta    
        $stmt = $conn->prepareStatement($sql);

        // Vincular parámetros y ejecutar la consulta
        $stmt->bind_param("iiiisiii", $id_categoria, $id_presentacion, $id_proveedor, $codigo, $producto, $precio, $stock_disponible, $peso);
        $stmt->execute();

        // Se ejecuta la consulta y se verifica si se ha insertado correctamente
        if ($stmt->affected_rows > 0) {
            // Se muestra un mensaje de éxito y se redirige a una página de gestión de mantenimientos
            echo "Suministro Registrado Correctamente.";
            header("Location: ../../Vista/Administrador/Adm_Gestion_Suministros.php");

        } else {
            // Si ocurre un error, se muestra un mensaje de error
            echo "Error al agregar mantenimiento: " . $query->error;
        }

        // Se cierra la conexión a la base de datos
        $conn->closeConnection();
    }
?>