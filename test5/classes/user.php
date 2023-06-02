<?php
class User
{
    private $db;

    public function __construct()
    {
        require_once 'Database.php';
        $this->db = new Database();
    }

    public function login($username, $password)
    {
        // Validar las credenciales del usuario en la base de datos
        $consulta = "SELECT * FROM usuarios WHERE nombre = '$username' AND contraseña = '$password'";
        echo $consulta; // Mostrar la consulta SQL para depurar
        $resultado = $this->db->ejecutarConsulta($consulta);
        if ($resultado->num_rows == 1) {
            return true; // Credenciales válidas
        } else {
            return false; // Credenciales inválidas
        }
    }


    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: login.php');
        exit();
    }
}
