<?php

    // Iniciar la sesión si no está iniciada
    session_start();

    // Incluir OBLIGATORIAMENTE el archivo de conexión a la base de datos en el Documento
    require_once "../Utilidades/Conexion_BD.php";

    // Recibir datos del formulario de inicio de sesión
    $nombre_usuario = $_POST['nameuser'];
    $contrasena = $_POST['password'];

    // Crear una instancia de la clase Database
    $conn = new Conexion_BD();
    
    // Consultar la base de datos para obtener el hash de la contraseña
    $sql = "SELECT nombre, contrasena, id_cargo, descripcion FROM usuarios INNER JOIN cargo ON id_cargo = id WHERE usuario = '$nombre_usuario'";
    
    // Ejecutamos la Consulta
    $resultado= $conn->executeQuery($sql);

    // Verificar si se encontró un usuario con las credenciales proporcionadas
    if ($resultado->num_rows > 0) {

        // Obtener el hash de la contraseña y la Descripcion del Cargo
        $fila = $resultado->fetch_assoc();
        $nombre = $fila['nombre']; // Contraseña Encontrada
        $hash_almacenado = $fila['contrasena']; // Contraseña Encontrada
        $id_cargo_usuario = $fila['id_cargo']; // ID Cargo Encontrado
        $cargo_usuario = $fila['descripcion']; // Cargo Encontrado

        // Verificar si la contraseña proporcionada coincide con el hash almacenado
        if (password_verify($contrasena, $hash_almacenado)) {                        

            // Verificar el cargo del usuario y redirigir a páginas específicas según el cargo
            if ($id_cargo_usuario == 1) { // Si el Usuario Es administrador

                // Iniciar sesión y almacenar el ID del usuario en la sesión de PHP
                $_SESSION['usuario'] = $nombre_usuario;
                $_SESSION['id_cargo'] = $cargo_usuario;
                $_SESSION['nombre'] = $nombre;

                header("Location: ../../Vista/General/Adm_Menu_Navegacion.php");
                exit();

            } else if ($id_cargo_usuario == 2) { // Si el Usuario Es supervisor
                
                // Iniciar sesión y almacenar el ID del usuario en la sesión de PHP
                $_SESSION['usuario'] = $nombre_usuario;
                $_SESSION['id_cargo'] = $cargo_usuario;
                $_SESSION['nombre'] = $nombre;
                header("Location: ../../Vista/General/Super_Menu_Navegacion.php");
                exit();

            } else {

                // Cargo desconocido, redirigir a una página de error
                header("Location: ../../Vista/General/index.php?e=UCI");
                exit();

            }

        } else {
            
            // Contraseña Incorrecta (El usuario si es correcto)
            header("Location: ../../Vista/General/index.php?e=UCI");
            exit();

        }

    } else {
        // Usario Y contraseña Incorrectos
        header("Location: ../../Vista/General/index.php?e=UCI");
        exit();

    }

    // Cerrar conexión
    $conn->closeConnection();

?>

