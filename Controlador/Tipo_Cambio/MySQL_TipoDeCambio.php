<?php

    // Incluir OBLIGATORIAMENTE el archivo de conexión a la base de datos en el Documento
    require_once "../Utilidades/Conexion_BD.php";

    // Iniciar la sesión si no está iniciada
    session_start();

    // Crear una instancia de la clase Database
    $conn = new Conexion_BD();

    // Verificar si el usuario está autenticado, si no lo está, DESTRUYE LA SESSION
    if (isset($_SESSION['usuario'])) {
        
        // Verificar si se proporcionó un VALOR validO en la URL
        if (isset($_GET['valor']) && !empty($_GET['valor'])) {

            // Obtener el VALOR (PRECIO) de la URL
            // Obtener el VALOR (PRECIO) de la URL
            $valor = $_GET['valor'];
            $TipoDeCambioActual = 3.63; // Manejar este valor de acuerdo al resultado de la API
            $Operacion_SOLES_DOLARES = $valor / $TipoDeCambioActual;

            // Redondear el resultado a 2 decimales
            $MostrarTipoDeCambio = number_format($Operacion_SOLES_DOLARES, 2);

            $_SESSION['IdTipoDeCambio'] = $MostrarTipoDeCambio;  
               
            // Redireccionar a la página de gestión de Suminitros
            header("Location: ../../Vista/Administrador/Adm_Gestion_Suministros.php");
            exit();      
                
        } else {

            // Redireccionar a la página de gestión de Suminitros
            header("Location: ../../Vista/Administrador/Adm_Gestion_Suministros.php");
            exit();

        }

    } else {

        header("Location: ../../Controlador/Utilidades/Sesion_Destroy.php");
        exit();

    }    

    // Cerrar la conexión a la base de datos
    $conn->closeConnection();

?>
