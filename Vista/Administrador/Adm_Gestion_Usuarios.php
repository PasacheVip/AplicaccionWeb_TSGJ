<?php

    // Incluir OBLIGATORIAMENTE el Archivo CONEXION BADE DE DATOS
    require_once '../../Controlador/Utilidades/Conexion_BD.php';
    // Incluir OBLIGATORIAMENTE el Archivo Controlador para Mostrar Usuarios
    require_once '../../Controlador/Ctrl_Administrador/MySQL_Mostrar_Usuarios.php';

    // Crear una instancia de la clase Database
    $conn = new Conexion_BD();

    // Crear una instancia de Database pasándole la instancia de Conexion_BD
    $MostrarUsuarios = new MostrarUsuarios($conn);

    // Obtener todos los usuarios
    $users = $MostrarUsuarios->ObtenerTodosLosUsuarios();

    // Cerrar la conexión a la base de datos
    $conn->closeConnection();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSGJ - Tabla de Usuarios</title>

    <!-- Icono de Pagina -->
    <link rel="icon" href="../../Modelo/Archivos_Media/Color_LogoTipo.png" type="image/png">

    <!-- USO DE ALERTAS PERZONALISADAS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

    <!-- ==== jQuery (Para Solicitudes Ajax)===== -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- ==== BOX-ICONS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="../../Modelo/Archivos_CSS/Gestion_Usuarios.css">
    <link rel="stylesheet" href="../../Modelo/Archivos_CSS/Style_table_Gestion.css">

    
</head>
<body>

<!-- MENU DE NAVEGACION -->

<?php
    require_once("../General/Menu_Navegacion.php");
    ?>

    <div id="iframe-container">
    
    <!-- Mostrar el nombre dentro del h2 -->
    <div class="container">
        <h2>Tabla Gestion de Usuarios</h2>    
    </div>
    
    <!-- Botón para agregar nuevo usuario -->
    <button role="button" class="button-name" onclick="location.href='Adm_Formulario_Registro.php'">Agregar Nuevo Usuario +</button>
    <button role="button" class="button-name" onclick="location.href='Adm_Gestion_Usuarios.php'">Actualizar</button>

    <!-- Tabla -->
    <div class="table-wrapper"> 
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th style="text-align: left">Nombre(s)</th>
                    <th style="text-align: left">Apellido(s)</th>
                    <th style="text-align: left">Correo Electronico</th>
                    <th>Telefono</th>
                    <th style="text-align: left">Cargo</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Mostrar los datos de la tabla usuarios en la tabla HTML
                    foreach ($users as $user) {
                        echo "<tr>";
                        echo "<td>" . $user["id_usuario"] . "</td>";
                        echo "<td>" . $user["usuario"] . "</td>";
                        echo "<td>" . str_repeat("*", strlen($user["contrasena"]) - 50) . "</td>";
                        echo "<td style='text-align: left;'>" . $user["nombre"] . "</td>";
                        echo "<td style='text-align: left;'>" . $user["apellido"] . "</td>";
                        echo "<td style='text-align: left;'>" . $user["correo"] . "</td>";
                        echo "<td>" . $user["telefono"] . "</td>";
                        echo "<td style='text-align: left;'>" . $user["cargo_usuario"] . "</td>";
                        echo "<td>
                            <a href='Adm_Editar_Usuario.php?id=" . $user["id_usuario"] . "'><i class='bx bx-edit bx-sm'></i><!-- Editar Linea --></a>
                            <a href='../../Controlador/Ctrl_Administrador/MySQL_Borrar_Usuario.php?id=" . $user["id_usuario"] . "'><i class='bx bx-trash bx-sm'></i><!-- Borrar Linea --></a>
                              </td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    </div>
    
    <!--===== ARCHIVO JS - VALIDACION DE EDITAR USUARII =====-->
    <script src="../../Modelo/Archivos_JS/Notifi_Editar_Usuario.js"></script>

    <!--===== ARCHIVO JS - VALIDACION DE ELIMINAR USUARIO =====-->
    <script src="../../Modelo/Archivos_JS/Notifi_Eliminar_Usuario.js"></script>


</body>
</html>
