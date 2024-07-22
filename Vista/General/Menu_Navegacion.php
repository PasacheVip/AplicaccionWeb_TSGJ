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
                        <a href="../General/Bienvenida.php">
                            <i class='bx bx-home-alt-2 icon'></i>
                            <span class="text nav-text">Inicio</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../Administrador/Adm_Gestion_Usuarios.php">
                            <i class='bx bx-user icon'></i>
                            <span class="text nav-text">Usuarios</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../Administrador/Adm_Gestion_Vehicular.php">
                            <i class='bx bx-bus icon'></i>
                            <span class="text nav-text">Flota</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../Administrador/Adm_Gestion_Mantenimientos.php">
                            <i class='bx bxs-wrench icon'></i>
                            <span class="text nav-text">Mantenimientos</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../Administrador/Adm_Gestion_Suministros.php">
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

    <!--===== ARCHIVO JS - MENU DE NAVEGACION =====-->
    <script src="../../Modelo/Archivos_JS/Intere_Menu_Navegacion.js"></script>

</body>

</html>