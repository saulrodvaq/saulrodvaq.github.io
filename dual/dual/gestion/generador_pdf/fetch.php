<?php
session_start();
include("../../templates/conexion.php");

$idAlumno = $_SESSION['idAlumno'];

$perPage = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$start = ($page-1) * $perPage;

// Obtener la fecha de inicio y fin de la semana actual
$currentDate = date('Y-m-d');
$weekStart = date('Y-m-d', strtotime('monday this week', strtotime($currentDate)));
$weekEnd = date('Y-m-d', strtotime('sunday this week', strtotime($currentDate)));

$query = "SELECT * FROM borradores WHERE idAlumno = $idAlumno AND F_Fin >= '$weekStart' AND F_Fin <= '$weekEnd' ORDER BY idBorrador DESC LIMIT $start, $perPage";

$respuesta = mysqli_query($conn, $query);

if (!$respuesta) {
    die('Error realizando la consulta: ' . $conn->error);
}

$rows = [];
while($row = mysqli_fetch_assoc($respuesta)) {
    $rows[] = $row;
}

echo json_encode($rows); // Retornar los datos en formato JSON

$conn->close();
?>