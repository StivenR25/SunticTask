<?php
require_once 'classes/User.php';

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: templates/login.php');
    exit();
}

require_once 'classes/Registro.php';

// Uso del CRUD
$registro = new Registro();

// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $archivoPdf = $_FILES["archivo_pdf"];

    // Validar el tipo de archivo
    $archivoPermitido = false;
    if ($archivoPdf["type"] == "application/pdf") {
        $archivoPermitido = true;
    }

    if (!$archivoPermitido) {
        echo "<script>alert('Solo se permiten archivos PDF.');</script>";
    } else {
        // Agregar el registro
        $resultado = $registro->agregarRegistro($nombre, $descripcion, $archivoPdf);

        if ($resultado) {
            echo "Registro agregado correctamente.";
        } else {
            echo "Error al agregar el registro.";
        }
    }
}

// Mostrar el formulario para agregar un registro
include 'templates/dashboard.php';

