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

// Redirigir al usuario a una página de inicio de sesión u otra página deseada
header("Location: ../../Vista/General/index.php");
exit;
