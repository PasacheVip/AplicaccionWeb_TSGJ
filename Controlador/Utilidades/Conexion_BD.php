<?php

    class Conexion_BD {

        // Cambia estos valores según tu configuración de base de datos
        private $host = "localhost";
        private $usuario = "root";
        private $contrasena = "";
        private $base_de_datos = "tsgj-v1-bd";
        private $conexion;

        // Método para establecer la conexión a la base de datos
        public function __construct() {

            // Crear una nueva conexión a la base de datos
            $this->conexion = new mysqli($this->host, $this->usuario, $this->contrasena, $this->base_de_datos);

            // Verificar si hay errores de conexión
            if ($this->conexion->connect_error) {

                die("Error de conexión: " . $this->conexion->connect_error);

            }
        }

        // Método para ejecutar una consulta SQL
        public function executeQuery($query) {
            return $this->conexion->query($query);
        }

        // Método para preparar una declaración SQL
        public function prepareStatement($query) {
            return $this->conexion->prepare($query);
        }

        // Método para cerrar la conexión a la base de datos
        public function closeConnection() {
            $this->conexion->close();
        }
    }

?>
