<?php

// Recuperar datos de la session iniciada anterior
session_start();

// Destruir cualquier sesión existente
session_unset();
session_destroy();

// Evitar el almacenamiento en caché
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Iniciar una nueva sesión después de destruir la existente
session_start();

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>TSGJ - Iniciar Sesi&oacute;n</title>

  <!-- Icono de Pagina -->
  <link rel="icon" href="../../Modelo/Archivos_Media/Color_LogoTipo.png" type="image/png" />

  <!-- USO DE ALERTAS PERZONALISADAS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

  <!-- ===== CSS ===== -->
  <link rel="stylesheet" href="../../Modelo/Archivos_CSS/Login-SignUp.css" />

  <!-- ===== BOX ICONS ===== -->
  <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
  <div class="login">
    <div class="login__content">
      <div class="login__img">
        <img src="../../Modelo/Archivos_Media/LogotipoFull.png" alt="" />
      </div>

      <div class="login__forms">
        <form action="../../Controlador/Ctrl_Administrador/MySQL_Inicio_Sesion.php" class="login__registre" id="login-in" method="post">
          <h1 class="login__title">Iniciar Sesi&oacute;n</h1>

          <div class="login__box">
            <i class="bx bx-user login__icon"></i>
            <input type="text" id="nameuser" name="nameuser" placeholder="Nombre de Usario" class="login__input" />
          </div>

          <div class="login__box">
            <i class="bx bx-lock-alt login__icon"></i>
            <input type="password" id="password" name="password" placeholder="Contrase&ntilde;a" class="login__input" />
          </div>

          <button type="submit" class="login__button">Ingresar</button>
        </form>

        <!--===== ARCHIVOS JS =====-->
        <script src="../../Modelo/Archivos_JS/Validacion_Iniciar_Session.js"></script>
      </div>
    </div>
  </div>
</body>

</html>