<?php

    // Iniciar la sesión si no está iniciada
    session_start();

    session_unset();
    session_destroy();

    // Redirigir al usuario a una página de inicio de sesión u otra página deseada
    header("Location: ../../Vista/General/index.php");
    exit;

?>
