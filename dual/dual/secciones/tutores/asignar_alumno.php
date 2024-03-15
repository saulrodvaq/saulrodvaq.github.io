<?php
include("../../templates/conexion.php");

$response = array(); // Crear un arreglo para almacenar la respuesta

if (isset($_POST["idAlumno"]) && isset($_POST["idTutor"])) {
    $idAlumno = $_POST["idAlumno"];
    $idTutor = $_POST["idTutor"];

    // Obtener la fecha actual
    $fechaAsignacion = date('Y-m-d');

    // Actualizar el campo idTutor del alumno con el valor proporcionado
    $query = "UPDATE alumnos SET idTutor = $idTutor WHERE idAlumno = $idAlumno";
    $resultado = mysqli_query($conn, $query);

    if ($resultado) {
        // Insertar un registro en la tabla historial_tutores
        $queryHistorial = "INSERT INTO historial_tutores (idAlumno, idTutor, fecha_asignacion) 
                           VALUES ($idAlumno, $idTutor, '$fechaAsignacion')";
        $resultadoHistorial = mysqli_query($conn, $queryHistorial);

        if ($resultadoHistorial) {
            $response["success"] = true;
            $response["message"] = "Alumno asignado exitosamente";
            $response["reload"] = true; // Agregar una propiedad "reload" al arreglo de respuesta
        } else {
            $response["success"] = false;
            $response["message"] = "Error al insertar en historial de tutores";
        }
    } else {
        $response["success"] = false;
        $response["message"] = "Error al asignar alumno";
    }
} else {
    $response["success"] = false;
    $response["message"] = "ID de alumno o ID de tutor no proporcionado";
}

// Devolver la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>