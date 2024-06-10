<?php

    // Iniciar la sesión obligatoriamente
    session_start();

    // Incluir OBLIGATORIAMENTE el archivo de conexión a la base de datos en el Documento
    require_once "../Utilidades/Conexion_BD.php";

    // Variables para Recibir los datos del formulario
    $placa = $_POST['placa']; /* Input Placa */
    $ano_fabricacion = $_POST['ano_fabricacion']; /* Input Año de Fabricacion */
    $marca = $_POST['marca']; /* Input Marca */  
    $modelo = $_POST['modelo']; /* Input Modelo */
    $tipo_vehiculo_id = $_POST['tipo_vehiculo_id']; /* Select Tipo De Vehiculo */ 
    $tipo_combustible_id = $_POST['tipo_combustible_id']; /* Select Tipo De Combustible */  
    
    // Crear una instancia de la clase "Conexion_BD"
    $conn = new Conexion_BD();

    // Preparar la consulta SQL
    $sql = "INSERT INTO vehiculos (placa, ano_fabricacion, marca, modelo, tipo_vehiculo_id, tipo_combustible_id) VALUES ('$placa','$ano_fabricacion','$marca', '$modelo', '$tipo_vehiculo_id', '$tipo_combustible_id')";

 
    // Ejecutar la consulta y verificar si fue exitosa
    if ($conn->executeQuery($sql) === TRUE) {
        
        // Agregacion Vehiculo Exitoso
        $_SESSION['vehiculoPlaca'] = $placa;

        header("Location: ../../Vista/Administrador/Adm_Gestion_Vehicular.php");
        exit();   

    } else {

        header("Location: ../../Vista/Administrador/Adm_Formulario_Flota.php");
        exit();
    }


    // Cerrar conexión
    $conn->closeConnection();
   
?>
