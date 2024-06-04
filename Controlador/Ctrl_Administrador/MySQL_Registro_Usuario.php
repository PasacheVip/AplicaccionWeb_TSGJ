<?php
    // Incluir OBLIGATORIAMENTE el archivo de conexión a la base de datos en el Documento
    require_once "../Utilidades/Conexion_BD.php";

    // Variables para Recibir los datos del formulario
    $usuario = $_POST['usuario']; /* Tabla usuarios */
    $contrasena = $_POST['contrasena']; /* Tabla usuarios */
    $nombre = $_POST['nombre']; /* Tabla usuarios */  
    $apellido = $_POST['apellido']; /* Tabla usuarios */ 
    $correo = $_POST['correo']; /* Tabla usuarios */    
    $telefono = $_POST['telefono']; /* Tabla usuarios */
    $rolusuario = $_POST['rolusuario']; /* Tabla usuarios */

    // Encriptar la contraseña - Usando el metodo HASH
    $contrasena_encriptada = password_hash($contrasena, PASSWORD_DEFAULT);

    // Crear una instancia de la clase "Conexion_BD"
    $conn = new Conexion_BD();

    // Preparar la consulta SQL
    $sql = "INSERT INTO usuarios (usuario, contrasena, nombre, apellido, correo, telefono, id_cargo) VALUES ('$usuario','$contrasena_encriptada','$nombre', '$apellido', '$correo','$telefono','$rolusuario')";

    // Ejecutar la consulta y verificar si fue exitosa
    if ($conn->executeQuery($sql) === TRUE) {
        
        header("Location: ../../Vista/Administrador/Adm_Formulario_Registro.php?mensaje=RegistroExitoso");
        exit();   

    } else {

        header("Location: ../../Vista/Administrador/Adm_Formulario_Registro.php?mensaje=RegistroErroneo");
        exit();
    }

    // Cerrar conexión
    $conn->closeConnection();

?>
