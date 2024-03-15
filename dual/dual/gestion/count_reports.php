<?php
session_start(); // Inicia la sesión
include("../templates/conexion.php");
$idAlumno = $_SESSION['idAlumno']; // Asegúrate de que esta sesión exista
$query = "SELECT COUNT(*) AS total FROM reportes WHERE idAlumno = $idAlumno";
$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    echo $row['total'];
} else {
    die('Error realizando la consulta: ' . $conn->error);
}

$conn->close();
?>



