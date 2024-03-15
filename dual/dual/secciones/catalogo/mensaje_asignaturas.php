<?php
include("../../templates/conexion.php");

$nombre = $_POST['nombre'];
$competencia = $_POST['competencia'];
$idCuatrimestre = $_POST['idCuatrimestre'];
$idCarrera = $_POST['idCarrera'];

$query = "INSERT INTO asignaturas (nombre, competencia, idCuatrimestre, idCarrera) 
          VALUES ('$nombre','$competencia','$idCuatrimestre','$idCarrera')";

$respuesta = mysqli_query($conn, $query);

if ($respuesta) {
    $msg = "Se agregó correctamente la asignatura.";
} else {
    $msg = "Error... intente de nuevo.";
}

mysqli_close($conn);
header("Location: ver_asignaturas.php?idCarrera=$idCarrera");
?>