<?php
class Registro {
    private $db;

    public function __construct() {
        require_once 'Database.php';
        $this->db = new Database();
    }

    public function agregarRegistro($nombre, $descripcion, $archivoPdf) {
        // Validaciones básicas
        if (empty($nombre) || empty($descripcion) || empty($archivoPdf)) {
            return false;
        }

        // Obtener la información del archivo
        $nombreArchivo = $archivoPdf['name'];
        $rutaTemporal = $archivoPdf['tmp_name'];
        $rutaDestino = '../uploads/' . $nombreArchivo;

        // Validar el tipo de archivo
        $archivoPermitido = false;
        if ($archivoPdf['type'] == 'application/pdf') {
            $archivoPermitido = true;
        }

        if (!$archivoPermitido) {
            return false;
        }

        // sirve para archivo a la carpeta de destino
        if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
            // Insertar el registro en la base de datos
            $consulta = "INSERT INTO registros (nombre, descripcion, archivo_pdf) VALUES ('$nombre', '$descripcion', '$rutaDestino')";
            return $this->db->ejecutarConsulta($consulta);
        } else {
            return false;
        }
    }

    public function obtenerRegistros() {
        $registros = array();

        $consulta = "SELECT * FROM registros";
        $resultado = $this->db->ejecutarConsulta($consulta);

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $registros[] = $fila;
            }
        }

        return $registros;
    }

    public function editarRegistro($id, $nombre, $descripcion) {
        // Validaciones básicas
        if (empty($nombre) || empty($descripcion)) {
            return false;
        }

        $consulta = "UPDATE registros SET nombre = '$nombre', descripcion = '$descripcion' WHERE id = $id";
        return $this->db->ejecutarConsulta($consulta);
    }

    public function eliminarRegistro($id) {
        $consulta = "DELETE FROM registros WHERE id = $id";
        return $this->db->ejecutarConsulta($consulta);
    }
}
