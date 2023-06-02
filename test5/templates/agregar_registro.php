<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

require_once '../classes/Registro.php';
$registro = new Registro();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $archivoPdf = $_FILES['archivo'];

    $resultado = $registro->agregarRegistro($nombre, $descripcion, $archivoPdf);

    if ($resultado) {
        header('Location: listar_registro.php ');
    } else {
        echo "Error al guardar el registro";
    }
}
require_once("c://xampp/htdocs/test5/view/head/head.php");
?>


<!DOCTYPE html>
<html>

<head>
    <title>Agregar Registro</title>
</head>

<body>
    <h1>Agregar Registro</h1>
    <form method="POST" enctype="multipart/form-data">
        <div class="col-5">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" name="nombre" required>
        </div>
        <div class="col-5">
            <label for="descripcion" class="form-label">Descripción:</label>
            <input type="text" class="form-control" name="descripcion" required>
        </div>
        <div class="col-5">
            <label for="archivo">Archivo PDF:</label>
            <input type="file" name="archivo" accept=".pdf" required>
        </div>
        <input type="submit" class="btn btn-primary" value="Guardar">
    </form>

</body>

</html>




<?php
require_once("c://xampp/htdocs/test5/view/head/footer.php");
?>