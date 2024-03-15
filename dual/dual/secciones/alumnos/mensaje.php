<?php
include("../../templates/conexion.php");

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$matricula = $_POST['matricula'];
$carrera = $_POST['carrera'];
$empresa = $_POST['empresa'];
$cuatrimestre = $_POST['cuatrimestre'];
$ingreso = date("Y-m-d H:i:s");
$estatus_alumno = $_POST['estatus_alumno'];
$duracion = $_POST['duracion'];
$ingreso = $_POST['ingreso'];
$fecha_fin = $_POST['fecha_fin'];
$usuario = $_POST['matricula'];
$password = $_POST['password'];

$query = "INSERT INTO alumnos (nombres, apellidos, matricula, carrera, idEmpresa, cuatrimestre, usuario, password, estatus_alumno, duracion, ingreso, fecha_fin) 
          VALUES ('$nombres', '$apellidos', '$matricula', '$carrera', '$empresa', '$cuatrimestre', '$usuario', '$password', '$estatus_alumno', '$duracion', '$ingreso', '$fecha_fin')";

$respuesta = mysqli_query($conn, $query);

if ($respuesta) {
    $msg = "Se agregó correctamente el alumno.";
} else {
    $msg = "Error... intente de nuevo.";
}

mysqli_close($conn);
header("Location: alumnos.php?msg=$msg");
?>