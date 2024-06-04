<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSGJ - Registro de Usuario</title>

    <!-- Icono de Pagina -->
    <link rel="icon" href="../../Modelo/Archivos_Media/Color_LogoTipo.png" type="image/png">
        
    <!-- USO DE ALERTAS PERZONALISADAS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="../../Modelo/Archivos_CSS/Style_Formulario.css">

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
      
    
    <form action="../../Controlador/Ctrl_Administrador/MySQL_Registro_Usuario.php" method="POST" id="Form_Registro" novalidate>
            
        <h2>Registro de Usuarios</h2><hr><br>
        
        <diV class="colums">

            <div data-div="1">
                
                <label for="usuario">Usuario:</label><br>
                <input type="text" id="usuario" name="usuario" onkeyup="convertirAMayusculas(this)"><br>

            </div>

            <div data-div="1">

                <label for="contrasena">Contraseña:</label><br>
                <input type="password" id="contrasena" name="contrasena"><br>
        
            </div>

            <div data-div="2">
                
                <label for="nombre">Nombre del Usuario:</label><br>
                <input type="text" id="nombre" name="nombre" onkeyup="convertirAMayusculas(this)"><br>                    

            </div>

            <div data-div="2">
                
                <label for="apellido">Apellido del Usuario:</label><br>
                <input type="text" id="apellido" name="apellido" onkeyup="convertirAMayusculas(this)"><br>

            </div>            

            <div data-div="3">        

                <label for="correo">Correo electrónico:</label><br>
                <input type="email" id="correo" name="correo" onkeyup="convertirAMayusculas(this)"><br>
                
            </div>

            <div data-div="3">

                <label for="telefono">Telefono:</label><br>
                <input type="number" id="telefono" name="telefono" oninput="limitarDigitos(this, 9)"><br>

            </div>

        </div>

        <label for="rolusuario">Rol por establecer al Usuario:</label>
        <p>(1) Administrador <strong>/</strong> (2) Supervisor</p>
        <input type="number" id="rolusuario" name="rolusuario" oninput="limitarDigitos(this, 1)"><br>
            
        <diV class="colums">

            <div data-div="4">
                <!-- Button de envio de registro -->
                <input type="submit" value="Registrarse">
            </div>

            <div data-div="4">
                <!-- Button de envio de registro -->
                <input type="reset" value="Borrar Registro">
            </div>
            
        </diV>
        
    </form>

    <!--===== ARCHIVO JS - VALIDACION DE REGISTRO USUARIO =====-->
    <script src="../../Modelo/Archivos_JS/Validacion_Agregar_Usuario.js"></script>

    <!--===== ARCHIVO JS - VALIDACION DE ESCRIBIR =====-->
    <script src="../../Modelo/Archivos_JS/Validacion_Escribir.js"></script>

</body>
</html>
