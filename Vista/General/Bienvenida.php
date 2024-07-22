<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TSGJ - Menu De Navegacion</title>

    <!-- ===== Icono de Pagina ===== -->
    <link rel="icon" type="image/png" href="../../Modelo/Archivos_Media/Color_LogoTipo.png">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="../../Modelo/Archivos_CSS/Style_Bienvenido.css">

    <!-- USO DE ALERTAS PERZONALISADAS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

    <!-- ===== BOXICONS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- ==== jQuery (Para Solicitudes Ajax)===== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <!-- MENU DE NAVEGACION -->

    <?php
    require_once("../General/Menu_Navegacion.php");
    ?>

    <div id="iframe-container">

        <section id="bienvenidoUsuario"><!-- INICIO -->

            <div class="bienvenidoUser">

                <?php

                // Verificar si el nombre está establecido en la sesión
                if (isset($_SESSION['nombre'])) {
                    // Obtener el nombre de la sesión
                    $nombre = $_SESSION['nombre'];
                ?>
                    <!-- Mostrar el nombre dentro del h2 -->
                    <div id="titulo-container">

                        <h2>Bienvenido Administrador - <?php echo $nombre; ?></h2>
                        <br>
                        <a href="#GestionMantenimientos"><button class="button">Comenzar</button></a>

                        <!--===== ARCHIVO JS - VALIDACION DE REGISTRO =====-->
                        <script src="../../Modelo/Archivos_JS/Notifi_Inicio_Session.js"></script>

                    </div>

                <?php } else {

                    header('Location: ../../Controlador/Utilidades/Sesion_Destroy.php');
                    exit;
                } ?>

            </div>

        </section>
        
    </div>


    <!--===== ARCHIVO JS - MENU DE NAVEGACION =====-->
    <script src="../../Modelo/Archivos_JS/Intere_Menu_Navegacion.js"></script>

</body>

</html>