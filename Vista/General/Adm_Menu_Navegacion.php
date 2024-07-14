<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../Controlador/Utilidades/Sesion_Destroy.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TSGJ - Menu De Navegacion</title>

    <!-- ===== Icono de Pagina ===== -->
    <link rel="icon" type="image/png" href="../../Modelo/Archivos_Media/Color_LogoTipo.png">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="../../Modelo/Archivos_CSS/Menu_Navegacion.css">

    <!-- USO DE ALERTAS PERZONALISADAS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

    <!-- ===== BOXICONS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- ==== jQuery (Para Solicitudes Ajax)===== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>

    <nav class="sidebar close">

        <header>

            <div class="image-text">

                <span class="image">
                    <img src="../../Modelo/Archivos_Media/Color_LogoTipo.png" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name"></span>
                    <span class="profession">TSGJ - V1 - 2024</span>
                </div>

            </div>

            <i class='bx bx-chevron-right toggle'></i>

        </header>

        <br>

        <div class="menu-bar">

            <div class="menu">

                <ul class="menu-links">

                    <li class="nav-link">
                        <a href="Adm_Menu_Navegacion.php">
                            <i class='bx bx-home-alt-2 icon'></i>
                            <span class="text nav-text">Inicio</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#GestionUsuarios">
                            <i class='bx bx-user icon'></i>
                            <span class="text nav-text">Usuarios</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#GestionVehicular">
                            <i class='bx bx-bus icon'></i>
                            <span class="text nav-text">Flota</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#GestionMantenimientos">
                            <i class='bx bxs-wrench icon'></i>
                            <span class="text nav-text">Mantenimientos</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#GestionSuministros">
                            <i class='bx bxs-package icon'></i>
                            <span class="text nav-text">Suministros</span>
                        </a>
                    </li>

                </ul>

            </div>

            <div class="bottom-content">

                <li class="mode">
                    <a href="../../Controlador/Utilidades/Sesion_Destroy.php">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Cerrar Sesión</span>
                    </a>
                </li>

            </div>

        </div>

    </nav>

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

                        <a href="#GestionMantenimientos"><button>Comenzar</button></a>

                        <!--===== ARCHIVO JS - VALIDACION DE REGISTRO =====-->
                        <script src="../../Modelo/Archivos_JS/Notifi_Inicio_Session.js"></script>

                    </div>

                <?php } else {

                    header('Location: ../../Controlador/Utilidades/Sesion_Destroy.php');
                    exit;
                } ?>

            </div>

        </section>

        <section id="GestionUsuarios"><!-- Aqui mostrar la pagina "GESTION DE USUARIOS"-->
            <iframe src="../Administrador/Adm_Gestion_Usuarios.php"></iframe>
        </section>

        <section id="GestionVehicular"> <!-- Aqui mostrar la pagina "GESTION VEHICULAR" -->
            <iframe src="../Administrador/Adm_Gestion_Vehicular.php"></iframe>
        </section>

        <!--

            <section id="pagina3"> Aqui mostrar la pagina "DOCUMENTOS"                
                <iframe  src=""></iframe>
            </section> -->

        <section id="GestionMantenimientos"><!-- Aqui mostrar la pagina "MANTENIMIENTOS" -->
            <iframe src="../Administrador/Adm_Gestion_Mantenimientos.php"></iframe>
        </section>

        <section id="GestionSuministros"><!-- Aqui mostrar la pagina "SUMINISTROS" -->
            <iframe src="../Administrador/Adm_Gestion_Suministros.php"></iframe>
        </section>

    </div>

    <!--===== ARCHIVO JS - MENU DE NAVEGACION =====-->
    <script src="../../Modelo/Archivos_JS/Intere_Menu_Navegacion.js"></script>

</body>

</html>