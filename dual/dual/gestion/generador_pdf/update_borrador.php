<?php
session_start();
include("../../templates/conexion.php");

// Obtener el ID del borrador a actualizar
$idReporte = $_POST["id"];

// Recopilar los datos del formulario
$idAlumno = $_SESSION["idAlumno"];
$matricula = $_POST["matricula"];
$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$carrera = $_POST["carrera"];
$idTutor = $_POST["idTutor"];
$idInstructor = $_POST["idInstructor"];
$empresa = $_POST["empresa"];
$semana = $_POST["semana"];
$f_Inicio = $_POST["f_Inicio"];
$f_Fin = $_POST["f_Fin"];
$cuatrimestre = $_POST["cuatrimestre"];

// Calcular las fechas de los días de la semana (Lunes a Viernes) basándose en la fecha de finalización (Viernes)
$timestamp_f_Fin = strtotime($f_Fin); // Convertir la fecha de finalización a un timestamp
$numero_dia_f_Fin = date("N", $timestamp_f_Fin); // Obtener el número de día de la semana correspondiente a la fecha de finalización

$timestamp_f_Inicio = $timestamp_f_Fin - (($numero_dia_f_Fin - 1) * 24 * 60 * 60); // Calcular la fecha de inicio de semana (Lunes)

$fecha_L = date("d-m-Y", $timestamp_f_Inicio);
$fecha_M = date("d-m-Y", $timestamp_f_Inicio + (24 * 60 * 60));
$fecha_Mi = date("d-m-Y", $timestamp_f_Inicio + (2 * 24 * 60 * 60));
$fecha_J = date("d-m-Y", $timestamp_f_Inicio + (3 * 24 * 60 * 60));
$fecha_V = date("d-m-Y", $timestamp_f_Fin);

$resumen_L = $_POST["resumen_L"];
$resumen_M = $_POST["resumen_M"];
$resumen_Mi = $_POST["resumen_Mi"];
$resumen_J = $_POST["resumen_J"];
$resumen_V = $_POST["resumen_V"];

// Actualizar los datos en la base de datos
$sql = "UPDATE borradores SET matricula='$matricula', nombres='$nombres', apellidos='$apellidos', carrera='$carrera', empresa='$empresa', tutor='$tutor', instructor='$instructor', semana='$semana', f_Inicio='$f_Inicio', f_Fin='$f_Fin', cuatrimestre='$cuatrimestre', fecha_L='$fecha_L', resumen_L='$resumen_L', fecha_M='$fecha_M', resumen_M='$resumen_M', fecha_Mi='$fecha_Mi', resumen_Mi='$resumen_Mi', fecha_J='$fecha_J', resumen_J='$resumen_J', fecha_V='$fecha_V', resumen_V='$resumen_V' WHERE id='$idReporte'";

if ($conn->query($sql) === TRUE) {
    echo "Borrador actualizado exitosamente.";
} else {
    echo "Error al actualizar el borrador: " . $conn->error;
}

$conn->close();
?>
