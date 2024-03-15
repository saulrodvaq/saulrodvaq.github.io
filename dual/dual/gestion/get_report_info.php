<?php
include("../templates/conexion.php");

// Asegurarte de que el ID de reporte es seguro para usarlo en la consulta SQL
$idReporte = intval($_GET['id']);

// Ejecutar consulta SQL para obtener la información de retro_tutor y retro_formador
$sql = "SELECT retro_tutor, retro_instructor FROM reportes WHERE idReporte = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idReporte);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

// Devolver el resultado como un objeto JSON
header('Content-Type: application/json');
echo json_encode($data);

// Cerrar la conexión a la base de datos
$conn->close();
?>