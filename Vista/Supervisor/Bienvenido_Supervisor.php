<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSGJ - Bienvenido</title>

    <!-- Icono de Pagina -->
    <link rel="icon" href="Archivos_Media/Color_LogoTipo.png" type="image/png">
    
    <!-- USO DE ALERTAS PERZONALISADAS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

    <!-- ==== jQuery (Para Solicitudes Ajax)===== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="Archivos_CSS/StyleBienvenido.css">

</head>
<body>
    
    <!-- Botón para Cerrar Sesión -->
    <button class="logout-btn" onclick="location.href='../../Controlador/Utilidades/Sesion_Destroy.php'">Cerrar Sesión</button>

    <!--===== ARCHIVO JS - VALIDACION DE REGISTRO =====-->
    <script src="../../Modelo/Archivos_JS/Obtener_Datos_Sesion.js"></script>

</body>
</html>
