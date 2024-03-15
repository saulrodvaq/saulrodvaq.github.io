<?php
include("../../templates/conexion.php");
// Verificar si se recibió el parámetro "idAsignatura" por GET
if (isset($_GET['idAsignatura'])) {
    $idAsignatura = $_GET['idAsignatura'];

    // Consulta SQL para eliminar la asignatura por ID
    $sql_delete_asignatura = "DELETE FROM asignaturas WHERE idAsignatura = $idAsignatura";
    $resultado_delete = mysqli_query($conn, $sql_delete_asignatura);

    if ($resultado_delete) {
        // Si se eliminó correctamente, redirigir a la página anterior (donde se listan las asignaturas)
        echo '<script>history.go(-1);</script>';
        exit;
    } else {
        // Si ocurrió un error, muestra un mensaje de error o realiza alguna otra acción adecuada.
        echo "Error al eliminar la asignatura.";
    }
} else {
    // Si no se proporcionó el ID de la asignatura a eliminar, redirigir a la página anterior
    header("Location: ver_asignaturas.php?idCarrera=$idCarrera");
    exit;
}
?>