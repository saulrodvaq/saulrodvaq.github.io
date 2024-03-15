<?php
include("../../templates/conexion.php");

$nombre = $_POST['nombre'];

$query = "INSERT INTO carreras (nombre) 
          VALUES ('$nombre')";

$respuesta = mysqli_query($conn, $query);

if ($respuesta) {
    $msg = "Se agregó correctamente la carrera.";
} else {
    $msg = "Error... intente de nuevo.";
}

mysqli_close($conn);
header("Location: catalogo.php?msg=$msg");
?>