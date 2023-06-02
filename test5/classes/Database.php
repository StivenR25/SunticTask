<?php
class Database {
    private $host = "localhost";
    private $usuario = "root";
    private $contraseña = "";
    private $nombreBaseDatos = "sunticpruba";
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->contraseña, $this->nombreBaseDatos);
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public function ejecutarConsulta($consulta) {
        return $this->conexion->query($consulta);
    }

    public function cerrarConexion() {
        $this->conexion->close();
    }
}
?>
