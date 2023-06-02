<?php
require_once '../classes/Registro.php';
require_once("c://xampp/htdocs/test5/view/head/head.php");

$registro = new Registro();
$registros = $registro->obtenerRegistros();

// Verificar si se ha enviado una solicitud de eliminación
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];

    // Llamar al método eliminarRegistro de la clase Registro
    $eliminado = $registro->eliminarRegistro($id);

    if ($eliminado) {
        // Redireccionar a la página de listado después de eliminar exitosamente
        header("Location: listar_registro.php");
        exit();
    } else {
        echo "Error al eliminar el registro.";
    }
}
?>

<h2>Listado de Registros</h2>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Archivo PDF</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($registros as $registro) : ?>
        <tr>
            <td><?php echo $registro['id']; ?></td>
            <td><?php echo $registro['nombre']; ?></td>
            <td><?php echo $registro['descripcion']; ?></td>
            <td><a href="<?php echo $registro['archivo_pdf']; ?>" target="_blank">Ver PDF</a></td>
            <td>
                <a href="editar_registro.php?id=<?php echo $registro['id']; ?>">Editar</a>
                <a href="listar_registro.php?eliminar=<?php echo $registro['id']; ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
require_once("c://xampp/htdocs/test5/view/head/footer.php");
?>