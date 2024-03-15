<?php
include("../../templates/conexion.php");
if(isset($_POST["idAlumno"])) {
    // Obtener los valores actualizados de los campos de entrada del formulario
    $idAlumno = $_POST["idAlumno"];
    $estatus_alumno = $_POST["estatus_alumno"];
    $motivo_baja = $_POST["motivo_baja"];
    $observaciones = $_POST["observaciones"];

    // Consulta para actualizar los datos del usuario correspondiente
    $query = "UPDATE alumnos SET 
            estatus_alumno= '$estatus_alumno',
            motivo_baja= '$motivo_baja',
            observaciones= '$observaciones'
            WHERE idAlumno = $idAlumno";
    mysqli_query($conn, $query);

    // Redirigir a la página de inicio
    header("Location: alumnos.php");
    exit();
}
?>