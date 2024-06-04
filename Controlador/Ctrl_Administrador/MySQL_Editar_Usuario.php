<?php

    // Iniciamos Sesion para recuperar los Datos
    session_start();

    // Incluir el archivo de conexión a la base de datos
    require_once '../../Controlador/Utilidades/Conexion_BD.php';

    // Verificar si se enviaron datos del formulario de edición
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Recuperar los datos del formulario
        $id_usuario = $_POST["id_usuario"];  // Agrega este campo para identificar el usuario
        $usuario = $_POST["usuario"];   
        $contrasena = $_POST["contrasena"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $correo = $_POST["correo"];
        $telefono = $_POST["telefono"];
        $id_cargo = $_POST["rolusuario"];

        // Encriptar la contraseña - Usando el metodo HASH
        $contrasena_encriptada = password_hash($contrasena, PASSWORD_DEFAULT);

        // Crear una instancia de la clase Database
        $connMySQL = new Conexion_BD();
        
        // Construir la consulta SQL para Editar el usuario. 
        $sql = "UPDATE usuarios SET usuario=?, contrasena=?, nombre=?, apellido=?, correo=?, telefono=?, id_cargo=? WHERE id_usuario=?";
        
        // Preparar la consulta
        $stmt = $connMySQL->prepareStatement($sql);

        // Vincular parámetros y ejecutar la consulta
        $stmt->bind_param("sssssiii", $usuario, $contrasena_encriptada, $nombre, $apellido, $correo, $telefono, $id_cargo, $id_usuario);

        // Verificamos si la consulta fue exitosa
        if ($stmt->execute()){
            
            // La eliminación fue exitosa
            $_SESSION['usuarioUpdate'] = $usuario;
            
            // Redirigir a alguna página de éxito o a la lista de usuarios
            header("Location: ../../Vista/Administrador/Adm_Gestion_Usuarios.php");
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
