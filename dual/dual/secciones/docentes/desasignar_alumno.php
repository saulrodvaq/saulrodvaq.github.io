<?php
include("../../templates/conexion.php");

$response = array(); // Crear un arreglo para almacenar la respuesta

if (isset($_POST["idAlumno"])) {
    $idAlumno = $_POST["idAlumno"];

    // Eliminar la asignación del alumno en la tabla alumnos_docente
    $query = "DELETE FROM alumnos_docentes WHERE idAlumno = $idAlumno";
    $resultado = mysqli_query($conn, $query);

    if ($resultado) {
        $response["success"] = true;
        $response["message"] = "Alumno desasignado exitosamente";
    } else {
        $response["success"] = false;
        $response["message"] = "Error al desasignar alumno";
    }
} else {
    $response["success"] = false;
    $response["message"] = "ID de alumno no proporcionado";
}

// Devolver la respuesta como JSON y finalizar la ejecución del script
header('Content-Type: application/json');
die(json_encode($response));
?>