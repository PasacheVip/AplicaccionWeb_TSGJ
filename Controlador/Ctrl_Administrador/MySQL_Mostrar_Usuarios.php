<?php

    class MostrarUsuarios {

        private $conexion;

        public function __construct($conn) {
            $this->conexion = $conn;
        }

        public function ObtenerTodosLosUsuarios() {

            // Ejecutar la consulta SQL utilizando la conexión proporcionada
            //$sql = "SELECT * FROM usuarios";

            $sql = "SELECT u.*, c.descripcion AS cargo_usuario
            FROM usuarios u
            INNER JOIN cargo c ON u.id_cargo = c.id";

            $result = $this->conexion->executeQuery($sql);

            $users = array();

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $users[] = $row;
                }
            }

            return $users;
            
        }

        public function closeConnection() {
            // No necesitamos cerrar la conexión aquí ya que la clase Conexion_BD manejará eso
        }
    }

?>
