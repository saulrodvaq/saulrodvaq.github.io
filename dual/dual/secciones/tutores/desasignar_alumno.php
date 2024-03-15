<?php
include("../../templates/conexion.php");

$response = array(); // Crear un arreglo para almacenar la respuesta

if (isset($_POST["idAlumno"])) {
  $idAlumno = $_POST["idAlumno"];

  // Actualizar el campo idTutor del alumno a 0 (desasignar)
  $query = "UPDATE alumnos SET idTutor = 0 WHERE idAlumno = $idAlumno";
  $resultado = mysqli_query($conn, $query);

  if ($resultado) {
    $response["success"] = true;
    $response["message"] = "Alumno desasignado exitosamente";
    $response["reload"] = false; // No es necesario recargar la página
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