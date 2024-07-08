<?php

    // Iniciamos Sesion para recuperar los Datos
    session_start();

    // Incluir el archivo de conexión a la base de datos
    require_once '../../Controlador/Utilidades/Conexion_BD.php';

    // Verificar si se enviaron datos del formulario de edición
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Recuperar los datos del formulario
        $id_mantenimiento = $_POST["id_mantenimiento"];  // Agrega este campo para identificar el usuario
        $id_vehiculo = $_POST["vehiculo"];   
        $ano_fabricacion = $_POST["ano_fabricacion"];
        $marca = $_POST["marca"];
        $modelo = $_POST["modelo"];
        $tipo_vehiculo = $_POST["tipo_vehiculo_id"];
        $tipo_combustible = $_POST["tipo_combustible_id"];

        // Crear una instancia de la clase Database
        $connMySQL = new Conexion_BD();
        
        // Construir la consulta SQL para Editar el usuario. 
        $sql = "UPDATE vehiculos SET placa=?, ano_fabricacion=?, marca=?, modelo=?, tipo_vehiculo_id=?, tipo_combustible_id=? WHERE id=?";
        
        // Preparar la consulta
        $stmt = $connMySQL->prepareStatement($sql);

        // Vincular parámetros y ejecutar la consulta
        $stmt->bind_param("sissiii", $placa, $ano_fabricacion, $marca, $modelo, $tipo_vehiculo, $tipo_combustible, $id_vehiculo);

        // Verificamos si la consulta fue exitosa
        if ($stmt->execute()){
            
            // Enviamos un dato en la SESSION para verificar que se editar el vehiculo correctamente
            $_SESSION['vehiculoUpdate'] = $placa;
            
            // Redirigir a alguna página de éxito o a la lista de usuarios
            header("Location: ../../Vista/Administrador/Adm_Gestion_Vehicular.php");
            exit();

        }else{

            // Cerrar la conexión a la base de datos
            $connMySQL->closeConnection();
            
            // en caso de error en la consulta, nos dirije a esta PAGINA
            header("Location: ../../Controlador/Utilidades/Sesion_Destroy.php");
            exit();

        }

        

    } else {

        // Cerrar la conexión a la base de datos
        $connMySQL->closeConnection();

        // Redirigir a la Pagina MENU DE NAVEGACION, simpre y cuando no existan datos del formulario de edicion
        header("Location: ../../Vista/General/Adm_Menu_Navegacion.php");
        exit();
    }

    

?>
