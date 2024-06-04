<?php

    class MostrarVehiculos {

        private $conexion;

        public function __construct($conn) {
            $this->conexion = $conn;
        }

        public function ObtenerTodosLosVehiculos() {

            // Ejecutar la consulta SQL utilizando la conexión proporcionada
            $sql = "SELECT v.*, tv.vehiculotipo AS tipo_vehiculo, tc.combustibletipo AS tipo_combustible 
            FROM vehiculos v
            INNER JOIN tipovehiculo tv ON v.tipo_vehiculo_id = tv.id
            INNER JOIN tipocombustible tc ON v.tipo_combustible_id = tc.id";

            $result = $this->conexion->executeQuery($sql);

            $vehiculos = array();

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $vehiculos[] = $row;
                }
            }

            return $vehiculos;
            
        }

    }

?>
