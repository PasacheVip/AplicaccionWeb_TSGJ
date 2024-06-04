<?php
    // Incluir el archivo de conexión a la base de datos
    require_once '../../Controlador/Utilidades/Conexion_BD.php';

    // Verificar si se proporcionó un ID de usuario válido en la URL
    if (isset($_GET['id']) && !empty($_GET['id'])) {

        // Obtener el ID de usuario de la URL
        $id_usuario = $_GET['id'];

        // Crear una instancia de la clase Database
        $connMySQL = new Conexion_BD();

        // Obtener los datos del usuario de la base de datos
        $sql = "SELECT * FROM usuarios WHERE id_usuario=?";


        // Preparar la consulta
        $stmt = $connMySQL->prepareStatement($sql);

        // Vincular parámetros y ejecutar la consulta
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();

        $result = $stmt->get_result(); // Obtener el resultado de la consulta
        $usuario = $result->fetch_assoc(); // Obtener los datos del usuario como un array asociativo

        // Cerrar la conexión a la base de datos
        $connMySQL->closeConnection();

    } else {

        // Si no se proporciona un ID válido, redirigir a alguna página de error o a la lista de usuarios
        header("Location: ../../Vista/Error.php");
        exit();

    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSGJ - Editar Usuario</title>

    <!-- Icono de Pagina -->
    <link rel="icon" href="../../Modelo/Archivos_Media/Color_LogoTipo.png" type="image/png">

    <!-- USO DE ALERTAS PERZONALISADAS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="../../Modelo/Archivos_CSS/UpdateUser.css">

</head>
<body>
    
    <button class="button" onclick="location.href='Adm_Gestion_Usuarios.php'">
        <div class="button-box">
          <span class="button-elem">
            <svg viewBox="0 0 46 40" xmlns="http://www.w3.org/2000/svg">
              <path d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"></path>
            </svg>
          </span>
          <span class="button-elem">
            <svg viewBox="0 0 46 40">
              <path d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"></path>
            </svg>
          </span>
        </div>
    </button>
      
    
    <form action="../../Controlador/Ctrl_Administrador/MySQL_Editar_Usuario.php" method="POST" id="Form_Registro" novalidate>
            
        <h2>Datos a Modificar</h2><hr><br>
        
        <diV class="colums">

            <div data-div="1">
                <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">
                <label for="usuario">Nuevo Usuario:</label><br>
                <input type="text" id="usuario" name="usuario" value="<?php echo $usuario['usuario']; ?>" onkeyup="convertirAMayusculas(this)"><br>

            </div>

            <div data-div="1">

                <label for="contrasena">Nueva Contraseña:</label><br>
                <input type="password" id="contrasena" name="contrasena" value="<?php echo $usuario['contrasena']; ?>"><br>
        
            </div>

            <div data-div="2">
                
                <label for="nombre">Nuevo Nombre del Usuario:</label><br>
                <input type="text" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>" onkeyup="convertirAMayusculas(this)"><br>                    

            </div>

            <div data-div="2">
                
                <label for="apellido">Nuevo Apellido del Usuario:</label><br>
                <input type="text" id="apellido" name="apellido" value="<?php echo $usuario['apellido']; ?>" onkeyup="convertirAMayusculas(this)"><br>

            </div>            

            <div data-div="3">        

                <label for="correo">Nuevo Correo electrónico:</label><br>
                <input type="email" id="correo" name="correo" value="<?php echo $usuario['correo']; ?>" onkeyup="convertirAMayusculas(this)"><br>
                
            </div>

            <div data-div="3">

                <label for="telefono">Nuevo Telefooono:</label><br>
                <input type="number" id="telefono" name="telefono" value="<?php echo $usuario['telefono']; ?>" oninput="limitarDigitos(this, 9)"><br>

            </div>

        </div>

        <label for="rolusuario">Nuevo Rol por asignar al Usuario:</label>
        <p>(1) Administrador <strong>/</strong> (2) Supervisor</p>
        <input type="number" id="rolusuario" name="rolusuario" value="<?php echo $usuario['id_cargo']; ?>" oninput="limitarDigitos(this, 1)"><br>
        
        <!-- Button de envio de registro -->
        <input type="submit" value="Modificar">
        
    </form>

    <!--===== ARCHIVO JS - VALIDACION DE REGISTRO =====-->
    <script src="../../Modelo/Archivos_JS/Validacion_Editar_Usuario.js"></script>

    
    <!--===== ARCHIVO JS - VALIDACION DE ESCRIBIR =====-->
    <script src="../../Modelo/Archivos_JS/Validacion_Escribir.js"></script>

</body>
</html>
