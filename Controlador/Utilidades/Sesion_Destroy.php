<?php

    // Iniciar la sesión si no está iniciada
    session_start();

    // Eliminar todas las variables de sesión
    $_SESSION = array();

    // Destruir la sesión
    session_destroy();

    // Redirigir al usuario a una página de inicio de sesión u otra página deseada
    header("Location: ../../Vista/General/index.php");
    exit;

?>
