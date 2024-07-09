    <?php

        // Iniciamos Sesion para recuperar los Datos
        session_start();

        // Incluir el archivo de conexión a la base de datos
        require_once '../../Controlador/Utilidades/Conexion_BD.php';

        // Verificar si se enviaron datos del formulario de edición
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Recuperar los datos del formulario
            $id_mantenimiento = $_POST["id_mantenimiento"];  // Agrega este campo para identificar el usuario
            $id_vehiculo = $_POST["flotaVehiculo"];   
            $encargado = $_POST["encargado"];
            $descripcion = $_POST["descripcion"];
            $fecha = $_POST["fecha"];
            $tipo_mantenimiento = $_POST["tipo_mantenimiento"];

            // Crear una instancia de la clase Database
            $connMySQL = new Conexion_BD();
            
            // Construir la consulta SQL para Editar el usuario. 
            $sql = "UPDATE mantenimientos SET id_vehiculo=?, encargado=?, descripcion=?, fecha=?, tipo_mantenimiento=? WHERE id_mantenimiento=?";
            
            // Preparar la consulta
            $stmt = $connMySQL->prepareStatement($sql);

            // Vincular parámetros y ejecutar la consulta
            $stmt->bind_param("issssi", $id_vehiculo, $encargado, $descripcion, $fecha, $tipo_mantenimiento, $id_mantenimiento);

            // Verificamos si la consulta fue exitosa
            if ($stmt->execute()){
                
                // Enviamos un dato en la SESSION para verificar que se editar el vehiculo correctamente
                $_SESSION['MantenimientoEditado'] = $id_vehiculo;
                
                // Redirigir a alguna página de éxito o a la lista de usuarios
                header("Location: ../../Vista/Administrador/Adm_Gestion_Mantenimientos.php");
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
